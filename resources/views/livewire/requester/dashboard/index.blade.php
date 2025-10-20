<x-requester.dashboard-layout>
    <div class="min-h-screen p-6 bg-gray-50">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-2">
                        Welcome, {{ auth()->user()->name }}
                    </h1>
                    <p class="text-gray-600 text-lg">Manage your organization's events and volunteers</p>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalEvents ?? 0 }}</div>
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
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $activeEvents ?? 0 }}</div>
                        <div class="text-sm text-gray-600 font-medium">Active Events</div>
                    </div>
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="activity" class="w-6 h-6 text-gray-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $pendingApplications ?? 0 }}</div>
                        <div class="text-sm text-gray-600 font-medium">Pending Approvals</div>
                    </div>
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="clock" class="w-6 h-6 text-gray-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Event Statistics -->
            <div class="col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i> Event Statistics
                </h2>
                <div class="space-y-6">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Completion Rate</span>
                            <span class="text-sm font-bold text-gray-900">{{$completedRate}}%</span>
                        </div>

                        <progress class="progress w-full" value="{{$completedRate}}" max="100"></progress>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Volunteer Approval Rate</span>
                            <span class="text-sm font-bold text-gray-900">{{$approvalRate}}%</span>
                        </div>
                        <progress class="progress w-full" value="{{ $approvalRate }}" max="100"></progress>
                    </div>
                   
                    <div class="grid grid-cols-2 gap-4 mt-6 pt-6 border-t border-gray-200">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">{{$totalVol}}</div>
                            <div class="text-xs text-gray-600">Total Volunteers</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">{{ $certificateIssued }}</div>
                            <div class="text-xs text-gray-600">Certificates Issued</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recent Activity -->
            <div class="col-span-1 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <i data-lucide="activity" class="w-5 h-5"></i> Recent Activity
                </h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-medium text-gray-900">Task Completion</div>
                            <div class="text-xs text-gray-600">{{ $recentNotificationText }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{$recentNotificationTime }}</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i data-lucide="calendar-plus" class="w-4 h-4 text-blue-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-medium text-gray-900">Event Created</div>
                            <div class="text-xs text-gray-600">{{ $recentEventCreationName}}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $recentEventCreationTime }}</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i data-lucide="award" class="w-4 h-4 text-purple-600"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-medium text-gray-900">Certificate Issued</div>
                            <div class="text-xs text-gray-600">{{$certificateIssued}} certificate was issued</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-8">
            <div class="col-span-4 bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <i data-lucide="calendar" class="w-5 h-5"></i> Upcoming Events
                </h2>
                @if (isset($upcomingEvents) && count($upcomingEvents))
                    <div class="space-y-4">
                        @foreach ($upcomingEvents as $event)
                            <div
                                class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-900 mb-1">{{ $event->name }}</div>
                                    <div class="text-sm text-gray-600 mb-2">
                                        {{ \Illuminate\Support\Str::limit($event->description, 80) }}
                                    </div>
                                    <div class="text-xs text-gray-500 flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3 h-3"></i>
                                        {{ $event->start_date ? date('M d, Y • H:i', strtotime($event->start_date)) : 'TBA' }}
                                    </div>
                                </div>
                                <a href="{{ route('requester.event.show', $event->id) }}"
                                    class="ml-4 inline-flex items-center px-4 py-2 bg-primary hover:bg-primary-800 text-white text-sm font-medium rounded-lg transition-colors"
                                    wire:navigate>
                                    View Details
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="calendar-x" class="w-8 h-8 text-gray-400"></i>
                        </div>
                        <div class="font-semibold text-gray-900 mb-1">No upcoming events</div>
                        <div class="text-sm text-gray-600">Create a new event to get started!</div>
                    </div>
                @endif
            </div>
            <!-- Quick Actions -->
            <div class="col-span-1 bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <i data-lucide="zap" class="w-5 h-5"></i> Quick Actions
                </h2>
                <div class="grid grid-rows-1 sm:grid-rows-2 lg:grid-rows-4 gap-4">
                    <a href="/requester/dashboard/my-events/create"
                        class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all group">
                        <div
                            class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-gray-900 transition-colors">
                            <i data-lucide="plus" class="w-5 h-5 text-gray-600 group-hover:text-white"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Create Event</div>
                            <div class="text-xs text-gray-500">Start new event</div>
                        </div>
                    </a>
                    <a href="/requester/dashboard/my-events"
                        class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all group">
                        <div
                            class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-gray-900 transition-colors">
                            <i data-lucide="list" class="w-5 h-5 text-gray-600 group-hover:text-white"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">View All Events</div>
                            <div class="text-xs text-gray-500">Manage events</div>
                        </div>
                    </a>
                    <a href="/requester/dashboard/issued-certificates"
                        class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all group">
                        <div
                            class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-gray-900 transition-colors">
                            <i data-lucide="award" class="w-5 h-5 text-gray-600 group-hover:text-white"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Certificates</div>
                            <div class="text-xs text-gray-500">View issued</div>
                        </div>
                    </a>
                    <a href="/requester/dashboard/profile"
                        class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all group">
                        <div
                            class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-gray-900 transition-colors">
                            <i data-lucide="user" class="w-5 h-5 text-gray-600 group-hover:text-white"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Profile</div>
                            <div class="text-xs text-gray-500">Edit profile</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-requester.dashboard-layout>
