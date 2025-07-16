@php
    // Sample data for demonstration
    $volunteers = [
        ['rank' => 1, 'name' => 'Hart Hagerty', 'country' => 'United States', 'points' => 1200, 'level' => 'Gold', 'hours' => 150, 'badges' => 5, 'feedback' => 4.8, 'is_new' => true, 'progress' => 80],
        ['rank' => 2, 'name' => 'Brice Swyre', 'country' => 'China', 'points' => 1000, 'level' => 'Silver', 'hours' => 120, 'badges' => 3, 'feedback' => 4.5, 'is_new' => false, 'progress' => 60],
        ['rank' => 3, 'name' => 'Marjy Ferencz', 'country' => 'Russia', 'points' => 800, 'level' => 'Bronze', 'hours' => 90, 'badges' => 2, 'feedback' => 4.2, 'is_new' => false, 'progress' => 40],
        ['rank' => 4, 'name' => 'Yancy Tear', 'country' => 'Brazil', 'points' => 600, 'level' => 'Bronze', 'hours' => 60, 'badges' => 1, 'feedback' => 4.0, 'is_new' => true, 'progress' => 20],
    ];
@endphp

<x-volunteer.dashboard-layout>
    <div class="px-4 sm:px-6 lg:px-10 py-8">
        <!-- Heading -->
        <div class="flex flex-col items-center gap-2 mb-8">
            <h1 class="text-3xl sm:text-4xl xl:text-5xl font-bold text-primary leading-tight text-center">
                Smile Volunteer Leaderboard
            </h1>
            <p class="text-lg font-semibold text-gray-600 leading-tight text-center">
                Celebrating Our Top Volunteers!
            </p>
        </div>

        <!-- Top Volunteers Carousel (Mobile) -->
        <div class="block lg:hidden my-8">
            <div class="carousel carousel-end rounded-box flex gap-5">
                @foreach($volunteers as $index => $volunteer)
                    @if($index < 3)
                        <div class="carousel-item">
                            <div class="card bg-base-100 w-80 shadow-sm">
                                <figure class="pt-4">
                                    <img
                                        class="w-24"
                                        src="{{ asset('storage/assets/'.($index + 1).'place.png') }}"
                                        alt="Rank {{ $index + 1 }}"
                                    />
                                </figure>
                                <div class="card-body">
                                    <div class="flex justify-between items-center">
                                        <h2 class="card-title">{{ $volunteer['name'] }}</h2>
                                        <div class="avatar">
                                            <div class="w-16 rounded-full">
                                                <img src="https://img.daisyui.com/images/profile/demo/{{ $index + 2 }}@94.webp" alt="{{ $volunteer['name'] }} avatar" />
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $volunteer['country'] }}</p>
                                    <div class="flex items-center gap-2">
                                        <span class="badge badge-primary">{{ $volunteer['points'] }} Points</span>
                                        @if($volunteer['is_new'])
                                            <span class="badge badge-success">New Entry</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Filter Section -->
        <div class="flex flex-col sm:flex-row gap-3 my-10 items-center justify-center text-lg font-semibold text-gray-600">
            <span>Filter by:</span>
            <div class="flex gap-2" x-data="{ filter: 'all' }">
                <input
                    type="radio"
                    name="metaframeworks"
                    class="btn btn-sm"
                    aria-label="All time leaderboard"
                    x-model="filter"
                    value="all"
                    checked
                />
                <input
                    type="radio"
                    name="metaframeworks"
                    class="btn btn-sm"
                    aria-label="Monthly leaderboard"
                    x-model="filter"
                    value="monthly"
                />
                <input
                    type="radio"
                    name="metaframeworks"
                    class="btn btn-sm"
                    aria-label="Yearly leaderboard"
                    x-model="filter"
                    value="yearly"
                />
            </div>
        </div>

        <!-- Leaderboard Table (Desktop) -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="table w-full border-collapse">
                <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">Rank</th>
                    <th class="p-3 text-left">Volunteer</th>
                    <th class="p-3 text-left">Points</th>
{{--                    <th class="p-3 text-left">Level</th>--}}
                    <th class="p-3 text-left">Hours</th>
                    <th class="p-3 text-left">Badges</th>
                    <th class="p-3 text-left">Feedback</th>
                </tr>
                </thead>
                <tbody>
                @foreach($volunteers as $index => $volunteer)
                    <tr class="{{ $index % 2 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100 transition-colors">
                        <td class="p-3">
                            <div class="text-3xl font-thin opacity-30 tabular-nums">{{ str_pad($volunteer['rank'], 2, '0', STR_PAD_LEFT) }}</div>
                        </td>
                        <td class="p-3">
                            <a href="#" class="flex items-center gap-3 hover:underline">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-12 w-12">
                                        <img
                                            src="https://img.daisyui.com/images/profile/demo/{{ $index + 2 }}@94.webp"
                                            alt="{{ $volunteer['name'] }} avatar"
                                        />
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">{{ $volunteer['name'] }}</div>
                                    <div class="text-sm opacity-50">{{ $volunteer['country'] }}</div>
                                </div>
                            </a>
                        </td>
                        <td class="p-3">
                            <div class="flex items-center gap-2">
                                <span>{{ $volunteer['points'] }}</span>
                                <div class="w-24 bg-gray-200 rounded-full h-2">
                                    <div
                                        class="bg-green-600 h-2 rounded-full"
                                        style="width: {{ $volunteer['progress'] }}%"
                                    ></div>
                                </div>
                            </div>
                        </td>

                        <td class="p-3">{{ $volunteer['hours'] }}</td>
                        <td class="p-3">
                            <div class="flex gap-1">
                                @for($i = 0; $i < $volunteer['badges']; $i++)
                                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                @endfor
                            </div>
                        </td>
                        <td class="p-3">{{ $volunteer['feedback'] }}/5</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Leaderboard Cards (Mobile) -->
        <div class="lg:hidden flex flex-col gap-4">
            @foreach($volunteers as $index => $volunteer)
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-2xl font-thin opacity-30 tabular-nums">#{{ str_pad($volunteer['rank'], 2, '0', STR_PAD_LEFT) }}</div>
                                <a href="#" class="font-bold hover:underline">{{ $volunteer['name'] }}</a>
                                <div class="text-sm opacity-50">{{ $volunteer['country'] }}</div>
                            </div>
                            <div class="avatar">
                                <div class="mask mask-squircle h-12 w-12">
                                    <img
                                        src="https://img.daisyui.com/images/profile/demo/{{ $index + 2 }}@94.webp"
                                        alt="{{ $volunteer['name'] }} avatar"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 mt-2">
                            <div class="flex items-center gap-2">
                                <span>{{ $volunteer['points'] }} Points</span>
                                <div class="w-24 bg-gray-200 rounded-full h-2">
                                    <div
                                        class="bg-blue-600 h-2 rounded-full"
                                        style="width: {{ $volunteer['progress'] }}%"
                                    ></div>
                                </div>
                            </div>

                            <div>Hours: {{ $volunteer['hours'] }}</div>
                            <div class="flex gap-1">
                                Badges:
                                @for($i = 0; $i < $volunteer['badges']; $i++)
                                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                @endfor
                            </div>
                            <div>Feedback: {{ $volunteer['feedback'] }}/5</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('leaderboard', () => ({
                    filter: 'all',
                    init() {
                        this.$watch('filter', value => {
                            // Trigger Livewire event for filter change
                            Livewire.emit('filterChanged', value);
                        });
                    }
                }));
            });
        </script>
    @endpush
</x-volunteer.dashboard-layout>
