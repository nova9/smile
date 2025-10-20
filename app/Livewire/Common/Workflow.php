<?php

namespace App\Livewire\Common;

use App\Models\Event;
use App\Models\Task;
use App\Models\TaskList;
use App\Models\User;
use App\Services\Notifications\ApprovalNotification;
use App\Services\Notifications\TaskAssignedNotification;
use App\Services\Notifications\TaskCompletionNotification;
use Illuminate\Support\Arr;
use Livewire\Component;
use PhpParser\Builder\Use_;

class Workflow extends Component
{
    public $newTaskListName;
    public $event;
    public $taskLists;

    public function mount($eventId)
    {
        $this->event = Event::query()->find($eventId); // TODO: not secure
        $this->loadTaskLists();
    }

    public function loadTaskLists()
    {
        $this->taskLists = $this->event->tasksLists()->with([
            'tasks' => function ($query) {
                $query->orderBy('order');
            }
        ])->orderBy('order')->get();
    }

    public function addTaskList()
    {
        $this->validate(Arr::only($this->rules(), ['newTaskListName']));
        $this->event->tasksLists()->create([
            'name' => $this->newTaskListName,
        ]);

        session()->flash('message', 'New task list "' . $this->newTaskListName . '" added!');
        $this->newTaskListName = '';
        $this->loadTaskLists();
    }

    public function removeTaskList($taskListId)
    {
        $taskList = $this->taskLists->find($taskListId);
        if ($taskList) {
            $taskList->delete();
        }
        $this->loadTaskLists();
    }

    public function editTaskList($taskListId, $newName)
    {
        $taskList = $this->taskLists->find($taskListId);
        if ($taskList) {
            $taskList->name = $newName;
            $taskList->save();
        }
        $this->loadTaskLists();

    }

    public function addTask($taskListId, $name, $description)
    {
        $taskList = $this->taskLists->find($taskListId);
        if ($taskList) {
            $taskList->tasks()->create([
                'name' => $name,
                'description' => $description,
            ]);
        }
        $this->loadTaskLists();
    }

    public function updateTask($taskId, $name, $description)
    {
        foreach ($this->taskLists as $taskList) {
            $task = $taskList->tasks->find($taskId);
            if ($task) {
                $task->name = $name;
                $task->description = $description;
                $task->save();
                break;
            }
        }
        $this->loadTaskLists();
    }

    public function assignVolunteer($taskId, $volunteerId)
    {
        $task = Task::query()->find($taskId);
        if ($task) {
            $task->assigned_id = $volunteerId;
            $task->save();
            User::find($volunteerId)->notify(new TaskAssignedNotification($task));
            
        }
        $this->loadTaskLists();
        
    }

    public function removeTask($taskId)
    {
        foreach ($this->taskLists as $taskList) {
            $task = $taskList->tasks->find($taskId);
            if ($task) {
                $task->delete();
                break;
            }
        }
        $this->loadTaskLists();
    }

    public function toggleTaskStatus($taskId)
    {
        $task = Task::query()->find($taskId);
        if ($task) {
            $task->status = $task->status === 'done' ? 'doing' : 'done';
            $task->save();
            if($task->status === 'done'){
                foreach($this->event->users as $user){
                    $user->notify(new TaskCompletionNotification($task));
                }
                $this->event->eventCreator()->notify(new TaskCompletionNotification($task));
            }
        }
        $this->loadTaskLists();
    }

    public function updateTaskListOrder($order)
    {
        foreach ($order as $item) {
            $taskList = $this->taskLists->find($item['value']);
            if ($taskList) {
                $taskList->order = $item['order'];
                $taskList->save();
            }
        }
        $this->loadTaskLists();
    }

    public function updateTaskOrder($taskLists)
    {
        foreach ($taskLists as $taskList) {
            $taskListId = $taskList['value'];

            foreach ($taskList['items'] as $task) {
                Task::query()->findOrFail($task['value'])
                    ->update([
                        'order' => $task['order'],
                        'task_list_id' => $taskListId,
                    ]);
            }
        }

        $this->loadTaskLists();
    }

    public function render()
    {
        return view('livewire.common.workflow');
    }

    public function rules()
    {
        return [
            'newTaskListName' => 'required|string|max:255',
        ];
    }
}
