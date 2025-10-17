<div class="bg-base-200 p-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-3 mb-4">
            <input wire:model="newTaskListName" type="text" placeholder="New Task List Name"
                   class="input input-sm input-bordered w-64"/>
            <button id="add-column" class="btn btn-secondary btn-sm" wire:click="addTaskList">Create Task List</button>
            @error('newTaskListName')
            <p class="text-xs text-rose-500 text-center">{{ $message }}</p>
            @enderror
        </div>

        <div id="board" class="flex gap-4 overflow-x-auto pb-6">
            @foreach($taskLists as $taskList)
                <section class="w-80 flex-shrink-0">
                    <div class="card bg-base-100 shadow">
                        <div class="card-body p-3">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-semibold">{{ $taskList->name }}</h3>

                                    {{-- Edit Button--}}
                                    <button
                                        onclick="editTaskList{{$taskList->id}}.showModal()"
                                        class="text-[10px] text-gray-500 hover:cursor-pointer"
                                    >Edit
                                    </button>
                                    <dialog id="editTaskList{{$taskList->id}}" class="modal">
                                        <div class="modal-box" x-data="{input: '{{$taskList->name}}'}">
                                            <form method="dialog">
                                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                                                    ✕
                                                </button>
                                            </form>
                                            <h3 class="text-lg font-bold">Edit Task List</h3>

                                            <input type="text"
                                                   x-model="input"
                                                   class="input input-bordered w-full mt-4"
                                                   placeholder="Task List Name"
                                            />
                                            <form method="dialog">
                                                <button
                                                    class="btn mt-4"
                                                    x-on:click="$wire.editTaskList({{$taskList->id}}, input)"
                                                    title="Delete task list"
                                                >
                                                    Edit
                                                </button>
                                            </form>
                                        </div>
                                    </dialog>
                                </div>
                                <div class="flex items-center">
                                    {{-- Add Task--}}
                                    <button
                                        onclick="addTask{{$taskList->id}}.showModal()"
                                        class="btn btn-xs btn-ghost"
                                    >+ Add Task
                                    </button>
                                    <dialog id="addTask{{$taskList->id}}" class="modal">
                                        <div class="modal-box" x-data="{name: '', description: '' }">
                                            <form method="dialog">
                                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                                                    ✕
                                                </button>
                                            </form>
                                            <h3 class="text-lg font-bold">Add Task</h3>

                                            <input type="text"
                                                   x-model="input"
                                                   class="input input-bordered w-full mt-4"
                                                   placeholder="Title"
                                            />

                                            <textarea
                                                x-model="description"
                                                class="textarea textarea-bordered w-full mt-4"
                                                placeholder="Description"
                                            >
                                            </textarea>
                                            <form method="dialog">
                                                <button
                                                    class="btn mt-4"
                                                    x-on:click="$wire.addTask({{$taskList->id}}, name, description)"
                                                >
                                                    Add
                                                </button>
                                            </form>
                                        </div>
                                    </dialog>

                                    <!-- delete task list -->
                                    <button
                                        onclick="taskList{{$taskList->id}}.showModal()"
                                        class="btn btn-xs btn-ghost text-rose-500"
                                    ><i data-lucide="trash2" class="size-4"></i></button>
                                    <dialog id="taskList{{$taskList->id}}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                                                    ✕
                                                </button>
                                            </form>
                                            <h3 class="text-lg font-bold">Are you sure?</h3>
                                            <p class="py-4">
                                                Tasks inside this list will <span class="text-error">also</span> be
                                                deleted.
                                            </p>

                                            <button
                                                class="btn btn-error"
                                                wire:click="removeTaskList({{ $taskList->id }})"
                                                title="Delete task list"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    </dialog>
                                </div>
                            </div>

                            <div class="space-y-3 dropzone" data-list="todo">
                                fff
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
            <!-- Column: To Do -->
            <section class="w-80 flex-shrink-0">
                <div class="card bg-base-100 shadow">
                    <div class="card-body p-3">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-semibold">To do <span class="text-sm opacity-60">(3)</span></h3>
                            <button class="btn btn-xs btn-ghost">+ Add</button>
                        </div>

                        <div class="space-y-3 dropzone" data-list="todo">
                            <article class="task card bg-white shadow-sm cursor-move p-3" draggable="true"
                                     data-id="task-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium">Write onboarding copy</h4>
                                        <p class="text-xs text-base-content/60">Short intro and first steps for new
                                            users.</p>
                                    </div>
                                    <div class="ml-2 text-xs">
                                        <span class="badge badge-outline">Low</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-3">
                                    <div class="flex -space-x-2">
                                        <div class="avatar">
                                            <div
                                                class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-xs">
                                                AL
                                            </div>
                                        </div>
                                        <div class="avatar">
                                            <div
                                                class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center text-xs">
                                                KT
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-xs text-base-content/50">Due: Oct 20</div>
                                </div>
                            </article>

                            <article class="task card bg-white shadow-sm cursor-move p-3" draggable="true"
                                     data-id="task-2">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium">Design header variants</h4>
                                        <p class="text-xs text-base-content/60">Create 3 different header layouts.</p>
                                    </div>
                                    <div class="ml-2 text-xs">
                                        <span class="badge badge-primary">High</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-3">
                                    <div class="flex -space-x-2">
                                        <div class="avatar">
                                            <div
                                                class="w-6 h-6 rounded-full bg-neutral text-white flex items-center justify-center text-xs">
                                                JR
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-xs text-base-content/50">Due: Oct 22</div>
                                </div>
                            </article>

                            <article class="task card bg-white shadow-sm cursor-move p-3" draggable="true"
                                     data-id="task-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium">Set up CI pipeline</h4>
                                        <p class="text-xs text-base-content/60">Initial GitHub Actions workflow for
                                            tests + lint.</p>
                                    </div>
                                    <div class="ml-2 text-xs">
                                        <span class="badge badge-outline">Med</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-3">
                                    <div class="flex -space-x-2">
                                        <div class="avatar">
                                            <div
                                                class="w-6 h-6 rounded-full bg-accent text-white flex items-center justify-center text-xs">
                                                SM
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-xs text-base-content/50">Due: Oct 26</div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


</div>
