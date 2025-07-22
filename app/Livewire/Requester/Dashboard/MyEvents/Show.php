<?php

namespace App\Livewire\Requester\Dashboard\MyEvents;

use Livewire\Component;

class Show extends Component
{
    public $event;
    public function mount($id)
    {
        $this->event = auth()->user()->organizingEvents()->find($id);
        dd($this->event->users);
    }

    public function render()
    {
        return view('livewire.requester.dashboard.my-events.show');
    }
}
