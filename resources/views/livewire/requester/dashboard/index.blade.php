@php
    $upcomingEvents = [
        (object) [
            'id' => 1,
            'name' => 'Legal Awareness Workshop',
            'description' => 'A workshop to educate the public about their legal rights and responsibilities.',
            'start_date' => now()->addDays(2)->format('Y-m-d H:i'),
        ],
        (object) [
            'id' => 2,
            'name' => 'Community Mediation Session',
            'description' => 'Facilitating peaceful resolution of disputes within the community.',
            'start_date' => now()->addDays(5)->format('Y-m-d H:i'),
        ],
        (object) [
            'id' => 3,
            'name' => 'Pro Bono Legal Aid Camp',
            'description' => 'Offering free legal advice and support to those in need.',
            'start_date' => now()->addDays(10)->format('Y-m-d H:i'),
        ],
    ];
@endphp
<x-requester.dashboard-layout>
    <div class="min-h-screen p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                        Welcome {{ auth()->user()->name }}
                    </h1>
                    <p class="text-slate-600 text-lg">Manage your organization’s events</p>
                </div>
                <div
                    class="inline-flex items-center mb-10 px-6 py-3 bg-gradient-to-r from-primary/10 to-green-600/10 text-primary rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-primary/20">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Welcome to Your Requester Dashboard
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
            <div
                class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 px-4 py-2 hover:bg-white transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-slate-800">{{ $eventsCount ?? 0 }}</div>
                        <div class="text-sm text-slate-500 font-medium">Total Events</div>
                    </div>
                    <div class="size-10 bg-slate-100 rounded-xl flex items-center justify-center">
                        <i data-lucide="calendar-days" class="size-4 text-slate-600"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 px-4 py-2 hover:bg-white transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-slate-800">{{ $activeEventsCount ?? 0 }}</div>
                        <div class="text-sm text-slate-500 font-medium">Active Events</div>
                    </div>
                    <div class="size-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i data-lucide="zap" class="size-4 text-blue-600"></i>
                    </div>
                </div>
            </div>
            <div
                class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 px-4 py-2 hover:bg-white transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-slate-800">{{ $pendingEventsCount ?? 0 }}</div>
                        <div class="text-sm text-slate-500 font-medium">Pending Events</div>
                    </div>
                    <div class="size-10 bg-amber-100 rounded-xl flex items-center justify-center">
                        <i data-lucide="clock" class="size-4 text-amber-600"></i>
                    </div>
                </div>
            </div>


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
                <h2 class="text-base font-semibold mb-4 text-primary">Most Popular Events (Trend)</h2>
                <div class="flex-1 flex items-center justify-center">
                    <canvas id="popularEventsLineChart" style="width:100%;height:100%;max-height:180px;"></canvas>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <h2 class="text-lg font-semibold text-primary mb-4 flex items-center gap-2">
                <i data-lucide="calendar" class="size-5"></i> Upcoming Events
            </h2>
            @if (isset($upcomingEvents) && count($upcomingEvents))
                <ul class="divide-y divide-gray-100">
                    @foreach ($upcomingEvents as $event)
                        <li class="py-3 flex items-center justify-between">
                            <div>
                                <div class="font-semibold text-slate-800">{{ $event->name }}</div>
                                <div class="text-sm text-slate-500">
                                    {{ \Illuminate\Support\Str::limit($event->description, 60) }}</div>
                                <div class="text-xs text-slate-400 mt-1 flex items-center gap-2">
                                    <i data-lucide="clock" class="size-3"></i>
                                    {{ $event->start_date ? date('M d, Y H:i', strtotime($event->start_date)) : 'TBA' }}
                                </div>
                            </div>
                            <a href="{{ route('requester.event.show', $event->id) }}" class="btn btn-sm btn-primary"
                                wire:navigate>View</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-center text-slate-400 py-8">
                    <i data-lucide="calendar-x" class="size-8 mx-auto mb-2"></i>
                    <div class="font-medium">No upcoming events</div>
                    <div class="text-xs">Create a new event to get started!</div>
                </div>
            @endif
        </div>
    </div>
</x-requester.dashboard-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bar Chart: Events by Status
        const eventsStatusBarChart = document.getElementById('eventsStatusBarChart').getContext('2d');
        new Chart(eventsStatusBarChart, {
            type: 'bar',
            data: {
                labels: ['Active', 'Pending', 'Completed', 'Cancelled'],
                datasets: [{
                    label: 'Events',
                    data: [
                        {{ $activeEventsCount ?? 0 }},
                        {{ $pendingEventsCount ?? 0 }},
                        {{ $completedEventsCount ?? 0 }},
                        {{ $cancelledEventsCount ?? 0 }}
                    ],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.6)',
                        'rgba(251, 191, 36, 0.6)',
                        'rgba(16, 185, 129, 0.6)',
                        'rgba(244, 63, 94, 0.6)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(251, 191, 36, 1)',
                        'rgba(16, 185, 129, 1)',
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

        // Line Chart: Most Popular Events (dummy data)
        const popularEventsLineChart = document.getElementById('popularEventsLineChart').getContext('2d');
        new Chart(popularEventsLineChart, {
            type: 'line',
            data: {
                labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                datasets: [{
                        label: 'Legal Awareness Workshop',
                        data: [30, 45, 60, 80, 100, 120],
                        borderColor: 'rgba(59, 130, 246, 1)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Pro Bono Legal Aid Camp',
                        data: [10, 30, 50, 70, 85, 98],
                        borderColor: 'rgba(16, 185, 129, 1)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Community Mediation Session',
                        data: [5, 20, 35, 50, 60, 75],
                        borderColor: 'rgba(251, 191, 36, 1)',
                        backgroundColor: 'rgba(251, 191, 36, 0.1)',
                        tension: 0.4,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
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
    });
</script>
