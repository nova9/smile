<?php

namespace App\Livewire\Requester\Dashboard;

use App\Services\FileManager;
use Illuminate\Support\Arr;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component

{
    use WithFileUploads;
    public $attribute;
    public $completion;
    public $name;
    public $email;
    public $contact_number;
    public $logo;
    public $user;
    public $is_verified = false;
    public $address;
    public $description;
    public $verification_details;
    public $registration_number;
    public $legal_status;
    public $credentials;
    public $verification_document;
    public $latitude;
    public $longitude;

    #[Validate]
    public $profile_picture;

    public $profile_picture_url;

    public function rules()
    {
        return [
            'profile_picture' => 'nullable|image|max:10240', // 10MB max size
        ];
    }


    public function mount()
    {
        $this->user = auth()->user();

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->attribute = $this->user->attributes()->get()->pluck('pivot.value', 'name')->all();

        $requiredskills = [
            'name' => 0.1,
            'email' => 0.1,
            'contact_number' => 0.1,
            'address' => 0.1,
            'description' => 0.1,
            'verification_details' => 0.1,
            'logo' => 0.05,
            'latitude' => 0.1,
            'longitude' => 0.1,
        ];

        $this->completion = $this->user->profileCompletionPercentage($requiredskills);

        $this->profile_picture_url = FileManager::getTemporaryUrl(auth()->user()->getCustomAttribute('profile_picture'));


        $this->contact_number = $this->user->attributes()->where('name', 'contact_number')->get()->pluck('pivot.value')->first();
        $this->logo = $this->user->attributes()->where('name', 'logo')->get()->pluck('pivot.value')->first();
           if ($this->latitude === null) {
            $this->latitude = $this->user->attributes()->where('name', 'latitude')->get()->pluck('pivot.value')->first();
        }
        if ($this->longitude === null) {

            $this->longitude = $this->user->attributes()->where('name', 'longitude')->get()->pluck('pivot.value')->first();
        }
        $this->description = $this->user->attributes()->where('name', 'description')->get()->pluck('pivot.value')->first();
        $verificationDetails = json_decode($this->user->attributes()->where('name', 'verification_details')->get()->pluck('pivot.value')->first() ?? '{}', true);
        $this->registration_number = $verificationDetails['registration_number'] ?? '';
        $this->legal_status = $verificationDetails['legal_status'] ?? '';
        $this->credentials = $verificationDetails['credentials'] ?? '';
        $this->verification_document = $verificationDetails['verification_document'] ?? null;
    }

    public function saveProfilePicture()
    {
        $this->validate(Arr::only($this->rules(), ['profile_picture']));
        $file = FileManager::store($this->profile_picture);
        auth()->user()->setCustomAttribute('profile_picture', $file->id);
        session()->flash('success', 'Profile picture updated successfully!');
        $this->redirect('/requester/dashboard/profile');
    }


    public function save()
    {


        $verificationDetails = [
            'registration_number' => $this->registration_number,
            'legal_status' => $this->legal_status,
            'credentials' => $this->credentials,
            'verification_document' => $this->verification_document, // handle file upload separately
        ];

        auth()->user()->setCustomAttribute('contact_number', $this->contact_number);
        // auth()->user()->setCustomAttribute('address', $this->address);
        auth()->user()->setCustomAttribute('latitude', $this->latitude);
        auth()->user()->setCustomAttribute('longitude', $this->longitude);
        auth()->user()->setCustomAttribute('description', $this->description);
        auth()->user()->setCustomAttribute('verification_details', json_encode($verificationDetails));
    }




    public function render()
    {
        return view('livewire.requester.dashboard.profile');
    }
}
