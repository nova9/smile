<?php

namespace App\Livewire\Volunteer\Dashboard\Eventz;

use App\Models\Event;
use Livewire\Component;

class Show extends Component
{
    public $event;
    public $profileCompletionPercentage;

    public function mount($id)
    {
        $this->profileCompletionPercentage = auth()->user()->profileCompletionPercentage();
        $this->event = Event::query()->with(['address', 'users'])->find($id);
    }

    public function join()
    {
        $this->event->users()->attach(auth()->user()->id);
        return redirect('/volunteer/dashboard/my-events');
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.events.show');
    }
}
