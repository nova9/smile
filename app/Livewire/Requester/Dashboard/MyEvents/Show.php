<?php

namespace App\Livewire\Requester\Dashboard\MyEvents;

use Livewire\Component;

class Show extends Component
{
    public $event;
    public $pendingUsers;
    public $acceptedUsers;
    public function mount($id)
    {
        $this->event = auth()->user()->organizingEvents()->find($id);
        $this->pendingUsers = $this->event->users->where('pivot.status', 'pending');
        $this->acceptedUsers = $this->event->users->where('pivot.status', 'accepted');
    }

    public function approve($userId)
    {
        $this->event->users()->updateExistingPivot($userId, ['status' => 'accepted']);
        $this->pendingUsers = $this->event->users->where('pivot.status', 'pending');
        $this->acceptedUsers = $this->event->users->where('pivot.status', 'accepted');
    }

    public function render()
    {
        return view('livewire.requester.dashboard.my-events.show');
    }
}
