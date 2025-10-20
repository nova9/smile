<x-admin.dashboard-layout>
    <div class="min-h-screen bg-gray-50 p-6">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-2">
                        Admin Dashboard
                    </h1>
                    <p class="text-gray-600 text-lg">Monitor platform activity and manage key operations</p>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-6 gap-6 mb-8">
            <!-- Total Volunteers -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalVolunteers }}</div>
                        <div class="text-sm text-gray-600 font-medium">Volunteers</div>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Total Organizations -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalOrganizations }}</div>
                        <div class="text-sm text-gray-600 font-medium">Organizations</div>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="building-2" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Total Lawyers -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalLawyers }}</div>
                        <div class="text-sm text-gray-600 font-medium">Lawyers</div>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="scale" class="w-6 h-6 text-purple-600"></i>
                    </div>
                </div>
            </div>

            <!-- Total Events -->
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

            <!-- Pending Reports -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $pendingReports }}</div>
                        <div class="text-sm text-gray-600 font-medium">Pending Reports</div>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
                    </div>
                </div>
            </div>

            <!-- Open Help Requests -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $openHelpRequests }}</div>
                        <div class="text-sm text-gray-600 font-medium">Help Requests</div>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="help-circle" class="w-6 h-6 text-yellow-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
            <!-- Recent Activity Section -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Pending Reports -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <i data-lucide="alert-triangle" class="w-5 h-5"></i> Pending Event Reports
                        </h2>
                        <a href="/admin/dashboard" class="text-sm text-gray-600 hover:text-gray-900 font-medium">
                            View All →
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse ($recentReports as $report)
                            <div class="border border-gray-200 rounded-xl p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900 mb-1">
                                            {{ $report->event->name ?? 'Unknown Event' }}
                                        </h3>
                                        <p class="text-sm text-gray-600 mb-2">
                                            Reported by {{ $report->user->name ?? 'Anonymous' }}
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">{{ Str::limit($report->reason, 80) }}</p>
                                        <div class="flex items-center gap-2 text-xs text-gray-500">
                                            <i data-lucide="clock" class="w-3 h-3"></i>
                                            {{ $report->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    <div>
                                        <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">
                                            Pending
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <i data-lucide="check-circle" class="w-12 h-12 mx-auto mb-2 text-gray-400"></i>
                                <p>No pending reports</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Open Help Requests -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <i data-lucide="help-circle" class="w-5 h-5"></i> Open Help Requests
                        </h2>
                        <a href="/admin/dashboard/help-requests"
                            class="text-sm text-gray-600 hover:text-gray-900 font-medium">
                            View All →
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse ($recentHelpRequests as $ticket)
                            <div class="border border-gray-200 rounded-xl p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900 mb-1">{{ $ticket->subject }}</h3>
                                        <p class="text-sm text-gray-600 mb-2">
                                            From {{ $ticket->user->name ?? 'Unknown User' }}
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">{{ Str::limit($ticket->message, 80) }}</p>
                                        <div class="flex items-center gap-2 text-xs text-gray-500">
                                            <i data-lucide="clock" class="w-3 h-3"></i>
                                            {{ $ticket->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    <div>
                                        <span
                                            class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-700 rounded-full">
                                            Open
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <i data-lucide="check-circle" class="w-12 h-12 mx-auto mb-2 text-gray-400"></i>
                                <p>No open help requests</p>
                            </div>
                        @endforelse
                    </div>
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
                        <a href="/admin/dashboard/volunteer-management"
                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all group">
                            <div
                                class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                <i data-lucide="users" class="w-5 h-5 text-blue-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">Volunteers</div>
                                <div class="text-xs text-gray-500">Manage volunteers</div>
                            </div>
                        </a>

                        <a href="/admin/dashboard/organization-management"
                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all group">
                            <div
                                class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                <i data-lucide="building-2" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">Organizations</div>
                                <div class="text-xs text-gray-500">Manage organizations</div>
                            </div>
                        </a>

                        <a href="/admin/dashboard"
                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all group">
                            <div
                                class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-200 transition-colors">
                                <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">Reports</div>
                                <div class="text-xs text-gray-500">Handle event reports</div>
                            </div>
                        </a>

                        <a href="/admin/dashboard/help-requests"
                            class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all group">
                            <div
                                class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center group-hover:bg-yellow-200 transition-colors">
                                <i data-lucide="help-circle" class="w-5 h-5 text-yellow-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">Help Requests</div>
                                <div class="text-xs text-gray-500">Support tickets</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Platform Stats -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i data-lucide="trending-up" class="w-5 h-5"></i> Platform Stats
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
                                </div>
                                <span class="text-sm text-gray-600">Active Events</span>
                            </div>
                            <span class="text-lg font-bold text-gray-900">{{ $activeEvents }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <i data-lucide="eye-off" class="w-4 h-4 text-gray-600"></i>
                                </div>
                                <span class="text-sm text-gray-600">Hidden Events</span>
                            </div>
                            <span class="text-lg font-bold text-gray-900">{{ $hiddenEvents }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <i data-lucide="shield-ban" class="w-4 h-4 text-orange-600"></i>
                                </div>
                                <span class="text-sm text-gray-600">Restricted Orgs</span>
                            </div>
                            <span class="text-lg font-bold text-gray-900">{{ $restrictedOrganizations }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>