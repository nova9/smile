<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Services\Notifications\EventReminderNotification;

class SendEventReminders extends Command
{
    protected $signature = 'event:send-reminders';
    protected $description = 'Send reminders to volunteers for upcoming events';

    public function handle()
    {
        // Find events starting tomorrow
        $events = Event::whereDate('starts_at', now()->addDays(1))->with('users', 'category')->get();
      foreach ($events as $event) {
            // Assuming volunteers relation exists on Event
            $acceptedUsers = $event->users->where('pivot.status', 'accepted');
            
            foreach ($acceptedUsers as $user) {
                $user->notify(new EventReminderNotification($event));
            }
        }
        $this->info('Event reminders sent to volunteers.');
    }
}
