<?php

namespace App\Livewire\Volunteer\Dashboard;

use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class Achievements extends Component
{
    public $activities;
    public $certificates;
    public $badges;
    public function mount()
    {
       
       
        //pivottable=event_user
        $this->certificates = auth()->user()->participatingEvents()
            ->wherePivot('status','=','accepted')
            ->wherePivot('ends_at', '<', now())
            ->get();
        // dd($this->certificates);

        $this->badges = auth()->user()->badges;
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.achievements');
    }
}
