<x-admin.dashboard-layout>
    <!-- Header Section -->
    <div class="mb-8 mt-8 ml-4 lg:ml-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                    Analytics
                    <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                        Dashboard
                    </span>
                </h1>
                <p class="text-slate-600 text-lg">Comprehensive insights and data visualization</p>
            </div>
        </div>
    </div>

    <!-- Main Stats Section -->
    <div class="ml-4 lg:ml-8 mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Users Stats -->
            <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</p>
                        <p class="text-xs text-gray-500">All registered accounts</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Volunteers Stats -->
            <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Volunteers</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_volunteers']) }}</p>
                        <p class="text-xs text-gray-500">Active volunteers</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="heart" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Organizations Stats -->
            <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Organizations</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_organizations']) }}
                        </p>
                        <p class="text-xs text-gray-500">Registered NGOs</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="building-2" class="w-6 h-6 text-purple-600"></i>
                    </div>
                </div>
            </div>

            <!-- Events Stats -->
            <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Events</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_events']) }}</p>
                        <p class="text-xs text-gray-500">All time events</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="calendar" class="w-6 h-6 text-orange-600"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 sm:px-6 lg:px-8 py-8 ml-4 lg:ml-8">
        <div class="tabs tabs-lift">
            <!-- Overview Tab -->
            <label class="tab flex gap-1">
                <input type="radio" name="analytics_tabs" checked="checked" />
                <i class="fas fa-chart-bar mr-2 text-primary"></i>
                <span class="font-semibold">Overview</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Monthly Registrations Chart -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Monthly User Registrations</h3>
                        <div class="h-64 relative">
                            <canvas id="monthlyRegistrationsChart"></canvas>
                        </div>
                    </div>

                    <!-- User Status Distribution -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">User Status Distribution</h3>
                        <div class="h-64 relative">
                            <canvas id="userStatusChart"></canvas>
                        </div>
                    </div>

                    <!-- Event Status Distribution -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Event Status Overview</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-4 bg-green-50 rounded-lg">
                                <p class="text-2xl font-bold text-green-600">{{ $stats['active_events'] }}</p>
                                <p class="text-sm text-gray-600">Active Events</p>
                            </div>
                            <div class="text-center p-4 bg-blue-50 rounded-lg">
                                <p class="text-2xl font-bold text-blue-600">{{ $stats['completed_events'] }}</p>
                                <p class="text-sm text-gray-600">Completed</p>
                            </div>
                            <div class="text-center p-4 bg-yellow-50 rounded-lg">
                                <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending_events'] }}</p>
                                <p class="text-sm text-gray-600">Pending</p>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <p class="text-2xl font-bold text-gray-600">{{ $stats['total_events'] }}</p>
                                <p class="text-sm text-gray-600">Total</p>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Events Chart -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Monthly Events Created</h3>
                        <div class="h-64 relative">
                            <canvas id="monthlyEventsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Analytics Tab -->
            <label class="tab flex gap-1">
                <input type="radio" name="analytics_tabs" />
                <i class="fas fa-users mr-2 text-accent"></i>
                <span class="font-semibold">User Analytics</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Top Volunteers -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Most Active Volunteers</h3>
                        <div class="space-y-3">
                            @foreach($volunteerActivity->take(5) as $volunteer)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $volunteer->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $volunteer->badges_count }} badges earned</p>
                                    </div>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                        {{ $volunteer->participating_events_count }} events
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Badge Distribution -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Volunteer Badge Distribution</h3>
                        <div class="h-64 relative">
                            <canvas id="badgeDistributionChart"></canvas>
                        </div>
                    </div>

                    <!-- Top Organizations -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Most Active Organizations</h3>
                        <div class="space-y-3">
                            @foreach($topOrganizations as $org)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $org->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $org->email }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                        {{ $org->organizing_events_count }} events
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Recent User Registrations</h3>
                        <div class="space-y-3">
                            @foreach($recentUsers as $user)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                    </div>
                                    <span class="text-xs text-gray-500">
                                        {{ $user->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Analytics Tab -->
            <label class="tab flex gap-1">
                <input type="radio" name="analytics_tabs" />
                <i class="fas fa-calendar mr-2 text-primary"></i>
                <span class="font-semibold">Event Analytics</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Event Participation -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Top Events by Participation</h3>
                        <div class="space-y-3">
                            @foreach($eventParticipation->take(8) as $event)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 truncate">{{ $event->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $event->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <span
                                        class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium ml-2">
                                        {{ $event->users_count }} volunteers
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recent Events -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Events Created</h3>
                        <div class="space-y-3">
                            @foreach($recentEvents as $event)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $event->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $event->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <span
                                        class="px-2 py-1 bg-{{ $event->status === 'active' ? 'green' : ($event->status === 'pending' ? 'yellow' : 'gray') }}-100 text-{{ $event->status === 'active' ? 'green' : ($event->status === 'pending' ? 'yellow' : 'gray') }}-800 rounded text-xs font-medium">
                                        {{ ucfirst($event->status ?? 'Draft') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Monthly Registrations Chart
            const monthlyRegCtx = document.getElementById('monthlyRegistrationsChart').getContext('2d');
            const monthlyRegData = @json($monthlyRegistrations);
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            new Chart(monthlyRegCtx, {
                type: 'line',
                data: {
                    labels: monthlyRegData.map(item => monthNames[item.month - 1]),
                    datasets: [{
                        label: 'New Users',
                        data: monthlyRegData.map(item => item.count),
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            // User Status Chart
            const userStatusCtx = document.getElementById('userStatusChart').getContext('2d');
            const userStatusData = @json($userStatuses);

            new Chart(userStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: userStatusData.map(item => item.status || 'Active'),
                    datasets: [{
                        data: userStatusData.map(item => item.count),
                        backgroundColor: [
                            '#10B981',
                            '#F59E0B',
                            '#EF4444',
                            '#6B7280'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        }
                    }
                }
            });

            // Monthly Events Chart
            const monthlyEventsCtx = document.getElementById('monthlyEventsChart').getContext('2d');
            const monthlyEventsData = @json($monthlyEvents);

            new Chart(monthlyEventsCtx, {
                type: 'bar',
                data: {
                    labels: monthlyEventsData.map(item => monthNames[item.month - 1]),
                    datasets: [{
                        label: 'Events Created',
                        data: monthlyEventsData.map(item => item.count),
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderColor: 'rgb(16, 185, 129)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            // Badge Distribution Chart
            const badgeCtx = document.getElementById('badgeDistributionChart').getContext('2d');
            const badgeData = @json($badgeStats);

            new Chart(badgeCtx, {
                type: 'pie',
                data: {
                    labels: Object.keys(badgeData),
                    datasets: [{
                        data: Object.values(badgeData),
                        backgroundColor: [
                            '#EF4444',
                            '#F59E0B',
                            '#10B981',
                            '#3B82F6'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
</x-admin.dashboard-layout>