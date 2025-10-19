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

    <body class="bg-gray-100 font-sans">
        <div class="flex h-screen">
            <!-- Main Content -->
            <div class="flex-1 p-8 overflow-y-auto">
                <div class="flex flex-col  mb-6">
                    <h1 class="text-2xl font-bold">Dashboard</h1>
                    <p class="text-gray-600 text-sm italic"> Empowering organizations to create, manage, and grow impactful volunteer opportunities—connect, track, and celebrate your community’s contributions with Smile</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Project Stats -->
                    <div class="bg-primary text-white p-6 rounded-lg">
                        <p>Total Events</p>
                        <p class="text-3xl font-bold">24</p>
                        <p class="text-sm">increased from last month</p>
                    </div>
                    <div class="bg-primary text-white p-6 rounded-lg">
                        <p>Ended Events</p>
                        <p class="text-3xl font-bold">10</p>
                        <p class="text-sm">increased from last month</p>
                    </div>
                    <div class="bg-primary text-white p-6 rounded-lg">
                        <p>Running Events</p>
                        <p class="text-3xl font-bold">12</p>
                        <p class="text-sm">increased from last month</p>
                    </div>
                    <div class="bg-primary text-white p-6 rounded-lg">
                        <p>Pending Events</p>
                        <p class="text-3xl font-bold">2</p>
                        <p class="text-sm">On Discuss</p>
                    </div>

                    <!-- Project Analytics -->
                    <div class="col-span-2 bg-white p-6 rounded-lg shadow">
                        <h2 class="text-xl font-bold mb-4">Project Analytics</h2>
                        <div class="flex space-x-4">
                            <div class="w-1/5 bg-gray-200 h-32 rounded"></div>
                            <div class="w-1/5 bg-gray-200 h-24 rounded"></div>
                            <div class="w-1/5 bg-gray-200 h-20 rounded"></div>
                            <div class="w-1/5 bg-gray-200 h-16 rounded"></div>
                            <div class="w-1/5 bg-gray-200 h-12 rounded"></div>
                        </div>
                    </div>

                    <!-- Reminders -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-xl font-bold mb-4">Reminders</h2>
                        <p>Meeting with Arc Company</p>
                        <p>Time: 02:00 pm - 04:00 pm</p>
                        <button class="bg-green-600 text-white px-4 py-2 rounded mt-4">Start Meeting</button>
                    </div>

                    <!-- Project -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-xl font-bold mb-4">Project</h2>
                        <p>New</p>
                        <p>Develop API Endpoints</p>
                        <p>Due: Nov 28, 2024</p>
                        <p>Onboarding Flow</p>
                        <p>Due: Nov 18, 2024</p>
                        <p>Build Dashboard</p>
                        <p>Due: Nov 18, 2024</p>
                    </div>

                    <!-- Team Collaboration -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-xl font-bold mb-4">Team Collaboration</h2>
                        <button class="bg-green-600 text-white px-4 py-2 rounded mb-4">Add Member</button>
                        <p>Alexandra Deff</p>
                        <p>Working on Github Project Repository</p>
                        <p>Edwin Adinike</p>
                        <p>Integrate User Authentication System</p>
                        <p>Isaac Olawatemilorun</p>
                        <p>Working on Develop Search & Filter Functionality</p>
                        <p>David Oshodi</p>
                        <p>Working on Responsive Layout for Homepage</p>
                    </div>

                    <!-- Project Progress -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-xl font-bold mb-4">Project Progress</h2>
                        <div class="w-full bg-gray-200 rounded-full h-8">
                            <div class="bg-green-600 h-8 rounded-full" style="width: 41%"></div>
                        </div>
                        <p class="text-center mt-2">41% Project Ended</p>
                        <div class="flex justify-around mt-4">
                            <span>Completed</span>
                            <span>In Progress</span>
                            <span>Pending</span>
                        </div>
                    </div>

                    <!-- Time Tracker -->
                    <div class="bg-green-600 text-white p-6 rounded-lg shadow">
                        <h2 class="text-xl font-bold mb-4">Time Tracker</h2>
                        <p>01:24:08</p>
                        <button class="bg-white text-green-600 px-4 py-2 rounded mt-4">Play</button>
                    </div>
                </div>
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
