<?php

namespace App\Livewire\Volunteer\Dashboard\MyEvents;

use Livewire\Component;

class Index extends Component
{
    public $participatingEvents;
    public $confirmedEvents;
    public $pendingEvents;

    public function mount()
    {
        $this->participatingEvents = auth()->user()->participatingEvents()->orderBy('created_at', 'desc')->get();
        // dd($this->participatingEvents[0]->pivot->status);
        $this->confirmedEvents =$this->participatingEvents->filter(function($event){
            return $event->pivot->status === 'accepted';
        });
        $this->pendingEvents =$this->participatingEvents->filter(function($event){
            return $event->pivot->status === 'pending';
        });

        // dd($this->participatingEvents[0]->category->color);


    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.my-events.index');
    }
}
