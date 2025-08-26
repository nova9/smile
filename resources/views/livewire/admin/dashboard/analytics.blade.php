<x-admin.dashboard-layout>
    <!-- Enhanced Header Section -->
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
                <div class="flex items-center gap-4 mt-4">
                    <div class="text-sm text-gray-500">
                        <i data-lucide="clock" class="w-4 h-4 inline-block mr-1"></i>
                        Last updated: {{ now()->format('M d, Y H:i') }}
                    </div>
                    <div class="text-sm text-gray-500">
                        <i data-lucide="calendar" class="w-4 h-4 inline-block mr-1"></i>
                        Period: {{ now()->startOfYear()->format('M Y') }} - {{ now()->format('M Y') }}
                    </div>
                </div>
            </div>
            <div class="hidden lg:flex items-center gap-3">
                <button class="btn btn-outline btn-sm" onclick="exportData()">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    Export
                </button>
                <button class="btn btn-primary btn-sm" onclick="refreshData()">
                    <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                    Refresh
                </button>
            </div>
        </div>
    </div>

    <!-- Enhanced Main Stats Section with Interactive Filters -->
    <div class="ml-4 lg:ml-8 mb-8">
        <!-- Filter Controls -->
        <div class="mb-6 bg-white/90 rounded-2xl shadow-lg p-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <h3 class="text-lg font-semibold text-gray-800">Filters</h3>
                    <select class="select select-bordered select-sm" id="timeRangeFilter" onchange="updateTimeRange()">
                        <option value="7">Last 7 days</option>
                        <option value="30">Last 30 days</option>
                        <option value="90" selected>Last 3 months</option>
                        <option value="365">Last year</option>
                        <option value="all">All time</option>
                    </select>
                    <select class="select select-bordered select-sm" id="regionFilter" onchange="updateRegion()">
                        <option value="all" selected>All Regions</option>
                        <option value="western">Western Province</option>
                        <option value="central">Central Province</option>
                        <option value="southern">Southern Province</option>
                        <option value="northern">Northern Province</option>
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <button class="btn btn-ghost btn-sm" onclick="resetFilters()">
                        <i data-lucide="x" class="w-4 h-4"></i>
                        Reset
                    </button>
                    <div class="tooltip" data-tip="Auto-refresh every 5 minutes">
                        <label class="cursor-pointer label">
                            <input type="checkbox" class="toggle toggle-primary toggle-sm" id="autoRefresh" onchange="toggleAutoRefresh()">
                            <span class="label-text ml-2 text-sm">Auto-refresh</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Enhanced Users Stats with Trend Indicators -->
            <div class="bg-white/90 rounded-2xl shadow-xl p-6 hover:shadow-2xl transition-shadow group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs {{ $stats['user_growth_rate'] >= 0 ? 'text-green-600' : 'text-red-600' }} flex items-center">
                                @if($stats['user_growth_rate'] >= 0)
                                    <i data-lucide="trending-up" class="w-3 h-3 mr-1"></i>
                                @else
                                    <i data-lucide="trending-down" class="w-3 h-3 mr-1"></i>
                                @endif
                                {{ $stats['user_growth_rate'] >= 0 ? '+' : '' }}{{ number_format($stats['user_growth_rate'], 1) }}%
                            </span>
                            <span class="text-xs text-gray-500 ml-1">vs last month</span>
                        </div>
                        <div class="mt-2 w-full bg-gray-200 rounded-full h-1.5">
                            <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ min(100, ($stats['total_users'] / 1000) * 100) }}%"></div>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Enhanced Volunteers Stats with Interactive Elements -->
            <div class="bg-white/90 rounded-2xl shadow-xl p-6 hover:shadow-2xl transition-shadow group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Volunteers</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_volunteers']) }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-blue-600 flex items-center">
                                <i data-lucide="heart" class="w-3 h-3 mr-1"></i>
                                {{ number_format($stats['volunteer_retention_rate'], 1) }}%
                            </span>
                            <span class="text-xs text-gray-500 ml-1">retention rate</span>
                        </div>
                        <div class="mt-2 flex gap-1">
                            <div class="flex-1 bg-gray-200 rounded-full h-1.5">
                                <div class="bg-green-600 h-1.5 rounded-full" style="width: {{ $stats['volunteer_retention_rate'] }}%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="heart" class="w-6 h-6 text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Enhanced Organizations Stats -->
            <div class="bg-white/90 rounded-2xl shadow-xl p-6 hover:shadow-2xl transition-shadow group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Organizations</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_organizations']) }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-purple-600 flex items-center">
                                <i data-lucide="activity" class="w-3 h-3 mr-1"></i>
                                {{ number_format($stats['avg_events_per_org'], 1) }}
                            </span>
                            <span class="text-xs text-gray-500 ml-1">avg events/org</span>
                        </div>
                        <div class="mt-2">
                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                <div class="bg-purple-600 h-1.5 rounded-full" style="width: {{ min(100, ($stats['avg_events_per_org'] / 10) * 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="building-2" class="w-6 h-6 text-purple-600"></i>
                    </div>
                </div>
            </div>

            <!-- Enhanced Events Stats -->
            <div class="bg-white/90 rounded-2xl shadow-xl p-6 hover:shadow-2xl transition-shadow group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Events</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_events']) }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-orange-600 flex items-center">
                                <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                {{ number_format($stats['event_completion_rate'], 1) }}%
                            </span>
                            <span class="text-xs text-gray-500 ml-1">completion rate</span>
                        </div>
                        <div class="mt-2">
                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                <div class="bg-orange-600 h-1.5 rounded-full" style="width: {{ $stats['event_completion_rate'] }}%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
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
                    <!-- Enhanced Monthly Growth Trends with Comparison -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-gray-800">Growth Trends</h3>
                            <div class="flex items-center gap-2">
                                <select class="select select-bordered select-xs" id="growthChartType" onchange="updateGrowthChart()">
                                    <option value="line">Line Chart</option>
                                    <option value="bar">Bar Chart</option>
                                    <option value="area">Area Chart</option>
                                </select>
                                <button class="btn btn-ghost btn-xs" onclick="fullscreenChart('growthTrendsChart')">
                                    <i data-lucide="maximize-2" class="w-3 h-3"></i>
                                </button>
                            </div>
                        </div>
                        <div class="h-64 relative">
                            <canvas id="growthTrendsChart"></canvas>
                        </div>
                        <div class="mt-4 grid grid-cols-2 gap-4 text-center">
                            <div class="bg-blue-50 rounded-lg p-3">
                                <p class="text-sm text-gray-600">This Month</p>
                                <p class="text-lg font-bold text-blue-600">+{{ number_format($stats['user_growth_rate'], 1) }}%</p>
                            </div>
                            <div class="bg-green-50 rounded-lg p-3">
                                <p class="text-sm text-gray-600">Events Created</p>
                                <p class="text-lg font-bold text-green-600">{{ $stats['total_events'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Volunteer Retention with Segmentation -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-gray-800">Volunteer Retention</h3>
                            <div class="tooltip" data-tip="Volunteer engagement levels">
                                <i data-lucide="info" class="w-4 h-4 text-gray-400"></i>
                            </div>
                        </div>
                        <div class="h-64 relative">
                            <canvas id="retentionChart"></canvas>
                        </div>
                        <div class="mt-4 space-y-2">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">Highly Engaged (6+ events)</span>
                                <span class="font-semibold text-blue-600">{{ $retentionAnalytics['repeat_6_plus'] ?? 0 }} volunteers</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">At-Risk (1 event only)</span>
                                <span class="font-semibold text-red-600">{{ $retentionAnalytics['first_time'] ?? 0 }} volunteers</span>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Event Category Performance with Drill-down -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-gray-800">Event Category Performance</h3>
                            <div class="flex items-center gap-2">
                                <select class="select select-bordered select-xs" id="categoryMetric" onchange="updateCategoryChart()">
                                    <option value="events">Event Count</option>
                                    <option value="volunteers">Volunteer Count</option>
                                    <option value="completion">Completion Rate</option>
                                </select>
                                <button class="btn btn-ghost btn-xs" onclick="showCategoryDetails()">
                                    <i data-lucide="eye" class="w-3 h-3"></i>
                                </button>
                            </div>
                        </div>
                        <div class="h-64 relative">
                            <canvas id="categoryPerformanceChart"></canvas>
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between items-center text-sm mb-2">
                                <span class="text-gray-600">Most Popular Category</span>
                                <span class="font-semibold text-purple-600">
                                    {{ $categoryPerformance->first()->name ?? 'General' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">Total Categories</span>
                                <span class="font-semibold text-gray-800">{{ $categoryPerformance->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Organization Efficiency with Rankings -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-gray-800">Top Performing Organizations</h3>
                            <div class="flex items-center gap-2">
                                <select class="select select-bordered select-xs" id="orgSortBy" onchange="updateOrgRanking()">
                                    <option value="efficiency">Efficiency</option>
                                    <option value="events">Event Count</option>
                                    <option value="volunteers">Volunteer Attraction</option>
                                </select>
                                <button class="btn btn-ghost btn-xs" onclick="exportOrgData()">
                                    <i data-lucide="download" class="w-3 h-3"></i>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-3 max-h-56 overflow-y-auto">
                            @foreach($topOrganizations as $index => $org)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer" onclick="showOrgDetails({{ $org->id }})">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-gradient-to-r {{ $index == 0 ? 'from-yellow-400 to-yellow-600' : ($index == 1 ? 'from-gray-400 to-gray-600' : 'from-orange-400 to-orange-600') }} rounded-full flex items-center justify-center text-white font-bold text-sm">
                                            {{ $index + 1 }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $org->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $org->organizing_events_count }} events • {{ $org->total_volunteers_attracted }} volunteers</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                            {{ number_format($org->efficiency_score, 1) }}%
                                        </span>
                                        <p class="text-xs text-gray-500 mt-1">efficiency score</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <p class="text-sm text-gray-600">Avg Efficiency</p>
                                    <p class="text-lg font-bold text-blue-600">{{ number_format($topOrganizations->avg('efficiency_score'), 1) }}%</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Events</p>
                                    <p class="text-lg font-bold text-green-600">{{ $topOrganizations->sum('organizing_events_count') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Reach</p>
                                    <p class="text-lg font-bold text-purple-600">{{ number_format($topOrganizations->sum('total_volunteers_attracted')) }}</p>
                                </div>
                            </div>
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

    <!-- Enhanced Chart.js Scripts with Interactive Features -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Global chart instances for updating
        let charts = {};
        
        // Interactive Functions
        function updateTimeRange() {
            const timeRange = document.getElementById('timeRangeFilter').value;
            // Here you would typically make a Livewire call to update data
            console.log('Time range updated to:', timeRange);
            // Livewire.emit('updateTimeRange', timeRange);
        }
        
        function updateRegion() {
            const region = document.getElementById('regionFilter').value;
            console.log('Region updated to:', region);
            // Livewire.emit('updateRegion', region);
        }
        
        function resetFilters() {
            document.getElementById('timeRangeFilter').value = '90';
            document.getElementById('regionFilter').value = 'all';
            updateTimeRange();
            updateRegion();
        }
        
        function toggleAutoRefresh() {
            const autoRefresh = document.getElementById('autoRefresh').checked;
            if (autoRefresh) {
                console.log('Auto-refresh enabled');
                // Set up interval for auto-refresh
                setInterval(() => {
                    // Livewire.emit('refreshData');
                }, 300000); // 5 minutes
            }
        }
        
        function exportData() {
            console.log('Exporting analytics data...');
            // Implement export functionality
        }
        
        function refreshData() {
            console.log('Refreshing data...');
            // Livewire.emit('refreshData');
        }
        
        function updateGrowthChart() {
            const chartType = document.getElementById('growthChartType').value;
            if (charts.growthTrends) {
                charts.growthTrends.config.type = chartType;
                charts.growthTrends.update();
            }
        }
        
        function fullscreenChart(chartId) {
            const chartContainer = document.getElementById(chartId).parentElement;
            if (chartContainer.requestFullscreen) {
                chartContainer.requestFullscreen();
            }
        }
        
        function updateCategoryChart() {
            const metric = document.getElementById('categoryMetric').value;
            console.log('Category metric updated to:', metric);
            // Update chart based on selected metric
        }
        
        function showCategoryDetails() {
            console.log('Showing category details...');
            // Show detailed category breakdown
        }
        
        function updateOrgRanking() {
            const sortBy = document.getElementById('orgSortBy').value;
            console.log('Organization ranking updated to:', sortBy);
            // Re-sort organizations
        }
        
        function exportOrgData() {
            console.log('Exporting organization data...');
            // Export organization performance data
        }
        
        function showOrgDetails(orgId) {
            console.log('Showing details for organization:', orgId);
            // Show detailed organization analytics
        }

        // Wait for both DOM and Chart.js to be ready
        function initializeCharts() {
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            // Check if all required elements exist
            const requiredElements = [
                'growthTrendsChart',
                'retentionChart', 
                'categoryPerformanceChart',
                'geographicChart'
            ];

            let allElementsExist = true;
            requiredElements.forEach(id => {
                if (!document.getElementById(id)) {
                    console.warn(`Chart element ${id} not found`);
                    allElementsExist = false;
                }
            });

            if (!allElementsExist) {
                console.log('Retrying chart initialization in 100ms...');
                setTimeout(initializeCharts, 100);
                return;
            }

            try {
                // Enhanced Growth Trends Chart with animations
                const growthCtx = document.getElementById('growthTrendsChart').getContext('2d');
                const monthlyUsers = @json($monthlyRegistrations ?? []);
                const monthlyEvents = @json($monthlyEvents ?? []);

                if (monthlyUsers.length > 0 && monthlyEvents.length > 0) {
                    charts.growthTrends = new Chart(growthCtx, {
                        type: 'line',
                        data: {
                            labels: monthlyUsers.map(item => monthNames[item.month - 1] || 'Unknown'),
                            datasets: [{
                                label: 'New Users',
                                data: monthlyUsers.map(item => item.count || 0),
                                borderColor: 'rgb(59, 130, 246)',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.4,
                                yAxisID: 'y',
                                fill: true
                            }, {
                                label: 'New Events',
                                data: monthlyEvents.map(item => item.count || 0),
                                borderColor: 'rgb(16, 185, 129)',
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                tension: 0.4,
                                yAxisID: 'y1',
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 2000,
                                easing: 'easeInOutQuart'
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index'
                            },
                            plugins: {
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    titleColor: 'white',
                                    bodyColor: 'white',
                                    borderColor: 'rgba(255, 255, 255, 0.1)',
                                    borderWidth: 1
                                },
                                legend: {
                                    position: 'top',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 20
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    type: 'linear',
                                    display: true,
                                    position: 'left',
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.1)'
                                    }
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
                }

                // Enhanced Volunteer Retention Chart with better styling
                const retentionCtx = document.getElementById('retentionChart').getContext('2d');
                const retentionData = @json($retentionAnalytics ?? []);

                if (retentionData && Object.keys(retentionData).length > 0) {
                    charts.retention = new Chart(retentionCtx, {
                        type: 'bar',
                        data: {
                            labels: ['First Time', '2-3 Events', '4-5 Events', '6+ Events'],
                            datasets: [{
                                label: 'Volunteers',
                                data: [
                                    retentionData.first_time || 0,
                                    retentionData.repeat_2_3 || 0,
                                    retentionData.repeat_4_5 || 0,
                                    retentionData.repeat_6_plus || 0
                                ],
                                backgroundColor: [
                                    'rgba(239, 68, 68, 0.8)',
                                    'rgba(245, 158, 11, 0.8)',
                                    'rgba(34, 197, 94, 0.8)',
                                    'rgba(59, 130, 246, 0.8)'
                                ],
                                borderColor: [
                                    'rgb(239, 68, 68)',
                                    'rgb(245, 158, 11)',
                                    'rgb(34, 197, 94)',
                                    'rgb(59, 130, 246)'
                                ],
                                borderWidth: 2,
                                borderRadius: 8,
                                borderSkipped: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 1500,
                                easing: 'easeInOutCubic'
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    titleColor: 'white',
                                    bodyColor: 'white',
                                    callbacks: {
                                        afterLabel: function(context) {
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = ((context.raw / total) * 100).toFixed(1);
                                            return `${percentage}% of all volunteers`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.1)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                }

                // Enhanced Category Performance Chart with hover effects
                const categoryCtx = document.getElementById('categoryPerformanceChart').getContext('2d');
                const categoryData = @json($categoryPerformance ?? []);

                if (categoryData && categoryData.length > 0) {
                    charts.category = new Chart(categoryCtx, {
                        type: 'doughnut',
                        data: {
                            labels: categoryData.map(item => item.name || 'Unknown'),
                            datasets: [{
                                data: categoryData.map(item => item.events_count || 0),
                                backgroundColor: [
                                    '#EF4444',
                                    '#F59E0B',
                                    '#10B981',
                                    '#3B82F6',
                                    '#8B5CF6',
                                    '#F97316',
                                    '#06B6D4',
                                    '#84CC16'
                                ],
                                borderColor: '#ffffff',
                                borderWidth: 3,
                                hoverBorderWidth: 5,
                                hoverOffset: 10
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                animateRotate: true,
                                duration: 2000
                            },
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 15,
                                        font: {
                                            size: 12
                                        }
                                    }
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    titleColor: 'white',
                                    bodyColor: 'white',
                                    callbacks: {
                                        label: function(context) {
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = ((context.raw / total) * 100).toFixed(1);
                                            return `${context.label}: ${context.raw} events (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                // Enhanced Geographic Distribution Chart
                const geoCtx = document.getElementById('geographicChart').getContext('2d');
                const geoData = @json($regionActivity ?? []);

                if (geoData && geoData.length > 0) {
                    charts.geographic = new Chart(geoCtx, {
                        type: 'bar',
                        data: {
                            labels: geoData.slice(0, 8).map(item => item.city || 'Unknown'),
                            datasets: [{
                                label: 'Events',
                                data: geoData.slice(0, 8).map(item => item.events_count || 0),
                                backgroundColor: 'rgba(139, 92, 246, 0.8)',
                                borderColor: 'rgb(139, 92, 246)',
                                borderWidth: 2,
                                borderRadius: 6,
                                borderSkipped: false,
                                hoverBackgroundColor: 'rgba(139, 92, 246, 1)',
                                hoverBorderColor: 'rgb(139, 92, 246)',
                                hoverBorderWidth: 3
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 1800,
                                easing: 'easeInOutBounce'
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    titleColor: 'white',
                                    bodyColor: 'white'
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        maxRotation: 45,
                                        font: {
                                            size: 11
                                        }
                                    },
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.1)'
                                    }
                                }
                            }
                        }
                    });
                }

                console.log('All charts initialized successfully');
            } catch (error) {
                console.error('Error initializing charts:', error);
                // Retry after a short delay
                setTimeout(initializeCharts, 500);
            }
        }

        // Multiple initialization triggers to ensure charts load
        document.addEventListener('DOMContentLoaded', initializeCharts);
        
        // Fallback for cases where DOMContentLoaded has already fired
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeCharts);
        } else {
            // DOM is already ready
            setTimeout(initializeCharts, 100);
        }

        // Additional fallback for Livewire components
        window.addEventListener('load', function() {
            setTimeout(initializeCharts, 200);
        });

        // Livewire hook if using Livewire
        if (typeof Livewire !== 'undefined') {
            Livewire.hook('component.initialized', () => {
                setTimeout(initializeCharts, 300);
            });
        }
    </script>
</x-admin.dashboard-layout>