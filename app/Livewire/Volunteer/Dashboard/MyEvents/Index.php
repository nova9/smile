<?php

namespace App\Livewire\Volunteer\Dashboard\MyEvents;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{
    public $participatingEvents;
    public $confirmedEvents;
    public $pendingEvents;
    public $statusFilter = '';
    public $categories;
    public $categoryFilter = '';

    public function mount()
    {
        $this->loadEvents();
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
        $query = auth()->user()->participatingEvents()->orderBy('created_at', 'desc');
        if (!empty($this->statusFilter)) {
            $query->wherePivot('status', $this->statusFilter);
        }
        if (!empty($this->categoryFilter)) {
            $query->where('category_id', $this->categoryFilter);
        }
        $this->participatingEvents = $query->get();
        $this->confirmedEvents = $this->participatingEvents->filter(function ($event) {
            return $event->pivot->status === 'accepted';
        });
        $this->pendingEvents = $this->participatingEvents->filter(function ($event) {
            return $event->pivot->status === 'pending';
        });
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.my-events.index');
    }
}
