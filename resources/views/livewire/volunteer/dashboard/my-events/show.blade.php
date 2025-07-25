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
    <div class="min-h-screen bg-gradient-to-br from-white via-gray-50 to-white">

        <!-- Hero Section with Event Image and Organizer Side by Side -->
        <div class="p-6">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden flex flex-col lg:flex-row">
                <!-- Event Image (Left) -->
                <div class="relative h-72 lg:h-auto lg:w-2/5 bg-gradient-to-r from-blue-500 to-purple-600 flex-shrink-0">
                    <img src="https://picsum.photos/seed/1234/600/800" alt="Event Image"
                        class="w-full h-full object-cover">
                    <div class="absolute top-6 left-6">
                        <div class="px-4 py-2 bg-white/90 backdrop-blur-sm rounded-full text-sm font-medium"
                            style="color: #2563eb;">
                            {{ $event->category->name }}
                        </div>
                    </div>
                    <div class="absolute top-6 right-6">
                        <button class="p-3 bg-white/90 backdrop-blur-sm rounded-full hover:bg-white transition-colors">
                            <i data-lucide="heart" class="w-5 h-5 text-gray-600"></i>
                        </button>
                    </div>
                </div>

                <!-- Main Content (Right) -->
                <div class="flex-1 p-8 flex flex-col justify-between">
                    <!-- Back Button -->
                    <div class="mb-4">
                        <a href="/volunteer/dashboard/my-events" wire:navigate
                            class="inline-flex items-center gap-2 text-gray-600 hover:text-accent transition-colors group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 group-hover:-translate-x-1 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Back to My Events
                        </a>
                    </div>

                    <!-- Header -->
                    <div class="mb-6">
                        <h1 class="text-4xl font-bold text-accent mb-3">
                            {{ $event->name }}
                        </h1>
                        <p class="text-gray-600 text-lg leading-relaxed">{{ $event->description }}</p>
                    </div>

                    <!-- Quick Info Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <div
                                class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="calendar" class="w-6 h-6 text-blue-600"></i>
                            </div>
                            <div class="text-sm text-gray-500">Date</div>
                            <div class="font-semibold text-gray-700">{{ $event->starts_at->format('F j, Y') }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <div
                                class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="clock" class="w-6 h-6 text-green-600"></i>
                            </div>
                            <div class="text-sm text-gray-500">Duration</div>
                            <div class="font-semibold text-gray-700">
                                {{ $event->starts_at->diffForHumans($event->ends_at) }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <div
                                class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="map-pin" class="w-6 h-6 text-purple-600"></i>
                            </div>
                            <div class="text-sm text-gray-500">Location</div>
                            <div class="font-semibold text-gray-700">Central Park</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <div
                                class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <i data-lucide="users" class="w-6 h-6 text-orange-600"></i>
                            </div>
                            <div class="text-sm text-gray-500">Volunteers</div>
                            <div class="font-semibold text-gray-700">20/{{ $event->maximum_participants }}</div>
                        </div>
                    </div>

                    <!-- Main Content Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column - Event Details -->
                        <div class="lg:col-span-3 space-y-8">
                            <!-- About Event -->
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">About This Event</h2>
                                <div class="prose prose-gray max-w-none">
                                    <p class="text-gray-600 leading-relaxed mb-4">
                                        {{ $event->notes }}
                                    </p>
                                </div>
                            </div>

                            <!-- Skills & Tags -->
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">Tags</h2>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($event->tags as $tag)
                                        <span
                                            class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Location Card -->
                            <div class="bg-white border border-gray-100 rounded-xl p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Location</h3>
                                <div class="space-y-3">
                                    <div class="flex items-start gap-3">
                                        <i data-lucide="map-pin" class="w-5 h-5 text-gray-400 mt-0.5"></i>
                                        <div>
                                            <p class="font-medium text-gray-800">Central Park</p>
                                            <p class="text-gray-600 text-sm">Main Entrance, City Center</p>
                                        </div>
                                    </div>
                                    <div class="bg-gray-100 rounded-lg h-32 flex items-center justify-center">
                                        <span class="text-gray-500 text-sm">Interactive Map</span>
                                    </div>
                                    <button class="w-full btn btn-outline btn-sm">
                                        <i data-lucide="navigation" class="w-4 h-4 mr-2"></i>
                                        Get Directions
                                    </button>
                                </div>
                            </div>
                            <div class="space-y-6">
                                <!-- Organizer Card -->
                                <div
                                    class="bg-gradient-to-br from-gray-50 to-white border border-gray-100 rounded-xl p-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-4">Event Organizer</h3>
                                    <div class="flex items-center gap-4 mb-4">
                                        <div
                                            class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white text-xl font-bold">
                                            J
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">{{ $event->user->name }}</h4>
                                            <p class="text-gray-600 text-sm">Community Organizer</p>
                                            <div class="flex items-center gap-1 mt-1">
                                                <div class="flex text-yellow-400">
                                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                </div>
                                                <span class="text-sm text-gray-600 ml-1">4.9 (87 reviews)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">
                                        Passionate about building a cleaner, greener community. Organized 20+ local
                                        events and mobilized hundreds of volunteers.
                                    </p>
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <i data-lucide="calendar" class="w-4 h-4"></i>
                                            <span>20 events organized</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <i data-lucide="users" class="w-4 h-4"></i>
                                            <span>500+ volunteers reached</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="space-y-3">
                                    @php
                                        $user = $event->users->where('id', auth()->id())->first();
                                        $status = $user?->pivot->status;
                                    @endphp
                                    @if (!$event->users->contains(auth()->user()))
                                        <button class="w-full btn btn-primary btn-lg" wire:click="join">
                                            <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                                            Join This Event
                                        </button>
                                    @endif

                                    {{-- Completed Event Section --}}
                                    @if ($event->ends_at < now() && $status == 'accepted')
                                        <div
                                            class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center gap-4 mb-4">
                                            <i data-lucide="check-circle" class="w-8 h-8 text-green-500"></i>
                                            <div>
                                                <h3 class="text-lg font-bold text-green-700 mb-1">You have completed
                                                    this event!</h3>
                                                <p class="text-green-600 text-sm">Thank you for your participation and
                                                    contribution.</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-3">
                                            <button class="w-full md:w-auto btn btn-outline flex-1">
                                                <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
                                                <a href="{{ route('volunteer.feedback') }}">Feedback</a>
                                            </button>
                                            <button
                                                class="w-full md:w-auto btn btn-accent flex-1 inline-flex items-center justify-center gap-2 font-semibold shadow hover:bg-primary transition-colors duration-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                                <a href="{{ route('community.space', ['id' => $event->id]) }}"
                                                    class="text-white">Go to
                                                    Community Space</a>
                                            </button>
                                            <button class="w-full md:w-auto btn btn-outline flex-1">
                                                <i data-lucide="share-2" class="w-5 h-5 mr-2"></i>
                                                Share Event
                                            </button>
                                        </div>
                                    @elseif($status == 'pending')
                                        <div
                                            class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 flex items-center gap-4 mb-4">
                                            <i data-lucide="clock" class="w-8 h-8 text-yellow-500"></i>
                                            <div>
                                                <h3 class="text-lg font-bold text-yellow-700 mb-1">Your participation
                                                    is pending approval</h3>
                                                <p class="text-yellow-600 text-sm">The organizer will review your
                                                    request soon.</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-3">
                                            <button class="w-full md:w-auto btn btn-outline flex-1">
                                                <i data-lucide="share-2" class="w-5 h-5 mr-2"></i>
                                                Share Event
                                            </button>
                                        </div>
                                    @elseif($status == 'accepted')
                                        <div
                                            class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center gap-4 mb-4">
                                            <i data-lucide="check-circle" class="w-8 h-8 text-green-500"></i>
                                            <div>
                                                <h3 class="text-lg font-bold text-green-700 mb-1">You have been
                                                    accepted to this event!</h3>
                                                <p class="text-green-600 text-sm">Looking forward to your participation
                                                    and contribution.</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row gap-3">
                                            <button
                                                class="w-full md:w-auto btn btn-accent flex-1 inline-flex items-center justify-center gap-2 font-semibold shadow hover:bg-primary transition-colors duration-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                                <a href="{{ route('community.space', ['id' => $event->id]) }}"
                                                    class="text-white">Go to
                                                    Community Space</a>
                                            </button>
                                            <button class="w-full md:w-auto btn btn-outline flex-1">
                                                <i data-lucide="share-2" class="w-5 h-5 mr-2"></i>
                                                Share Event
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</x-volunteer.dashboard-layout>
