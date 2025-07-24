<?php

namespace App\Livewire\Volunteer\Dashboard;

use Livewire\Component;
use App\Models\Event;

class Community extends Component
{


    public $event;
    public function mount($id){
        $this->event=Event::query()
        ->with(['address','users','category','tags'])
        ->find($id);
    }
    public function render()
    {
        return view('livewire.volunteer.dashboard.community');
    }
}
