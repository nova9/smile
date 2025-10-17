<?php

namespace App\Livewire\Common;

use App\Models\Event;
use App\Models\TaskList;
use Illuminate\Support\Arr;
use Livewire\Component;

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
        $this->taskLists = $this->event->tasksLists;
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

    public function removeTaskList($taskListId) {
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
