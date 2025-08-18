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
                <p class="text-slate-600 text-lg">Strategic insights and performance metrics</p>
            </div>
        </div>
    </div>

    <!-- Main Stats Section with Growth Indicators -->
    <div class="ml-4 lg:ml-8 mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Users Stats with Growth -->
            <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</p>
                        <div class="flex items-center mt-1">
                            <span
                                class="text-xs {{ $stats['user_growth_rate'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $stats['user_growth_rate'] >= 0 ? '+' : '' }}{{ number_format($stats['user_growth_rate'], 1) }}%
                            </span>
                            <span class="text-xs text-gray-500 ml-1">vs last month</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Volunteers Stats with Retention -->
            <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Volunteers</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_volunteers']) }}</p>
                        <div class="flex items-center mt-1">
                            <span
                                class="text-xs text-blue-600">{{ number_format($stats['volunteer_retention_rate'], 1) }}%</span>
                            <span class="text-xs text-gray-500 ml-1">retention rate</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="heart" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Organizations Stats with Efficiency -->
            <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Organizations</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_organizations']) }}
                        </p>
                        <div class="flex items-center mt-1">
                            <span
                                class="text-xs text-purple-600">{{ number_format($stats['avg_events_per_org'], 1) }}</span>
                            <span class="text-xs text-gray-500 ml-1">avg events/org</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="building-2" class="w-6 h-6 text-purple-600"></i>
                    </div>
                </div>
            </div>

            <!-- Events Stats with Completion Rate -->
            <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Events</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_events']) }}</p>
                        <div class="flex items-center mt-1">
                            <span
                                class="text-xs text-orange-600">{{ number_format($stats['event_completion_rate'], 1) }}%</span>
                            <span class="text-xs text-gray-500 ml-1">completion rate</span>
                        </div>
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
            <!-- Performance Overview Tab -->
            <label class="tab flex gap-1">
                <input type="radio" name="analytics_tabs" checked="checked" />
                <i class="fas fa-chart-line mr-2 text-primary"></i>
                <span class="font-semibold">Performance</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Monthly Growth Trends -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Growth Trends</h3>
                        <div class="h-64 relative">
                            <canvas id="growthTrendsChart"></canvas>
                        </div>
                    </div>

                    <!-- Volunteer Retention Analytics -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Volunteer Retention</h3>
                        <div class="h-64 relative">
                            <canvas id="retentionChart"></canvas>
                        </div>
                    </div>

                    <!-- Event Category Performance -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Event Category Performance</h3>
                        <div class="h-64 relative">
                            <canvas id="categoryPerformanceChart"></canvas>
                        </div>
                    </div>

                    <!-- Organization Efficiency -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Top Performing Organizations</h3>
                        <div class="space-y-3">
                            @foreach($topOrganizations as $org)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $org->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $org->organizing_events_count }} events •
                                            {{ $org->total_volunteers_attracted }} volunteers</p>
                                    </div>
                                    <div class="text-right">
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                            {{ number_format($org->efficiency_score, 1) }}% efficiency
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Geographic Analytics Tab -->
            <label class="tab flex gap-1">
                <input type="radio" name="analytics_tabs" />
                <i class="fas fa-map-marked-alt mr-2 text-accent"></i>
                <span class="font-semibold">Geographic</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Geographic Distribution -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Events by Location</h3>
                        <div class="h-64 relative">
                            <canvas id="geographicChart"></canvas>
                        </div>
                    </div>

                    <!-- Regional Performance -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Regional Activity</h3>
                        <div class="space-y-3">
                            @foreach($regionActivity as $region)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $region->city }}</p>
                                        <p class="text-sm text-gray-600">{{ $region->state }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-blue-600">{{ $region->events_count }}</p>
                                        <p class="text-xs text-gray-500">events</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Peak Activity Analysis -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6 lg:col-span-2">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Peak Activity Times</h3>
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach($peakActivity as $period => $data)
                                <div class="text-center p-4 bg-blue-50 rounded-lg">
                                    <p class="text-2xl font-bold text-blue-600">{{ $data['count'] }}</p>
                                    <p class="text-sm text-gray-600">{{ ucfirst($period) }}</p>
                                    <p class="text-xs text-gray-500">{{ $data['percentage'] }}% of events</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Analytics Tab -->
            <label class="tab flex gap-1">
                <input type="radio" name="analytics_tabs" />
                <i class="fas fa-calendar-check mr-2 text-primary"></i>
                <span class="font-semibold">Events</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Event Status Distribution -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Event Status Overview</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-4 bg-green-50 rounded-lg">
                                <p class="text-2xl font-bold text-green-600">{{ $stats['active_events'] }}</p>
                                <p class="text-sm text-gray-600">Active Events</p>
                                <p class="text-xs text-gray-500">
                                    {{ number_format(($stats['active_events'] / $stats['total_events']) * 100, 1) }}%</p>
                            </div>
                            <div class="text-center p-4 bg-blue-50 rounded-lg">
                                <p class="text-2xl font-bold text-blue-600">{{ $stats['completed_events'] }}</p>
                                <p class="text-sm text-gray-600">Completed</p>
                                <p class="text-xs text-gray-500">
                                    {{ number_format(($stats['completed_events'] / $stats['total_events']) * 100, 1) }}%</p>
                            </div>
                            <div class="text-center p-4 bg-yellow-50 rounded-lg">
                                <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending_events'] }}</p>
                                <p class="text-sm text-gray-600">Pending</p>
                                <p class="text-xs text-gray-500">
                                    {{ number_format(($stats['pending_events'] / $stats['total_events']) * 100, 1) }}%</p>
                            </div>
                            <div class="text-center p-4 bg-purple-50 rounded-lg">
                                <p class="text-2xl font-bold text-purple-600">
                                    {{ number_format($stats['avg_volunteers_per_event'], 1) }}</p>
                                <p class="text-sm text-gray-600">Avg Volunteers</p>
                                <p class="text-xs text-gray-500">per event</p>
                            </div>
                        </div>
                    </div>

                    <!-- Top Events by Participation -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Top Events by Participation</h3>
                        <div class="space-y-3">
                            @foreach($eventParticipation->take(6) as $event)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 truncate">{{ $event->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $event->category->name ?? 'General' }} •
                                            {{ $event->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="text-right ml-2">
                                        <span
                                            class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                                            {{ $event->users_count }}
                                        </span>
                                        <p class="text-xs text-gray-500 mt-1">volunteers</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Application Success Rate -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6 lg:col-span-2">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Application & Participation Analytics</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="text-center p-4 bg-indigo-50 rounded-lg">
                                <p class="text-3xl font-bold text-indigo-600">
                                    {{ number_format($stats['application_success_rate'], 1) }}%</p>
                                <p class="text-sm text-gray-600">Application Success Rate</p>
                                <p class="text-xs text-gray-500">{{ $stats['total_applications'] }} total applications
                                </p>
                            </div>
                            <div class="text-center p-4 bg-teal-50 rounded-lg">
                                <p class="text-3xl font-bold text-teal-600">
                                    {{ number_format($stats['volunteer_show_rate'], 1) }}%</p>
                                <p class="text-sm text-gray-600">Volunteer Show Rate</p>
                                <p class="text-xs text-gray-500">actual vs registered participation</p>
                            </div>
                            <div class="text-center p-4 bg-rose-50 rounded-lg">
                                <p class="text-3xl font-bold text-rose-600">
                                    {{ number_format($stats['avg_application_time'], 1) }}</p>
                                <p class="text-sm text-gray-600">Avg. Response Time</p>
                                <p class="text-xs text-gray-500">days to process applications</p>
                            </div>
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
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            // Growth Trends Chart
            const growthCtx = document.getElementById('growthTrendsChart').getContext('2d');
            const monthlyUsers = @json($monthlyRegistrations);
            const monthlyEvents = @json($monthlyEvents);

            new Chart(growthCtx, {
                type: 'line',
                data: {
                    labels: monthlyUsers.map(item => monthNames[item.month - 1]),
                    datasets: [{
                        label: 'New Users',
                        data: monthlyUsers.map(item => item.count),
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        yAxisID: 'y'
                    }, {
                        label: 'New Events',
                        data: monthlyEvents.map(item => item.count),
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        yAxisID: 'y1'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false,
                            },
                        }
                    }
                }
            });

            // Volunteer Retention Chart
            const retentionCtx = document.getElementById('retentionChart').getContext('2d');
            const retentionData = @json($retentionAnalytics);

            new Chart(retentionCtx, {
                type: 'bar',
                data: {
                    labels: ['First Time', '2-3 Events', '4-5 Events', '6+ Events'],
                    datasets: [{
                        label: 'Volunteers',
                        data: [
                            retentionData.first_time,
                            retentionData.repeat_2_3,
                            retentionData.repeat_4_5,
                            retentionData.repeat_6_plus
                        ],
                        backgroundColor: [
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(34, 197, 94, 0.8)',
                            'rgba(59, 130, 246, 0.8)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Category Performance Chart
            const categoryCtx = document.getElementById('categoryPerformanceChart').getContext('2d');
            const categoryData = @json($categoryPerformance);

            new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: categoryData.map(item => item.name),
                    datasets: [{
                        data: categoryData.map(item => item.events_count),
                        backgroundColor: [
                            '#EF4444',
                            '#F59E0B',
                            '#10B981',
                            '#3B82F6',
                            '#8B5CF6',
                            '#F97316'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Geographic Distribution Chart
            const geoCtx = document.getElementById('geographicChart').getContext('2d');
            const geoData = @json($regionActivity);

            new Chart(geoCtx, {
                type: 'bar',
                data: {
                    labels: geoData.slice(0, 8).map(item => item.city),
                    datasets: [{
                        label: 'Events',
                        data: geoData.slice(0, 8).map(item => item.events_count),
                        backgroundColor: 'rgba(139, 92, 246, 0.8)',
                        borderColor: 'rgb(139, 92, 246)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                maxRotation: 45
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-admin.dashboard-layout>