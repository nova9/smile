<?php

namespace App\Livewire;

use App\Jobs\GenerateEmbedding;
use App\Models\Attribute;
use App\Models\File;
use App\Services\Kyc;
use Aws\Exception\AwsException;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Signup extends Component
{
    use WithFileUploads;

    public $step = 1;

    public $selfie;
    public $selfie_url;

    public $verified = false;
    #[Validate]
    public $front_image;

    #[Validate]
    public $back_image;
    public $document_type = 'national_id';

    #[Validate]
    public $role = '';

    #[Validate]
    public $name = '';

    #[Validate]
    public $password = '';

    #[Validate]
    public $password_confirmation = '';

    #[Validate]
    public $email = '';

    #[Validate]
    public $tos = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Password::default()],
            'password_confirmation' => 'same:password',
            'tos' => 'accepted',
            'role' => 'required|in:volunteer,requester',
            'selfie' => 'required|string',
            'front_image' => 'required|image|max:10240',
            'back_image' => 'required|image|max:10240',
            'document_type' => 'required|in:national_id,passport,driving_license',
        ];
    }

    protected function messages()
    {
        return [
            'tos.accepted' => 'You must accept the terms of service to signup.',
            'role.required' => 'What would you like to do?',
            'selfie.required' => 'Selfie is required.',
            'front_image.required' => 'Image of the document is required.',
        ];
    }

    public function capture($base64Image)
    {
        $this->selfie = $this->storeBase64Image($base64Image);
        $this->selfie_url = $this->getTemporaryUrl($this->selfie);
        $this->resetErrorBag();
    }

    public function retake()
    {
        $this->selfie = null;
        $this->selfie_url = null;
        $this->verified = false;
    }

    public function navigate(int $from, int $to)
    {
        if ($from === 1 && $to === 2) {
            $fields = ['name', 'email', 'password', 'password_confirmation'];
            $this->validate(Arr::only($this->rules(), $fields));
        }

        if ($from === 2 && $to === 3) {
            $this->validate(Arr::only($this->rules(), ['role']));
        }

        if ($from === 3 && $to === 4) {
            $this->validate(Arr::only($this->rules(), ['selfie']));
        }

        if ($from === 4 && $to === 5) {
        }

        $this->step = $to;
    }

    public function verify()
    {
        Log::info('Verifying documents...');
        if ($this->document_type !== 'passport') {
            $this->validate(Arr::only($this->rules(), ['back_image', 'front_image', 'selfie']));
        } else {
            $this->validate(Arr::only($this->rules(), ['front_image', 'selfie']));
        }

        $selfieImage = Storage::get($this->selfie);
        $frontImage = $this->front_image->get();

        [$isValid, $error] = Kyc::isValid($frontImage, $selfieImage);

        if ($isValid) {
            $this->verified = true;
        } else {
            $this->addError('front_image', $error);
        }
    }

    public function save()
    {
        if ($this->document_type !== 'passport') {
            $validated = $this->validate();
        } else {
            $this->validate(Arr::except($this->rules(), ['back_image']));
        }

        $fronImagePath = $this->front_image->store(path: 'files');
        $backImagePath = $this->back_image->store(path: 'files');
        $selfiePath = 'files/' . basename($this->selfie);

        Storage::move($this->selfie, $selfiePath);

        $frontImageFile = File::query()->create(['name' => $fronImagePath]);
        $backImageFile = File::query()->create(['name' => $backImagePath]);
        $selfieFile = File::query()->create(['name' => $selfiePath]);



        $role = \App\Models\Role::where('name', $validated['role'])->firstOrFail();
        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role_id' => $role->id,
        ]);


        $attributes = Attribute::whereIn('name', ['front_image', 'back_image', 'selfie', 'document_type', 'date_of_birth'])->get()->keyBy('name');
        $frontImageAttribute = $attributes['front_image'] ?? null;
        $backImageAttribute = $attributes['back_image'] ?? null;
        $selfieAttribute = $attributes['selfie'] ?? null;
        $documentTypeAttribute = $attributes['document_type'] ?? null;
        $dateOfBirthAttribute = $attributes['date_of_birth'] ?? null;

        $dateOfBirth = Kyc::getDateOfBirth($this->front_image->get(), $this->back_image->get());

        $user->attributes()->attach([
            $frontImageAttribute->id => [
                'value' => $frontImageFile->id,
            ],
            $backImageAttribute->id => [
                'value' => $backImageFile->id,
            ],
            $selfieAttribute->id => [
                'value' => $selfieFile->id,
            ],
            $documentTypeAttribute->id => [
                'value' => $validated['document_type'],
            ],
            $dateOfBirthAttribute->id => [
                'value' => $dateOfBirth,
            ],
        ]);

        GenerateEmbedding::dispatch($user, textToEmbed: json_encode($user->getAllAttributes()));


        auth()->login($user);
        
        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }

    public function render()
    {
        return view('livewire.signup');
    }

    protected function getExtensionFromBase64($base64String)
    {
        // Check if the string contains a data URI prefix
        if (preg_match('/^data:image\/(\w+);base64/', $base64String, $matches)) {
            return $matches[1]; // Returns 'png', 'jpeg', 'jpg', 'gif', etc.
        }
        return null; // No valid extension found
    }

    protected function storeBase64Image($base64Image)
    {
        if (str_starts_with($base64Image, 'data:image')) {
            [$typeInfo, $encoded] = explode(',', $base64Image);
            $decoded = base64_decode($encoded);

            // get the file type from $typeInfo
            $extension = $this->getExtensionFromBase64($typeInfo);

            $filename = 'temp/' . uniqid(more_entropy: true) . '.' . $extension;
            Storage::put($filename, $decoded);

            return $filename;
        }
        return null;
    }

    protected function getTemporaryUrl($filename)
    {
        return Storage::temporaryUrl($filename, now()->addMinutes(15));
    }
}
