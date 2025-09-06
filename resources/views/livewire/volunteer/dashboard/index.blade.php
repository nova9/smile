<x-volunteer.dashboard-layout>
    <div class="min-h-screen p-4 sm:p-6 lg:p-8 bg-gray-50">
        <!-- Hero Section -->
        <div
            class="mb-8 bg-gradient-to-r from-primary/5 to-green-600/5 rounded-3xl p-6 sm:p-8 shadow-sm border border-primary/10">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-accent">
                        Welcome,
                        <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                            {{ Auth::user()->name ?? 'Volunteer' }}
                        </span>
                    </h1>
                    <p class="text-slate-600 text-base sm:text-lg mt-2">Your impact at a glance</p>
                </div>
                <div
                    class="inline-flex items-center px-4 py-2 bg-white/50 backdrop-blur-sm rounded-full text-sm font-medium text-primary shadow-sm border border-primary/20">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Volunteer Dashboard
                </div>
            </div>
        </div>
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
            <div
                class="bg-white rounded-xl p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold text-slate-800">{{ $totalHours ?? '0' }}</div>
                        <div class="text-sm text-slate-500">Total Hours</div>
                    </div>
                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="timer" class="w-5 h-5 text-slate-600"></i>
                    </div>
                </div>
            </div>
            <div
                class="bg-white rounded-xl p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold text-emerald-600">{{ $eventsCount ?? '0' }}</div>
                        <div class="text-sm text-slate-500">Events Joined</div>
                    </div>
                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="calendar-days" class="w-5 h-5 text-emerald-600"></i>
                    </div>
                </div>
            </div>
            <div
                class="bg-white rounded-xl p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold text-violet-600">{{ $achievementsCount ?? '0' }}
                        </div>
                        <div class="text-sm text-slate-500">Achievements</div>
                    </div>
                    <div class="w-10 h-10 bg-violet-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="trophy" class="w-5 h-5 text-violet-600"></i>
                    </div>
                </div>
            </div>
            <div
                class="bg-white rounded-xl p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl sm:text-3xl font-bold text-amber-600">{{ $certificatesCount ?? '0' }}</div>
                        <div class="text-sm text-slate-500">Certificates</div>
                    </div>
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="award" class="w-5 h-5 text-amber-600"></i>
                    </div>
                </div>
            </div>
        </div>
         <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 h-full flex flex-col">
                <h2 class="text-base font-semibold mb-4 text-primary">Volunteer Hours (Last 6 Months)</h2>
                <div class="flex-1 flex items-center justify-center">
                    <canvas id="hoursBarChart" style="width:100%;max-height:400px;"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 h-full flex flex-col">
                <h2 class="text-base font-semibold mb-4 text-primary">Event Participation Breakdown</h2>
                <div class="flex-1 flex items-center justify-center">
                    <canvas id="eventsPieChart" style="width:100%;max-height:400px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
            <a href="/volunteer/dashboard/events"
                class="group block bg-white rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="flex items-center gap-3">
                    <i data-lucide="party-popper"
                        class="w-8 h-8 text-primary group-hover:scale-105 transition-transform"></i>
                    <div>
                        <div class="text-base font-semibold text-primary">Find Opportunities</div>
                        <div class="text-sm text-slate-500">Browse new events</div>
                    </div>
                </div>
            </a>
            <a href="/volunteer/dashboard/my-events"
                class="group block bg-white rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="flex items-center gap-3">
                    <i data-lucide="file-clock"
                        class="w-8 h-8 text-emerald-600 group-hover:scale-105 transition-transform"></i>
                    <div>
                        <div class="text-base font-semibold text-emerald-600">My Events</div>
                        <div class="text-sm text-slate-500">View participation</div>
                    </div>
                </div>
            </a>
            <a href="/volunteer/dashboard/leaderboard"
                class="group block bg-white rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="flex items-center gap-3">
                    <i data-lucide="users"
                        class="w-8 h-8 text-violet-600 group-hover:scale-105 transition-transform"></i>
                    <div>
                        <div class="text-base font-semibold text-violet-600">Leaderboard</div>
                        <div class="text-sm text-slate-500">See top volunteers</div>
                    </div>
                </div>
            </a>
            <a href="/volunteer/dashboard/achievements"
                class="group block bg-white rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                <div class="flex items-center gap-3">
                    <i data-lucide="trophy"
                        class="w-8 h-8 text-amber-600 group-hover:scale-105 transition-transform"></i>
                    <div>
                        <div class="text-base font-semibold text-amber-600">Achievements</div>
                        <div class="text-sm text-slate-500">Celebrate milestones</div>
                    </div>
                </div>
            </a>
        </div>


        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Bar Chart: Volunteer Hours
                const hoursBarChart = document.getElementById('hoursBarChart').getContext('2d');
                new Chart(hoursBarChart, {
                    type: 'bar',
                    data: {
                        labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                        datasets: [{
                            label: 'Hours',
                            data: [12, 19, 8, 15, 10, 14],
                            backgroundColor: 'rgba(16, 185, 129, 0.4)',
                            borderColor: 'rgba(16, 185, 129, 1)',
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

                // Pie Chart: Event Participation
                const eventsPieChart = document.getElementById('eventsPieChart').getContext('2d');
                new Chart(eventsPieChart, {
                    type: 'pie',
                    data: {
                        labels: ['Completed', 'Upcoming', 'Cancelled'],
                        datasets: [{
                            data: [8, 3, 1],
                            backgroundColor: [
                                'rgba(99, 102, 241, 0.6)',
                                'rgba(16, 185, 129, 0.6)',
                                'rgba(251, 191, 36, 0.6)'
                            ],
                            borderColor: [
                                'rgba(99, 102, 241, 1)',
                                'rgba(16, 185, 129, 1)',
                                'rgba(251, 191, 36, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: 12
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    </div>
</x-volunteer.dashboard-layout>
