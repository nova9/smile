<?php

namespace App\Livewire\Requester\Dashboard;

use Livewire\Component;

class Profile extends Component

{
    public $attribute;
    public $completion;
    public $name;
    public $email;
    public $contact_number;
    public $logo;
    



    public function mount()
    {
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->attribute = $user->attributes()->get()->pluck('pivot.value', 'name')->all();


        $this->completion = $user->isProfileCompletionPercentage();


        $this->contact_number = $user->attributes()->where('name', 'contact_number')->get()->pluck('pivot.value')->first();
        $this->logo = $user->attributes()->where('name', 'logo')->get()->pluck('pivot.value')->first();
    }


    public function save()
    {
        // Update user basic info
        auth()->user()->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $this->logo = $this->logo ?? '';




        auth()->user()->attributes()->syncWithoutDetaching([
            5 => ['value' => $this->contact_number],
            7 => ['value' => $this->logo],
        ]);



        session()->flash('success', 'Profile updated successfully!');
        return redirect()->route('profile');
    }




    public function render()
    {
        return view('livewire.requester.dashboard.profile');
    }
}
