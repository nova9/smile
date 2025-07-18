<x-volunteer.dashboard-layout>

    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <!-- Badge -->
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary/10 to-green-600/10 text-primary rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-primary/20">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Celebrating Our Top Smilers
                </div>


                <!-- Title -->
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-accent leading-tight relative">
                        Top <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">Smilers</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-primary/30"
                            viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Recognizing our amazing volunteers who spread joy and make a difference in their communities
                    </p>
                </div>
            </div>

            <!-- Your Rank Summary Card -->
            <div class="relative group">
                <!-- Gradient background -->
                <div class="absolute inset-0 bg-gradient-to-br from-primary/20 via-green-500/10 to-accent/20 rounded-3xl transform rotate-1 group-hover:rotate-0 transition-transform duration-300"></div>

                <!-- Card content -->
                <div class="relative bg-white/90 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                    <div class="flex items-center justify-between flex-wrap gap-6">
                        <div class="flex items-center gap-6">
                            <div class="relative">

                                <div class="avatar">
                                    <div class="mask mask-squircle h-20 w-20 ring-4 ring-primary/20">
                                        <img src="https://img.daisyui.com/images/profile/demo/2@94.webp"
                                            alt="Your Avatar" />
                                    </div>
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-primary rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-bold text-2xl bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent">
                                    Your Current Standing
                                </h3>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <span class="text-gray-600 font-medium">UCSC</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-8">
                            <div class="text-center">
                                <div class="relative">
                                    <p class="text-3xl font-bold bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                                        {{ $currentUser->badges_sum_points ?? 0 }}
                                    </p>
                                    <div class="absolute -inset-2 bg-gradient-to-r from-primary/20 to-green-600/20 rounded-lg -z-10 opacity-50"></div>
                                </div>
                                <p class="text-sm text-gray-600 font-medium mt-1">Points</p>
                            </div>
                            <div class="text-center">
                                <div class="relative">
                                    <span class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-accent to-gray-800 text-white font-bold text-xl rounded-2xl shadow-lg transform hover:scale-105 transition-transform duration-200">
                                        {{ $currentUserPosition }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 font-medium mt-2">Rank</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leaderboard Card -->
            <div class="relative group">
                <!-- Card content -->
                <div class="relative bg-white/95 backdrop-blur-lg rounded-3xl shadow-xl overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-primary/10 px-8 py-6 border-b border-gray-100">
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent">
                            🏆 Leaderboard Champions
                        </h3>
                        <p class="text-gray-600 mt-1">Top performers making a difference</p>
                    </div>

                    <!-- Table Container -->
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <!-- Head -->
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                    <th class="px-8 py-4 text-left font-semibold text-accent">Volunteer</th>
                                    <th class="px-8 py-4 text-left font-semibold text-accent">Points</th>
                                    <th class="px-8 py-4 text-left font-semibold text-accent">Rank</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($users as $index => $user)
                                    @php
                                        $isTopThree = $user->rank <= 3;
                                        $rowClasses = $user->rank == 1 ? 'bg-gradient-to-r from-yellow-50/80 to-amber-50/40 hover:from-yellow-100/80 hover:to-amber-100/60' :
                                                     ($user->rank == 2 ? 'bg-gradient-to-r from-gray-50/80 to-slate-50/40 hover:from-gray-100/80 hover:to-slate-100/60' :
                                                     ($user->rank == 3 ? 'bg-gradient-to-r from-orange-50/80 to-red-50/40 hover:from-orange-100/80 hover:to-red-100/60' :
                                                     'hover:bg-gray-50/50'));
                                        $badgeClasses = $user->rank == 1 ? 'bg-gradient-to-r from-yellow-400 to-amber-500 text-white shadow-lg' :
                                                       ($user->rank == 2 ? 'bg-gradient-to-r from-gray-400 to-slate-500 text-white shadow-lg' :
                                                       ($user->rank == 3 ? 'bg-gradient-to-r from-orange-400 to-red-500 text-white shadow-lg' :
                                                       'bg-gray-100 text-gray-700 border border-gray-200'));
                                        $textClasses = $user->rank == 1 ? 'from-yellow-600 to-amber-600' :
                                                      ($user->rank == 2 ? 'from-gray-600 to-slate-600' :
                                                      ($user->rank == 3 ? 'from-orange-600 to-red-600' :
                                                      'text-accent'));
                                        $medal = $user->rank == 1 ? 'firstplace.png' : ($user->rank == 2 ? 'secondplace.png' : ($user->rank == 3 ? 'thirdplace.png' : null));
                                    @endphp
                                    @if($index < $users->takeWhile(fn($u) => $u->rank <= 3)->count())
                                        <tr class="{{ $rowClasses }} transition-all duration-300 border-l-4 {{ $user->rank == 1 ? 'border-l-yellow-400' : ($user->rank == 2 ? 'border-l-gray-400' : 'border-l-orange-400') }}">
                                            <td class="px-8 py-6">
                                                <div class="flex items-center gap-4">
                                                    <div class="relative">
                                                        <div class="avatar">
                                                            <div class="mask mask-squircle h-14 w-14 ring-2 {{ $user->rank == 1 ? 'ring-yellow-400/50' : ($user->rank == 2 ? 'ring-gray-400/50' : 'ring-orange-400/50') }}">
                                                                <img src="https://img.daisyui.com/images/profile/demo/{{ $index + 2 }}@94.webp"
                                                                    alt="Avatar" />
                                                            </div>
                                                        </div>
                                                        @if($isTopThree)
                                                            <div class="absolute -top-1 -right-1 w-6 h-6 {{ $user->rank == 1 ? 'bg-yellow-400' : ($user->rank == 2 ? 'bg-gray-400' : 'bg-orange-400') }} rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                                {{ $user->rank }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="space-y-1">
                                                        <div class="font-bold text-lg {{ $isTopThree ? 'bg-gradient-to-r ' . $textClasses . ' bg-clip-text text-transparent' : 'text-accent' }}">
                                                            {{ $user->name }}
                                                        </div>
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                            </svg>
                                                            <span class="text-sm text-gray-600 font-medium">UCSC</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-6">
                                                <div class="flex items-center gap-4">
                                                    <div class="relative">
                                                        <span class="font-bold text-xl {{ $isTopThree ? 'bg-gradient-to-r ' . $textClasses . ' bg-clip-text text-transparent' : 'text-accent' }}">
                                                            {{ $user->badges_sum_points ?? 0 }}
                                                        </span>
                                                        @if($isTopThree)
                                                            <div class="absolute -inset-2 {{ $user->rank == 1 ? 'bg-yellow-400/10' : ($user->rank == 2 ? 'bg-gray-400/10' : 'bg-orange-400/10') }} rounded-lg -z-10"></div>
                                                        @endif
                                                    </div>
                                                    @if($medal)
                                                        <div class="avatar">
                                                            <div class="mask mask-squircle h-10 w-10">
                                                                <img src="{{ asset('storage/assets/' . $medal) }}" alt="Medal" />
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-8 py-6">
                                                <span class="inline-flex items-center justify-center px-4 py-2 rounded-xl font-bold text-sm {{ $badgeClasses }} transform hover:scale-105 transition-transform duration-200">
                                                    #{{ $user->rank }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                                <!-- Remaining Users -->
                                @foreach($users->slice($users->takeWhile(fn($u) => $u->rank <= 3)->count()) as $user)
                                    <tr class="hover:bg-gray-50/60 transition-all duration-200 group">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="avatar">
                                                    <div class="mask mask-squircle h-12 w-12 ring-2 ring-gray-200/50 group-hover:ring-primary/30 transition-all duration-200">
                                                        <img src="https://img.daisyui.com/images/profile/demo/5@94.webp"
                                                            alt="Avatar" />
                                                    </div>
                                                </div>
                                                <div class="space-y-1">
                                                    <div class="font-bold text-lg text-accent group-hover:text-primary transition-colors duration-200">
                                                        {{ $user->name }}
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                        </svg>
                                                        <span class="text-sm text-gray-600 font-medium">Brazil</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="font-semibold text-lg text-accent group-hover:text-primary transition-colors duration-200">
                                                {{ $user->badges_sum_points ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-lg font-bold text-sm bg-gray-100 text-gray-700 border border-gray-200 group-hover:bg-primary/10 group-hover:border-primary/30 group-hover:text-primary transition-all duration-200">
                                                #{{ $user->rank }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-volunteer.dashboard-layout>
