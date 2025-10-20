<?php

namespace App\Livewire\Volunteer\Dashboard\MyEvents;

use App\Models\Category;
use App\Models\Event;
use App\Models\Favourites;
use Livewire\Component;
use Livewire\Attributes\Url;

class Index extends Component
{
    public $participatingEvents;
    public $favouriteEvents;
    public $totalEvents;
    public $confirmedEvents;
    public $pendingEvents;
    public $completedEvents;
    public $cancelledEvents;
    public $statusFilter = '';
    public $categories;
    public $categoryFilter = '';
    public $favouriteEventsFilter = false;
    public $search = '';

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
    public function updatedFavouriteEventsFilter()
    {
        $this->loadEvents();
    }

    public function updatedSearch()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->favouriteEvents = Favourites::where('user_id', auth()->id())->get();
        $query = auth()->user()->participatingEvents()->orderBy('created_at', 'desc');
        $this->totalEvents = $query->count();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('events.name', 'like', '%' . $this->search . '%')
                    ->orWhere('events.description', 'like', '%' . $this->search . '%')
                    ->orWhere('events.notes', 'like', '%' . $this->search . '%');
            });
        }
    
    
        if (!empty($this->statusFilter)) {
            $query->wherePivot('status', $this->statusFilter);
        }
        if (!empty($this->categoryFilter)) {
            $query->where('category_id', $this->categoryFilter);
        }
        if ($this->favouriteEventsFilter) {
            $query->whereIn('events.id', $this->favouriteEvents->pluck('event_id'));
        }
        $this->participatingEvents = $query->get();
        $this->confirmedEvents = auth()->user()->participatingEvents()
            ->wherePivot('status', 'accepted')
            ->wherePivot('ends_at', null)
            ->get();

        $this->completedEvents = auth()->user()->participatingEvents()
            ->wherePivot('status', 'completed')
            ->get();
        $this->pendingEvents = auth()->user()->participatingEvents()
            ->wherePivot('status', 'pending')
            ->get();
        $this->cancelledEvents = auth()->user()
            ->participatingEvents()
            ->wherePivot('status', 'rejected')
            ->get();


        $this->categories = Category::all();
        //    dd($this->participatingEvents);



    }


    public function render()
    {
        return view('livewire.volunteer.dashboard.my-events.index');
    }
}
