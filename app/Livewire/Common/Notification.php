<?php

namespace App\Livewire\Common;


use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class Notification extends Component
{
    public $drawerOpen = false;

    public $notifications;


    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $this->notifications = Auth::user()->notifications()
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function markasRead($id)
    {

        $notification = auth()->user()->notifications->find($id);
        $markThatAsRead = $notification?->markAsRead();
        $routeReq = '/requester/dashboard/my-events/' . $notification['data']['event_id'];
        $routeVol = '/volunteer/dashboard/my-events/' . $notification['data']['event_id'];
        $this->loadNotifications();

        $route = auth()->user()->role->name === 'requester'
            ? $routeReq
            : $routeVol;

        return $this->redirect($route);
    }
    public function markAllAsRead()
    {
        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        $this->loadNotifications();
    }


    public function render()
    {
        return view('livewire.common.notification');
    }
}
