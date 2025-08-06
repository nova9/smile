
<x-requester.dashboard-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Back Button -->
        <div class="container mx-auto px-4 py-6">
            <a href="/requester/dashboard/my-events" wire:navigate
                class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:-translate-x-1 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to My Events
            </a>
        </div>

        <!-- Event Header -->
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden mb-8">
                <div class="relative h-64 sm:h-80 lg:h-96">
                    <img src="{{ $event->image ?? 'https://picsum.photos/seed/event' . $event->id . '/1024/480' }}"
                        alt="Event Cover" class="w-full h-full object-cover opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-2">{{ $event->name }}</h1>
                        <div class="flex items-center gap-4 text-white/90">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $event->starts_at->format('F j, Y') }}
                            </span>
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $event->location ?? 'Negombo Beach' }}
                            </span>
                        </div>
                    </div>
                    <div class="absolute top-6 right-6">
                        <div class="px-4 py-2 bg-white/90 backdrop-blur-sm rounded-full text-sm font-medium text-blue-600">
                            {{ $event->category->name ?? 'Environmental' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Total Applications</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $event->volunteers }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Approved</p>
                            <p class="text-3xl font-bold text-green-600">{{ $acceptedUsers->count() }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Pending Review</p>
                            <p class="text-3xl font-bold text-yellow-600">{{ $pendingUsers->count() }}</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Max Capacity</p>
                            <p class="text-3xl font-bold text-purple-600">{{ $event->maximum_participants }}</p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-full">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Volunteers Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Approved Volunteers -->
                <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                Approved Volunteers
                            </h2>
                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-medium">
                                {{ $acceptedUsers->count() }} confirmed
                            </span>
                        </div>
                    </div>
                    <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                        @foreach ($acceptedUsers as $user)
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                <div class="relative">
                                    <img src="{{ $user->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $user->id . '.jpg' }}"
                                        alt="{{ $user->name }}"
                                        class="w-12 h-12 rounded-full object-cover border-2 border-green-500">
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800">{{ $user->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $user->role->name ?? 'Volunteer' }} • 4.9★</p>
                                    <div class="flex gap-2 mt-1">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Experienced</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Local</span>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-2">
                                    <button wire:click="messageVolunteer({{ $user->id }})"
                                        class="p-2 bg-blue-100 hover:bg-blue-200 rounded-lg transition-colors">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </button>
                                    {{-- <span class="text-xs text-gray-500">Joined {{ $user->pivot->created_at->diffForHumans() }}</span> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pending Approval -->
                <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                                <div class="p-2 bg-yellow-100 rounded-lg">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                Pending Approval
                            </h2>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-sm font-medium">
                                {{ $pendingUsers->count() }} waiting
                            </span>
                        </div>
                    </div>
                    <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                        @foreach ($pendingUsers as $user)
                            <div class="flex items-center gap-4 p-4 bg-yellow-50 rounded-xl border border-yellow-100">
                                <div class="relative">
                                    <img src="{{ $user->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $user->id . '.jpg' }}"
                                        alt="{{ $user->name }}"
                                        class="w-12 h-12 rounded-full object-cover border-2 border-yellow-500">
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-yellow-500 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800">{{ $user->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $user->role->name ?? 'Volunteer' }} • 4.6★</p>
                                    <div class="flex gap-2 mt-1">
                                        <span class="px-2 py-1 bg-orange-100 text-orange-700 text-xs rounded-full">Leadership</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">3 Events</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <div class="flex gap-2">
                                        <button wire:click="approve({{ $user->id }})"
                                            class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Approve
                                        </button>
                                        <button wire:click="decline({{ $user->id }})"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Decline
                                        </button>
                                    </div>
                                    <span class="text-xs text-gray-500 text-center">Applied {{ $user->pivot->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="pt-4 border-t border-gray-200">
                            <button wire:click="approveAll"
                                class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Approve All
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tasks & Subtasks Section -->
            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mt-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m-6 4h12m-6 4h6m-9-8h6m-9 4h6m-9 4h6" />
                            </svg>
                        </div>
                        Tasks & Subtasks
                    </h2>
                    <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-medium">
                        {{ $tasks->count() }} tasks
                    </span>
                </div>

                <!-- Add Task Form -->
                <form wire:submit.prevent="addTask" class="mb-8 bg-gray-50 rounded-xl p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
                            <input type="text" wire:model.defer="taskName" placeholder="Enter task name"
                                class="input input-bordered w-full" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <input type="text" wire:model.defer="taskDescription" placeholder="Enter description"
                                class="input input-bordered w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Assign Volunteer</label>
                            <select wire:model.defer="assignedVolunteer" class="select select-bordered w-full">
                                <option value="">Select Volunteer</option>
                                @foreach ($acceptedUsers as $volunteer)
                                    <option value="{{ $volunteer->id }}">{{ $volunteer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 w-full sm:w-auto">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Add Task
                    </button>
                </form>

                <!-- Tasks List -->
                <div class="space-y-6">
                    @foreach ($tasks as $task)
                        <div class="bg-gray-50 rounded-xl p-6 shadow-sm border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $task->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $task->description ?? 'No description' }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Assigned to: {{ $task->assignedUser->name?? 'Unassigned' }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Status: <span class="font-medium {{ $task->status === 'completed' ? 'text-green-600' : 'text-yellow-600' }}">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </p>
                                </div>
                                <button wire:click="deleteTask({{ $task->id }})"
                                    class="btn btn-outline btn-sm hover:bg-red-100 hover:text-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Delete
                                </button>
                            </div>
                            <!-- Subtasks -->
                            <div class="ml-4">
                                <h4 class="text-sm font-semibold text-blue-600 mb-2">Subtasks</h4>
                                @foreach ($task->subtasks as $subtask)
                                    <div class="flex items-center justify-between mb-3 bg-white rounded-lg p-3 shadow-sm">
                                        <div>
                                            <span class="text-gray-800 font-medium">{{ $subtask->name }}</span>
                                            <p class="text-sm text-gray-600">{{ $subtask->description ?? 'No description' }}</p>
                                            <p class="text-xs text-gray-500">
                                                Assigned to: {{ $subtask->assignedUser->name ?? 'Unassigned' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                Status: <span class="font-medium {{ $subtask->status === 'completed' ? 'text-green-600' : 'text-yellow-600' }}">
                                                    {{ ucfirst($subtask->status) }}
                                                </span>
                                            </p>
                                        </div>
                                        <button wire:click="deleteSubtask({{ $subtask->id }})"
                                            class="btn btn-outline btn-xs hover:bg-red-100 hover:text-red-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                                <!-- Add Subtask Form -->
                                <form wire:submit.prevent="addSubtask({{ $task->id }})" class="flex flex-col sm:flex-row gap-2 mt-3">
                                    <input type="text" wire:model.defer="subtaskName.{{ $task->id }}"
                                        placeholder="Subtask name" class="input input-bordered flex-1" required>
                                    <input type="text" wire:model.defer="subtaskDescription.{{ $task->id }}"
                                        placeholder="Description" class="input input-bordered flex-1">
                                    <select wire:model.defer="subtaskAssignedVolunteer.{{ $task->id }}"
                                        class="select select-bordered flex-1">
                                        <option value="">Select Volunteer</option>
                                        @foreach ($acceptedUsers as $volunteer)
                                            <option value="{{ $volunteer->id }}">{{ $volunteer->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-accent w-full sm:w-auto">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Add Subtask
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 bg-white rounded-3xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <button wire:click="sendMessage"
                        class="flex items-center gap-3 p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors group">
                        <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-semibold text-gray-800">Send Message</p>
                            <p class="text-sm text-gray-600">Broadcast to all volunteers</p>
                        </div>
                    </button>
                    <button wire:click="exportList"
                        class="flex items-center gap-3 p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-colors group">
                        <div class="p-2 bg-green-100 rounded-lg group-hover:bg-green-200 transition-colors">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-semibold text-gray-800">Export List</p>
                            <p class="text-sm text-gray-600">Download volunteer data</p>
                        </div>
                    </button>
                    <a href="#"
                        class="flex items-center gap-3 p-4 bg-purple-50 hover:bg-purple-100 rounded-xl transition-colors group">
                        <div class="p-2 bg-purple-100 rounded-lg group-hover:bg-purple-200 transition-colors">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-semibold text-gray-800">Event Settings</p>
                            <p class="text-sm text-gray-600">Modify requirements</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-requester.dashboard-layout>