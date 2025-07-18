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
                <i data-lucide="timer" class="size-4 text-accent"></i>
                Time Tracking
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="flex flex-col gap-8 items-center justify-center">
                    <div class="w-full max-w-2xl">
                        <div class="card shadow-2xl rounded-3xl bg-gradient-to-r from-primary/10 to-accent/10 p-8 text-center flex flex-col items-center">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="bg-primary rounded-full p-3">
                                    <i data-lucide="timer" class="text-white size-8"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-xl text-primary">Total Volunteer Hours</h3>
                                    <p class="mt-1 text-3xl font-semibold text-accent">100 Hours</p>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-4 mt-4">
                                <div class="bg-gradient-to-r from-primary to-accent h-4 rounded-full" style="width: 80%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">80% of your yearly goal</p>
                        </div>
                    </div>
                    <div class="w-full max-w-4xl">
                        <h4 class="font-bold text-primary mb-4 text-lg">Recent Events</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @forelse($activities as $activity)
                                <div class="card bg-white rounded-2xl shadow-lg p-6 flex flex-col gap-2 hover:shadow-2xl transition-shadow">
                                    <div class="flex items-center gap-3 mb-2">
                                        <i data-lucide="activity" class="text-accent size-6"></i>
                                        <span class="font-bold text-primary text-lg">{{ $activity->name }}</span>
                                    </div>
                                    <p class="text-gray-700 text-sm">{{ $activity->description ?? 'No description available.' }}</p>
                                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                                        <span>{{ \Carbon\Carbon::parse($activity->created_at)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="card rounded-2xl p-8 flex flex-col items-center justify-center gap-4 col-span-2">
                                    <h3 class="font-bold text-xl text-primary">No Activities Found</h3>
                                    <p class="text-gray-600 text-center">You haven't participated in any activities yet.<br>Start volunteering to see your progress here!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="my_tabs_4" checked="checked" />
                <i data-lucide="shield-check" class="text-primary"></i>
                Certificates
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="w-full">
                    <h4 class="font-bold text-primary mb-4 text-lg">Your Certificates</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @forelse ($certificates as $certificate)
                            <div class="card bg-white/90 rounded-2xl shadow-xl p-6 flex flex-col justify-between hover:shadow-2xl transition-shadow duration-300">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="bg-gradient-to-r from-primary to-accent rounded-full p-2">
                                        <i data-lucide="award" class="text-white size-8"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-lg text-primary">{{ $certificate->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $certificate->description ?? 'Certificate' }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-2 mt-4 justify-end">
                                        <a href="{{ route('volunteer.certificate.show', $certificate->id) }}" wire:navigate class="btn btn-neutral btn-sm">View</a>

                                </div>
                            </div>
                        @empty
                            <div class="card rounded-2xl p-8 flex flex-col items-center justify-center gap-4 col-span-3">
                                <h3 class="font-bold text-xl text-primary">No Certificates Found</h3>
                                <p class="text-gray-600 text-center">You haven't earned any certificates yet.<br>Complete activities to unlock your first certificate!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="my_tabs_4" />
                <i data-lucide="award" class="text-accent"></i>
                Badges & Points
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="flex flex-col gap-8 items-center">
                    <h4 class="font-bold text-primary mb-4 text-lg">Badges & Points</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full">
                        @forelse ($badges as $badge)
                            <div class="card bg-white rounded-2xl shadow-lg p-6 flex flex-col gap-2 items-center hover:shadow-2xl transition-shadow">
                                <div class="flex items-center gap-3 mb-2">
                                    @if($badge->icon_file_id)
                                        @php
                                            $icon = \App\Models\File::find($badge->icon_file_id);
                                        @endphp
                                        @if($icon)
                                            <img src="{{ asset('storage/assets/' . $icon->name) }}" alt="Badge Icon" class="w-10 h-10" />
                                        @else
                                            <i data-lucide="star" class="text-accent size-8"></i>
                                        @endif
                                    @else
                                        <i data-lucide="star" class="text-accent size-8"></i>
                                    @endif
                                    <span class="font-bold text-primary text-lg">{{ $badge->name }}</span>
                                </div>
                                <p class="text-gray-700 text-sm text-center">{{ $badge->description }}</p>
                                <span class="badge bg-gradient-to-r from-primary to-accent text-white font-bold mt-2">{{ $badge->points }} Points</span>
                            </div>
                        @empty
                            <div class="card rounded-2xl p-8 flex flex-col items-center justify-center gap-4 col-span-3">
                                <h3 class="font-bold text-xl text-primary">No badges earned yet</h3>
                                <p class="text-gray-600 text-center">Start participating in activities to earn your first badge and unlock achievements!</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="w-full max-w-lg">
                        <div class="card shadow-xl rounded-2xl bg-gradient-to-r from-primary/10 to-accent/10 p-6 text-center">
                            <h3 class="font-bold text-lg bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Total Points</h3>
                            <p class="mt-2 text-3xl font-semibold text-primary">{{ $badges->sum('points')}} Points</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-volunteer.dashboard-layout>
