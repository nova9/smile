<?php

namespace App\Livewire\Common;


use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notification extends Component
{
    public $drawerOpen = false;

    public $notifications;


    public function mount()
    {
        $this->notifications = Auth::user()->notifications()// notifiable id = authuser id
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->get();
        
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->find($id);
        if (!$notification) return;

        $data = is_array($notification->data)
            ? $notification->data
            : json_decode($notification->data, true);

        if ($notification && $notification->read_at === null) {
            $notification->read_at = now();
            $notification->save();
        }
        $this->notifications = Auth::user()->notifications()
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->get();
        redirect($data['event_url'] ?? '/');
    }

    public function render()
    {
        return view('livewire.common.notification');
    }
}
