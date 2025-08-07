<?php

namespace App\Livewire\Volunteer\Dashboard\MyEvents;

use App\Models\Event;
use App\Services\GoogleMaps;
use Livewire\Component;

class Show extends Component
{
    public $event;
    public $status;
    public $volunteers;
    public $city;
    public $tasks;

    // public function join()
    // {
    //     if (auth()->user()->isProfileCompletionPercentage() != 1) {
    //         return redirect('/volunteer/dashboard/profile')->with('error', 'Please complete your profile before joining an event.');
    //     }
    //     $this->event->users()->attach(auth()->user()->id);
    //     return redirect('/volunteer/dashboard/my-events');
    // }

    public function mount($id,GoogleMaps $googleMaps)
    {
        // dd($this->event);
  
        $this->event=Event::query()
        ->with(['address','users','category','tags'])
        ->find($id);
        $this->status = $this->event->users->where('id', auth()->id())->first()?->pivot->status;
        $this->volunteers=$this->event->users;
        $this->city = $googleMaps->getNearestCity($this->event->latitude, $this->event->longitude);
        $this->tasks = $this->event->tasks()->where('parent_id', null)->get();
      


    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.my-events.show');
    }
}
