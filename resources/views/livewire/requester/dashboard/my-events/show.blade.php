<x-requester.dashboard-layout>
    <div class="min-h-screen bg-gray-100">
        <!-- Back Button and Event Header -->
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between mb-6">
                <a href="/requester/dashboard/my-events" wire:navigate
                    class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to My Events
                </a>
                <div class="text-right">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $event->name }}</h1>
                    <div class="flex items-center gap-4 text-gray-600 text-sm mt-2">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $event->starts_at->format('F j, Y') }}
                        </span>
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $location }}
                        </span>
                        <span
                            class="px-2 py-1 bg-{{ $event->category->color }} text-blue-600 rounded-full text-xs font-medium">
                            <span class="inline-block w-3 h-3 rounded-full mr-2"
                                style="background: {{ $event->category->color ?? '#ccc' }};"></span>
                            {{ $event->category->name }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200 text-center">
                    <p class="text-sm text-gray-600">Total Applications</p>
                    <p class="text-xl font-bold text-blue-600">{{ $event->users->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200 text-center">
                    <p class="text-sm text-gray-600">Approved</p>
                    <p class="text-xl font-bold text-green-600">{{ $acceptedUsers->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200 text-center">
                    <p class="text-sm text-gray-600">Pending Review</p>
                    <p class="text-xl font-bold text-yellow-600">{{ $pendingUsers->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200 text-center">
                    <p class="text-sm text-gray-600">Max Capacity</p>
                    <p class="text-xl font-bold text-purple-600">{{ $event->maximum_participants }}</p>
                </div>
            </div>

            <!-- Trello-like Board -->
            <div class="flex flex-col lg:flex-row gap-4 overflow-x-auto pb-4">
                <!-- Approved Volunteers Column -->
                <div class="flex-1 min-w-[300px] bg-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Approved Volunteers
                        </h2>
                        <span class="px-2 py-1 bg-green-100 text-green-600 rounded-full text-xs font-medium">
                            {{ $acceptedUsers->count() }}
                        </span>
                    </div>
                    <div class="space-y-3">
                        @foreach ($acceptedUsers as $user)
                            <div
                                class="bg-white rounded-lg p-4 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $user->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $user->id . '.jpg' }}"
                                        alt="{{ $user->name }}"
                                        class="w-10 h-10 rounded-full object-cover border-2 border-green-500">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-800">{{ $user->name }}</h3>
                                        <p class="text-xs text-gray-600">{{ $user->role->name ?? 'Volunteer' }} • 4.9★
                                        </p>
                                        <div class="flex gap-2 mt-1">
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Experienced</span>
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Local</span>
                                        </div>
                                    </div>
                                    <button wire:click="messageVolunteer({{ $user->id }})"
                                        class="p-2 bg-blue-100 hover:bg-blue-200 rounded-lg transition-colors">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pending Approval Column -->
                <div class="flex-1 min-w-[300px] bg-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Pending Approval
                        </h2>
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-600 rounded-full text-xs font-medium">
                            {{ $pendingUsers->count() }}
                        </span>
                    </div>
                    <div class="space-y-3">
                        @foreach ($pendingUsers as $user)
                            <div
                                class="bg-white rounded-lg p-4 shadow-sm border border-yellow-200 hover:shadow-md transition-shadow">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $user->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $user->id . '.jpg' }}"
                                        alt="{{ $user->name }}"
                                        class="w-10 h-10 rounded-full object-cover border-2 border-yellow-500">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-800">{{ $user->name }}</h3>
                                        <p class="text-xs text-gray-600">{{ $user->role->name ?? 'Volunteer' }} • 4.6★
                                        </p>
                                        <div class="flex gap-2 mt-1">
                                            <span
                                                class="px-2 py-1 bg-orange-100 text-orange-700 text-xs rounded-full">Leadership</span>
                                            <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">3
                                                Events</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Applied
                                            {{ $user->pivot->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button wire:click="approve({{ $user->id }})"
                                            class="px-2 py-1 bg-green-600 hover:bg-green-700 text-white rounded-lg text-xs font-medium transition-colors">
                                            Approve
                                        </button>
                                        <button wire:click="decline({{ $user->id }})"
                                            class="px-2 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-medium transition-colors">
                                            Decline
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="pt-3 border-t border-gray-300">
                            <button wire:click="approveAll"
                                class="w-full px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors">
                                Approve All
                            </button>
                        </div>
                    </div>
                </div>



                <!-- Quick Actions Column -->
                <div class="flex-1 min-w-[200px] bg-gray-200 rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h2>
                    <div class="space-y-3">
                        <button wire:click="sendMessage"
                            class="w-full flex items-center gap-2 p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Send Message
                        </button>
                        <button wire:click="exportList"
                            class="w-full flex items-center gap-2 p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export List
                        </button>
                        <a href="#"
                            class="w-full flex items-center gap-2 p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Event Settings
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tasks & Subtasks Column -->
            <div class="min-w-[300px] bg-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <div class="flex-1 min-w-[260px] bg-white rounded-lg shadow-md border border-gray-200 p-4">
                        <h3 class="text-md font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <span class="inline-block w-2 h-2 bg-blue-400 rounded-full"></span> Todo
                        </h3>
                        <div class="space-y-3">
                            @foreach ($tasks->where('status', 'todo') as $task)
                                <div class="drawer drawer-end">
                                    <input id="my-drawer-{{ $task->id }}" type="checkbox"
                                        class="drawer-toggle" />
                                    <div class="drawer-content">
                                        <div class="bg-gray-50 rounded-lg p-3 border border-blue-100 shadow-sm">
                                            <div class="flex items-center justify-between mb-2">
                                                <h4 class="font-semibold text-gray-800">{{ $task->name }}</h4>
                                                <label for="my-drawer-{{ $task->id }}"
                                                    wire:click="editTask({{ $task->id }})"><i
                                                        data-lucide="square-pen"></i></label>
                                            </div>
                                            <p class="text-xs text-gray-600">
                                                {{ $task->description }}</p>
                                            <p class="text-xs text-gray-500">
                                                @if ($task->assignedUser && $task->assignedUser->id)
                                                    <img src="{{ $task->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $task->assignedUser->id . '.jpg' }}"
                                                        alt="Profile Photo"
                                                        class="inline-block w-4 h-4 rounded-full" />
                                                    <span class="ml-1">{{ $task->assignedUser->name }}</span>
                                                @endif
                                            </p>
                                            <!-- Subtasks -->
                                            <div class="mt-2">
                                                @foreach ($task->subtasks as $subtask)
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <span
                                                            class="text-xs text-gray-700">{{ $subtask->name }}</span>
                                                        {{-- <span
                                                            class="text-xs text-gray-400">({{ $subtask->status }})</span> --}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="drawer-side">
                                        <label for="my-drawer-{{ $task->id }}" aria-label="close sidebar"
                                            class="drawer-overlay"></label>
                                        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                                            <form wire:submit.prevent="updateTask({{ $task->id }})"
                                                class="space-y-4">
                                                <h3 class="text-lg font-bold text-blue-700 flex items-center gap-2">
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
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Assign
                                                        Volunteer</label>
                                                    <select wire:model.defer="assignedVolunteer.{{ $task->id }}"
                                                        class="select select-bordered w-full">
                                                        <option value="">Select Volunteer</option>
                                                        @foreach ($acceptedUsers as $volunteer)
                                                            <option value="{{ $volunteer->id }}">
                                                                {{ $volunteer->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                                    <select wire:model.defer="taskStatus.{{ $task->id }}"
                                                        class="select select-bordered w-full">
                                                        <option value="todo">Todo</option>
                                                        <option value="doing">Doing</option>
                                                        <option value="done">Done</option>
                                                    </select>
                                                </div>
                                                @if ($task->subtasks->where('parent_id', $task->id)->count())
                                                    <div class="mt-4 p-3 rounded-lg bg-blue-50 border border-blue-200">
                                                        <h4
                                                            class="text-md font-bold text-blue-600 mb-2 flex items-center gap-2">
                                                            <svg class="w-4 h-4 text-blue-400" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M12 4v16m8-8H4" />
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
                                                    <button type="button" class="btn btn-outline btn-sm w-full mb-2"
                                                        onclick="this.nextElementSibling.classList.toggle('hidden')">
                                                        <i data-lucide="plus"></i> Add Subtask
                                                    </button>
                                                    <div class="hidden">
                                                        <div class="p-3 rounded-lg bg-blue-50 border border-blue-200">
                                                            <h4
                                                                class="text-md font-bold text-blue-600 mb-2 flex items-center gap-2">
                                                                <svg class="w-4 h-4 text-blue-400" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M12 4v16m8-8H4" />
                                                                </svg>
                                                                Add Subtask
                                                            </h4>
                                                            <div class="space-y-2">
                                                                <input type="text" placeholder="Subtask Name"
                                                                    class="input input-bordered w-full mb-1"
                                                                    wire:model.defer="subtaskName.{{ $task->id }}">
                                                                <textarea placeholder="Subtask Description" class="textarea textarea-bordered w-full mb-1"
                                                                    wire:model.defer="subtaskDescription.{{ $task->id }}"></textarea>
                                                                <select
                                                                    wire:model.defer="subtaskAssignedVolunteer.{{ $task->id }}"
                                                                    class="select select-bordered w-full mb-1">
                                                                    <option value="">Assign Volunteer</option>
                                                                    @foreach ($acceptedUsers as $volunteer)
                                                                        <option value="{{ $volunteer->id }}">
                                                                            {{ $volunteer->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <button type="button" class="btn btn-primary w-full"
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
                                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            <h3 class="text-xl font-bold text-blue-700">Add Task</h3>
                                        </div>

                                        <input type="text" placeholder="Task Name"
                                            class="input input-bordered w-full mb-2 focus:ring-2 focus:ring-blue-400"
                                            wire:model="taskName">

                                        <div class="flex gap-2">
                                            <button type="submit" class="btn btn-primary flex-1"
                                                onclick="document.getElementById('my_modal_6').checked=false;">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Add Task
                                            </button>
                                            <label for="my_modal_6" class="btn btn-ghost flex-1">Cancel</label>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Doing List -->
                    <div class="flex-1 min-w-[260px] bg-white rounded-lg shadow-md border border-gray-200 p-4">
                        <h3 class="text-md font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <span class="inline-block w-2 h-2 bg-yellow-400 rounded-full"></span> Doing
                        </h3>
                        <div class="space-y-3">
                            @foreach ($tasks->where('status', 'doing') as $task)
                                <div class="drawer drawer-end">
                                    <input id="my-drawer-{{ $task->id }}" type="checkbox"
                                        class="drawer-toggle" />
                                    <div class="drawer-content">
                                        <div class="bg-gray-50 rounded-lg p-3 border border-blue-100 shadow-sm">
                                            <div class="flex items-center justify-between mb-2">
                                                <h4 class="font-semibold text-gray-800">{{ $task->name }}</h4>
                                                <label for="my-drawer-{{ $task->id }}"
                                                    wire:click="editTask({{ $task->id }})"><i
                                                        data-lucide="square-pen"></i></label>
                                            </div>
                                            <p class="text-xs text-gray-600">
                                                {{ $task->description }}</p>
                                            <p class="text-xs text-gray-500">
                                                @if ($task->assignedUser && $task->assignedUser->id)
                                                    <img src="{{ $task->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $task->assignedUser->id . '.jpg' }}"
                                                        alt="Profile Photo"
                                                        class="inline-block w-4 h-4 rounded-full" />
                                                    <span class="ml-1">{{ $task->assignedUser->name }}</span>
                                                @endif
                                            </p>
                                            <!-- Subtasks -->
                                            <div class="mt-2">
                                                @foreach ($task->subtasks as $subtask)
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <span
                                                            class="text-xs text-gray-700">{{ $subtask->name }}</span>
                                                        {{-- <span
                                                            class="text-xs text-gray-400">({{ $subtask->status }})</span> --}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="drawer-side">
                                        <label for="my-drawer-{{ $task->id }}" aria-label="close sidebar"
                                            class="drawer-overlay"></label>
                                        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                                            <form wire:submit.prevent="updateTask({{ $task->id }})"
                                                class="space-y-4">
                                                <h3 class="text-lg font-bold text-blue-700 flex items-center gap-2">
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
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Assign
                                                        Volunteer</label>
                                                    <select wire:model.defer="assignedVolunteer.{{ $task->id }}"
                                                        class="select select-bordered w-full">
                                                        <option value="">Select Volunteer</option>
                                                        @foreach ($acceptedUsers as $volunteer)
                                                            <option value="{{ $volunteer->id }}">
                                                                {{ $volunteer->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                                    <select wire:model.defer="taskStatus.{{ $task->id }}"
                                                        class="select select-bordered w-full">
                                                        <option value="todo">Todo</option>
                                                        <option value="doing">Doing</option>
                                                        <option value="done">Done</option>
                                                    </select>
                                                </div>
                                                @if ($task->subtasks->where('parent_id', $task->id)->count())
                                                    <div class="mt-4 p-3 rounded-lg bg-blue-50 border border-blue-200">
                                                        <h4
                                                            class="text-md font-bold text-blue-600 mb-2 flex items-center gap-2">
                                                            <svg class="w-4 h-4 text-blue-400" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M12 4v16m8-8H4" />
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
                                                    <button type="button" class="btn btn-outline btn-sm w-full mb-2"
                                                        onclick="this.nextElementSibling.classList.toggle('hidden')">
                                                        <i data-lucide="plus"></i> Add Subtask
                                                    </button>
                                                    <div class="hidden">
                                                        <div class="p-3 rounded-lg bg-blue-50 border border-blue-200">
                                                            <h4
                                                                class="text-md font-bold text-blue-600 mb-2 flex items-center gap-2">
                                                                <svg class="w-4 h-4 text-blue-400" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M12 4v16m8-8H4" />
                                                                </svg>
                                                                Add Subtask
                                                            </h4>
                                                            <div class="space-y-2">
                                                                <input type="text" placeholder="Subtask Name"
                                                                    class="input input-bordered w-full mb-1"
                                                                    wire:model.defer="subtaskName.{{ $task->id }}">
                                                                <textarea placeholder="Subtask Description" class="textarea textarea-bordered w-full mb-1"
                                                                    wire:model.defer="subtaskDescription.{{ $task->id }}"></textarea>
                                                                <select
                                                                    wire:model.defer="subtaskAssignedVolunteer.{{ $task->id }}"
                                                                    class="select select-bordered w-full mb-1">
                                                                    <option value="">Assign Volunteer</option>
                                                                    @foreach ($acceptedUsers as $volunteer)
                                                                        <option value="{{ $volunteer->id }}">
                                                                            {{ $volunteer->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <button type="button" class="btn btn-primary w-full"
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
                    <div class="flex-1 min-w-[260px] bg-white rounded-lg shadow-md border border-gray-200 p-4">
                        <h3 class="text-md font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <span class="inline-block w-2 h-2 bg-green-400 rounded-full"></span> Done
                        </h3>
                        <div class="space-y-3">
                            @foreach ($tasks->where('status', 'done') as $task)
                                <div class="drawer drawer-end">
                                    <input id="my-drawer-{{ $task->id }}" type="checkbox"
                                        class="drawer-toggle" />
                                    <div class="drawer-content">
                                        <div class="bg-gray-50 rounded-lg p-3 border border-blue-100 shadow-sm">
                                            <div class="flex items-center justify-between mb-2">
                                                <h4 class="font-semibold text-gray-800">{{ $task->name }}</h4>
                                                <label for="my-drawer-{{ $task->id }}"
                                                    wire:click="editTask({{ $task->id }})"><i
                                                        data-lucide="square-pen"></i></label>
                                            </div>
                                            <p class="text-xs text-gray-600">
                                                {{ $task->description }}</p>
                                            <p class="text-xs text-gray-500">
                                                @if ($task->assignedUser && $task->assignedUser->id)
                                                    <img src="{{ $task->assignedUser->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $task->assignedUser->id . '.jpg' }}"
                                                        alt="Profile Photo"
                                                        class="inline-block w-4 h-4 rounded-full" />
                                                    <span class="ml-1">{{ $task->assignedUser->name }}</span>
                                                @endif
                                            </p>
                                            <!-- Subtasks -->
                                            <div class="mt-2">
                                                @foreach ($task->subtasks as $subtask)
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <span
                                                            class="text-xs text-gray-700">{{ $subtask->name }}</span>
                                                        {{-- <span
                                                            class="text-xs text-gray-400">({{ $subtask->status }})</span> --}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="drawer-side">
                                        <label for="my-drawer-{{ $task->id }}" aria-label="close sidebar"
                                            class="drawer-overlay"></label>
                                        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                                            <form wire:submit.prevent="updateTask({{ $task->id }})"
                                                class="space-y-4">
                                                <h3 class="text-lg font-bold text-blue-700 flex items-center gap-2">
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
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Assign
                                                        Volunteer</label>
                                                    <select wire:model.defer="assignedVolunteer.{{ $task->id }}"
                                                        class="select select-bordered w-full">
                                                        <option value="">Select Volunteer</option>
                                                        @foreach ($acceptedUsers as $volunteer)
                                                            <option value="{{ $volunteer->id }}">
                                                                {{ $volunteer->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                                    <select wire:model.defer="taskStatus.{{ $task->id }}"
                                                        class="select select-bordered w-full">
                                                        <option value="todo">Todo</option>
                                                        <option value="doing">Doing</option>
                                                        <option value="done">Done</option>
                                                    </select>
                                                </div>
                                                @if ($task->subtasks->where('parent_id', $task->id)->count())
                                                    <div class="mt-4 p-3 rounded-lg bg-blue-50 border border-blue-200">
                                                        <h4
                                                            class="text-md font-bold text-blue-600 mb-2 flex items-center gap-2">
                                                            <svg class="w-4 h-4 text-blue-400" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M12 4v16m8-8H4" />
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
                                                    <button type="button" class="btn btn-outline btn-sm w-full mb-2"
                                                        onclick="this.nextElementSibling.classList.toggle('hidden')">
                                                        <i data-lucide="plus"></i> Add Subtask
                                                    </button>
                                                    <div class="hidden">
                                                        <div class="p-3 rounded-lg bg-blue-50 border border-blue-200">
                                                            <h4
                                                                class="text-md font-bold text-blue-600 mb-2 flex items-center gap-2">
                                                                <svg class="w-4 h-4 text-blue-400" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M12 4v16m8-8H4" />
                                                                </svg>
                                                                Add Subtask
                                                            </h4>
                                                            <div class="space-y-2">
                                                                <input type="text" placeholder="Subtask Name"
                                                                    class="input input-bordered w-full mb-1"
                                                                    wire:model.defer="subtaskName.{{ $task->id }}">
                                                                <textarea placeholder="Subtask Description" class="textarea textarea-bordered w-full mb-1"
                                                                    wire:model.defer="subtaskDescription.{{ $task->id }}"></textarea>
                                                                <select
                                                                    wire:model.defer="subtaskAssignedVolunteer.{{ $task->id }}"
                                                                    class="select select-bordered w-full mb-1">
                                                                    <option value="">Assign Volunteer</option>
                                                                    @foreach ($acceptedUsers as $volunteer)
                                                                        <option value="{{ $volunteer->id }}">
                                                                            {{ $volunteer->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <button type="button" class="btn btn-primary w-full"
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
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>
</x-requester.dashboard-layout>
