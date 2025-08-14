<?php

namespace App\Livewire\Requester\Dashboard\MyEvents;

use App\Models\Task;
use App\Services\GoogleMaps;
use Livewire\Component;


class Show extends Component
{
    public $event;
    public $location;
    public $pendingUsers;
    public $acceptedUsers;
    public $tasks;
    public $subtasks;
    public $taskName;
    public $taskDescription = [];
    public $assignedVolunteer = [];
    public $taskStatus = [];
    public $subtaskName = [];
    public $subtaskDescription = [];
    public $subtaskAssignedVolunteer = [];

    public function mount($id, GoogleMaps $googleMaps)
    {
        $this->event = auth()->user()->organizingEvents()->with('users', 'category')->find($id);
        // dd($this->event); // Debugging line, can be removed later
        $this->location = $googleMaps->getNearestCity($this->event->latitude, $this->event->longitude);
        $this->pendingUsers = $this->event->users->where('pivot.status', 'pending');
        $this->acceptedUsers = $this->event->users->where('pivot.status', 'accepted');
        $this->tasks = Task::where('event_id', $this->event->id)->get();
        $this->subtasks = $this->tasks->flatMap->subTasks;
    }

    public function approve($userId)
    {
        $this->event->users()->updateExistingPivot($userId, ['status' => 'accepted']);
        $this->pendingUsers = $this->event->users->where('pivot.status', 'pending');
        $this->acceptedUsers = $this->event->users->where('pivot.status', 'accepted');
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
            //status update
            $task->status = $this->taskStatus[$taskId] ?? 'todo';
            $task->save();

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
        return view('livewire.requester.dashboard.my-events.show');
    }
}
