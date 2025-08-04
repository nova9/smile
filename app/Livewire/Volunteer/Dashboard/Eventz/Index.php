<?php

namespace App\Livewire\Volunteer\Dashboard\Eventz;

use App\Models\Event;
use App\Services\GoogleMaps;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public function mount(GoogleMaps $googleMaps)
    {
        dd($googleMaps->getNearestCity('7.8731', '80.7718'));
    }

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
