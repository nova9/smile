<?php

namespace App\Livewire\Requester\Dashboard\MyEvents;

use App\Models\Event;
use Livewire\Component;

class Index extends Component
{
    public $search = '';

    public function render()
    {
        $user = auth()->user();

        $events = $user->organizingEvents()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('livewire.requester.dashboard.my-events.index', [
            'events' => $events,
        ]);
    }
}
