<?php

namespace App\Livewire\Volunteer\Dashboard;

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
    public $age; // Age attribute



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
        $this->age = $user->attributes()->where('name', 'age')->get()->pluck('pivot.value')->first(); // Initialize age
    }


    public function save()
    {
        // Validation
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'skills' => 'nullable|array',
            'age' => 'nullable|integer|min:1|max:120',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'contact_number' => 'nullable|string|max:20',
            'gender' => 'nullable|string|in:male,female,other,prefer_not_to_say',
            'profile_picture' => 'nullable|string|max:255',
        ]);

        // Update user basic info
        // auth()->user()->update([
        //     'name' => $this->name,
        //     'email' => $this->email,
        // ]);
        $this->profile_picture = $this->profile_picture ?? 'IMG';

        $skillsValue = (is_array($this->skills) && count($this->skills) > 0) ? json_encode($this->skills) : null;
        $newattributes = [
            'skills' => $skillsValue,
            'age' => $this->age,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'contact_number' => $this->contact_number,
            'gender' => $this->gender,
            'profile_picture' => $this->profile_picture,
        ];


        $this->insertUserAttributes($newattributes);
    }

    /**
     * Insert or update user attributes (only non-empty values).
     * @param array $attributes
     */
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

        session()->flash('success', 'Profile updated successfully!');
        return redirect()->route('profile');
    }

    #[On('coordinates')]
    public function handleNewPost($lat = null, $lng = null)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
    }




    public function render()
    {
        return view('livewire.volunteer.dashboard.profile');
    }
}
