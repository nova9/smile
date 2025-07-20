<?php

namespace App\Livewire\Requester\Dashboard\MyEvents;

use App\Models\Event;
use Livewire\Component;

class Index extends Component
{

    public $events;
    public function mount(){
        $user=auth()->user();
        $this->events=$user->organizingEvents;
    }
    public function render()
    {
        return view('livewire.requester.dashboard.my-events.index');
    }
}
