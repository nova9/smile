<?php

namespace App\Livewire\Admin\Dashboard;

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

    public function mount()
    {
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->attribute = $user->attributes()->get()->pluck('pivot.value', 'name')->all();

        $this->completion = $user->profileCompletionPercentage();

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
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:20',

        ]);

        auth()->user()->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $this->profile_picture = $this->profile_picture ?? 'IMG';

        $skillsValue = (is_array($this->skills) && count($this->skills) > 0) ? json_encode($this->skills) : null;


    }

    protected function insertUserAttributes(array $attributes)
    {
        $attributesToSync = [];
        $i = 1;
        foreach ($attributes as $val) {
            if (!empty($val)) {
                $attributesToSync[$i] = ['value' => $val];
            }
            $i++;
        }
        if (!empty($attributesToSync)) {
            auth()->user()->attributes()->syncWithoutDetaching($attributesToSync);
        }

        return redirect()->route('profile');
    }



    public function render()
    {
        return view('livewire.admin.dashboard.profile');
    }
}
