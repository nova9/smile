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
        // dd($id);
        auth()->user()->notifications->find($id)?->markAsRead();
        $this->loadNotifications();
        
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
