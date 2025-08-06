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
    <div class="min-h-screen bg-gray-50">
        <!-- Main Container -->
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                <!-- Hero Section -->
                <div class="relative h-64 sm:h-80 lg:h-96">
                    <img src="{{ $event->image ?? 'https://picsum.photos/seed/' . $event->id . '/1200/800' }}"
                        alt="Event Image" class="w-full h-full object-cover opacity-90">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white drop-shadow-lg">
                                {{ $event->name }}
                            </h1>
                            <div class="mt-3 px-4 py-2 bg-white/80 rounded-full text-sm font-semibold text-blue-800">
                                {{ $event->category->name }}
                            </div>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4">
                        <button
                            class="p-2 bg-white/90 rounded-full hover:bg-white transition-colors shadow-sm"
                            wire:click="toggleFavorite">
                            <i data-lucide="heart" class="w-5 h-5 {{ $event->is_favorited ? 'text-red-500 fill-current' : 'text-gray-600' }}"></i>
                        </button>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="p-6 sm:p-8 lg:p-12">
                    <!-- Back Button -->
                    <div class="mb-6">
                        <a href="/volunteer/dashboard/my-events" wire:navigate
                            class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 transition-colors group">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 group-hover:-translate-x-1 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Back to My Events
                        </a>
                    </div>

                    <!-- Event Description -->
                    <div class="mb-8 text-center">
                        <p class="text-gray-600 text-lg max-w-3xl mx-auto leading-relaxed">
                            {{ $event->description }}
                        </p>
                    </div>

                    <!-- Quick Info Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                        <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm">
                            <i data-lucide="calendar" class="w-8 h-8 text-blue-600 mx-auto mb-2"></i>
                            <div class="text-sm text-gray-500">Date</div>
                            <div class="font-semibold text-gray-800">{{ $event->starts_at->format('M j, Y') }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm">
                            <i data-lucide="clock" class="w-8 h-8 text-green-600 mx-auto mb-2"></i>
                            <div class="text-sm text-gray-500">Time</div>
                            <div class="font-semibold text-gray-800">
                                {{ $event->starts_at->format('h:i A') }} - {{ $event->ends_at->format('h:i A') }}
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm">
                            <i data-lucide="map-pin" class="w-8 h-8 text-purple-600 mx-auto mb-2"></i>
                            <div class="text-sm text-gray-500">Location</div>
                            <div class="font-semibold text-gray-800">{{ $event->location ?? 'TBD' }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm">
                            <i data-lucide="users" class="w-8 h-8 text-orange-600 mx-auto mb-2"></i>
                            <div class="text-sm text-gray-500">Volunteers</div>
                            <div class="font-semibold text-gray-800">{{ $event->volunteers_count ?? 0 }}/{{ $event->maximum_participants }}</div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mb-10 text-center">
                        @php
                            $user = $event->users->where('id', auth()->id())->first();
                            $status = $user?->pivot->status;
                        @endphp
                        @if (!$event->users->contains(auth()->user()))
                            <button class="btn btn-primary btn-lg rounded-full px-8 py-3 font-semibold shadow-lg hover:scale-105 transition"
                                wire:click="join">
                                <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                                Join This Event
                            </button>
                        @elseif ($event->ends_at < now() && $status == 'accepted')
                            <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-6 flex items-center gap-4">
                                <i data-lucide="check-circle" class="w-8 h-8 text-green-500"></i>
                                <div>
                                    <h3 class="text-lg font-bold text-green-700">Event Completed!</h3>
                                    <p class="text-green-600 text-sm">Thank you for your participation.</p>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                <a href="{{ route('volunteer.feedback') }}"
                                    class="btn btn-outline btn-lg px-6 py-3 flex items-center gap-2">
                                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                                    Leave Feedback
                                </a>
                                <a href="{{ route('community.space', ['id' => $event->id]) }}"
                                    class="btn btn-accent btn-lg px-6 py-3 flex items-center gap-2">
                                    <i data-lucide="users" class="w-5 h-5"></i>
                                    Community Space
                                </a>
                                <button class="btn btn-outline btn-lg px-6 py-3 flex items-center gap-2">
                                    <i data-lucide="share-2" class="w-5 h-5"></i>
                                    Share Event
                                </button>
                            </div>
                        @elseif ($status == 'pending')
                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-6 flex items-center gap-4">
                                <i data-lucide="clock" class="w-8 h-8 text-yellow-500"></i>
                                <div>
                                    <h3 class="text-lg font-bold text-yellow-700">Pending Approval</h3>
                                    <p class="text-yellow-600 text-sm">The organizer will review your request soon.</p>
                                </div>
                            </div>
                            <button class="btn btn-outline btn-lg px-6 py-3 flex items-center gap-2">
                                <i data-lucide="share-2" class="w-5 h-5"></i>
                                Share Event
                            </button>
                        @elseif ($status == 'accepted')
                            <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-6 flex items-center gap-4">
                                <i data-lucide="check-circle" class="w-8 h-8 text-green-500"></i>
                                <div>
                                    <h3 class="text-lg font-bold text-green-700">You're In!</h3>
                                    <p class="text-green-600 text-sm">Looking forward to your participation.</p>
                                </div>
                            </div>
                            <button class="btn btn-outline btn-lg px-6 py-3 flex items-center gap-2">
                                <i data-lucide="share-2" class="w-5 h-5"></i>
                                Share Event
                            </button>
                        @endif
                    </div>

                    <!-- Grid Layout for Content -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column: Event Details -->
                        <div class="lg:col-span-2 space-y-8">
                            <!-- About Event -->
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">About This Event</h2>
                                <div class="prose prose-gray max-w-none">
                                    <p class="text-gray-600 leading-relaxed">{{ $event->notes ?? $event->description }}</p>
                                </div>
                            </div>

                            <!-- Schedule/Agenda -->
                            @php
                                $agenda = [
                                    '9:00 AM - Welcome & Briefing',
                                    '9:30 AM - Park Clean-Up Begins',
                                    '11:00 AM - Tree Planting',
                                    '11:30 AM - Games & Refreshments',
                                    '12:00 PM - Closing Remarks',
                                ];
                            @endphp
                            @if (!empty($agenda))
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Schedule</h2>
                                    <ul class="list-disc pl-6 text-gray-600">
                                        @foreach ($agenda as $item)
                                            <li class="mb-2">{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Gallery -->
                            @php
                                $images = [
                                    'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
                                    'https://images.unsplash.com/photo-1465101046530-73398c7f28ca',
                                    'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee',
                                    'https://images.unsplash.com/photo-1464983953574-0892a716854b',
                                ];
                            @endphp
                            @if (!empty($images))
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Gallery</h2>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                        @foreach ($images as $img)
                                            <img src="{{ $img }}" class="rounded-lg shadow-sm object-cover w-full h-32"
                                                alt="Event Image">
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Map -->
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">Location</h2>
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <div class="flex items-start gap-3 mb-4">
                                        <i data-lucide="map-pin" class="w-5 h-5 text-gray-500 mt-1"></i>
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $event->location ?? 'Central Park' }}</p>
                                            <p class="text-gray-600 text-sm">Main Entrance, City Center</p>
                                        </div>
                                    </div>
                                    <div class="rounded-lg overflow-hidden h-64">
                                        <iframe
                                            src="https://www.openstreetmap.org/export/embed.html?bbox=-0.128%2C51.507%2C-0.127%2C51.508&amp;layer=mapnik"
                                            style="width:100%;height:100%;border:0;"></iframe>
                                    </div>
                                    <a href="https://maps.google.com/?q={{ urlencode($event->location ?? 'Central Park') }}"
                                        target="_blank"
                                        class="btn btn-outline btn-sm w-full mt-4 flex items-center justify-center gap-2">
                                        <i data-lucide="navigation" class="w-4 h-4"></i>
                                        Get Directions
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Community Features -->
                        <div class="space-y-8">
                            <!-- Organizer -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h2 class="text-xl font-bold text-gray-800 mb-4">Event Organizer</h2>
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-12 h-12 rounded-full bg-blue-500 text-white flex items-center justify-center text-xl font-bold">
                                        {{ substr($event->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">{{ $event->user->name }}</h3>
                                        <p class="text-gray-600 text-sm">{{ $event->user->role->name ?? 'Community Organizer' }}</p>
                                        <div class="flex items-center gap-1 mt-1">
                                            <div class="flex text-yellow-400">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                @endfor
                                            </div>
                                            <span class="text-sm text-gray-600">4.9 (87 reviews)</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">
                                    {{ $event->user->bio ?? 'Passionate about building a cleaner, greener community.' }}
                                </p>
                                <button class="btn btn-outline btn-sm w-full flex items-center justify-center gap-2">
                                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                                    Message Organizer
                                </button>
                            </div>

                            <!-- Volunteers -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h2 class="text-xl font-bold text-gray-800 mb-4">Volunteers</h2>
                                <div class="max-h-64 overflow-y-auto space-y-4">
                                    @foreach ($volunteers as $volunteer)
                                        <div class="flex items-center gap-4">
                                            <img src="https://randomuser.me/api/portraits/men/{{ $volunteer->id }}.jpg"
                                                class="w-10 h-10 rounded-full object-cover" alt="{{ $volunteer->name }}">
                                            <div>
                                                <p class="font-semibold text-gray-800">{{ $volunteer->name }}</p>
                                                <p class="text-gray-600 text-sm">{{ $volunteer->role->name ?? 'Volunteer' }}</p>
                                            </div>
                                            <button class="btn btn-outline btn-sm ml-auto flex items-center gap-1">
                                                <i data-lucide="message-circle" class="w-4 h-4"></i>
                                                Message
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h2 class="text-xl font-bold text-gray-800 mb-4">Tags</h2>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($event->tags as $tag)
                                        <span
                                            class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-2">Contact Information</h2>
                            <p class="text-gray-600">Email: {{ $event->user->email }}</p>
                            <p class="text-gray-600">Phone: {{ $event->user->contact_number ?? 'Not provided' }}</p>
                            <p class="text-gray-600">Social: <a href="#" class="text-blue-600 underline">Twitter</a></p>
                        </div>
                        {{-- <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-2">Accessibility</h2>
                            <p class="text-gray-600">Wheelchair accessible, sign language interpreters available.</p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-volunteer.dashboard-layout>