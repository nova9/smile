<?php

namespace App\Livewire\Requester\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $totalEvents;
    public $activeEvents;
    public $pendingApplications;

    public function mount()
    {
        $user = Auth::user();
        $this->totalEvents = $user->events()->count();
        $this->activeEvents = $user->events()->where('status', 'active')->count();
        $this->pendingApplications = $user->events()->where('user_id', auth()->id())->get();

    }

    public function render()
    {
        return view('livewire.requester.dashboard.index');
    }
}
