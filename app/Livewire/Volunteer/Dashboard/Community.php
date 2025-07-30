<?php

namespace App\Livewire\Volunteer\Dashboard;

use Livewire\Component;
use App\Models\Event;
use Illuminate\Validation\Rules\ExcludeIf;

class Community extends Component
{


    public $event;
    public $volunteers;
    public function mount($id){
        $this->event=Event::query()
        ->with(['address','users','category','tags'])
        ->find($id);
       
       //exclude me here
        $this->volunteers=$this->event->users;
      
    }
    public function render()
    {
        return view('livewire.volunteer.dashboard.community');
    }
}
