<div class="mx-auto">
    <div class="flex items-center gap-3 mb-4">
        <input wire:model="newTaskListName" type="text" placeholder="New Task List Name"
               class="input input-sm input-bordered w-64"/>
        <button id="add-column" class="btn btn-secondary btn-sm" wire:click="addTaskList">Create Task List</button>
        @error('newTaskListName')
        <p class="text-xs text-rose-500 text-center">{{ $message }}</p>
        @enderror
    </div>

{{-- max-w-96 work but dont know how --}}
    <div class="flex flex-wrap gap-4 pb-6" wire:sortable="updateTaskListOrder"
         wire:sortable-group="updateTaskOrder">
        @forelse($taskLists as $taskList)
            <section wire:key="tasklist-{{ $taskList->id }}" wire:sortable.item="{{ $taskList->id }}"
                     class="w-80 flex-shrink-0">
                <div class="card bg-base-100 shadow">
                    <div class="card-body p-3">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <button wire:sortable.handle
                                        class="drag-handle cursor-move p-1 rounded hover:bg-gray-100 text-gray-500"
                                        aria-label="Drag task list" title="Drag to reorder">
                                    <i data-lucide="grip-vertical" class="size-4"></i>
                                </button>
                                <h3 class="font-semibold">{{ $taskList->name }}</h3>

                                {{-- Edit Button--}}
                                <button onclick="editTaskList{{$taskList->id}}.showModal()"
                                        class="text-[10px] text-gray-500 hover:cursor-pointer">Edit
                                </button>
                                <dialog id="editTaskList{{$taskList->id}}" class="modal">
                                    <div class="modal-box" x-data="{input: '{{$taskList->name}}'}">
                                        <form method="dialog">
                                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                                                ✕
                                            </button>
                                        </form>
                                        <h3 class="text-lg font-bold">Edit Task List</h3>
                                        <p class="text-sm text-base-content/60 mt-2">Change the name of this task list.
                                            This
                                            helps keep your board organized.</p>

                                        <input type="text" x-model="input" class="input input-bordered w-full mt-4"
                                               placeholder="Task List Name"/>
                                        <form method="dialog">
                                            <button class="btn mt-4"
                                                    x-on:click="$wire.editTaskList({{$taskList->id}}, input)"
                                                    title="Delete task list">
                                                Edit
                                            </button>
                                        </form>
                                    </div>
                                </dialog>
                            </div>
                            <div class="flex items-center">
                                {{-- Add Task--}}
                                <button onclick="addTask{{$taskList->id}}.showModal()" class="btn btn-xs btn-ghost">+
                                    Add
                                    Task
                                </button>
                                <dialog id="addTask{{$taskList->id}}" class="modal">
                                    <div class="modal-box" x-data="{name: '', description: '' }">
                                        <form method="dialog">
                                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                                                ✕
                                            </button>
                                        </form>
                                        <h3 class="text-lg font-bold">Add Task</h3>
                                        <p class="text-sm text-base-content/60 mt-2">Add a new task to this list with a
                                            title and optional description.</p>

                                        <input type="text" x-model="name" class="input input-bordered w-full mt-4"
                                               placeholder="Title"/>

                                        <textarea x-model="description" class="textarea textarea-bordered w-full mt-4"
                                                  placeholder="Description">
                                                                </textarea>
                                        <form method="dialog">
                                            <button class="btn mt-4"
                                                    x-on:click="$wire.addTask({{$taskList->id}}, name, description)">
                                                Add
                                            </button>
                                        </form>
                                    </div>
                                </dialog>

                                <!-- delete task list -->
                                <button onclick="taskList{{$taskList->id}}.showModal()"
                                        class="btn btn-xs btn-ghost text-rose-500"><i data-lucide="trash2"
                                                                                      class="size-4"></i></button>
                                <dialog id="taskList{{$taskList->id}}" class="modal">
                                    <div class="modal-box">
                                        <form method="dialog">
                                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                                                ✕
                                            </button>
                                        </form>
                                        <h3 class="text-lg font-bold">Are you sure?</h3>
                                        <p class="text-sm text-base-content/60 mt-2">Deleting this task list will
                                            permanently remove it and all tasks inside it.</p>
                                        <p class="py-4">
                                            Tasks inside this list will <span class="text-error">also</span> be
                                            deleted.
                                        </p>

                                        <button class="btn btn-error" wire:click="removeTaskList({{ $taskList->id }})"
                                                title="Delete task list">
                                            Delete
                                        </button>
                                    </div>
                                </dialog>
                            </div>
                        </div>

                        <div class="space-y-3" wire:sortable-group.item-group="{{ $taskList->id }}">
                            @forelse($taskList->tasks as $task)
                                <article class="card bg-white shadow-sm p-3 max-w-80 w-full"
                                         wire:key="task-{{ $task->id }}" wire:sortable-group.item="{{ $task->id }}">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-start gap-2">
                                            <button wire:sortable-group.handle
                                                    class="task-drag-handle p-1 rounded text-gray-400 hover:text-gray-600 mr-1"
                                                    aria-label="Drag task" title="Drag to reorder">
                                                <i data-lucide="grip-vertical" class="size-4"></i>
                                            </button>
                                            <div>
                                                <h4 class="font-medium">{{ $task->name }}</h4>
                                                <p class="text-xs text-base-content/60">{{ $task->description }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <!-- Edit button -->
                                            <button onclick="editTask{{ $task->id }}.showModal()"
                                                    class="text-xs text-gray-500 hover:cursor-pointer">Edit
                                            </button>
                                            <dialog id="editTask{{ $task->id }}" class="modal">
                                                <div class="modal-box"
                                                     x-data="{title: '{{ addslashes($task->name) }}', desc: '{{ addslashes($task->description) }}'}">
                                                    <form method="dialog">
                                                        <button
                                                            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                                                            ✕
                                                        </button>
                                                    </form>
                                                    <h3 class="text-lg font-bold">Edit Task</h3>
                                                    <p class="text-sm text-base-content/60 mt-2">Update the task title
                                                        and
                                                        description to reflect the latest details.</p>
                                                    <input type="text" x-model="title"
                                                           class="input input-bordered w-full mt-4"
                                                           placeholder="Title"/>
                                                    <textarea x-model="desc"
                                                              class="textarea textarea-bordered w-full mt-4"
                                                              placeholder="Description"></textarea>
                                                    <div class="modal-action">
                                                        <form method="dialog">
                                                            <button class="btn"
                                                                    x-on:click="$wire.updateTask({{ $task->id }}, title, desc)">
                                                                Save
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </dialog>

                                            <!-- Assign Volunteer button -->
                                            <button onclick="assignVolunteer{{ $task->id }}.showModal()"
                                                    class="text-xs text-gray-500 hover:cursor-pointer">Assign
                                            </button>
                                            <dialog id="assignVolunteer{{ $task->id }}" class="modal">
                                                <div class="modal-box" x-data="{ volunteerId: '{{$task->assignedUser->id ?? ''}}' }">
                                                    <form method="dialog">
                                                        <button
                                                            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                                                            ✕
                                                        </button>
                                                    </form>
                                                    <h3 class="text-lg font-bold">Assign Volunteer</h3>
                                                    <p class="text-sm text-base-content/60 mt-2">Choose a volunteer from
                                                        the
                                                        list to assign this task.</p>
                                                    <div class="mt-4 space-y-2">
                                                        @forelse($event->users as $user)
                                                            <label class="flex items-center gap-2">
                                                                <input type="radio" name="volunteer-{{ $task->id }}"
                                                                       value="{{ $user->id }}" x-model="volunteerId"/>
                                                                <span>{{ $user->name }}</span>
                                                            </label>
                                                        @empty
                                                            <p class="text-sm text-base-content/60 mt-2">No volunteers
                                                                available.</p>
                                                        @endforelse
                                                    </div>
                                                    <div class="modal-action">
                                                        <form method="dialog">
                                                            <button class="btn btn-primary"
                                                                    x-on:click="$wire.assignVolunteer({{ $task->id }}, volunteerId)">
                                                                Assign
                                                            </button>

                                                            <button class="btn btn-error"
                                                                    x-on:click="$wire.assignVolunteer({{ $task->id }}, null)">
                                                                Unassign
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </dialog>

                                            <!-- Delete button -->
                                            <button onclick="deleteTask{{ $task->id }}.showModal()"
                                                    class="text-xs text-gray-500 hover:cursor-pointer">Delete
                                            </button>
                                            <dialog id="deleteTask{{ $task->id }}" class="modal">
                                                <div class="modal-box">
                                                    <form method="dialog">
                                                        <button
                                                            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                                                            ✕
                                                        </button>
                                                    </form>
                                                    <h3 class="text-lg font-bold">Delete Task</h3>
                                                    <p class="text-sm text-base-content/60 mt-2">This action will remove
                                                        the
                                                        task permanently from the board.</p>
                                                    <p class="py-4">Are you sure you want to delete "{{ $task->name }}
                                                        "?</p>
                                                    <div class="modal-action">
                                                        <button class="btn btn-error"
                                                                wire:click="removeTask({{ $task->id }})">Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </dialog>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between mt-3">
                                        @if($task->assignedUser)
                                            <div
                                                class="size-6 rounded-full bg-primary text-white flex items-center justify-center text-[10px]">
                                                <span class="block">
                                                    {{ strtoupper(substr($task->assignedUser->name, 0, 2))}}
                                                </span>
                                            </div>
                                        @endif

                                    </div>
                                </article>
                            @empty
                                <div
                                    class="flex flex-col items-center justify-center p-4 text-center text-sm text-base-content/60">
                                    <p class="mt-1">Add your first task to get things rolling — small steps, big
                                        smiles!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
        @empty
            <div class="w-full flex flex-col items-center justify-center p-8 text-center text-sm text-base-content/60">
                <i data-lucide="inbox" class="size-8 mb-2"></i>
                <p class="mt-1">No task lists yet. Start by creating a new task list to organize your workflow!</p>
            </div>
        @endforelse
    </div>
</div>
