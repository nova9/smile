<x-volunteer.dashboard-layout>
    <div class="min-h-screen p-6">
        <div class="inline-flex items-center mb-10 px-6 py-3 bg-gradient-to-r from-primary/10 to-green-600/10 text-primary rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-primary/20">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Welcome to Your Achievements
        </div>
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                        My Volunteer
                        <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                            Achievements
                        </span>
                    </h1>
                    <p class="text-slate-600 text-lg">Celebrate your journey and milestones as a volunteer</p>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6 hover:shadow-lg hover:bg-white transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-slate-800">{{ $totalHours ?? '0' }}</div>
                        <div class="text-sm text-slate-500 font-medium">Total Hours</div>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center">
                        <i data-lucide="timer" class="w-6 h-6 text-slate-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6 hover:shadow-lg hover:bg-white transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-emerald-600">{{ count($certificates) }}</div>
                        <div class="text-sm text-slate-500 font-medium">Certificates</div>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-xl flex items-center justify-center">
                        <i data-lucide="award" class="w-6 h-6 text-emerald-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6 hover:shadow-lg hover:bg-white transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-amber-600">{{ count($badges) }}</div>
                        <div class="text-sm text-slate-500 font-medium">Badges</div>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-amber-200 rounded-xl flex items-center justify-center">
                        <i data-lucide="star" class="w-6 h-6 text-amber-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6 hover:shadow-lg hover:bg-white transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-violet-600">{{ $badges->sum('points') }}</div>
                        <div class="text-sm text-slate-500 font-medium">Points</div>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-violet-100 to-violet-200 rounded-xl flex items-center justify-center">
                        <i data-lucide="zap" class="w-6 h-6 text-violet-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Certificates Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-accent mb-6">Certificates</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($certificates as $certificate)
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6 flex flex-col items-center hover:shadow-2xl transition-shadow duration-300 border border-emerald-100">
                        <div class="bg-gradient-to-r from-accent to-primary rounded-full p-4 mb-4">
                            <i data-lucide="award" class="text-white size-10"></i>
                        </div>
                        <h4 class="font-bold text-lg text-accent mb-1">{{ $certificate->name }}</h4>
                        <p class="text-sm text-gray-500 text-center mb-4">{{ $certificate->description ?? 'Certificate' }}</p>
                        <a href="{{ route('volunteer.certificate.show', $certificate->id) }}" wire:navigate class="btn btn-accent btn-sm mt-auto">View Certificate</a>
                    </div>
                @empty
                    <div class="bg-white/90 rounded-2xl p-8 flex flex-col items-center justify-center gap-4 col-span-3 shadow">
                        <h3 class="font-bold text-xl text-accent">No Certificates Found</h3>
                        <p class="text-gray-600 text-center">You haven't earned any certificates yet.<br>Complete activities to unlock your first certificate!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Badges Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-accent mb-6">Badges</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($badges as $badge)
                    <div class="bg-white/90 rounded-2xl shadow-xl p-6 flex flex-col items-center hover:shadow-2xl transition-shadow duration-300 border border-amber-100">
                        @if($badge->icon_file_id)
                            @php
                                $icon = \App\Models\File::find($badge->icon_file_id);
                            @endphp
                            @if($icon)
                                <img src="{{ asset('storage/assets/' . $icon->name) }}" alt="Badge Icon" class="w-12 h-12 mb-2" />
                            @else
                                <i data-lucide="star" class="text-primary size-10 mb-2"></i>
                            @endif
                        @else
                            <i data-lucide="star" class="text-primary size-10 mb-2"></i>
                        @endif
                        <span class="font-bold text-accent text-lg mb-1">{{ $badge->name }}</span>
                        <p class="text-gray-700 text-sm text-center mb-2">{{ $badge->description }}</p>
                        <span class="inline-block bg-gradient-to-r from-accent to-primary text-white font-bold px-4 py-1 rounded-full mt-2">{{ $badge->points }} Points</span>
                    </div>
                @empty
                    <div class="bg-white/90 rounded-2xl p-8 flex flex-col items-center justify-center gap-4 col-span-3 shadow">
                        <h3 class="font-bold text-xl text-accent">No badges earned yet</h3>
                        <p class="text-gray-600 text-center">Start participating in activities to earn your first badge and unlock achievements!</p>
                    </div>
                @endforelse
            </div>
        </div>

       
    </div>
</x-volunteer.dashboard-layout>
