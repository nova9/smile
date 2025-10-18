<?php

namespace App\Services\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Event;

class EventJoinNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['database','mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Participant Joined Your Event')
            ->greeting('Hello!')
            ->line('A new participant has joined your event: ' . $this->event->name)
            ->action('View Event', url('/requester/dashboard/my-events/' . $this->event->id))
            ->line('Thank you for using Smile!');
    }

    public function toArray($notifiable)
    {
        return [
            'event_id' => $this->event->id,
            'name' => $this->event->name,
            'message' => "You have a new participant in your event '{$this->event->name}'",
            'event_url' => url('/requester/dashboard/my-events/' . $this->event->id)
        ];
    }
}
