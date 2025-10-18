<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\Event;

class EventDetails extends Component
{
    public $event;
    public $id;

    public function mount($id)
    {
        $this->id = $id;
        $this->event = Event::with(['user', 'category', 'users', 'reports.user', 'tags'])
            ->withCount(['reports' => function ($query) {
                $query->where('status', 'pending');
            }])
            ->findOrFail($id);
    }

    public function toggleEventStatus()
    {
        $this->event->update(['is_active' => !$this->event->is_active]);
        $this->event->refresh();
        
        $status = $this->event->is_active ? 'visible' : 'hidden';
        session()->flash('message', "Event is now {$status} to volunteers!");
    }

    public function dismissReports()
    {
        $this->event->reports()
            ->where('status', 'pending')
            ->update(['status' => 'dismissed']);
        
        $this->event->refresh();
        session()->flash('message', 'Reports dismissed successfully!');
    }

    public function render()
    {
        return view('livewire.admin.dashboard.event-details');
    }
}
