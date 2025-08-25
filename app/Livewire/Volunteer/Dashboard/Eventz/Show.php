<?php

namespace App\Livewire\Volunteer\Dashboard\Eventz;

use App\Models\Event;
use App\Models\User;
use App\Services\GoogleMaps;
use App\Services\Messaging;
use Livewire\Attributes\Session;
use Livewire\Component;

class Show extends Component
{
    public $event;
    public $profileCompletionPercentage;
    public $city;
    public $organizer;
    public $Volunteers;

    public function mount($id, GoogleMaps $googleMaps)
    {
        
         $requiredskills = [
//            'skills'=> 0.1,
            'age' => 0.2,
            'latitude' => 0.1,
            'longitude' => 0.1,
            'contact_number' => 0.1,
            'gender' => 0.2,
            // 'profile_picture' => 0.1
        ];

        $this->profileCompletionPercentage = auth()->user()->profileCompletionPercentage($requiredskills);
        $this->event = Event::query()->with(['address', 'users'])->find($id);
        $this->Volunteers = $this->event->users;
        // dd($this->event);
        $this->organizer = User::find($this->event->user_id);
        // dd($this->organizer);
        $this->city = $googleMaps->getNearestCity($this->event->latitude, $this->event->longitude) ;
    }

    public function join()
    {

        $this->event->userJoinsNotify();
        $this->event->users()->attach(auth()->user()->id);
        return redirect('/volunteer/dashboard/my-events');
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.events.show');
    }

    public function chat()
    {
        $isSuccess = Messaging::initializeDirectChatTo(auth()->user(), $this->event->user);
        $this->dispatch('openChat', chatId: Messaging::getDirectChatTo(auth()->user(), $this->event->user)->id);
    }
}
