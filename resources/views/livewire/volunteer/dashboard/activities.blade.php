<x-volunteer.dashboard-layout>
    
    <div class="flex flex-col gap-4 mt-10 tab-bg min-h-screen">

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
                <i data-lucide="timer" class="size-4 animate-spin text-accent"></i>
                Time Tracking
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="flex flex-col  items-center justify-center">
                @if($activities->isEmpty())
                    <div class="card  rounded-2xl p-8 flex flex-col items-center justify-center gap-4">
                        
                        <h3 class="font-bold text-xl text-primary">No Activities Found</h3>
                        <p class="text-gray-600 text-center">You haven't participated in any activities yet.<br>Start volunteering to see your progress here!</p>
                    </div>
                @else
                  <div class="card shadow-xl rounded-2xl bg-white/90 p-8 text-center w-full mb-10">
                        <div class="flex flex-col items-center">
                            <svg class="w-10 h-10 text-accent mb-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <h3 class="font-bold text-lg bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Total Volunteer Hours</h3>
                            <p class="mt-2 text-3xl font-semibold text-primary">100 Hours</p>
                            <p class="text-sm text-gray-600 mt-1">Your dedication is making a difference!</p>
                        </div>
                        <div class="mt-6">
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-gradient-to-r from-primary to-accent h-3 rounded-full" style="width: 80%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">80% of your yearly goal</p>
                        </div>
                    </div>
                </div>
                    <div class="w-full">
                        <h4 class="font-bold text-primary mb-2">Recent Activities</h4>
                        <div class="overflow-x-auto w-full">
                            <table class="w-full min-w-full bg-white rounded-lg shadow">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Description</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($activities as $activity)
                                    <tr>
                                        <td class="px-6 py-4 font-bold text-primary">{{ $activity->name }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ $activity->description ?? 'No description available.' }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ \Carbon\Carbon::parse($activity->started_at)->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ ceil(\Carbon\Carbon::parse($activity->started_at)->floatDiffInHours(\Carbon\Carbon::parse($activity->ended_at))) }} hour</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                      
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="my_tabs_4" checked="checked" />
                <i data-lucide="shield-check" class="text-primary"></i>
                Certificates
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="overflow-x-auto">
                    @if($certificates->isEmpty())
                    <div class="card  rounded-2xl p-8 flex flex-col items-center justify-center gap-4">
                        
                        <h3 class="font-bold text-xl text-primary">No Certificates Found</h3>
                        <p class="text-gray-600 text-center">You haven't earned any certificates yet.<br>Complete activities to unlock your first certificate!</p>
                    </div>
                    @else
                    <table class="min-w-full bg-white rounded-lg shadow">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Event</th>
                                {{-- <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Event</th> --}}
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 flex justify-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($certificates as $certificate )
                            <tr>
                                <td class="px-6 py-4 font-bold text-gray-900">{{ $certificate->name}}</td>
                                <td class="px-6 py-4 flex justify-end gap-2">
                                    <button class="btn btn-neutral">View</button>
                                    <button class="btn btn-outline">Download</button>
                                </td>
                            </tr>
                        @endforeach
                          </tbody>
                    </table>
                    @endif
                </div>

            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="my_tabs_4" />
                <i data-lucide="award" class="text-accent"></i>
                Badges & Points
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="flex flex-col gap-8 items-center">
                <div class="overflow-x-auto w-full">
                @if($badges->isEmpty())
                    <div class="card  rounded-2xl p-8 flex flex-col items-center justify-center gap-4">
                        
                        <h3 class="font-bold text-xl text-primary">No badges earned yet</h3>
                        <p class="text-gray-600 text-center">Start participating in activities to earn your first badge and unlock achievements!</p>
                    </div>
                @else
                    <table class="min-w-full bg-white rounded-lg shadow">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Badge</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Description</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Points</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($badges as $badge)
                            <tr>
                                <td class="px-6 py-4 font-bold text-gray-900 flex items-center gap-2">
                                    @if($badge->icon_file_id)
                                        @php
                                            $icon = \App\Models\File::find($badge->icon_file_id);
                                            // dd($icon->name);
                                        @endphp
                                        @if($icon)
                                        
                                            <img src="{{ asset('storage/assets/' . $icon->name) }}" alt="Badge Icon" class="w-8 h-8 " />
                                        @endif
                                    @endif
                                    {{ $badge->name }}
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $badge->description }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $badge->points }}</td>
                            </tr>
                        @endforeach
                            
                        </tbody>
                    </table>
                    @endif
                </div>
                    <div class="w-full max-w-lg">
                        <div class="card shadow-xl rounded-2xl bg-white/90 p-6 text-center">
                            <h3 class="font-bold text-lg bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Total Points</h3>
                            <p class="mt-2 text-3xl font-semibold text-primary">{{ $totalBadgePoints }} Points</p>
                
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
</x-volunteer.dashboard-layout>