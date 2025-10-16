<?php

namespace App\Livewire\Requester\Dashboard\MyEvents;

use App\Models\Task;
use App\Models\User;
use App\Services\GoogleMaps;
use App\Services\Notifications\TaskCompletionNotification;
use Livewire\Component;


class Show extends Component
{
    public $event;
    public $location;
    public $pendingUsers;
    public $acceptedUsers;
    public $tasks;
    public $assignedtasks;
    public $subtasks;
    public $taskName;
    public $taskDescription = [];
    public $assignedVolunteer = [];
    public $taskStatus = [];
    public $subtaskName = [];
    public $subtaskDescription = [];
    public $subtaskAssignedVolunteer = [];
    public $genderFilter = '';
    public $levelFilter = '';
    public $filteredVolunteers = [];
    public $volunteerLevel;

    public function mount($id, GoogleMaps $googleMaps)
    {
        $this->loadVolunteers($id, $googleMaps);
    }

    public function updatedGenderFilter()
    {
        $this->loadVolunteers($this->event->id, app(GoogleMaps::class));
    }

    public function updatedLevelFilter()
    {
        $this->loadVolunteers($this->event->id, app(GoogleMaps::class));
    }

    public function loadVolunteers($id , GoogleMaps $googleMaps){

        $this->event = auth()->user()->organizingEvents()->with('users', 'category')->find($id);
        // dd($this->event->users); // Debugging line, can be removed later
        $this->location = $googleMaps->getNearestCity($this->event->latitude, $this->event->longitude);
        $this->pendingUsers = $this->event->users->where('pivot.status', 'pending');
        $this->acceptedUsers = $this->event->users->where('pivot.status', 'accepted');
        $this->tasks = Task::where('event_id', $this->event->id)->get();
        $this->subtasks = $this->tasks->flatMap->subTasks;


        // Always set filteredVolunteers, handle empty filters
        $filtered = $this->pendingUsers;
        if ($this->genderFilter) {

            $filtered = $filtered->filter(function ($user) {
                return $user->getCustomAttribute('gender') == $this->genderFilter;
            });
        }
        //level
        //beginner = points(0-10) + events(0-10) + tasks(0-10)
        //intermediate = points(11-30) + events(11-30) + tasks(11-30)
        //advanced = points(31+) + events(31+) + tasks(31+)

        foreach($filtered as $user){
            $points = $user->badges->sum('points');
            $events = $user->events->count();
            $tasks = $user->tasks->count();
            $user->setVolunteerLevel($points, $events, $tasks);

        }

        if ($this->levelFilter) {
            $filtered = $filtered->filter(function ($user) {
                return $user->getCustomAttribute('level') == $this->levelFilter;
            });
        }

        $this->filteredVolunteers = $filtered->all();
        // dd($this->filteredVolunteers);

    }
    public function approve($userId)
    {
        $this->event->users()->updateExistingPivot($userId, ['status' => 'accepted']);
        $this->event->approveUserNotify($userId); // notify the user
        $this->pendingUsers = $this->event->users->where('pivot.status', 'pending');
        $this->acceptedUsers = $this->event->users->where('pivot.status', 'accepted');
        //update the level
        foreach ($this->acceptedUsers as $user) {
            $points = $user->badges->sum('points');
            $events = $user->participatingEvents()->where('status', 'accepted')->count();
            $tasks = $user->tasks->count();
            // dd($tasks);
            $user->setVolunteerLevel($points, $events,$tasks);
        }
    }


    public  function addTask()
    {

        // validate the task data

        // add task data
        $task = Task::create([
            'event_id' => $this->event->id,
            'name' => $this->taskName,
            'parent_id' => null
        ]);

        // show the updated list of tasks with subtasks also
        $this->tasks = Task::where('event_id', $this->event->id)->get();
        session()->flash('success', 'Task added successfully.');
        //reset input fields
        $this->reset(['taskName']);
    }
    public function editTask($taskId)
    {
        $task = Task::find($taskId);
        if ($task) {
            $this->taskDescription[$taskId] = $task->description;
            $this->assignedVolunteer[$taskId] = $task->assigned_id;
            $this->taskStatus[$taskId] = $task->status;
        }
    }
    public function updateTask($taskId)
    {
        // validate the task data

        // update task data
        $task = Task::find($taskId);

        if ($task) {
            $task->update([
                'description' => $this->taskDescription[$taskId] ?? '',
                'assigned_id' => $this->assignedVolunteer[$taskId] ?? null,
            ]);
            // send the notification to assigned user
            if ($this->assignedVolunteer[$taskId] != null) {
                $task->TaskAssignment();
            }
            //status update


            $this->tasks = Task::where('event_id', $this->event->id)->get();
            session()->flash('success', 'Task updated successfully.');
        }

        // Only add subtask if all required subtask fields are set for this task
        if (
            isset($this->subtaskName[$taskId]) &&
            isset($this->subtaskDescription[$taskId]) &&
            isset($this->subtaskAssignedVolunteer[$taskId]) &&
            $this->subtaskName[$taskId] !== null &&
            $this->subtaskName[$taskId] !== ''
        ) {
            $this->addSubtask($taskId);
        }
    }
    public function addSubtask($taskId)
    {
        // validate

        //add subtask
        $name = $this->subtaskName[$taskId] ?? null;
        $desc = $this->subtaskDescription[$taskId] ?? null;
        $assigned = $this->subtaskAssignedVolunteer[$taskId] ?? null;
        if ($name !== null && $name !== '') {
            $subtask = Task::create([
                'event_id' => $this->event->id,
                'name' => $name,
                'description' => $desc,
                'assigned_id' => $assigned,
                'parent_id' => $taskId
            ]);
            // show the updated list of subtasks
            $this->subtasks = $this->tasks->find($taskId)->subTasks()->get();
            //reset input fields
            $this->reset(['subtaskName', 'subtaskDescription', 'subtaskAssignedVolunteer']);
            session()->flash('success', 'Subtask added successfully.');
        }
        // show the updated list of subtasks
        $this->subtasks = $this->tasks->find($taskId)->subTasks()->get();
        //reset input fields
        $this->reset(['subtaskName', 'subtaskDescription', 'subtaskAssignedVolunteer']);
        session()->flash('success', 'Subtask added successfully.');
    }
    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->delete();
            // to show the updated list of tasks
            $this->tasks = Task::where('event_id', $this->event->id)->where('parent_id', null)->get();
            session()->flash('success', 'Task deleted successfully.');
        }
    }

    public function deleteSubtask($subtaskId)
    {
        $subtask = Task::find($subtaskId);
        if ($subtask) {
            $subtask->delete();
            // to show the updated list of subtasks
            $this->subtasks = $this->tasks->find($subtask->parent_id)->subTasks()->get();
            session()->flash('success', 'Subtask deleted successfully.');
        }
    }

    public function render()
    {
        return view('livewire.requester.dashboard.my-events.show',[

            'filteredVolunteers' => $this->filteredVolunteers,

        ]);
    }
}
