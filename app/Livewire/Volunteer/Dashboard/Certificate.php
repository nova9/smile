<?php

namespace App\Livewire\Volunteer\Dashboard;


use Livewire\Component;
use App\Models\Event;
use App\Models\User;

class Certificate extends Component
{
    public $certificate;
    public $requester;
    public $volunteer_name;
    public $event;
    public $id;

    public function mount($id)
    {
        $this->id = $id;
        $this->event = Event::where('id', $id)->first();
        $certificate = \App\Models\Certificate::where('issued_to', auth()->id())
            ->where('event_id', $id)
            ->first();
            
        // Now $certificate is a single model or null
        if($certificate){
            $this->certificate = $certificate;
            $this->requester = User::where('id', $certificate->issued_by)->first();
            $this->volunteer_name = User::where('id', $certificate->issued_to)->first()->name;
        }



    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.certificate');
    }
}
