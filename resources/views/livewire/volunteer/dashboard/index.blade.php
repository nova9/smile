<x-volunteer.dashboard-layout>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Header -->
            <header class="bg-white shadow rounded-lg p-4 mb-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold">Welcome To Smile!</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{auth()->user()->name}}</span>

                </div>
            </header>

            <!-- Stats Section (DaisyUI) -->
            <div class="stats shadow mb-6">
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-8 w-8 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Hours Contributed</div>
                    <div class="stat-value text-primary">45</div>
                    <div class="stat-desc">10% more than last month</div>
                </div>

                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-8 w-8 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="stat-title">Events Attended</div>
                    <div class="stat-value text-secondary">12</div>
                    <div class="stat-desc">2 more this month</div>
                </div>

                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <div class="avatar avatar-online">
                            <div class="w-16 rounded-full">
                                <img src="https://via.placeholder.com/64" alt="Profile" />
                            </div>
                        </div>
                    </div>
                    <div class="stat-value">86%</div>
                    <div class="stat-title">Tasks Completed</div>
                    <div class="stat-desc text-secondary">5 tasks remaining</div>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Upcoming Events -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Upcoming Events</h3>
                    <ul class="list bg-base-100 rounded-box shadow-md">
                        <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Upcoming Events This Week</li>
                        <li class="list-row">
                            <div class="text-4xl font-thin opacity-30 tabular-nums">01</div>
                            <div><img class="size-10 rounded-box" src="https://img.daisyui.com/images/profile/demo/1@94.webp"/></div>
                            <div class="list-col-grow">
                                <div>Community Cleanup</div>
                                <div class="text-xs uppercase font-semibold opacity-60">Jul 19, 2025 - 9:00 AM</div>
                            </div>
                            <button class="btn btn-square btn-ghost">
                                <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"><path d="M6 3L20 12 6 21 6 3z"></path></g></svg>
                            </button>
                        </li>
                        <li class="list-row">
                            <div class="text-4xl font-thin opacity-30 tabular-nums">02</div>
                            <div><img class="size-10 rounded-box" src="https://img.daisyui.com/images/profile/demo/4@94.webp"/></div>
                            <div class="list-col-grow">
                                <div>Food Drive</div>
                                <div class="text-xs uppercase font-semibold opacity-60">Jul 20, 2025 - 10:00 AM</div>
                            </div>
                            <button class="btn btn-square btn-ghost">
                                <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"><path d="M6 3L20 12 6 21 6 3z"></path></g></svg>
                            </button>
                        </li>
                        <li class="list-row">
                            <div class="text-4xl font-thin opacity-30 tabular-nums">03</div>
                            <div><img class="size-10 rounded-box" src="https://img.daisyui.com/images/profile/demo/3@94.webp"/></div>
                            <div class="list-col-grow">
                                <div>Tree Planting</div>
                                <div class="text-xs uppercase font-semibold opacity-60">Jul 21, 2025 - 2:00 PM</div>
                            </div>
                            <button class="btn btn-square btn-ghost">
                                <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"><path d="M6 3L20 12 6 21 6 3z"></path></g></svg>
                            </button>
                        </li>
                    </ul>
                    <a href="#" class="text-blue-600 hover:underline mt-4 block">View All Events</a>
                </div>

        </main>

</x-volunteer.dashboard-layout>
