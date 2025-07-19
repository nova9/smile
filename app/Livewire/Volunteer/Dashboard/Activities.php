<?php

namespace App\Livewire\Volunteer\Dashboard;

use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class Activities extends Component
{
    public $activities;
    public $certificates;
    public $badges;
    public function mount()
    {
        $this->activities = auth()->user()->participatingEvents()->wherePivot('starts_at','!=',null)->get();
        //pivottable=event_user
        $this->certificates = auth()->user()->participatingEvents()->wherePivot('ends_at','!=', null)->get();

        $this->badges = auth()->user()->badges;


    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.activities');
    }
}
