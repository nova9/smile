<x-volunteer.dashboard-layout>
    <div class="min-h-screen">
        <div class="container mx-auto px-4 py-10">
            @php
                $agenda = (object) [
                    'agenda' => [
                        '9:00 AM - Welcome & Briefing',
                        '9:30 AM - Park Clean-Up Begins',
                        '11:00 AM - Tree Planting',
                        '11:30 AM - Games & Refreshments',
                        '12:00 PM - Closing Remarks',
                    ],
                ];
                $images = (object) [
                    'images' => [
                        'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
                        'https://images.unsplash.com/photo-1465101046530-73398c7f28ca',
                        'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee',
                        'https://images.unsplash.com/photo-1464983953574-0892a716854b',
                    ],
                ];
                $map = (object) [
                    'map_embed' =>
                        '<iframe src="https://www.openstreetmap.org/export/embed.html?bbox=-0.128%2C51.507%2C-0.127%2C51.508&amp;layer=mapnik" style="width:100%;height:300px;border:0;"></iframe>',
                ];
            @endphp
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <!-- Hero/Event Header -->
                <div class="relative h-72 sm:h-96">
                    <img src="https://picsum.photos/seed/{{ $event->id }}/1200/800" alt="Event Image"
                        class="w-full h-full object-cover opacity-80">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <h1 class="text-4xl sm:text-5xl font-bold text-white drop-shadow-xl">{{ $event->name }}</h1>
                            <div
                                class="mt-3 px-5 py-2 bg-white/80 rounded-full text-base font-semibold text-amber-800 inline-block shadow">
                                {{ $event->category->name }}</div>
                        </div>
                    </div>
                </div>
                <!-- Main Content -->
                <div class="p-8 sm:p-12">
                    <!-- Event Overview -->
                    <div class="mb-10">
                        <p class="text-gray-700 text-xl text-center max-w-3xl mx-auto leading-relaxed">
                            {{ $event->description }}</p>
                    </div>
                    <!-- Quick Info Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                        <div class="bg-gray-50 rounded-xl p-5 text-center shadow">
                            <i data-lucide="calendar" class="w-8 h-8 text-amber-600 mx-auto mb-2"></i>
                            <div class="text-sm text-gray-500">Date</div>
                            <div class="font-bold text-gray-800 text-lg">{{ $event->starts_at->format('M j Y') }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5 text-center shadow">
                            <i data-lucide="clock" class="w-8 h-8 text-amber-600 mx-auto mb-2"></i>
                            <div class="text-sm text-gray-500">Duration</div>
                            <div class="font-bold text-gray-800 text-lg">{{ $event->starts_at->format(' h:i A') }}
                                - {{ $event->ends_at->format('h:i A ') }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5 text-center shadow">
                            <i data-lucide="map-pin" class="w-8 h-8 text-amber-600 mx-auto mb-2"></i>
                            <div class="text-sm text-gray-500">Location</div>
                            <div class="font-bold text-gray-800 text-lg">{{ $event->location ?? 'TBD' }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5 text-center shadow">
                            <i data-lucide="users" class="w-8 h-8 text-amber-600 mx-auto mb-2"></i>
                            <div class="text-sm text-gray-500">Spots</div>
                            <div class="font-bold text-gray-800 text-lg">{{ $event->audience ?? 'Open to all' }}</div>
                        </div>

                    </div>
                    <!-- Call to Action -->
                    <div class="mb-10 text-center">
                        <a href="#"
                            class="btn btn-primary btn-lg rounded-full shadow-lg px-10 py-4 text-xl font-bold transition hover:scale-105">
                            Join The Community
                        </a>

                    </div>
                    <!-- Schedule/Agenda -->
                    @if (!empty($agenda->agenda))
                        <div class="mb-10">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">Schedule / Agenda</h2>
                            <ul class="list-disc pl-6 text-lg text-gray-700">
                                @foreach ($agenda->agenda as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Speakers/Organizers -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Speakers & Organizers</h2>
                        <div class="flex flex-wrap gap-6">
                            <div class="bg-white rounded-xl shadow p-4 flex items-center gap-4">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg"
                                    class="w-16 h-16 rounded-full object-cover" alt="organizer">
                                <div>
                                    <div class="font-bold text-lg text-gray-800">{{ $event->user->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $event->user->role->name }}</div>
                                    @if ($event->user->bio)
                                        <div class="text-xs text-gray-500 mt-1">{{ $event->user->bio }}</div>
                                    @endif
                                </div>
                                <button class="btn btn-outline btn-sm ml-auto flex items-center gap-1">
                                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                                    Message
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Associated Volunteers (Vertical Card) -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Volunteers</h2>
                       
                        <div class="bg-white rounded-xl shadow p-6 max-h-[600px] overflow-y-auto">
                            <ul class="divide-y divide-gray-100">
                                @foreach ($volunteers as $volunteer)
                                    <li class="py-4 flex items-center gap-4">
                                        <img  class="w-14 h-14 rounded-full object-cover" src='https://randomuser.me/api/portraits/men/' .{{$volunteer->id}}.'.jpg'
                                            alt="{{ $volunteer->name }}">
                                        <div class="flex-1">
                                            <div class="font-bold text-lg text-gray-800">{{ $volunteer->name }}</div>
                                            <div class="text-sm text-gray-600">{{ $volunteer->role->name }}</div>
                                        </div>
                                        <button class="btn btn-outline btn-sm ml-auto flex items-center gap-1">
                                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                                            Message
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    </script>
                </div>
                <!-- Visuals -->
                @if (!empty($images->images))
                    <div class="mb-10 p-10">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Gallery</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach ($images->images as $img)
                                <img src="{{ $img }}" class="rounded-xl shadow object-cover w-full h-40" />
                            @endforeach
                        </div>
                    </div>
                @endif
                <!-- Contact & Accessibility -->
                <div class="mb-10 grid grid-cols-1 md:grid-cols-2 gap-8 p-10">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Contact Information</h2>
                        <div class="text-gray-700 text-lg">Email: {{ $event->user->email }}
                        </div>
                        <div class="text-gray-700 text-lg">Phone: {{ $event->user->contact_number ?? '-' }}</div>
                        <div class="text-gray-700 text-lg">Social: <a href="#"
                                class="text-primary underline">https://twitter.com/cleanupday</a></div>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Accessibility</h2>
                        <div class="text-gray-700 text-lg">
                            Wheelchair accessible, sign language interpreters available</div>
                    </div>
                </div>
                <!-- Social Media & Terms -->
                <div class="mb-10 grid grid-cols-1 md:grid-cols-2 gap-8 p-10">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Social Media & Hashtags</h2>
                        <div class="text-gray-700 text-lg">
                            @if (!empty($event->tags))
                                @foreach ($event->tags as $tag)
                                    <span
                                        class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-base font-medium mr-2">#{{ $tag->name }}</span>
                                @endforeach
                            @else
                                <span class="text-gray-500">No tags yet.</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Terms & Conditions</h2>
                        <div class="text-gray-700 text-lg">Please wear closed-toe shoes. All participants must sign
                            a waiver
                        </div>
                    </div>
                </div>
                <!-- Map/Directions -->
                @if (!empty($map->map_embed))
                    <div class="mb-10 p-10">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Map & Directions</h2>
                        <div class="rounded-xl overflow-hidden shadow">
                            {!! $map->map_embed !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
        {{-- @endisset removed: not needed when using inline $event --}}
    </div>
    </div>
</x-volunteer.dashboard-layout>
