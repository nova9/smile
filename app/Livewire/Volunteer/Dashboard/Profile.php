<?php

namespace App\Livewire\Volunteer\Dashboard;

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

    public function mount()
    {
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;


        $this->attribute = $user->attributes()->get()->pluck('pivot.value', 'name')->all();
        $this->skills = $user->attributes()->where('name', 'skills')->get()->pluck('pivot.value')->all();

        if (!empty($this->attribute)) {
            $this->completion = $user->isProfileComplete(
                $this->attribute['contact_number'] ?? '',
                $this->attribute['skills'] ?? '',
                $this->attribute['location'] ?? '',
                $this->attribute['gender'] ?? '',
                $this->attribute['profile_picture'] ?? ''
            );
        }
        $this->contact_number = $user->attributes()->where('name', 'contact_number')->get()->pluck('pivot.value')->first();
        $this->location = $user->attributes()->where('name', 'location')->get()->pluck('pivot.value')->first();
        $this->gender = $user->attributes()->where('name', 'gender')->get()->pluck('pivot.value')->first();
        $this->profile_picture = $user->attributes()->where('name', 'profile_picture')->get()->pluck('pivot.value')->first();
    }


    public function save()
    {
        // Update user basic info
        auth()->user()->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $this->profile_picture = $this->profile_picture?? 'Img';

        auth()->user()->attributes()->syncWithoutDetaching([
            2 => ['value' => $this->location],
            3 => ['value' => $this->contact_number],
            4 => ['value' => $this->gender],
            5 => ['value' => $this->profile_picture],
        ]);



        session()->flash('success', 'Profile updated successfully!');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.profile');
    }
}
