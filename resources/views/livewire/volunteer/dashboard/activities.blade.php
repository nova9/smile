<x-volunteer.dashboard-layout>
    <div class="flex flex-col gap-4 mt-10">

        <h2 class="text-4xl sm:text-5xl font-bold text-primary leading-tight text-center relative">
            Activities
            <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-32 h-3 text-accent/30" viewBox="0 0 100 12" fill="none">
                <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
        </h2>
        <!-- name of each tab group should be unique -->
        <div class="tabs tabs-lift">
            <label class="tab flex gap-1">
                <input type="radio" name="my_tabs_4" />
                <i data-lucide="timer" class="size-4 "></i>
                Time Tracking
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div>
                    <div class="inline-flex items-center px-4 py-2 bg-accent/10 text-accent rounded-full text-sm font-medium mx-auto lg:mx-0">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Your Volunteer Contributions
                    </div>
                    <!-- Total Hours Card -->
                    <div class="relative bg-gray-50/80 backdrop-blur-sm rounded-2xl  p-6 text-center mt-6">
                        <div class="mt-8">
                            <h3 class="font-bold text-lg bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Total Volunteer Hours</h3>
                            <p class="mt-2 text-3xl font-semibold text-primary">100 Hours</p>
                            <p class="text-sm text-gray-600 mt-1">Your dedication is making a difference!</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- Head -->
                        <thead>
                        <tr class="bg-gradient-to-r from-accent/20 to-primary/20 text-primary">
                            <th class="px-4 py-3"></th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Activity</th>
                            <th class="px-4 py-3 text-left">Hours</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Row 1 -->
                        <tr class="bg-base-200 hover:bg-gray-50/50 transition-colors">
                            <th class="px-4 py-3">1</th>
                            <td class="px-4 py-3">2025/05/05</td>
                            <td class="px-4 py-3">Volunteered at a children's hospital</td>
                            <td class="px-4 py-3">2 hours/day</td>
                        </tr>
                        <!-- Row 2 (Sample Additional Entry) -->
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <th class="px-4 py-3">2</th>
                            <td class="px-4 py-3">2025/06/10</td>
                            <td class="px-4 py-3">Organized community cleanup</td>
                            <td class="px-4 py-3">3 hours/day</td>
                        </tr>
                        <!-- Row 3 (Sample Additional Entry) -->
                        <tr class="bg-base-200 hover:bg-gray-50/50 transition-colors">
                            <th class="px-4 py-3">3</th>
                            <td class="px-4 py-3">2025/07/01</td>
                            <td class="px-4 py-3">Assisted at local food bank</td>
                            <td class="px-4 py-3">4 hours/day</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="my_tabs_4" checked="checked" />
                <i data-lucide="shield-check"></i>
                Certificates
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="inline-flex items-center px-4 py-2 bg-accent/10 text-accent rounded-full text-sm font-medium mx-auto lg:mx-0">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Your Volunteer Achievements
                </div>
                <!-- Certificates Table -->
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- Head -->
                        <thead>
                        <tr class="bg-gradient-to-r from-accent/20 to-primary/20 text-primary">
                            <th class="px-4 py-3"></th>
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Event</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Row 1 -->
                        <tr class="bg-base-200 hover:bg-gray-50/50 transition-colors">
                            <th class="px-4 py-3">1</th>
                            <td class="px-4 py-3">Cy Ganderton</td>
                            <td class="px-4 py-3">Children's Hospital Volunteer</td>
                            <td class="px-4 py-3 flex justify-end gap-2">
                                <a href="{{asset('storage/certificates/cy_ganderton_certificate.pdf')}}" target="_blank" class="btn btn-sm btn-primary">View</a>
                                <a href="{{asset('storage/certificates/cy_ganderton_certificate.pdf')}}" download class="btn btn-sm btn-accent">Download</a>
                            </td>
                        </tr>
                        <!-- Row 2 (Sample Additional Entry) -->
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <th class="px-4 py-3">2</th>
                            <td class="px-4 py-3">Noufa Nuzurath</td>
                            <td class="px-4 py-3">Community Cleanup Initiative</td>
                            <td class="px-4 py-3 flex justify-end gap-2">
                                <a href="{{asset('storage/certificates/noufa_nuzurath_certificate.pdf')}}" target="_blank" class="btn btn-sm btn-primary">View</a>
                                <a href="{{asset('storage/certificates/noufa_nuzurath_certificate.pdf')}}" download class="btn btn-sm btn-accent">Download</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="my_tabs_4" />
                <i data-lucide="award"></i>
                Badges & Points
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                Badges & Points (view earned badges, points, leaderboard rank)
                <div class="flex gap-3">
                    <div class="card bg-base-100 w-96 shadow-sm">
                        <figure>
                            <img
                                src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                                alt="Shoes" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">Card Title</h2>
                            <p>A card component has a figure, a body part, and inside body there are title and actions parts</p>
                            <div class="card-actions justify-end">
                                <button class="btn btn-primary">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Favorite Color</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th>1</th>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th>2</th>
                                <td>Hart Hagerty</td>
                                <td>Desktop Support Technician</td>
                                <td>Purple</td>
                            </tr>
                            <!-- row 3 -->
                            <tr>
                                <th>3</th>
                                <td>Brice Swyre</td>
                                <td>Tax Accountant</td>
                                <td>Red</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-volunteer.dashboard-layout>
