<?php

namespace App\Livewire\Volunteer\Dashboard\Eventz;

use App\Models\Event;
use Livewire\Component;

class Show extends Component
{
    public $event;

    public function join()
    {
        $this->event->users()->attach(auth()->user()->id);
        return redirect('/volunteer/dashboard/applications');
    }

    public function mount($id)
    {
        $this->event = Event::query()->with(['address', 'users'])->find($id);
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.events.show');
    }
}
