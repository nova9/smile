<?php

namespace App\Livewire\Volunteer\Dashboard\Eventz;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.volunteer.dashboard.events.index', [
            'events' => Event::query()
                ->with(['category', 'tags', 'address', 'user'])
                ->orderBy('created_at', 'asc')
                ->paginate(12)
        ]);
    }
}
