<?php

namespace App\Livewire\Volunteer\Dashboard;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public $profile;
    public  function mount()
    {
//            $this->profile=User::with()
    }
    public function render()
    {
        return view('livewire.volunteer.dashboard.profile');
    }
}
