<?php

namespace App\Livewire\Requester\Dashboard\MyEvents;

use App\Models\Task;
use Livewire\Component;

class Show extends Component
{
    public $event;
    public $pendingUsers;
    public $acceptedUsers;
    public $tasks;
    public $subtasks;
    public $taskName;
    public $taskDescription;
    public $assignedVolunteer;

    public $subtaskName = [];
    public $subtaskDescription = [];
    public $subtaskAssignedVolunteer = [];

    public function mount($id)
    {
        $this->event = auth()->user()->organizingEvents()->find($id);
        $this->pendingUsers = $this->event->users->where('pivot.status', 'pending');
        $this->acceptedUsers = $this->event->users->where('pivot.status', 'accepted');
        $this->tasks = Task::where('event_id',$this->event->id)->where('parent_id',null)->get();
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
       $task= Task::create([
            'event_id' => $this->event->id,
            'name'=> $this->taskName,
            'description' => $this->taskDescription,
            'assigned_id' => $this->assignedVolunteer,
            'parent_id' => null
            ]);
            
    // show the updated list of tasks
        $this->tasks= Task::where('event_id', $this->event->id)->get();
        session()->flash('success', 'Task added successfully.');
    //reset input fields
        $this->reset(['taskName', 'taskDescription', 'assignedVolunteer']);

    }
    public function addSubtask($taskId)
    {
    // validate
    
    //add subtask 
        $subtask= Task::create([
            'event_id' => $this->event->id,
            'name' => $this->subtaskName[$taskId],
            'description' => $this->subtaskDescription[$taskId],
            'assigned_id' => $this->subtaskAssignedVolunteer[$taskId],
            'parent_id' => $taskId
            ]);
    // show the updated list of subtasks
    $this->subtasks = $this->tasks->find($taskId)->subTasks()->get();
    //reset input fields
        $this->reset(['subtaskName', 'subtaskDescription', 'subtaskAssignedVolunteer']);
        session()->flash('success', 'Subtask added successfully.');

    }
    public function deleteTask($taskId){
        $task = Task::find($taskId);
        if($task){
            $task->delete();
            // to show the updated list of tasks
            $this->tasks = Task::where('event_id', $this->event->id)->get();
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
