<?php
// app/Models/Task.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\Notifications\TaskCompletionNotification; // Fixed import path
use App\Services\Notifications\TaskAssignedNotification;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'parent_id',
        'name',
        'description',
        'assigned_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function taskCreator()
    {
        // Get the user who created the event for this task
        return $this->event ? $this->event->owner ?? $this->event->user ?? null : null;
    }

    public function subTasks()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }

    public function TaskCompletion()
    {
        // Send notification to task creator
        $taskCreator = $this->taskCreator();
        if ($taskCreator) {
            $taskCreator->notify(new TaskCompletionNotification($this));
            // dd("Notification sent to task creator: " . $taskCreator->name);
        }

        return $this;
    }

    public function TaskAssignment()
    {
        // Send notification to assigned volunteer
        $assignedVolunteer = $this->assignedUser;
        if ($assignedVolunteer) {
            $assignedVolunteer->notify(new TaskAssignedNotification($this));
            // dd("Notification sent to assigned volunteer: " . $assignedVolunteer->name);
        }

        return $this;
    }
}
