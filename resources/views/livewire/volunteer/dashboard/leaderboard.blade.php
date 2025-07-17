<x-volunteer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 pt-20 pb-32">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white/90 backdrop-blur-md rounded-3xl p-10 flex flex-col gap-6">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-accent/10 text-accent rounded-full text-sm font-medium mx-auto lg:mx-0">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Celebrating Our Top Smilers
                </div>

                <!-- Title -->
                <h2 class="text-4xl sm:text-5xl font-bold text-primary leading-tight text-center relative">
                    Top Smilers
                    <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-32 h-3 text-accent/30" viewBox="0 0 100 12" fill="none">
                        <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </h2>

                <!-- Responsive Flex Row: My Rank Card + Leaderboard Table -->
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <!-- My Rank Card -->
                    <div class="w-full md:w-1/3">
                        <div class="relative bg-gray-50/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 text-center transform hover:scale-105 transition-transform duration-300">
                            <div class="mt-8">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-16 w-16 mx-auto">
                                        <img src="https://img.daisyui.com/images/profile/demo/2@94.webp" alt="User Avatar" />
                                    </div>
                                </div>
                                <h3 class="mt-4 font-bold text-lg bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">You</h3>
                                <p class="text-sm text-gray-600">UCSC</p>
                                <p class="mt-2 font-semibold text-primary">{{ $currentUser->badges_sum_points ?? 'Zero' }} Points</p>
                                <span class="badge bg-primary text-white font-bold mt-2">{{ $currentUserPosition }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Leaderboard Table -->
                    <div class="w-full md:w-2/3 overflow-x-auto">
                        <table class="table w-full">
                            <!-- Head -->
                            <thead>
                            <tr class="bg-gradient-to-r from-accent/20 to-primary/20 text-primary">
                                <th class="px-4 py-3"></th>
                                <th class="px-4 py-3 text-left">Volunteer</th>
                                <th class="px-4 py-3 text-left">Points</th>
                                <th class="px-4 py-3 text-left">Rank</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $index => $user)
                                @php
                                    $rowClasses = $user->rank == 1 ? 'bg-yellow-50/50 hover:bg-yellow-100/50' : ($user->rank == 2 ? 'bg-gray-100/50 hover:bg-gray-200/50' : ($user->rank == 3 ? 'bg-orange-50/50 hover:bg-orange-100/50' : 'hover:bg-gray-50/50'));
                                    $badgeClasses = $user->rank == 1 ? 'bg-yellow-400 text-white' : ($user->rank == 2 ? 'bg-gray-400 text-white' : ($user->rank == 3 ? 'bg-orange-400 text-white' : 'badge-ghost'));
                                    $textClasses = $user->rank == 1 ? 'from-yellow-600 to-yellow-400' : ($user->rank == 2 ? 'from-gray-600 to-gray-400' : ($user->rank == 3 ? 'from-orange-600 to-orange-400' : 'text-primary'));
                                    $medal = $user->rank == 1 ? 'firstplace.png' : ($user->rank == 2 ? 'secondplace.png' : ($user->rank == 3 ? 'thirdplace.png' : null));
                                    $university = $user->rank == 1 ? 'UCSC' : ($user->rank == 2 ? 'UOC' : ($user->rank == 3 ? 'UOK' : 'Brazil'));
                                @endphp
                                @if($index < $users->takeWhile(fn($u) => $u->rank <= 3)->count())
                                    <tr class="{{ $rowClasses }} transition-colors">
                                        <th class="px-4 py-3">
                                            @if($medal)
                                                <label>
                                                    <div class="avatar">
                                                        <div class="mask mask-squircle h-12 w-12">
                                                            <img src="{{ asset('storage/assets/' . $medal) }}" alt="Place Medal" />
                                                        </div>
                                                    </div>
                                                </label>
                                            @endif
                                        </th>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="avatar">
                                                    <div class="mask mask-squircle h-12 w-12">
                                                        <img src="https://img.daisyui.com/images/profile/demo/{{ $index + 2 }}@94.webp" alt="Avatar Tailwind CSS Component" />
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-lg bg-gradient-to-r {{ $textClasses }} bg-clip-text text-transparent">{{ $user->name }}</div>
                                                    <div class="text-sm text-gray-600">{{ $university }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 font-semibold text-primary">{{ $user->badges_sum_points ?? 0 }}</td>
                                        <td class="px-4 py-3">
                                            <span class="badge {{ $badgeClasses }} font-bold">{{ $user->rank }}</span>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <!-- Remaining Users -->
                            @foreach($users->slice($users->takeWhile(fn($u) => $u->rank <= 3)->count()) as $user)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <th class="px-4 py-3"></th>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="mask mask-squircle h-12 w-12">
                                                    <img src="https://img.daisyui.com/images/profile/demo/5@94.webp" alt="Avatar Tailwind CSS Component" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold text-lg text-primary">{{ $user->name }}</div>
                                                <div class="text-sm text-gray-600">Brazil</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-primary">{{ $user->badges_sum_points ?? 0 }}</td>
                                    <td class="px-4 py-3">
                                        <span class="badge badge-ghost font-bold">{{ $user->rank }}</span>
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
