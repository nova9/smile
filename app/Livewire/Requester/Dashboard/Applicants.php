<?php

namespace App\Livewire\Requester\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Applicants extends Component
{
    public $applicants;

    public function mount()
    {
        $this->applicants = Auth::user()->events()
            ->with(['applications.user'])
            ->get()
            ->flatMap(function($event) {
                return $event->applications;
            });
    }

    public function render()
    {
        return view('livewire.requester.dashboard.applicants');
    }
}
