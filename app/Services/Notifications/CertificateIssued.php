<?php

namespace App\Services\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Certificate;
use App\Models\Event;

class CertificateIssued extends Notification implements ShouldQueue
{
    use Queueable;

    protected $certificate;

    public function __construct(Certificate $certificate)
    {
        $this->certificate = $certificate;
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
        $event = Event::find($this->certificate->event_id);
        return [
            'event_id' => $this->certificate->event_id,
            'name' => $event->name,
            'message' => "Your participation in the event '{$event->name}' has been approved.",
            'event_url' => url('/volunteer/dashboard/my-events/' . $this->certificate->event_id)
        ];
    }
}
