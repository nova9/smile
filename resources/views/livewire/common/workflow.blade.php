<div class="tab-content bg-base-100 border-base-300">
    <!-- Tasks & Subtasks Column -->
    <div class="min-w-[300px] rounded-lg p-4">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m-6 4h12m-6 4h6m-9-8h6m-9 4h6m-9 4h6"/>
                </svg>
                Tasks & Subtasks
            </h2>
            <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium">
                                        {{ $tasks->count() }}
                                    </span>
        </div>
        <!-- Trello Lists: Todo, Doing, Done -->
        <div class="flex gap-4 overflow-x-auto">
            <!-- Todo List -->
            <div
                class="flex-1 min-w-[260px] bg-white rounded-xl shadow-lg border border-blue-100 p-6">
                <h3 class="text-md font-bold text-blue-700 mb-4 flex items-center gap-2">
                    <i data-lucide="list-todo" class="w-5 h-5 text-blue-400"></i>
                    Todo
                </h3>
                <div class="space-y-5">
                    @foreach ($tasks->where('status', 'todo') as $task)
                        <div class="drawer drawer-end">
                            <input id="my-drawer-{{ $task->id }}" type="checkbox"
                                   class="drawer-toggle"/>
                            <div class="drawer-content">
                                <div
                                    class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-4 border border-blue-200 shadow-sm hover:shadow-lg transition-shadow duration-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4
                                            class="font-semibold text-gray-800 text-lg flex items-center gap-2">
                                            <i data-lucide="circle"
                                               class="w-4 h-4 text-blue-400"></i>
                                            {{ $task->name }}
                                        </h4>
                                        <span
                                            class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Todo</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">
                                        {{ $task->description }}
                                    </p>
                                    <div class="flex items-center gap-2 mb-2">
                                        @if ($task->assignedUser && $task->assignedUser->id)
                                            <img
                                                src="{{ $task->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $task->assignedUser->id . '.jpg' }}"
                                                alt="Profile Photo"
                                                class="inline-block w-5 h-5 rounded-full"/>
                                            <span
                                                class="ml-1 text-xs text-gray-700">{{ $task->assignedUser->name }}</span>
                                        @endif
                                    </div>
                                    <label for="my-drawer-{{ $task->id }}"
                                           wire:click="editTask({{ $task->id }})"
                                           class="btn btn-sm btn-outline btn-info w-full font-semibold flex items-center justify-center gap-2 transition-colors duration-150">
                                        <i data-lucide="square-pen" class="w-4 h-4"></i> Edit
                                        Task
                                    </label>
                                </div>
                            </div>
                            <div class="drawer-side">
                                <label for="my-drawer-{{ $task->id }}"
                                       aria-label="close sidebar"
                                       class="drawer-overlay"></label>
                                <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                                    <form wire:submit.prevent="updateTask({{ $task->id }})"
                                          class="space-y-4">
                                        <h3
                                            class="text-lg font-bold text-blue-700 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-blue-500" fill="none"
                                                 stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            Edit Task
                                        </h3>

                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                            <textarea
                                                wire:model.defer="taskDescription.{{ $task->id }}"
                                                placeholder="Description"
                                                class="textarea textarea-bordered w-full"></textarea>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-1">Assign
                                                Volunteer</label>
                                            <select
                                                wire:model.defer="assignedVolunteer.{{ $task->id }}"
                                                class="select select-bordered w-full">
                                                <option value="">Select Volunteer
                                                </option>
                                                @foreach ($acceptedUsers as $volunteer)
                                                    <option value="{{ $volunteer->id }}">
                                                        {{ $volunteer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @if ($task->subtasks->where('parent_id', $task->id)->count())
                                            <div
                                                class="mt-4 p-3 rounded-lg bg-blue-50 border border-blue-200">
                                                <h4
                                                    class="text-md font-bold text-blue-600 mb-2 flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-blue-400"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M12 4v16m8-8H4"/>
                                                    </svg>
                                                    Subtasks
                                                </h4>
                                                <ul class="space-y-2">
                                                    @foreach ($task->subtasks->where('parent_id', $task->id) as $subtask)
                                                        <li
                                                            class="flex items-center justify-between bg-white rounded-lg px-3 py-2 border border-blue-100">
                                                            <div>
                                                                                        <span
                                                                                            class="font-semibold text-gray-800">{{ $subtask->name }}</span>
                                                                <span
                                                                    class="ml-2 text-xs text-gray-500">{{ $subtask->description }}</span>
                                                                <span
                                                                    class="ml-2 text-xs text-gray-400">({{ $subtask->status }})</span>
                                                            </div>
                                                            <div
                                                                class="flex items-center gap-2">
                                                                @if ($subtask->assignedUser)
                                                                    <img
                                                                        src="{{ $subtask->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $subtask->assignedUser->id . '.jpg' }}"
                                                                        alt="Profile Photo"
                                                                        class="inline-block w-5 h-5 rounded-full"/>
                                                                    <span
                                                                        class="ml-1 text-xs text-gray-700">{{ $subtask->assignedUser->name }}</span>
                                                                @else
                                                                    <span
                                                                        class="ml-1 text-xs text-gray-400">Unassigned</span>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="mt-4">
                                            <button type="button"
                                                    class="btn btn-outline btn-sm w-full mb-2"
                                                    onclick="this.nextElementSibling.classList.toggle('hidden')">
                                                <i data-lucide="plus"></i> Add Subtask
                                            </button>
                                            <div class="hidden">
                                                <div
                                                    class="p-3 rounded-lg bg-blue-50 border border-blue-200">
                                                    <h4
                                                        class="text-md font-bold text-blue-600 mb-2 flex items-center gap-2">
                                                        <svg class="w-4 h-4 text-blue-400"
                                                             fill="none" stroke="currentColor"
                                                             viewBox="0 0 24 24">
                                                            <path stroke-linecap="round"
                                                                  stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M12 4v16m8-8H4"/>
                                                        </svg>
                                                        Add Subtask
                                                    </h4>
                                                    <div class="space-y-2">
                                                        <input type="text"
                                                               placeholder="Subtask Name"
                                                               class="input input-bordered w-full mb-1"
                                                               wire:model.defer="subtaskName.{{ $task->id }}">
                                                        <textarea
                                                            placeholder="Subtask Description"
                                                            class="textarea textarea-bordered w-full mb-1"
                                                            wire:model.defer="subtaskDescription.{{ $task->id }}"></textarea>
                                                        <select
                                                            wire:model.defer="subtaskAssignedVolunteer.{{ $task->id }}"
                                                            class="select select-bordered w-full mb-1">
                                                            <option value="">Assign
                                                                Volunteer
                                                            </option>
                                                            @foreach ($acceptedUsers as $volunteer)
                                                                <option
                                                                    value="{{ $volunteer->id }}">
                                                                    {{ $volunteer->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <button type="button"
                                                                class="btn btn-primary w-full"
                                                                wire:click="addSubtask({{ $task->id }})">
                                                            Add
                                                            Subtask
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex gap-2 mt-4">
                                            <button type="submit" class="btn btn-primary flex-1"
                                                    onclick="document.getElementById('my-drawer-{{ $task->id }}').checked=false;">
                                                Update
                                            </button>
                                            <label for="my-drawer-{{ $task->id }}"
                                                   class="btn btn-ghost flex-1">Cancel</label>
                                        </div>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                    <!-- The button to open modal -->
                    <label for="my_modal_6" class="btn w-full"> <i data-lucide="book-plus"></i>
                        Add a
                        task</label>

                    <!-- Put this part before </body> tag -->
                    <input type="checkbox" id="my_modal_6" class="modal-toggle"/>
                    <div class="modal" role="dialog">
                        <div
                            class="modal-box rounded-xl shadow-2xl border border-blue-200 bg-gradient-to-br from-white via-blue-50 to-blue-100">
                            <form wire:submit.prevent="addTask" class="space-y-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-6 h-6 text-blue-500" fill="none"
                                         stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    <h3 class="text-xl font-bold text-blue-700">Add Task</h3>
                                </div>

                                <input type="text" placeholder="Task Name"
                                       class="input input-bordered w-full mb-2 focus:ring-2 focus:ring-blue-400"
                                       wire:model="taskName">

                                <div class="flex gap-2">
                                    <button type="submit" class="btn btn-primary flex-1"
                                            onclick="document.getElementById('my_modal_6').checked=false;">
                                        <svg class="w-4 h-4 mr-1" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Add Task
                                    </button>
                                    <label for="my_modal_6"
                                           class="btn btn-ghost flex-1">Cancel</label>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Doing List -->
            <div
                class="flex-1 min-w-[260px] bg-white rounded-xl shadow-lg border border-yellow-100 p-6">
                <h3 class="text-md font-bold text-yellow-700 mb-4 flex items-center gap-2">
                    <i data-lucide="loader" class="w-5 h-5 text-yellow-400 animate-spin"></i>
                    Doing
                </h3>
                <div class="space-y-5">
                    @foreach ($tasks->where('status', 'doing') as $task)
                        <div class="drawer drawer-end">
                            <input id="my-drawer-{{ $task->id }}" type="checkbox"
                                   class="drawer-toggle"/>
                            <div class="drawer-content">
                                <div
                                    class="bg-gradient-to-br from-yellow-50 to-white rounded-xl p-4 border border-yellow-200 shadow-sm hover:shadow-lg transition-shadow duration-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4
                                            class="font-semibold text-gray-800 text-lg flex items-center gap-2">
                                            <i data-lucide="circle-dot"
                                               class="w-4 h-4 text-yellow-400"></i>
                                            {{ $task->name }}
                                        </h4>
                                        <span
                                            class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Doing</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">
                                        {{ $task->description }}
                                    </p>
                                    <div class="flex items-center gap-2 mb-2">
                                        @if ($task->assignedUser && $task->assignedUser->id)
                                            <img
                                                src="{{ $task->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $task->assignedUser->id . '.jpg' }}"
                                                alt="Profile Photo"
                                                class="inline-block w-5 h-5 rounded-full"/>
                                            <span
                                                class="ml-1 text-xs text-gray-700">{{ $task->assignedUser->name }}</span>
                                        @endif
                                    </div>
                                    <label for="my-drawer-{{ $task->id }}"
                                           wire:click="editTask({{ $task->id }})"
                                           class="btn btn-sm btn-outline btn-warning w-full font-semibold flex items-center justify-center gap-2 transition-colors duration-150">
                                        <i data-lucide="square-pen" class="w-4 h-4"></i> Edit
                                        Task
                                    </label>
                                </div>
                            </div>
                            <div class="drawer-side">
                                <label for="my-drawer-{{ $task->id }}"
                                       aria-label="close sidebar"
                                       class="drawer-overlay"></label>
                                <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                                    <form wire:submit.prevent="updateTask({{ $task->id }})"
                                          class="space-y-4">
                                        <h3
                                            class="text-lg font-bold text-blue-700 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-blue-500" fill="none"
                                                 stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            Edit Task
                                        </h3>

                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                            <textarea
                                                wire:model.defer="taskDescription.{{ $task->id }}"
                                                placeholder="Description"
                                                class="textarea textarea-bordered w-full"></textarea>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-1">Assign
                                                Volunteer</label>
                                            <select
                                                wire:model.defer="assignedVolunteer.{{ $task->id }}"
                                                class="select select-bordered w-full">
                                                <option value="">Select Volunteer
                                                </option>
                                                @foreach ($acceptedUsers as $volunteer)
                                                    <option value="{{ $volunteer->id }}">
                                                        {{ $volunteer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @if ($task->subtasks->where('parent_id', $task->id)->count())
                                            <div
                                                class="mt-4 p-3 rounded-lg bg-blue-50 border border-blue-200">
                                                <h4
                                                    class="text-md font-bold text-blue-600 mb-2 flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-blue-400"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M12 4v16m8-8H4"/>
                                                    </svg>
                                                    Subtasks
                                                </h4>
                                                <ul class="space-y-2">
                                                    @foreach ($task->subtasks->where('parent_id', $task->id) as $subtask)
                                                        <li
                                                            class="flex items-center justify-between bg-white rounded-lg px-3 py-2 border border-blue-100">
                                                            <div>
                                                                                        <span
                                                                                            class="font-semibold text-gray-800">{{ $subtask->name }}</span>
                                                                <span
                                                                    class="ml-2 text-xs text-gray-500">{{ $subtask->description }}</span>
                                                                <span
                                                                    class="ml-2 text-xs text-gray-400">({{ $subtask->status }})</span>
                                                            </div>
                                                            <div
                                                                class="flex items-center gap-2">
                                                                @if ($subtask->assignedUser)
                                                                    <img
                                                                        src="{{ $subtask->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $subtask->assignedUser->id . '.jpg' }}"
                                                                        alt="Profile Photo"
                                                                        class="inline-block w-5 h-5 rounded-full"/>
                                                                    <span
                                                                        class="ml-1 text-xs text-gray-700">{{ $subtask->assignedUser->name }}</span>
                                                                @else
                                                                    <span
                                                                        class="ml-1 text-xs text-gray-400">Unassigned</span>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="mt-4">
                                            <button type="button"
                                                    class="btn btn-outline btn-sm w-full mb-2"
                                                    onclick="this.nextElementSibling.classList.toggle('hidden')">
                                                <i data-lucide="plus"></i> Add Subtask
                                            </button>
                                            <div class="hidden">
                                                <div
                                                    class="p-3 rounded-lg bg-blue-50 border border-blue-200">
                                                    <h4
                                                        class="text-md font-bold text-blue-600 mb-2 flex items-center gap-2">
                                                        <svg class="w-4 h-4 text-blue-400"
                                                             fill="none" stroke="currentColor"
                                                             viewBox="0 0 24 24">
                                                            <path stroke-linecap="round"
                                                                  stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M12 4v16m8-8H4"/>
                                                        </svg>
                                                        Add Subtask
                                                    </h4>
                                                    <div class="space-y-2">
                                                        <input type="text"
                                                               placeholder="Subtask Name"
                                                               class="input input-bordered w-full mb-1"
                                                               wire:model.defer="subtaskName.{{ $task->id }}">
                                                        <textarea
                                                            placeholder="Subtask Description"
                                                            class="textarea textarea-bordered w-full mb-1"
                                                            wire:model.defer="subtaskDescription.{{ $task->id }}"></textarea>
                                                        <select
                                                            wire:model.defer="subtaskAssignedVolunteer.{{ $task->id }}"
                                                            class="select select-bordered w-full mb-1">
                                                            <option value="">Assign
                                                                Volunteer
                                                            </option>
                                                            @foreach ($acceptedUsers as $volunteer)
                                                                <option
                                                                    value="{{ $volunteer->id }}">
                                                                    {{ $volunteer->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <button type="button"
                                                                class="btn btn-primary w-full"
                                                                wire:click="addSubtask({{ $task->id }})">
                                                            Add
                                                            Subtask
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex gap-2 mt-4">
                                            <button type="submit" class="btn btn-primary flex-1"
                                                    onclick="document.getElementById('my-drawer-{{ $task->id }}').checked=false;">
                                                Update
                                            </button>
                                            <label for="my-drawer-{{ $task->id }}"
                                                   class="btn btn-ghost flex-1">Cancel</label>
                                        </div>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Done List -->
            <div
                class="flex-1 min-w-[260px] bg-white rounded-xl shadow-lg border border-green-100 p-6">
                <h3 class="text-md font-bold text-green-700 mb-4 flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-400"></i>
                    Done
                </h3>
                <div class="space-y-5">
                    @foreach ($tasks->where('status', 'done') as $task)
                        <div class="drawer drawer-end">
                            <input id="my-drawer-{{ $task->id }}" type="checkbox"
                                   class="drawer-toggle"/>
                            <div class="drawer-content">
                                <div
                                    class="bg-gradient-to-br from-green-50 to-white rounded-xl p-4 border border-green-200 shadow-sm hover:shadow-lg transition-shadow duration-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4
                                            class="font-semibold text-gray-800 text-lg flex items-center gap-2">
                                            <i data-lucide="check"
                                               class="w-4 h-4 text-green-400"></i>
                                            {{ $task->name }}
                                        </h4>
                                        <span
                                            class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Done</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">
                                        {{ $task->description }}
                                    </p>
                                    <div class="flex items-center gap-2 mb-2">
                                        @if ($task->assignedUser && $task->assignedUser->id)
                                            <img
                                                src="{{ $task->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $task->assignedUser->id . '.jpg' }}"
                                                alt="Profile Photo"
                                                class="inline-block w-5 h-5 rounded-full"/>
                                            <span
                                                class="ml-1 text-xs text-gray-700">{{ $task->assignedUser->name }}</span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
