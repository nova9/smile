<?php

namespace App\Livewire\Volunteer\Dashboard\Eventz;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

//    public function updatingSearch()
//    {
//        $this->resetPage();
//    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.events.index', [
            'events' => Event::query()
                ->with(['category', 'tags', 'address', 'user'])
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(12)
        ]);
    }
}
