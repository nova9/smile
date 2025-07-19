<?php

namespace App\Livewire\Requester\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $name, $email;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();
        session()->flash('success', 'Profile updated!');
    }

    public function render()
    {
        return view('livewire.requester.dashboard.profile');
    }
}
