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
    public $event_name;
    public $event_des;
    public function mount()
    {
       
       
        //pivottable=event_user
        $this->certificates = auth()->user()->certificates;
        $this->event_name = Event::find($this->certificates->first()->event_id)->name;
        $this->event_des = Event::find($this->certificates->first()->event_id)->description;
        $this->badges = auth()->user()->badges;
        
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.achievements');
    }
}
