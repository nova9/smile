<?php

namespace App\Services\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;
use App\Models\User;

class TaskCompletionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
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
    $assigned_volunteer = $this->task->assignedUser->name;
    $eventUrl = url('/requester/dashboard/my-events/' . $this->task->event_id);
    return [
        'task_id' => $this->task->id,
        'name' => $this->task->name,
        'event_id' => $this->task->event_id,
        'assigned_volunteer' => $assigned_volunteer,
        'message' => 'Task was completed by ' . $assigned_volunteer,
        'event_url' => $eventUrl
    ];
}
}
