<?php

namespace App\Livewire\Volunteer\Dashboard;

use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class Achievements extends Component
{
    public $activities;
    public $certificates = [];
    public $badges;
    public $event_name;
    public $event_des;
    public function mount()
    {


        //pivottable=event_user
        $user = auth()->user();
        $this->certificates = $user ? $user->certificates->toArray() : [];
        if (!empty($this->certificates)) {
            $eventId = $this->certificates[0]['event_id'] ?? null;
            if ($eventId) {
                $event = Event::find($eventId);
                if ($event) {
                    $this->event_name = $event->name;
                    $this->event_des = $event->description;
                }
            }
        }

        $this->badges = $user ? $user->badges : [];
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.achievements');
    }
}
