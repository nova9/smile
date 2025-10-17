<?php

namespace App\Livewire\Volunteer\Dashboard;

use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class Reviews extends Component
{

    public $reviews;
    public $events;
    public function mount()
    {
        $this->reviews = auth()->user()->reviews;
        $this->events = auth()->user()->participatingEvents;
        
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.reviews', [
            'reviews' => $this->reviews
        ]);
    }

}
