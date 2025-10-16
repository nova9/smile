<?php

namespace App\Livewire\Volunteer\Dashboard\MyEvents;

use App\Models\Category;
use Livewire\Component;

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
        $this->totalEvents = $query->count();
        if(!empty($this->statusFilter)){
            
            $query->wherePivot('status',$this->statusFilter);
        }
        if(!empty($this->categoryFilter)){
            $query->where('category_id',$this->categoryFilter);
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

       
            

    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.my-events.index',[
         $participatingEvents= auth()->user()->participatingEvents()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
        ]);
    }
}
