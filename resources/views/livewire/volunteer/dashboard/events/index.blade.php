@php
    function hexToRgba($hex, $opacity = 0.2)
    {
        $hex = str_replace('#', '', $hex);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return "rgba($r, $g, $b, $opacity)";
    }
@endphp

<x-volunteer.dashboard-layout>
    <div class="min-h-screen bg-gradient-to-br from-white via-gray-50 to-white p-4">

        <!-- Search and Filter Section -->
        <div class="flex flex-col lg:flex-row gap-4 mb-4">
            <!-- Search Bar -->
            <label class="input flex-grow-1">
                <i data-lucide="search" class="opacity-50"></i>
                <input type="search" class="grow" placeholder="Search events..."
                       wire:model.live.debounce.300ms="search"/>
            </label>
        </div>

        <!-- Opportunities Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2">
            <!-- Opportunity Card 1 - Environment -->
            @forelse($events as $item)
                <div
                    class="flex flex-col bg-white rounded-xl shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 transform overflow-hidden">
                    {{--                    <img src="https://picsum.photos/seed/{{$item->id}}/350/200" alt="image" class="w-full">--}}
                    <div class="p-6 flex flex-col grow">
                        <div class="flex justify-between items-center mb-2 flex-wrap">
                            <div class="px-3 py-1 bg-green-100 rounded-full text-sm font-medium"
                                 style="color: {{ $item->category->color }}; background-color: {{ hexToRgba($item->category->color, 0.1) }}">
                                {{ $item->category->name }}
                            </div>
                            <div class="text-sm text-gray-500">{{ $item->created_at->diffForHumans() }}</div>
                        </div>
                        <h2 class="text-xl font-bold text-accent mb-2">{{ $item->name }}</h2>
                        <p class="text-gray-600 text-sm mb-3 leading-relaxed line-clamp-2">{{ $item->description }}</p>

                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($item->tags as $tag)
                                <div
                                    class="px-2 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs">{{ $tag->name }}</div>

                            @endforeach
                        </div>

                        <div class="flex-1">
                            {{-- spacer --}}
                        </div>

                        <!-- Event Creator -->
                        <div class="flex items-center gap-2 mb-3 py-2 px-3 bg-gray-50 rounded-lg">
                            @if($item->user->getCustomAttribute('profile_picture'))
                                <img
                                    class="size-8 rounded-full object-cover"
                                    src="{{ \App\Services\FileManager::getTemporaryUrl($item->user->getCustomAttribute('profile_picture')) }}"
                                    alt="organizer profile picture"
                                >
                            @else
                                <div
                                    class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white text-sm font-semibold">
                                    {{ substr($item->user->name ?? 'Unknown', 0, 1) }}
                                </div>
                            @endif


                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-700">{{ $item->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $item->user->email }}</div>
                            </div>
                            <div class="flex items-center gap-1 text-yellow-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                     viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">4.8</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $item->city }}
                            </div>
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{$item->starts_at->diffForHumans($item->ends_at, true)}}
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="text-sm">
                                <span class="text-accent">
                                    <span class="font-semibold ">{{ $item->starts_at->format('F j') }}</span> to <span
                                        class="font-semibold ">{{ $item->ends_at->format('F j') }}</span>
                                </span>
                                {{-- <span class="text-gray-500"> • 8:00 AM</span>--}}
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <a href="/volunteer/dashboard/events/{{ $item->id }}" wire:navigate class="w-full">
                                <button class="flex-1 btn btn-primary w-full">
                                    Show more
                                </button>
                            </a>
                            <button class="p-2 bg-white/90 rounded-full hover:bg-white transition-colors shadow-sm"
                                    wire:click="toggleFavorite({{ $item->id }})">
                                <i data-lucide="heart"
                                   class="w-5 h-5 {{ $item->isFavourite() ? 'text-red-500 fill-current' : 'text-gray-600'}}"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 text-center p-6 bg-white rounded-xl shadow-md border border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">No Opportunities Found</h2>
                    <p class="text-gray-500">Try adjusting your search or adding <b>Interests</b> to to your profile</p>
                    <a class="btn btn-primary mt-4" href="/volunteer/dashboard/profile" wire:navigate>
                        Profile
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $events->links() }}
        </div>

    </div>
</x-volunteer.dashboard-layout>
