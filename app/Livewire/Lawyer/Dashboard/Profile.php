<?php

namespace App\Livewire\Lawyer\Dashboard;

use App\Services\FileManager;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $attribute;
    public $skills = [];
    public $name;
    public $email;
    public $contact_number;
    public $gender;
    public $profile_picture;
    public $profile_picture_url;
    public $latitude;
    public $longitude;
    public $age;
    // Lawyer-specific attributes
    public $license_number;
    public $specialization;
    public $experience_years;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'age' => 'nullable|integer|min:18|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'skills' => 'nullable|array',
            'profile_picture' => 'nullable|image|max:10240',
            // Lawyer-specific validation
            'license_number' => 'nullable|string|max:100',
            'specialization' => 'nullable|string|max:100',
            'experience_years' => 'nullable|integer|min:0|max:70',
        ];
    }

    public function mount()
    {
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->attribute = $user->attributes()->get()->pluck('pivot.value', 'name')->all();

        // Lawyer profile doesn't need completion percentage (admin sets up the profile)
        $this->profile_picture_url = FileManager::getTemporaryUrl($user->getCustomAttribute('profile_picture'));

        $this->contact_number = $user->attributes()->where('name', 'contact_number')->get()->pluck('pivot.value')->first();

        $skillsRaw = $user->attributes()->where('name', 'skills')->get()->pluck('pivot.value')->first();
        $this->skills = $skillsRaw ? json_decode($skillsRaw, true) ?? [] : [];

        if ($this->latitude === null) {
            $this->latitude = $user->attributes()->where('name', 'latitude')->get()->pluck('pivot.value')->first();
        }
        if ($this->longitude === null) {
            $this->longitude = $user->attributes()->where('name', 'longitude')->get()->pluck('pivot.value')->first();
        }
        $this->gender = $user->attributes()->where('name', 'gender')->get()->pluck('pivot.value')->first();
        $this->age = $user->attributes()->where('name', 'age')->get()->pluck('pivot.value')->first();

        // Lawyer-specific attributes
        $this->license_number = $user->attributes()->where('name', 'license_number')->get()->pluck('pivot.value')->first();
        $this->specialization = $user->attributes()->where('name', 'specialization')->get()->pluck('pivot.value')->first();
        $this->experience_years = $user->attributes()->where('name', 'experience_years')->get()->pluck('pivot.value')->first();
    }

    public function saveProfilePicture()
    {
        $this->validate(Arr::only($this->rules(), ['profile_picture']));
        $file = FileManager::store($this->profile_picture);
        auth()->user()->setCustomAttribute('profile_picture', $file->id);
        session()->flash('success', 'Profile picture updated successfully!');
        return $this->redirect('/lawyer/dashboard/profile');
    }

    public function save()
    {
        $this->validate(Arr::except($this->rules(), ['profile_picture']));

        $user = auth()->user();

        // Update basic info
        $user->update(['name' => $this->name]);

        // Update custom attributes
        $user->setCustomAttribute('contact_number', $this->contact_number);
        $user->setCustomAttribute('gender', $this->gender);
        $user->setCustomAttribute('age', $this->age);
        $user->setCustomAttribute('latitude', $this->latitude);
        $user->setCustomAttribute('longitude', $this->longitude);
        $user->setCustomAttribute('skills', json_encode($this->skills));

        // Update lawyer-specific attributes
        $user->setCustomAttribute('license_number', $this->license_number);
        $user->setCustomAttribute('specialization', $this->specialization);
        $user->setCustomAttribute('experience_years', $this->experience_years);

        session()->flash('success', 'Profile updated successfully!');
        return $this->redirect('/lawyer/dashboard/profile');
    }

    #[On('coordinates')]
    public function handleNewPost($lat = null, $lng = null)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.profile');
    }
}
