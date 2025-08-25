<x-requester.dashboard-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Main Container -->
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                <!-- Hero Section -->
                <div class="relative h-64 sm:h-80 lg:h-96">
                    <img src="{{ $event->image ?? 'https://picsum.photos/seed/' . $event->id . '/1200/800' }}"
                        alt="Event Image" class="w-full h-full object-cover opacity-90">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white drop-shadow-lg">
                                {{ $event->name }}
                            </h1>
                            <div class="mt-3 px-4 py-2 bg-white/80 rounded-full text-sm font-semibold text-blue-800">
                                {{ $event->category->name }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="p-6 sm:p-8 lg:p-12">
                    <!-- Back Button -->
                    <div class="mb-6">
                        <a href="/requester/dashboard/my-events" wire:navigate
                            class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 group-hover:-translate-x-1 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Back to My Events
                        </a>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                        <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm">
                            <i data-lucide="users" class="w-8 h-8 text-blue-600 mx-auto mb-2"></i>
                            <div class="text-sm text-gray-500">Total Applications</div>
                            <div class="font-semibold text-gray-800">{{ $event->users->count() }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm">
                            <i data-lucide="check-circle" class="w-8 h-8 text-green-600 mx-auto mb-2"></i>
                            <div class="text-sm text-gray-500">Approved</div>
                            <div class="font-semibold text-gray-800">{{ $acceptedUsers->count() }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm">
                            <i data-lucide="clock" class="w-8 h-8 text-yellow-600 mx-auto mb-2"></i>
                            <div class="text-sm text-gray-500">Pending Review</div>
                            <div class="font-semibold text-gray-800">{{ $pendingUsers->count() }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm">
                            <i data-lucide="user" class="w-8 h-8 text-purple-600 mx-auto mb-2"></i>
                            <div class="text-sm text-gray-500">Max Capacity</div>
                            <div class="font-semibold text-gray-800">{{ $event->maximum_participants }}</div>
                        </div>
                    </div>

                    <!-- Trello-like Volunteer Board -->
                    <div class="mt-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Volunteers</h2>
                        <div class="flex flex-col md:flex-row gap-4 overflow-x-auto pb-4">
                            <!-- Approved Volunteers Column -->
                            <div class="flex-1 min-w-[280px] bg-gray-100 rounded-xl p-4 shadow-md">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-bold text-green-700 flex items-center gap-2">
                                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                                        Approved Volunteers
                                    </h3>
                                    <span class="text-sm text-gray-500">{{ $acceptedUsers->count() }}</span>
                                </div>
                                <div class="space-y-3 volunteer-column" data-status="accepted">
                                    @foreach ($acceptedUsers as $user)
                                        <div class="volunteer-card bg-white rounded-lg p-4 shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200 cursor-move"
                                            draggable="true" data-user-id="{{ $user->id }}">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $user->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $user->id . '.jpg' }}"
                                                    alt="{{ $user->name }}"
                                                    class="w-10 h-10 rounded-full object-cover border-2 border-green-500">
                                                <div class="flex-1">
                                                    <h3 class="font-semibold text-gray-800">{{ $user->name }}</h3>
                                                    <p class="text-xs text-gray-600">
                                                        {{ $user->role->name ?? 'Volunteer' }} • 4.9★</p>
                                                    <div class="flex gap-2 mt-1">
                                                        <span
                                                            class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Experienced</span>
                                                        <span
                                                            class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Local</span>
                                                    </div>
                                                </div>
                                                <button wire:click="messageVolunteer({{ $user->id }})"
                                                    class="p-2 bg-blue-100 hover:bg-blue-200 rounded-lg transition-colors">
                                                    <i data-lucide="message-circle" class="w-4 h-4 text-blue-600"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Pending Approval Column -->
                            <div class="flex-1 min-w-[280px] bg-gray-100 rounded-xl p-4 shadow-md">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-bold text-yellow-700 flex items-center gap-2">
                                        <i data-lucide="clock" class="w-5 h-5 text-yellow-500"></i>
                                        Pending Approval
                                    </h3>
                                    <span class="text-sm text-gray-500">{{ $pendingUsers->count() }}</span>
                                </div>
                                <div class="space-y-3 volunteer-column" data-status="pending">
                                    @foreach ($pendingUsers as $user)
                                        <div class="volunteer-card bg-white rounded-lg p-4 shadow-sm border border-yellow-200 hover:shadow-md transition-all duration-200 cursor-move"
                                            draggable="true" data-user-id="{{ $user->id }}">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $user->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $user->id . '.jpg' }}"
                                                    alt="{{ $user->name }}"
                                                    class="w-10 h-10 rounded-full object-cover border-2 border-yellow-500">
                                                <div class="flex-1">
                                                    <h3 class="font-semibold text-gray-800">{{ $user->name }}</h3>
                                                    <p class="text-xs text-gray-600">
                                                        {{ $user->role->name ?? 'Volunteer' }} • 4.6★</p>
                                                    <div class="flex gap-2 mt-1">
                                                        <span
                                                            class="px-2 py-1 bg-orange-100 text-orange-700 text-xs rounded-full">Leadership</span>
                                                        <span
                                                            class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">3
                                                            Events</span>
                                                    </div>
                                                    <p class="text-xs text-gray-500 mt-1">Applied
                                                        {{ $user->pivot->created_at->diffForHumans() }}</p>
                                                </div>
                                                <div class="flex gap-2">
                                                    <button wire:click="approve({{ $user->id }})"
                                                        class="px-2 py-1 bg-green-500 hover:bg-green-600 text-white rounded-lg text-xs font-medium transition-colors">
                                                        Approve
                                                    </button>
                                                    <button wire:click="decline({{ $user->id }})"
                                                        class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-medium transition-colors">
                                                        Decline
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($pendingUsers->count() > 0)
                                        <div class="pt-3 border-t border-gray-300">
                                            <button wire:click="approveAll"
                                                class="w-full flex items-center justify-center gap-2 bg-green-500 text-white text-sm font-medium py-2 rounded-lg hover:bg-green-600 transition-colors">
                                                <i data-lucide="check-circle" class="w-4 h-4"></i> Approve All
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tasks & Subtasks Column -->
                    <div class="min-w-[300px] bg-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m-6 4h12m-6 4h6m-9-8h6m-9 4h6m-9 4h6" />
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
                            <div class="flex-1 min-w-[260px] bg-white rounded-xl shadow-lg border border-blue-100 p-6">
                                <h3 class="text-md font-bold text-blue-700 mb-4 flex items-center gap-2">
                                    <i data-lucide="list-todo" class="w-5 h-5 text-blue-400"></i>
                                    Todo
                                </h3>
                                <div class="space-y-5">
                                    @foreach ($tasks->where('status', 'todo') as $task)
                                        <div class="drawer drawer-end">
                                            <input id="my-drawer-{{ $task->id }}" type="checkbox"
                                                class="drawer-toggle" />
                                            <div class="drawer-content">
                                                <div
                                                    class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-4 border border-blue-200 shadow-sm hover:shadow-lg transition-shadow duration-200">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <h4
                                                            class="font-semibold text-gray-800 text-lg flex items-center gap-2">
                                                            <i data-lucide="circle" class="w-4 h-4 text-blue-400"></i>
                                                            {{ $task->name }}
                                                        </h4>
                                                        <span
                                                            class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Todo</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600 mb-2">{{ $task->description }}</p>
                                                    <div class="flex items-center gap-2 mb-2">
                                                        @if ($task->assignedUser && $task->assignedUser->id)
                                                            <img src="{{ $task->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $task->assignedUser->id . '.jpg' }}"
                                                                alt="Profile Photo"
                                                                class="inline-block w-5 h-5 rounded-full" />
                                                            <span
                                                                class="ml-1 text-xs text-gray-700">{{ $task->assignedUser->name }}</span>
                                                        @endif
                                                    </div>
                                                    <label for="my-drawer-{{ $task->id }}"
                                                        wire:click="editTask({{ $task->id }})"
                                                        class="btn btn-sm btn-outline btn-info w-full font-semibold flex items-center justify-center gap-2 transition-colors duration-150">
                                                        <i data-lucide="square-pen" class="w-4 h-4"></i> Edit Task
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="drawer-side">
                                                <label for="my-drawer-{{ $task->id }}" aria-label="close sidebar"
                                                    class="drawer-overlay"></label>
                                                <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                                                    <form wire:submit.prevent="updateTask({{ $task->id }})"
                                                        class="space-y-4">
                                                        <h3
                                                            class="text-lg font-bold text-blue-700 flex items-center gap-2">
                                                            <svg class="w-5 h-5 text-blue-500" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M12 4v16m8-8H4" />
                                                            </svg>
                                                            Edit Task
                                                        </h3>

                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                                            <textarea wire:model.defer="taskDescription.{{ $task->id }}" placeholder="Description"
                                                                class="textarea textarea-bordered w-full"></textarea>
                                                        </div>
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Assign
                                                                Volunteer</label>
                                                            <select
                                                                wire:model.defer="assignedVolunteer.{{ $task->id }}"
                                                                class="select select-bordered w-full">
                                                                <option value="">Select Volunteer</option>
                                                                @foreach ($acceptedUsers as $volunteer)
                                                                    <option value="{{ $volunteer->id }}">
                                                                        {{ $volunteer->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        @if ($task->subtasks->where('parent_id', $task->id)->count())
                                                            <div
                                                                class="mt-4 p-3 rounded-lg bg-blue-50 border border-blue-200">
                                                                <h4
                                                                    class="text-md font-bold text-blue-600 mb-2 flex items-center gap-2">
                                                                    <svg class="w-4 h-4 text-blue-400" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M12 4v16m8-8H4" />
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
                                                                            <div class="flex items-center gap-2">
                                                                                @if ($subtask->assignedUser)
                                                                                    <img src="{{ $subtask->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $subtask->assignedUser->id . '.jpg' }}"
                                                                                        alt="Profile Photo"
                                                                                        class="inline-block w-5 h-5 rounded-full" />
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
                                                                                stroke-width="2" d="M12 4v16m8-8H4" />
                                                                        </svg>
                                                                        Add Subtask
                                                                    </h4>
                                                                    <div class="space-y-2">
                                                                        <input type="text"
                                                                            placeholder="Subtask Name"
                                                                            class="input input-bordered w-full mb-1"
                                                                            wire:model.defer="subtaskName.{{ $task->id }}">
                                                                        <textarea placeholder="Subtask Description" class="textarea textarea-bordered w-full mb-1"
                                                                            wire:model.defer="subtaskDescription.{{ $task->id }}"></textarea>
                                                                        <select
                                                                            wire:model.defer="subtaskAssignedVolunteer.{{ $task->id }}"
                                                                            class="select select-bordered w-full mb-1">
                                                                            <option value="">Assign Volunteer
                                                                            </option>
                                                                            @foreach ($acceptedUsers as $volunteer)
                                                                                <option value="{{ $volunteer->id }}">
                                                                                    {{ $volunteer->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <button type="button"
                                                                            class="btn btn-primary w-full"
                                                                            wire:click="addSubtask({{ $task->id }})">Add
                                                                            Subtask</button>
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
                                    <label for="my_modal_6" class="btn w-full"> <i data-lucide="book-plus"></i> Add a
                                        task</label>

                                    <!-- Put this part before </body> tag -->
                                    <input type="checkbox" id="my_modal_6" class="modal-toggle" />
                                    <div class="modal" role="dialog">
                                        <div
                                            class="modal-box rounded-xl shadow-2xl border border-blue-200 bg-gradient-to-br from-white via-blue-50 to-blue-100">
                                            <form wire:submit.prevent="addTask" class="space-y-4">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <svg class="w-6 h-6 text-blue-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
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
                                                                stroke-width="2" d="M12 4v16m8-8H4" />
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
                                                class="drawer-toggle" />
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
                                                    <p class="text-sm text-gray-600 mb-2">{{ $task->description }}</p>
                                                    <div class="flex items-center gap-2 mb-2">
                                                        @if ($task->assignedUser && $task->assignedUser->id)
                                                            <img src="{{ $task->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $task->assignedUser->id . '.jpg' }}"
                                                                alt="Profile Photo"
                                                                class="inline-block w-5 h-5 rounded-full" />
                                                            <span
                                                                class="ml-1 text-xs text-gray-700">{{ $task->assignedUser->name }}</span>
                                                        @endif
                                                    </div>
                                                    <label for="my-drawer-{{ $task->id }}"
                                                        wire:click="editTask({{ $task->id }})"
                                                        class="btn btn-sm btn-outline btn-warning w-full font-semibold flex items-center justify-center gap-2 transition-colors duration-150">
                                                        <i data-lucide="square-pen" class="w-4 h-4"></i> Edit Task
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="drawer-side">
                                                <label for="my-drawer-{{ $task->id }}" aria-label="close sidebar"
                                                    class="drawer-overlay"></label>
                                                <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                                                    <form wire:submit.prevent="updateTask({{ $task->id }})"
                                                        class="space-y-4">
                                                        <h3
                                                            class="text-lg font-bold text-blue-700 flex items-center gap-2">
                                                            <svg class="w-5 h-5 text-blue-500" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M12 4v16m8-8H4" />
                                                            </svg>
                                                            Edit Task
                                                        </h3>

                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                                            <textarea wire:model.defer="taskDescription.{{ $task->id }}" placeholder="Description"
                                                                class="textarea textarea-bordered w-full"></textarea>
                                                        </div>
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 mb-1">Assign
                                                                Volunteer</label>
                                                            <select
                                                                wire:model.defer="assignedVolunteer.{{ $task->id }}"
                                                                class="select select-bordered w-full">
                                                                <option value="">Select Volunteer</option>
                                                                @foreach ($acceptedUsers as $volunteer)
                                                                    <option value="{{ $volunteer->id }}">
                                                                        {{ $volunteer->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        @if ($task->subtasks->where('parent_id', $task->id)->count())
                                                            <div
                                                                class="mt-4 p-3 rounded-lg bg-blue-50 border border-blue-200">
                                                                <h4
                                                                    class="text-md font-bold text-blue-600 mb-2 flex items-center gap-2">
                                                                    <svg class="w-4 h-4 text-blue-400" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M12 4v16m8-8H4" />
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
                                                                            <div class="flex items-center gap-2">
                                                                                @if ($subtask->assignedUser)
                                                                                    <img src="{{ $subtask->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $subtask->assignedUser->id . '.jpg' }}"
                                                                                        alt="Profile Photo"
                                                                                        class="inline-block w-5 h-5 rounded-full" />
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
                                                                                stroke-width="2" d="M12 4v16m8-8H4" />
                                                                        </svg>
                                                                        Add Subtask
                                                                    </h4>
                                                                    <div class="space-y-2">
                                                                        <input type="text"
                                                                            placeholder="Subtask Name"
                                                                            class="input input-bordered w-full mb-1"
                                                                            wire:model.defer="subtaskName.{{ $task->id }}">
                                                                        <textarea placeholder="Subtask Description" class="textarea textarea-bordered w-full mb-1"
                                                                            wire:model.defer="subtaskDescription.{{ $task->id }}"></textarea>
                                                                        <select
                                                                            wire:model.defer="subtaskAssignedVolunteer.{{ $task->id }}"
                                                                            class="select select-bordered w-full mb-1">
                                                                            <option value="">Assign Volunteer
                                                                            </option>
                                                                            @foreach ($acceptedUsers as $volunteer)
                                                                                <option value="{{ $volunteer->id }}">
                                                                                    {{ $volunteer->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <button type="button"
                                                                            class="btn btn-primary w-full"
                                                                            wire:click="addSubtask({{ $task->id }})">Add
                                                                            Subtask</button>
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
                                                class="drawer-toggle" />
                                            <div class="drawer-content">
                                                <div
                                                    class="bg-gradient-to-br from-green-50 to-white rounded-xl p-4 border border-green-200 shadow-sm hover:shadow-lg transition-shadow duration-200">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <h4
                                                            class="font-semibold text-gray-800 text-lg flex items-center gap-2">
                                                            <i data-lucide="check" class="w-4 h-4 text-green-400"></i>
                                                            {{ $task->name }}
                                                        </h4>
                                                        <span
                                                            class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Done</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600 mb-2">{{ $task->description }}</p>
                                                    <div class="flex items-center gap-2 mb-2">
                                                        @if ($task->assignedUser && $task->assignedUser->id)
                                                            <img src="{{ $task->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $task->assignedUser->id . '.jpg' }}"
                                                                alt="Profile Photo"
                                                                class="inline-block w-5 h-5 rounded-full" />
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


                    {{-- Certificate Table Section - below task board --}}
                    @if (isset($acceptedUsers) && $acceptedUsers->count() > 0)
                        <div class="mt-12 mb-8">
                            <h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-gray-800">
                                <i data-lucide="award" class="w-6 h-6 text-yellow-500"></i>
                                Issue Certificates
                            </h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white rounded-xl shadow border border-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tl-xl">
                                                Name</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                                Tasks Status</th>
                                            <th
                                                class=" flex justify-end px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tr-xl">
                                                Certificate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($acceptedUsers as $volunteer)
                                            <tr class="border-b last:border-b-0 hover:bg-gray-50 transition">
                                                <td class="px-6 py-4 flex items-center gap-3">
                                                    <img src="{{ $volunteer->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $volunteer->id . '.jpg' }}"
                                                        alt="{{ $volunteer->name }}"
                                                        class="w-8 h-8 rounded-full border-2 border-blue-100">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $volunteer->name }}</span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    @php
                                                        $assignedTasks = $tasks->where('assigned_id', $volunteer->id);
                                                        $doneTasksCount = $assignedTasks
                                                            ->where('status', 'done')
                                                            ->count();
                                                        $totalAssignedCount = $assignedTasks->count();
                                                    @endphp
                                                    @if ($totalAssignedCount > 0 && $doneTasksCount === $totalAssignedCount)
                                                        <span
                                                            class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full font-bold">
                                                            <i data-lucide="check-circle" class="w-4 h-4"></i> All
                                                            Tasks Completed
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center gap-1 px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">
                                                            <i data-lucide="alert-circle" class="w-4 h-4"></i> Pending
                                                            Tasks
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 flex justify-end">
                                                    @if ($totalAssignedCount > 0 && $doneTasksCount === $totalAssignedCount)
                                                        <form method="GET"
                                                            action="{{ route('certificate.issue', ['id' => $event->id, 'volunteerid' => $volunteer->id]) }}"
                                                            class="inline">

                                                            <button class="btn btn-info">
                                                                <i data-lucide="eye" class="w-4 h-4"></i> View
                                                                Certificate
                                                            </button>
                                                        </form>
                                                    @elseif(!empty($volunteer->certificate_issued))
                                                        <span
                                                            class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 text-gray-500 text-xs rounded-full">
                                                            <i data-lucide="award" class="w-4 h-4"></i> Certificate
                                                            Issued
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center gap-1 px-2 py-1 bg-gray-50 text-gray-400 text-xs rounded-full">
                                                            <i data-lucide="slash" class="w-4 h-4"></i> Not Eligible
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    <!-- Add Task Modal -->

                </div>
            </div>
        </div>

</x-requester.dashboard-layout>
