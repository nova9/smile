<x-admin.dashboard-layout>
    <div class="min-h-screen p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                        Volunteer
                        <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                            Management
                        </span>
                    </h1>
                    <p class="text-slate-600 text-lg">Track and manage all volunteer activities and registrations
                    </p>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="mb-8">
            <x-admin.stats-card :stats="[
        [
            'icon' => 'users',
            'title' => 'Total Volunteers',
            'value' => number_format($stats['total_volunteers']),
            'description' => 'Registered volunteers'
        ],
        [
            'icon' => 'award',
            'title' => 'Badges Awarded',
            'value' => number_format($stats['total_badges']),
            'description' => 'Total badges earned'
        ],
        [
            'icon' => 'clock',
            'title' => 'Hours Logged',
            'value' => number_format($stats['total_hours']),
            'description' => 'Across all volunteers'
        ]
    ]" />
        </div>

        <!-- Volunteers Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6">
            <!-- Search & Filters -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div class="flex gap-2 w-full md:w-auto">
                    <input type="text" wire:model.live="search" placeholder="Search volunteers..."
                        class="input input-bordered w-full md:w-64 rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all duration-200 border border-slate-200 focus:border-accent bg-white" />
                    <select wire:model.live="activityFilter"
                        class="select select-bordered rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all duration-200 border border-slate-200 focus:border-accent bg-white">
                        <option value="">All Activity Levels</option>
                        <option value="high">High Activity (5+ events)</option>
                        <option value="medium">Medium Activity (2-4 events)</option>
                        <option value="low">Low Activity (1 event)</option>
                        <option value="none">No Activity (0 events)</option>
                    </select>
                </div>
            </div>

            <!-- Volunteers Table -->
            <div class="border border-slate-200 overflow-hidden rounded-2xl shadow-sm">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Activity Level</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Badges</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Activities</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Joined</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($volunteers as $volunteer)
                            <tr class="border-t border-slate-100 hover:bg-slate-50/50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">#{{ $volunteer->id }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $volunteer->name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $volunteer->email }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $eventCount = $volunteer->participatingEvents->count();
                                        if ($eventCount >= 5) {
                                            $activityLevel = 'High';
                                            $colorClass = 'bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-700';
                                        } elseif ($eventCount >= 2) {
                                            $activityLevel = 'Medium';
                                            $colorClass = 'bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700';
                                        } elseif ($eventCount == 1) {
                                            $activityLevel = 'Low';
                                            $colorClass = 'bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700';
                                        } else {
                                            $activityLevel = 'No Activity';
                                            $colorClass = 'bg-gradient-to-r from-gray-100 to-slate-100 text-gray-700';
                                        }
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium {{ $colorClass }}">
                                        {{ $activityLevel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $volunteer->badges->count() }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $volunteer->participatingEvents->count() }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $volunteer->created_at->format('M j, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ url('/admin/dashboard/volunteer-details/' . $volunteer->id) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white text-slate-600 hover:bg-slate-100 transition-colors border border-slate-200 shadow-sm group relative"
                                            title="View Details">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                            <span
                                                class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">View
                                                Details</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center">
                                            <i data-lucide="users-x" class="w-8 h-8 text-slate-400"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-slate-900">No volunteers found</h3>
                                            <p class="text-sm text-slate-500 mt-1">No volunteers match your current filters.
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $volunteers->links() }}
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>