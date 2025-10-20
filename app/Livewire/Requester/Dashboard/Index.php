<?php

namespace App\Livewire\Requester\Dashboard;

use App\Models\Notification;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $totalEvents;
    public $activeEvents;
    public $pendingApplications;
    public $upcomingEvents;
    public $completedRate;
    public $completedEvents;
    public $approvalRate;
    public $certificateIssued;
    public $totalVol;
    public $recentNotification;
    public $recentNotificationText;
    public $recentNotificationTime;
    public $recentEventCreation;
    public $recentCertificateIssued;
    // public $upcomingEventsCount;

    public function mount()
    {
        $user = Auth::user();
        $this->totalEvents = $user->events()->count();
        $this->activeEvents = $user->events()->where('is_active', 1)->count();
        // $this->upcomingEventsCount = $user->events()->where('starts_at','>',now())->count();

        // Get all volunteers with pending status from user's events
        $this->pendingApplications = $user->events()
            ->with(['users' => function ($query) {
                $query->wherePivot('status', 'pending');
            }])
            ->get()
            ->pluck('users')
            ->flatten()
            ->count();
        // dd($this->pendingApplications);

        $this->upcomingEvents = $user->events()->where('starts_at', '>', now())->limit(3)->get();
        $this->completedEvents = $user->events()->where('ends_at', '<', now())->count();
        if($this->totalEvents == 0){
            $this->completedRate = 0;
        }
        else{
            $this->completedRate = ($this->completedEvents / $this->totalEvents) * 100;
        }
        $approvelVol = $user->events()
            ->with(['users' => function ($query) {
                $query->wherePivot('status', 'accepted');
            }])
            ->get()
            ->pluck('users')
            ->flatten()
            ->count();
        $this->totalVol = $user->events()->get()->pluck('users')->flatten()->count();
        if ($this->totalVol == 0) {
            $this->approvalRate = 0;
        } else {
            $this->approvalRate = ($approvelVol / $this->totalVol) * 100;
        }

        // Get all certificates issued across all user's events
        $this->certificateIssued = $user->events()
            ->with('certificates')
            ->get()
            ->pluck('certificates')
            ->flatten()
            ->count();
        // dd($this->certificateIssued);
        $this->recentNotification = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->first();
        if ($this->recentNotification != null) {
            $this->recentNotificationTime = $this->recentNotification['created_at']->diffForHumans();
            $this->recentNotificationText = $this->recentNotification->data['message'];
        } else {
            $this->recentNotificationText = 'No notifications';
            $this->recentNotificationTime = '';
        }


        $this->recentEventCreation = $user->organizingEvents()->orderBy('created_at', 'desc')->first();
        // $this->recentCertificateIssued = $user->events()->with('certificates')->get()->pluck('certificates')
        // dd($this->recentEventCreation);


    }

    public function render()
    {
        return view('livewire.requester.dashboard.index');
    }
}
