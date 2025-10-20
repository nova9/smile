<?php

namespace App\Livewire\Volunteer\Dashboard;

use Livewire\Component;
use App\Models\Category;

class Index extends Component
{

    public $participatingEvents;
    public $totalEvents;
    public $confirmedEvents;
    public $pendingEvents;
    public $completedEvents;
    public $cancelledEvents;
    public $statusFilter = '';
    public $categories;
    public $categoryFilter = '';
    public $search = '';
    public $hoursVolunteered = 0;
    public $certificateIssued;

    public function mount()
    {
        $this->loadEvents();
        $participatingEvents = auth()->user()->participatingEvents;

        foreach ($participatingEvents as $event) {
            // Calculate duration in hours between starts_at and ends_at
            $duration = $event->ends_at->diffInHours($event->starts_at);
            $this->hoursVolunteered += $duration;
        }
        $this->certificateIssued = auth()->user()->
        
    }

    public function updatedStatusFilter()
    {
        $this->loadEvents();
    }
    public function updatedCategoryFilter()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $query = auth()->user()->participatingEvents()
            ->where('is_active', true) // Only show active events
            ->orderBy('created_at', 'desc');
        $this->totalEvents = $query->count();
        if (!empty($this->statusFilter)) {

            $query->wherePivot('status', $this->statusFilter);
        }
        if (!empty($this->categoryFilter)) {
            $query->where('category_id', $this->categoryFilter);
        }
        $this->participatingEvents = $query->get();

        $this->confirmedEvents = auth()->user()->participatingEvents()
            ->where('is_active', true) // Only show active events
            ->wherePivot('status', 'accepted')
            ->wherePivot('ends_at', null)
            ->get();

        $this->completedEvents = auth()->user()->participatingEvents()
            ->where('is_active', true) // Only show active events
            ->wherePivot('status', 'completed')
            ->get();

        $this->pendingEvents = auth()->user()->participatingEvents()
            ->where('is_active', true) // Only show active events
            ->wherePivot('status', 'pending')
            ->get();
        $this->cancelledEvents = auth()->user()
            ->participatingEvents()
            ->where('is_active', true) // Only show active events
            ->wherePivot('status', 'rejected')
            ->get();

        $this->categories = Category::all();
    }

    public function render()
    {
        return view(
            'livewire.volunteer.dashboard.index',
            $participatingEvents = auth()->user()->participatingEvents()
                ->where('is_active', true) // Only show active events
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(5)
        );
    }
}
