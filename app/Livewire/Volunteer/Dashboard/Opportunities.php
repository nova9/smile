<?php

namespace App\Livewire\Volunteer\Dashboard;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Opportunities extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.volunteer.dashboard.opportunities', [
            'events' => Event::query()
                ->with(['category', 'tags', 'address', 'user'])
                ->orderBy('created_at', 'asc')
                ->paginate(12)
        ]);
    }
}
