<x-volunteer.dashboard-layout>
    <div class="p-6 lg:p-12 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Welcome, {{ auth()->user()->name }}!</h1>
            <p class="text-gray-600 mt-2">Here's an overview of your volunteer journey.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-6 gap-6 items-start">
            <!-- Stats Section -->
            <div class=" col-span-1 lg:col-span-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div
                        class="stats bg-white shadow-lg rounded-xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                        <div class="stat p-6">
                            <div class="stat-title text-gray-500 font-medium">Total Events</div>
                            <div class="stat-value text-4xl font-extrabold text-indigo-600">8</div>
                            <div class="stat-desc text-green-500 font-medium">21% more than last month</div>
                        </div>
                    </div>
                    <div
                        class="stats bg-white shadow-lg rounded-xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                        <div class="stat p-6">
                            <div class="stat-title text-gray-500 font-medium">Total Points</div>
                            <div class="stat-value text-4xl font-extrabold text-indigo-600">80</div>
                            <div class="stat-desc text-green-500 font-medium">21% more than last month</div>
                        </div>
                    </div>
                    <div
                        class="stats bg-white shadow-lg rounded-xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                        <div class="stat p-6">
                            <div class="stat-title text-gray-500 font-medium">Total Hours</div>
                            <div class="stat-value text-4xl font-extrabold text-indigo-600">54</div>
                            <div class="stat-desc text-green-500 font-medium">21% more than last month</div>
                        </div>
                    </div>

                </div>
                <div>
                    
                    <div class="bg-white rounded-xl shadow-lg p-6 mt-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Monthly Volunteer Progress</h3>
                        <canvas id="volunteerProgressChart" class="w-full h-64"></canvas>
                    </div>
                    <!-- Chart.js CDN and chart script -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var ctx = document.getElementById('volunteerProgressChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: {!! json_encode($months ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!},
                                    datasets: [{
                                        label: 'Hours',
                                        data: {!! json_encode($monthlyHours ?? [12, 19, 3, 5, 2, 3]) !!},
                                        backgroundColor: 'rgba(59,130,246,0.7)',
                                        borderColor: 'rgba(59,130,246,1)',
                                        borderWidth: 2,
                                        borderRadius: 8,
                                        hoverBackgroundColor: 'rgba(34,197,94,0.7)',
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false
                                        },
                                        tooltip: {
                                            backgroundColor: 'rgba(59,130,246,0.9)',
                                            titleColor: '#fff',
                                            bodyColor: '#fff',
                                            borderColor: 'rgba(34,197,94,0.7)',
                                            borderWidth: 1,
                                            padding: 12,
                                            cornerRadius: 8,
                                        }
                                    },
                                    scales: {
                                        x: {
                                            grid: {
                                                display: false
                                            },
                                            ticks: {
                                                color: '#3b82f6',
                                                font: {
                                                    weight: 'bold'
                                                }
                                            }
                                        },
                                        y: {
                                            beginAtZero: true,
                                            grid: {
                                                color: 'rgba(59,130,246,0.1)'
                                            },
                                            ticks: {
                                                color: '#22c55e',
                                                font: {
                                                    weight: 'bold'
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                </div>

            </div>

            <!-- Achievements Section -->
            <div class="col-span-1 lg:col-span-2">
                <div class="card w-full bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="card-body p-6">
                        <h2 class="card-title text-2xl font-semibold text-gray-800 mb-4">Your Achievements</h2>
                        <p class="text-gray-600 mb-4">Celebrating your milestones:</p>
                        <ul class="space-y-3">
                            <li class="flex items-center text-gray-700 mb-2">
                                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zm0-10a1 1 0 00-1 1v3a1 1 0 002 0V7a1 1 0 00-1-1zm0 8a1 1 0 100-2 1 1 0 000 2z" />
                                </svg>
                                Leaderboard Rank #1
                            </li>
                            @if (isset($badges) && count($badges))
                                <li class="flex flex-col text-gray-700 mb-2">
                                    <div class="flex items-center mb-1">
                                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <circle cx="10" cy="10" r="8" />
                                        </svg>
                                        Badges Earned
                                    </div>
                                    <ul class="ml-7 space-y-1">
                                        @foreach ($badges as $badge)
                                            <li class="flex items-center">
                                                <span class="text-sm text-gray-600">{{ $badge->name }}</span>
                                                @if ($badge->icon)
                                                    <img src="{{ $badge->icon }}" alt="{{ $badge->name }}"
                                                        class="w-5 h-5 ml-2" />
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                            @if (isset($certificates) && count($certificates))
                                <li class="flex flex-col text-gray-700 mb-2">
                                    <div class="flex items-center mb-1">
                                        <svg class="w-5 h-5 text-purple-500 mr-2" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <rect x="4" y="4" width="12" height="12" rx="2" />
                                        </svg>
                                        Certificates Awarded
                                    </div>
                                    <ul class="ml-7 space-y-1">
                                        @foreach ($certificates as $certificate)
                                            <li class="flex items-center">
                                                <span class="text-sm text-gray-600">{{ $certificate->title }}</span>
                                                @if ($certificate->icon)
                                                    <img src="{{ $certificate->icon }}" alt="{{ $certificate->title }}"
                                                        class="w-5 h-5 ml-2" />
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-volunteer.dashboard-layout>
