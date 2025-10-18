<x-requester.dashboard-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Main Container -->
        <div class="px-4 py-4 grid grid-cols-6 gap-5">
            <!-- Left Column -->
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden col-span-4">
                <!-- Hero Section -->
                <div class="relative overflow-hidden">
                    <div class="relative h-56 sm:h-72 lg:h-80 bg-gradient-to-r from-green-600 to-emerald-600 rounded-t-3xl">
                        <div class="absolute inset-0 bg-black/25" aria-hidden="true"></div>
                        <div class="relative z-10 max-w-5xl mx-auto px-6 py-6 sm:py-10 lg:py-14 text-white">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="md:flex-1">
                                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-semibold">
                                        <i data-lucide="tag" class="w-4 h-4"></i>
                                        <span>{{ $event->category->name }}</span>
                                    </div>

                                    <h1 class="mt-4 text-2xl sm:text-3xl lg:text-4xl font-extrabold leading-tight drop-shadow-md">
                                        {{ $event->name }}
                                    </h1>

                                    <p class="mt-3 text-sm sm:text-base text-white/90 max-w-2xl line-clamp-2">
                                        {{ $event->description }}
                                    </p>

                                    <div class="mt-4 flex flex-wrap gap-3 items-center">
                                        <div class="inline-flex items-center gap-2 bg-white/10 px-3 py-1 rounded-full text-sm">
                                            <i data-lucide="calendar" class="w-4 h-4"></i>
                                            <span>
                                                {{ $event->starts_at ? $event->starts_at->format('M j') : 'TBA' }}
                                                @if ($event->ends_at)
                                                    - {{ $event->ends_at->format('M j, Y') }}
                                                @endif
                                            </span>
                                        </div>

                                        <div class="inline-flex items-center gap-2 bg-white/10 px-3 py-1 rounded-full text-sm">
                                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                                            <span>{{ $event->address?->city ?? ($event->city ?? 'Online / TBA') }}</span>
                                        </div>

                                        <div class="inline-flex items-center gap-2 bg-white/10 px-3 py-1 rounded-full text-sm">
                                            <i data-lucide="user" class="w-4 h-4"></i>
                                            <span>By {{ $event->user?->name ?? 'Organizer' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs Section -->
                <div class="p-6 sm:p-8 lg:p-12">
                    <div class="tabs tabs-lift">
                        {{-- Volunteers Tab --}}
                        <label class="tab">
                            <input type="radio" name="my_tabs_4" checked />
                            <div class="flex gap-1">
                                <i data-lucide="users" class="w-4 h-4"></i>
                                <span>Volunteers</span>
                            </div>
                        </label>
                        <div class="tab-content bg-base-100 border-base-300 p-6">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Volunteers</h2>

                            <!-- Pending Approval & Filters -->
                            <div class="mb-6 flex flex-wrap gap-3 items-center justify-start">
                                <!-- Gender Filter -->
                                <div class="flex items-center gap-2 bg-blue-50 border border-blue-200 rounded-full px-4 py-2 shadow-sm">
                                    <i data-lucide="venus-mars" class="w-4 h-4 text-blue-400"></i>
                                    <span class="text-sm font-semibold text-blue-700">Gender</span>
                                    <select wire:model.change="genderFilter" class="bg-transparent text-blue-800 font-medium focus:outline-none px-2 py-1 rounded-full">
                                        <option value="">All</option>
                                        <option value="male">Man</option>
                                        <option value="female">Woman</option>
                                        <option value="non_binary">Non-Binary</option>
                                        <option value="prefer_not_to_say">Prefer not to say</option>
                                    </select>
                                </div>
                                <!-- Level Filter -->
                                <div class="flex items-center gap-2 bg-yellow-50 border border-yellow-200 rounded-full px-4 py-2 shadow-sm">
                                    <i data-lucide="bar-chart" class="w-4 h-4 text-yellow-400"></i>
                                    <span class="text-sm font-semibold text-yellow-700">Level</span>
                                    <select wire:model.change="levelFilter" class="bg-transparent text-yellow-800 font-medium focus:outline-none px-2 py-1 rounded-full">
                                        <option value="">All</option>
                                        <option value="beginner">Beginner</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="advanced">Advanced</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Volunteers List -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @forelse ($filteredVolunteers as $user)
                                    <div class="flex flex-col bg-gray-50 rounded-xl p-4 border border-gray-100 transform transition duration-200">
                                        <div class="flex items-start gap-4">
                                            <img src="{{ $user->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $user->id . '.jpg' }}"
                                                 alt="{{ $user->name }}"
                                                 class="w-12 h-12 rounded-full object-cover ring-2 ring-indigo-100">
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between gap-2">
                                                    <a href="{{ route('requester.dashboard.volunteers.show', $user->id) }}">
                                                        <h4 class="text-sm font-semibold text-gray-800 truncate">{{ $user->name }}</h4>
                                                    </a>
                                                    <span class="text-xs text-gray-500">{{ $user->getCustomAttribute('level') }}</span>
                                                </div>
                                                <p class="text-xs text-gray-500 truncate">
                                                    {{ $user->role->name ?? 'Volunteer' }} • {{ number_format($user->getCustomAttribute('rating') ?? 4.6, 1) }} ★
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-3 flex items-center gap-2">
                                            <button wire:click="approve({{ $user->id }})" class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-semibold transition">
                                                <i data-lucide="check-circle" class="w-4 h-4"></i> Approve
                                            </button>
                                            <button wire:click="decline({{ $user->id }})" class="inline-flex items-center gap-2 px-3 py-2 bg-white text-red-600 border border-gray-200 hover:bg-gray-50 rounded-lg text-sm font-semibold transition">
                                                <i data-lucide="x" class="w-4 h-4"></i> Decline
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-full text-center py-8 text-gray-500">
                                        No volunteers match the current filters.
                                    </div>
                                @endforelse
                            </div>

                            <!-- Approve All Button -->
                            @if ($pendingUsers->count() > 0)
                                <div class="mt-6 border-t border-gray-100 pt-4">
                                    <button wire:click="approveAll" class="w-full inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium py-3 rounded-lg transition-colors">
                                        <i data-lucide="check-circle" class="w-4 h-4"></i> Approve All
                                    </button>
                                </div>
                            @endif
                        </div>

                        {{-- Workflows Tab --}}
                        <label class="tab">
                            <input type="radio" name="my_tabs_4" />
                            <div class="flex gap-1">
                                <i data-lucide="book-check" class="w-4 h-4"></i>
                                <span>Workflows</span>
                            </div>
                        </label>
                        <div class="tab-content bg-gray-100 border-base-300 p-6">
                            <livewire:common.workflow :eventId="$event->id" />
                        </div>

                        {{-- Certificates Tab --}}
                        <label class="tab">
                            <input type="radio" name="my_tabs_4" />
                            <div class="flex gap-1">
                                <i data-lucide="shield-check" class="w-4 h-4"></i>
                                <span>Certificates</span>
                            </div>
                        </label>
                        <div class="tab-content bg-base-100 border-base-300 p-6">
                            @if (isset($acceptedUsers) && $acceptedUsers->count() > 0)
                                <div class="mt-12 mb-8">
                                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-gray-800">
                                        <i data-lucide="award" class="w-6 h-6 text-yellow-500"></i> Issue Certificates
                                    </h3>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white rounded-xl shadow border border-gray-200">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tl-xl">Name</th>
                                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tasks Status</th>
                                                    <th class="px-6 py-3 flex justify-end text-left text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tr-xl">Certificate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($acceptedUsers as $volunteer)
                                                    @php
                                                        $assignedTasks = $tasks->where('assigned_id', $volunteer->id);
                                                        $doneTasksCount = $assignedTasks->where('status', 'done')->count();
                                                        $totalAssignedCount = $assignedTasks->count();
                                                    @endphp
                                                    <tr class="border-b last:border-b-0 hover:bg-gray-50 transition">
                                                        <td class="px-6 py-4 flex items-center gap-3">
                                                            <img src="{{ $volunteer->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $volunteer->id . '.jpg' }}" alt="{{ $volunteer->name }}" class="w-8 h-8 rounded-full border-2 border-blue-100">
                                                            <span class="font-semibold text-gray-800">{{ $volunteer->name }}</span>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            @if ($totalAssignedCount > 0 && $doneTasksCount === $totalAssignedCount)
                                                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full font-bold">
                                                                    <i data-lucide="check-circle" class="w-4 h-4"></i> All Tasks Completed
                                                                </span>
                                                            @else
                                                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">
                                                                    <i data-lucide="alert-circle" class="w-4 h-4"></i> Pending Tasks
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td class="px-6 py-4 flex justify-end">
                                                            @if ($totalAssignedCount > 0 && $doneTasksCount === $totalAssignedCount)
                                                                <form method="GET" action="{{ route('certificate.show', ['id' => $event->id, 'volunteerid' => $volunteer->id]) }}" class="inline">
                                                                    <button class="btn btn-info">
                                                                        <i data-lucide="eye" class="w-4 h-4"></i> View Certificate
                                                                    </button>
                                                                </form>
                                                            @elseif(!empty($volunteer->certificate_issued))
                                                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 text-gray-500 text-xs rounded-full">
                                                                    <i data-lucide="award" class="w-4 h-4"></i> Certificate Issued
                                                                </span>
                                                            @else
                                                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-gray-50 text-gray-400 text-xs rounded-full">
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
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-span-2">
                <div class="bg-gradient-to-br from-white to-green-50 rounded-2xl p-6 shadow-lg ring-1 ring-green-100 border border-transparent">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-green-800 flex items-center gap-3">
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-white/60 ring-1 ring-green-100">
                                <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                            </span>
                            Approved Volunteers
                        </h3>
                        <span class="text-base text-gray-500">{{ $acceptedUsers->count() }}</span>
                    </div>

                    @if (count($acceptedUsers) == 0)
                        <div class="flex flex-col items-center justify-center py-12">
                            <i data-lucide="user-x" class="w-12 h-12 text-gray-400 mb-4"></i>
                            <h4 class="text-lg font-semibold text-gray-700 mb-2">No volunteers have been approved yet.</h4>
                            <p class="text-sm text-gray-500 mb-4 text-center">Once you approve volunteers, they will appear here.</p>
                        </div>
                    @else
                        <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                            @foreach ($acceptedUsers as $user)
                                <div class="volunteer-card rounded-xl p-4 border border-green-200 bg-white/80 transform transition-all duration-200 cursor-pointer flex items-center gap-4">
                                    <img src="{{ $user->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $user->id . '.jpg' }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover border-2 border-green-500">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-800 text-md">{{ $user->name }}</h3>
                                        <p class="text-xs text-gray-600">{{ $user->role->name ?? 'Volunteer' }} • 4.9★</p>
                                        <div class="flex gap-2 mt-1">
                                            <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">{{ $user->getCustomAttribute('level') }}</span>
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Local</span>
                                        </div>
                                    </div>
                                    <button wire:click="messageVolunteer({{ $user->id }})" title="Message" class="inline-flex items-center gap-2 px-3 py-2 bg-blue-100 hover:bg-blue-200 rounded-full transition-colors shadow-sm">
                                        <i data-lucide="message-circle" class="w-4 h-4 text-blue-600"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-requester.dashboard-layout>
