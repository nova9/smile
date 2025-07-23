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
        $this->activities = auth()->user()->participatingEvents()
        ->wherePivot('starts_at', '!=', null)
        ->wherePivot('starts_at', '<=', now())
        ->get();
        //pivottable=event_user
        $this->certificates = auth()->user()->participatingEvents()
            ->wherePivot('ends_at', '!=', null)
            // ->wherePivot('ends_at', '<=', now())
            ->get();

        $this->badges = auth()->user()->badges;
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.achievements');
    }
}
