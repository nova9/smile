<x-volunteer.dashboard-layout>
    <div class="min-h-screen p-6">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                        Welcome {{ auth()->user()->name }}
                    </h1>
                    <p class="text-slate-600 text-lg">Track and manage your volunteer activities</p>
                </div>
                <div
                    class="inline-flex items-center mb-10 px-6 py-3 bg-gradient-to-r from-primary/10 to-green-600/10 text-primary rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-primary/20">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Welcome to Your Volunteer Dashboard
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
            <x-volunteer.dashboard.my-events.card label="Total Events" :value="$totalEvents" icon="calendar-days"
                color="slate-600" color_bg="slate-100" />
            <x-volunteer.dashboard.my-events.card label="Confirmed" :value="count($confirmedEvents)" icon="clock" color="emerald-600"
                color_bg="emerald-100" />
            <x-volunteer.dashboard.my-events.card label="Pending" :value="count($pendingEvents)" icon="clock" color="amber-600"
                color_bg="amber-100" />
            <x-volunteer.dashboard.my-events.card label="Completed" :value="count($completedEvents)" icon="clock" color="violet-600"
                color_bg="violet-100" />
            <x-volunteer.dashboard.my-events.card label="Cancelled" :value="count($cancelledEvents)" icon="clock" color="rose-600"
                color_bg="rose-100" />
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 h-64 flex flex-col">
                <h2 class="text-base font-semibold mb-4 text-primary">Events by Status</h2>
                <div class="flex-1 flex items-center justify-center">
                    <canvas id="eventsStatusBarChart" style="width:100%;height:100%;max-height:180px;"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 h-64 flex flex-col">
                <h2 class="text-base font-semibold mb-4 text-primary">Events by Month</h2>
                <div class="flex-1 flex items-center justify-center">
                    <canvas id="eventsMonthDoughnutChart" style="width:100%;height:100%;max-height:180px;"></canvas>
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Bar Chart: Events by Status
                const eventsStatusBarChart = document.getElementById('eventsStatusBarChart').getContext('2d');
                new Chart(eventsStatusBarChart, {
                    type: 'bar',
                    data: {
                        labels: ['Confirmed', 'Pending', 'Completed', 'Cancelled'],
                        datasets: [{
                            label: 'Events',
                            data: [
                                {{ count($confirmedEvents) }},
                                {{ count($pendingEvents) }},
                                {{ count($completedEvents) }},
                                {{ count($cancelledEvents) }}
                            ],
                            backgroundColor: [
                                'rgba(16, 185, 129, 0.6)',
                                'rgba(251, 191, 36, 0.6)',
                                'rgba(139, 92, 246, 0.6)',
                                'rgba(244, 63, 94, 0.6)'
                            ],
                            borderColor: [
                                'rgba(16, 185, 129, 1)',
                                'rgba(251, 191, 36, 1)',
                                'rgba(139, 92, 246, 1)',
                                'rgba(244, 63, 94, 1)'
                            ],
                            borderWidth: 1,
                            borderRadius: 6
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
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: '#f3f4f6'
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

                // Doughnut Chart: Events by Month (sample data, replace with dynamic if available)
                const eventsMonthDoughnutChart = document.getElementById('eventsMonthDoughnutChart').getContext('2d');
                new Chart(eventsMonthDoughnutChart, {
                    type: 'doughnut',
                    data: {
                        labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                        datasets: [{
                            data: [2, 4, 3, 5, 1, 2], // Replace with dynamic data if available
                            backgroundColor: [
                                'rgba(16, 185, 129, 0.6)',
                                'rgba(251, 191, 36, 0.6)',
                                'rgba(139, 92, 246, 0.6)',
                                'rgba(244, 63, 94, 0.6)',
                                'rgba(59, 130, 246, 0.6)',
                                'rgba(251, 113, 133, 0.6)'
                            ],
                            borderColor: [
                                'rgba(16, 185, 129, 1)',
                                'rgba(251, 191, 36, 1)',
                                'rgba(139, 92, 246, 1)',
                                'rgba(244, 63, 94, 1)',
                                'rgba(59, 130, 246, 1)',
                                'rgba(251, 113, 133, 1)'
                            ],
                            borderWidth: 1
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
            });
        </script>

        <!-- Events List (Desktop) -->
        <div class="border border-slate-200 overflow-hidden rounded-2xl shadow-sm">
            <!-- Table Header -->
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">
                <div class="grid grid-cols-12 gap-4 text-sm font-semibold text-slate-700">
                    <div class="col-span-4">Event Details</div>
                    <div class="col-span-2">Date & Time</div>
                    <div class="col-span-2">Location</div>
                    <div class="col-span-1">Status</div>
                    <div class="col-span-2">Organizer</div>

                </div>
            </div>

            <!-- Events List Items -->
            <div class="px-6">
                @foreach ($participatingEvents->take(5) as $item)
                    <div class="hover:bg-white/60 transition-all duration-200 group">
                        <div class="grid grid-cols-12 gap-4 items-center">

                            <!-- Event Details -->
                            <div class="col-span-4">
                                <div class="flex items-start gap-4">
                                    <div class="min-w-0 flex-1">
                                        <a href="/volunteer/dashboard/my-events/{{ $item->id }}"
                                            class="font-bold text-slate-900 mb-2 text-lg transition-colors duration-200">
                                            {{ $item->name }}
                                        </a>
                                        <p class="text-sm text-slate-600 line-clamp-2 mb-3">
                                            {{ $item->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Date & Time -->
                            <div class="col-span-2">
                                <div class="bg-white/50 rounded-xl p-3">
                                    <div class="text-sm font-bold text-slate-900 mb-1">
                                        {{ date('M j, Y', strtotime($item->starts_at)) }}
                                    </div>
                                    <div class="text-sm text-slate-600 flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3 h-3"></i>
                                        {{ $item->starts_at->format('h:i A') }} -
                                        {{ $item->ends_at->format('h:i A') }}
                                    </div>
                                    <div class="text-xs text-slate-400 mt-2 flex items-center gap-1">
                                        <i data-lucide="calendar-plus" class="w-3 h-3"></i>
                                        Applied {{ date('M j', strtotime($item->pivot->created_at)) }}
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-span-2">
                                <div class="flex items-center gap-2 text-sm text-slate-600 bg-white/50 rounded-xl">
                                    <div
                                        class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i data-lucide="map-pin" class="w-4 h-4 text-slate-500"></i>
                                    </div>
                                    <span class="font-medium">{{ $item->city }}</span>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-span-1">
                                @if ($item->pivot->status === 'accepted')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-700 shadow-sm">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></div>
                                        Confirmed
                                    </span>
                                @elseif($item->pivot->status === 'pending')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700 shadow-sm">
                                        <div class="w-2 h-2 bg-amber-500 rounded-full mr-2 animate-pulse"></div>
                                        Pending
                                    </span>
                                @elseif($item->pivot->status === 'completed')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-violet-100 to-purple-100 text-violet-700 shadow-sm">
                                        <i data-lucide="check-circle" class="w-3 h-3 mr-2"></i>
                                        Completed
                                    </span>
                                @elseif($item->pivot->status === 'rejected' || $item->pivot->status === 'cancelled')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-rose-100 to-red-100 text-rose-700 shadow-sm">
                                        <i data-lucide="x-circle" class="w-3 h-3 mr-2"></i>
                                        Cancelled
                                    </span>
                                @endif
                            </div>

                            <!-- Organizer -->
                            <div class="col-span-3">
                                <div class="flex items-center gap-3 bg-white/50 rounded-xl">
                                    <div class="relative">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-sm font-bold text-white shadow-md">
                                            {{ $item->user->name ? substr($item->user->name, 0, 1) : '' }} </div>
                                        <div
                                            class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white">
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-sm font-semibold text-slate-900">{{ $item->user->name }}
                                        </div>
                                        <div class="text-xs text-slate-500">Event Organizer</div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        {{-- <div
            class="mt-8 flex items-center justify-between bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
            <div class="flex items-center gap-2 text-sm text-slate-600">
                <i data-lucide="list" class="w-4 h-4"></i>
                <span>Showing <span class="font-semibold text-slate-900">1-5</span> of <span
                        class="font-semibold text-slate-900">5</span> events</span>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i data-lucide="chevron-left" class="w-4 h-4 mr-1"></i>
                    Previous
                </button>
                <div class="flex items-center gap-2">
                    <button class="w-10 h-10 bg-black text-white rounded-xl text-sm font-semibold shadow-lg">1</button>
                    <button
                        class="w-10 h-10 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">2</button>
                    <button
                        class="w-10 h-10 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">3</button>
                    <span class="text-slate-400">...</span>
                    <button
                        class="w-10 h-10 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">10</button>
                </div>
                <button
                    class="px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">
                    Next
                    <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                </button>
            </div>
        </div> --}}

        <!-- Quick Actions FAB -->
        {{-- <div class="fixed bottom-6 right-6 flex flex-col gap-3 z-10">

            <button
                class="w-12 h-12 bg-white/90 backdrop-blur-sm text-slate-600 rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 border border-white/20 flex items-center justify-center md:hidden">
                <i data-lucide="filter" class="w-5 h-5"></i>
            </button>
        </div> --}}
    </div>
</x-volunteer.dashboard-layout>
