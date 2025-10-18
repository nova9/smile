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
    public $resources;

    public function mount($id, GoogleMaps $googleMaps)
    {
        $this->profileCompletionPercentage = auth()->user()->profileCompletionPercentage();
        $this->event = Event::query()->with(['address', 'users'])->find($id);
        // dd($this->event);
        $this->Volunteers = $this->event->users;
        // dd($this->event);
        $this->organizer = User::find($this->event->user_id);
        // dd($this->organizer);
        $this->city = $googleMaps->getNearestCity($this->event->latitude, $this->event->longitude);
        $this->resources = $this->event->resources;
        // dd($this->resources);
    }

    public function join()
    {
        $maxParticipants = $this->event->maximum_participants;
        $currentParticipants = $this->event->users()->count();
        $slotAvailable = $maxParticipants - $currentParticipants;

        if($slotAvailable > 0){
            if ((int)$maxParticipants < (int)$currentParticipants) {
                session()->flash('event_full', 'Sorry, this event has reached its maximum number of participants.');
                return redirect()->back();
            } else {
    
                $this->event->userJoinsNotify();
                $user = auth()->user();
                $this->event->users()->attach(auth()->user()->id);
    
                $participatedEventsCount = $user->participatingEvents()->count();
                $user->assignBadgesForEvents($participatedEventsCount, $user);
                return redirect('/volunteer/dashboard/my-events');
            }

            $method = $this->event->recruiting_method;
            dd($method);
            switch($method){
                case "first_come":
                    if($slotAvailable > 0){
                        $this->event->users()->updateExistingPivot(auth()->id(), ['status' => 'accepted']);
                    } else {
                        session()->flash('event_full', 'Sorry, this event has reached its maximum number of participants.');
                    }
                    break;
                case 'application_review':
                    $this->event->users()->updateExistingPivot(auth()->id(), ['status' => 'pending']);
                    break;
        
                case 'skill_assessment':
                    $this->event->users()->updateExistingPivot(auth()->id(), ['status' => 'pending']);
                    break;
        
                case 'metrics':
                    if ($applicant->rank <= 10) { // for example, top 10 ranks
                        $applicant->status = 'approved';
                    } else {
                        $applicant->status = 'rejected';
                    }
                    break;
        
                default:
                    $applicant->status = 'pending_review';
    
            }
        }
        else {
                    session()->flash('event_full', 'Sorry, this event has reached its maximum number of participants.');
         }
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
