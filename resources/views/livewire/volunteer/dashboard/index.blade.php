<x-volunteer.dashboard-layout>
    <div class="min-h-screen bg-gray-50 p-6">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-2">
                        Welcome, {{ auth()->user()->name }}
                    </h1>
                    <p class="text-gray-600 text-lg">Track and manage your volunteer activities</p>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalEvents }}</div>
                        <div class="text-sm text-gray-600 font-medium">Total Events</div>
                    </div>
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="calendar-days" class="w-6 h-6 text-gray-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ count($confirmedEvents) }}</div>
                        <div class="text-sm text-gray-600 font-medium">Confirmed</div>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ count($pendingEvents) }}</div>
                        <div class="text-sm text-gray-600 font-medium">Pending</div>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="clock" class="w-6 h-6 text-yellow-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ count($completedEvents) }}</div>
                        <div class="text-sm text-gray-600 font-medium">Completed</div>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="check-check" class="w-6 h-6 text-purple-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ count($cancelledEvents) }}</div>
                        <div class="text-sm text-gray-600 font-medium">Cancelled</div>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="x-circle" class="w-6 h-6 text-red-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
            <!-- Events List -->
            <div class="lg:col-span-3 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <i data-lucide="calendar" class="w-5 h-5"></i> My Events
                    </h2>
                    <a href="/volunteer/dashboard/my-events"
                        class="text-sm text-gray-600 hover:text-gray-900 font-medium">
                        View All →
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse ($participatingEvents->take(5) as $event)
                        <div class="border border-gray-200 rounded-xl p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <a href="/volunteer/dashboard/my-events/{{ $event->id }}"
                                        class="font-semibold text-gray-900 hover:text-gray-700 mb-1 block">
                                        {{ $event->name }}
                                    </a>
                                    <p class="text-sm text-gray-600 line-clamp-1 mb-3">
                                        {{ $event->description }}
                                    </p>

                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                        <div class="flex items-center gap-1">
                                            <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                            <span>{{ date('M j, Y', strtotime($event->starts_at)) }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                            <span>{{ $event->starts_at->format('h:i A') }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                                            <span>{{ $event->city }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i data-lucide="user" class="w-3.5 h-3.5"></i>
                                            <span>{{ $event->user->name }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-shrink-0">
                                    @if ($event->pivot->status === 'accepted')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-100 text-green-700 text-xs font-medium rounded-lg">
                                            <i data-lucide="check-circle" class="w-3.5 h-3.5"></i>
                                            Confirmed
                                        </span>
                                    @elseif($event->pivot->status === 'pending')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-lg">
                                            <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                            Pending
                                        </span>
                                    @elseif($event->pivot->status === 'completed')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-100 text-purple-700 text-xs font-medium rounded-lg">
                                            <i data-lucide="check-check" class="w-3.5 h-3.5"></i>
                                            Completed
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-100 text-red-700 text-xs font-medium rounded-lg">
                                            <i data-lucide="x-circle" class="w-3.5 h-3.5"></i>
                                            Cancelled
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="calendar-x" class="w-8 h-8 text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Events Yet</h3>
                            <p class="text-gray-600 mb-4">Start volunteering by browsing available events</p>
                            <a href="/volunteer/dashboard/browse-events"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white rounded-lg text-sm font-medium transition-colors">
                                <i data-lucide="search" class="w-4 h-4"></i>
                                Browse Events
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i data-lucide="zap" class="w-5 h-5"></i> Quick Actions
                    </h3>
                    <div class="space-y-3">
                        <a href="/volunteer/dashboard/events"
                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all group">
                            <div
                                class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-gray-900 transition-colors">
                                <i data-lucide="search" class="w-5 h-5 text-gray-600 group-hover:text-white"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 text-sm">Browse Events</div>
                                <div class="text-xs text-gray-500">Find opportunities</div>
                            </div>
                        </a>

                        <a href="/volunteer/dashboard/my-events"
                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all group">
                            <div
                                class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-gray-900 transition-colors">
                                <i data-lucide="calendar" class="w-5 h-5 text-gray-600 group-hover:text-white"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 text-sm">My Events</div>
                                <div class="text-xs text-gray-500">View all</div>
                            </div>
                        </a>

                        <a href="/volunteer/dashboard/achievements"
                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all group">
                            <div
                                class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-gray-900 transition-colors">
                                <i data-lucide="award" class="w-5 h-5 text-gray-600 group-hover:text-white"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 text-sm">Certificates</div>
                                <div class="text-xs text-gray-500">View earned</div>
                            </div>
                        </a>

                        <a href="/volunteer/dashboard/profile"
                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all group">
                            <div
                                class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-gray-900 transition-colors">
                                <i data-lucide="user" class="w-5 h-5 text-gray-600 group-hover:text-white"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 text-sm">Profile</div>
                                <div class="text-xs text-gray-500">Edit details</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Volunteer Stats -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i data-lucide="trending-up" class="w-5 h-5"></i> Your Impact
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i data-lucide="clock" class="w-4 h-4"></i>
                                <span class="text-sm">Hours Volunteered</span>
                            </div>
                            <div class="text-2xl font-bold text-gray-900">{{ count($completedEvents) * 4 }}</div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i data-lucide="award" class="w-4 h-4"></i>
                                <span class="text-sm">Certificates</span>
                            </div>
                            <div class="text-2xl font-bold text-gray-900">{{ count($completedEvents) }}</div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i data-lucide="users" class="w-4 h-4"></i>
                                <span class="text-sm">Events Joined</span>
                            </div>
                            <div class="text-2xl font-bold text-gray-900">{{ $totalEvents }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-volunteer.dashboard-layout>
