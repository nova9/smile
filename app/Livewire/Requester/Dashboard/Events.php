<?php

namespace App\Livewire\Requester\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Events extends Component
{
    public $events;

    public function mount()
    {
        $this->events = Auth::user()->events()->latest()->get();
    }

    public function render()
    {
        return view('livewire.requester.dashboard.events');
    }
}