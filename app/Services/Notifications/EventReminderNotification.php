<?php

namespace App\Services\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Event;

class EventReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->subject('Verify Task Completion')
    //         ->greeting('Hello!')
    //         ->line('Please verify if the following task is completed:')
    //         ->line('Task: ' . $this->task->name)
    //         ->action('View Task', url('/requester/dashboard/my-events/' . $this->task->event_id))
    //         ->line('Thank you for using Smile!');
    // }

    public function toArray($notifiable)
    {
        $remainingDays = (new \DateTime())->diff(new \DateTime($this->event->starts_at))->days;
        return [
            'event_id' => $this->event->id,
            'name' => $this->event->name,
            'starts_at' => $this->event->starts_at,
            'message' => "Only $remainingDays day(s) left! The event '{$this->event->name}' starts on " . date('F d, Y', strtotime($this->event->starts_at)) . ".",
            'event_url' => url('/volunteer/dashboard/my-events/' . $this->event->id)
        ];
    }
}
