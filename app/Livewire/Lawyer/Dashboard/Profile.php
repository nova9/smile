<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Attributes\On;
use Livewire\Component;

class Profile extends Component
{
    public $attribute;
    public $skills;
    public $completion;
    public $profile;
    public $name;
    public $email;
    public $contact_number;
    public $gender;
    public $profile_picture;
    public $location;
    public $latitude;
    public $longitude;
    public $age;
    // Lawyer-specific attributes
    public $license_number;
    public $specialization;
    public $experience_years;
    public $bar_association;

    public function mount()
    {
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->attribute = $user->attributes()->get()->pluck('pivot.value', 'name')->all();

        $this->completion = $user->isProfileCompletionPercentage();

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
        $this->profile_picture = $user->attributes()->where('name', 'profile_picture')->get()->pluck('pivot.value')->first();
        $this->age = $user->attributes()->where('name', 'age')->get()->pluck('pivot.value')->first();

        // Lawyer-specific attributes
        $this->license_number = $user->attributes()->where('name', 'license_number')->get()->pluck('pivot.value')->first();
        $this->specialization = $user->attributes()->where('name', 'specialization')->get()->pluck('pivot.value')->first();
        $this->experience_years = $user->attributes()->where('name', 'experience_years')->get()->pluck('pivot.value')->first();
        $this->bar_association = $user->attributes()->where('name', 'bar_association')->get()->pluck('pivot.value')->first();
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.profile');
    }
}
