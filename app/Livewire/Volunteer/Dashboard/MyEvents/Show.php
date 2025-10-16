<?php

namespace App\Livewire\Volunteer\Dashboard\MyEvents;

use App\Models\Event;
use App\Models\Task;
use App\Services\GoogleMaps;
use Livewire\Component;

class Show extends Component
{
    public $event;
    public $status;
    public $volunteers;
    public $city;
    public $tasks;

    // public function join()
    // {
    //     if (auth()->user()->isProfileCompletionPercentage() != 1) {
    //         return redirect('/volunteer/dashboard/profile')->with('error', 'Please complete your profile before joining an event.');
    //     }
    //     $this->event->users()->attach(auth()->user()->id);
    //     return redirect('/volunteer/dashboard/my-events');
    // }

    public function mount($id, GoogleMaps $googleMaps)
    {
        // dd($this->event);

        $this->event = Event::query()
            ->with(['address', 'users', 'category', 'tags'])
            ->find($id);
        $this->status = $this->event->users->where('id', auth()->id())->first()?->pivot->status;
        // dd($this->status);
        $this->volunteers = $this->event->users;
        $this->city = $googleMaps->getNearestCity($this->event->latitude, $this->event->longitude);
        $this->tasks = $this->event->tasks()->get();
    }

    public function render()
    {
        return view('livewire.volunteer.dashboard.my-events.show');
    }

    public function updateTaskStatus($taskId, $newStatus)
    {
        $task = $this->tasks->where('id', $taskId)->first();
        if (!$task) {
            session()->flash('error', 'Task not found.');
            return;
        }
        if (!in_array($newStatus, ['todo', 'doing', 'done'])) {
            session()->flash('error', 'Invalid status.');
            return;
        }
        if ($newStatus == 'done') {
            $task->status = 'done';
            $task->save();
            $task->TaskCompletion();

            // Check if this is the user's first completed task
            $user = auth()->user();
            $completedTasksCount = Task::where('assigned_id', $user->id)
                ->where('status', 'done')
                ->count();
            $user->assignBadgesForTasks($completedTasksCount, $user);
            
            $points=$user->badges->sum('points');
            $events=$user->participatingEvents()->where('status', 'accepted')->count();
            // dd($points,$events,$completedTasksCount);
            $user->setVolunteerLevel($points,$events,$completedTasksCount);

            session()->flash('success', 'Task status updated to Done.');
            // Optionally, reload tasks to reflect changes
            $this->tasks = $this->event->tasks()->get();
            return;
        }

        $task->status = $newStatus;
        $task->save();
        session()->flash('success', 'Task status updated to ' . ucfirst($newStatus) . '.');
        // Optionally, reload tasks to reflect changes
        $this->tasks = $this->event->tasks()->get();
    }
}
