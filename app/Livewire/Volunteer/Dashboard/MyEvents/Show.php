<?php

namespace App\Livewire\Volunteer\Dashboard\MyEvents;

use App\Models\Event;
use Livewire\Component;

class Show extends Component
{
    public $event;
    public $status;
    public $volunteers;

    // public function join()
    // {
    //     if (auth()->user()->isProfileCompletionPercentage() != 1) {
    //         return redirect('/volunteer/dashboard/profile')->with('error', 'Please complete your profile before joining an event.');
    //     }
    //     $this->event->users()->attach(auth()->user()->id);
    //     return redirect('/volunteer/dashboard/my-events');
    // }

    public function mount($id)
    {
        // dd($this->event);
  
        $this->event=Event::query()
        ->with(['address','users','category','tags'])
        ->find($id);
        $this->status = $this->event->users->where('id', auth()->id())->first()?->pivot->status;
        $this->volunteers=$this->event->users;


    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.my-events.show');
    }
}
