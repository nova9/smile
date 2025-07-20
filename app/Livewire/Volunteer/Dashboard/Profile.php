<?php

namespace App\Livewire\Volunteer\Dashboard;

use Livewire\Attributes\On;
use Livewire\Component;

class Profile extends Component

{
    public $attribute;
    //    public $skills;
    public $completion;
    public $profile;
    public $name;
    public $email;
    public $contact_number;
    public $gender;
    public $profile_picture;
    public $location;
    public $availableSkills;
    public $skills = [];
    //    public $availableTags;
    public $newSkill = '';
    public $latitude;
    public $longitude;
    public $age; // Age attribute



    public function mount()
    {
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;


        $this->attribute = $user->attributes()->get()->pluck('pivot.value', 'name')->all();
        //        $this->skills = $user->attributes()->where('name', 'skills')->get()->pluck('pivot.value')->all();
        $this->availableSkills = ['Communication', 'Laughing'];

        $this->completion = $user->isProfileCompletionPercentage(
            $this->attribute['contact_number'] ?? '',
            $this->attribute['skills'] ?? '',
            $this->attribute['latitude'] ?? '',
            $this->attribute['longitude'] ?? '',
            $this->attribute['gender'] ?? '',
            $this->attribute['profile_picture'] ?? '',
            $this->attribute['age'] ?? ''
        );


        $this->contact_number = $user->attributes()->where('name', 'contact_number')->get()->pluck('pivot.value')->first();
       if ($this->latitude === null) {
           $this->latitude = $user->attributes()->where('name', 'latitude')->get()->pluck('pivot.value')->first();
       }
       if ($this->longitude === null) {
           $this->longitude = $user->attributes()->where('name', 'longitude')->get()->pluck('pivot.value')->first();
       }
        $this->gender = $user->attributes()->where('name', 'gender')->get()->pluck('pivot.value')->first();
        $this->profile_picture = $user->attributes()->where('name', 'profile_picture')->get()->pluck('pivot.value')->first();
        $this->age = $user->attributes()->where('name', 'age')->get()->pluck('pivot.value')->first(); // Initialize age
    }


    public function save()
    {
        // Update user basic info
        auth()->user()->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $this->profile_picture = $this->profile_picture ?? '';
        $this->skills = $this->attribute['skills'] ?? '';
        // dd($this->latitude);


        auth()->user()->attributes()->syncWithoutDetaching([
            2 => ['value' => $this->age], // Age added as the second attribute
            3 => ['value' => $this->latitude],
            4 => ['value' => $this->longitude],
            5 => ['value' => $this->contact_number],
            6 => ['value' => $this->gender],
            7 => ['value' => $this->profile_picture],
        ]);



        session()->flash('success', 'Profile updated successfully!');
        return redirect()->route('profile');
    }

    #[On('coordinates')]
    public function handleNewPost($lat = null, $lng = null)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
    }
    public function addSkill()
    {
        if (empty(trim($this->newSkill))) {
            return;
        }

        $skillName = trim($this->newSkill);

        // Check if tag already exists in the selected skills
        if (!in_array($skillName, $this->skills)) {
            $this->skills[] = $skillName;
        }

        $this->newSkill = '';
    }

    public function removeSkill($index)
    {
        if (isset($this->skills[$index])) {
            unset($this->skills[$index]);
            $this->skills = array_values($this->skills); // Re-index array
        }
    }

    public function addExistingSkill($skillName)
    {
        if (!in_array($skillName, $this->skills)) {
            $this->skills[] = $skillName;
        }
    }



    public function render()
    {
        return view('livewire.volunteer.dashboard.profile');
    }
}
