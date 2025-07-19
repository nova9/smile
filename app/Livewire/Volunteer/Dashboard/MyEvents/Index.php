<?php

namespace App\Livewire\Volunteer\Dashboard\MyEvents;

use Livewire\Component;

class Index extends Component
{
    public $participatingEvents;

    public function mount()
    {
        $this->participatingEvents = auth()->user()->participatingEvents;
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.my-events.index');
    }
}
