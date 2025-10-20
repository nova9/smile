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
    <div class="bg-gray-50">

        <div class="p-4">
            <div class="tabs tabs-lift">
                <label class="tab">
                    <input type="radio" name="my_tabs_4" checked="checked"/>
                    <i data-lucide="info" class="w-4 h-4 mr-2"></i>
                    Event Details
                </label>
                <div class="tab-content bg-base-100 border-base-300 p-6">
                    <!-- Hero Section -->
                    <div
                        class="flex justify-between bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 mb-8 border border-gray-100 shadow-sm">
                        <div>
                            <div class="flex items-center gap-4">
                                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight max-w-4xl">
                                    {{ $event->name }}
                                </h1>
                                <div
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium border border-gray-200">
                                    {{ $event->category->name }}
                                </div>
                            </div>
                            <div>
                                <p class="text-gray-600 text-lg mx-auto leading-relaxed">
                                    {{ $event->description }}
                                </p>
                            </div>
                        </div>

                        <div class="mb-10 text-center">
                            <div class="flex flex-col sm:flex-row items-center gap-3 justify-center">
                                <button class="p-2 bg-white/90 rounded-full hover:bg-white transition-colors shadow-sm"
                                        wire:click="toggleFavorite">
                                    <i data-lucide="heart"
                                       class="w-5 h-5 {{ $is_favorited ? 'text-red-500 fill-current' : 'text-gray-600' }}"></i>
                                </button>
                                <button id="share-event-btn" type="button"
                                        class="inline-flex items-center gap-3 px-5 py-3 rounded-full border border-gray-200 bg-white hover:shadow-md transition-shadow duration-200 text-sm font-medium text-gray-700">
                                    <i data-lucide="share-2" class="w-5 h-5"></i>
                                    <span>Share</span>
                                </button>
                                <!-- Tiny toast for copy review -->
                                <div id="share-toast"
                                     class="fixed bottom-6 right-6 bg-gray-900 text-white px-4 py-2 rounded-lg shadow-lg opacity-0 pointer-events-none transition-opacity duration-300">
                                    Link copied to clipboard
                                </div>
                                <a href="{{ route('community.space', ['id' => $event->id]) }}"
                                   class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold transition-colors duration-200 text-sm">
                                    <i data-lucide="users" class="w-5 h-5"></i>
                                    <span>Community Space</span>
                                </a>
                                @if ($status == 'pending' || $status == 'accepted')
                                    <button onclick="leaveEvent.showModal()"
                                            class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-red-600 hover:bg-red-700 text-white font-semibold transition-colors duration-200 text-sm">
                                        <i data-lucide="log-out" class="w-5 h-5"></i>
                                        <span>Leave Event</span>
                                    </button>

                                    <dialog id="leaveEvent" class="modal">
                                        <div class="modal-box text-left">
                                            <form method="dialog">
                                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                                                    ✕
                                                </button>
                                            </form>
                                            <h3 class="text-lg font-bold">Are you sure?</h3>
                                            <p class="text-sm text-base-content/60 mt-2">Do you wish to leave this
                                                event?
                                            </p>
                                            <p class="py-4">
                                                You will not receive any points if you <span
                                                    class="text-error">leave</span>
                                                this even early.
                                            </p>

                                            <button class="btn btn-error" wire:click="leaveEvent"
                                                    title="Delete task list">
                                                Leave
                                            </button>
                                        </div>
                                    </dialog>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Event Description -->
                    <div class="flex flex-col">
                        @php
                            $user = $event->users->where('id', auth()->id())->first();
                            $status = $user?->pivot->status;
                        @endphp
                        <div>
                            @if ($status == 'completed')
                                <div
                                    class="bg-green-50 border border-green-200 rounded-xl p-6 mb-6 flex items-center gap-4">
                                    <i data-lucide="check-circle" class="w-8 h-8 text-green-500"></i>
                                    <div>
                                        <h3 class="text-lg font-bold text-green-700">Event Completed!</h3>
                                        <p class="text-green-600 text-sm">Thank you for your participation.</p>
                                    </div>
                                </div>
                            @elseif ($status == 'pending')
                                <div
                                    class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-6 flex items-center  gap-4">
                                    <i data-lucide="clock" class="w-8 h-8 text-yellow-500"></i>
                                    <div>
                                        <h3 class="text-lg text-left font-bold text-yellow-700">Pending
                                            Approval
                                        </h3>
                                        <p class="text-yellow-600 text-sm">The organizer will review your
                                            request
                                            soon.</p>
                                    </div>
                                </div>
                            @elseif ($status == 'accepted')
                                <div
                                    class="bg-green-50 border border-green-200 rounded-xl p-6 mb-6 flex text-left gap-4">
                                    <i data-lucide="check-circle" class="w-8 h-8 text-green-500"></i>
                                    <div>
                                        <h3 class="text-lg font-bold text-green-700">You're In!</h3>
                                        <p class="text-green-600 text-sm">Looking forward to your
                                            participation.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>


                    <!-- Quick Info Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        <div class="bg-gray-50 rounded-lg p-3 text-center shadow-sm">
                            <i data-lucide="calendar" class="w-5 h-5 text-blue-600 mx-auto mb-1"></i>
                            <div class="text-xs text-gray-500">Date</div>
                            <div class="font-medium text-gray-800 text-sm">{{ $event->starts_at->format('M j, Y') }}
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3 text-center shadow-sm">
                            <i data-lucide="clock" class="w-5 h-5 text-green-600 mx-auto mb-1"></i>
                            <div class="text-xs text-gray-500">Time</div>
                            <div class="font-medium text-gray-800 text-sm">
                                {{ $event->starts_at->format('h:i A') }} -
                                {{ $event->ends_at->format('h:i A') }}
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3 text-center shadow-sm">
                            <i data-lucide="map-pin" class="w-5 h-5 text-purple-600 mx-auto mb-1"></i>
                            <div class="text-xs text-gray-500">Location</div>
                            <div class="font-medium text-gray-800 text-sm">{{ $city }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3 text-center shadow-sm">
                            <i data-lucide="users" class="w-5 h-5 text-orange-600 mx-auto mb-1"></i>
                            <div class="text-xs text-gray-500">Volunteers</div>
                            <div class="font-medium text-gray-800 text-sm">
                                {{ count($event->users) ?? 0 }}/{{ $event->maximum_participants }}
                            </div>
                        </div>
                    </div>

                    <div class="my-4">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Eligibility & Selection Criteria
                        </h2>

                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 space-y-4">
                            <!-- Recruiting Method -->
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="user-check" class="w-4 h-4 text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Selection Method</h3>
                                    @php
                                        $recruitingMethodLabels = [
                                            'first_come' => 'First Come, First Served',
                                            'application_review' => 'Application Review',
                                            'skill_assessment' => 'Skill-Based Assessment',
                                            'metrics' => 'Based on Metrics (Rank)',
                                        ];
                                        $recruitingMethodLabel =
                                            $recruitingMethodLabels[$event->recruiting_method] ??
                                            ($event->recruiting_method ?? 'Not specified');
                                    @endphp
                                    <p class="text-gray-600 text-sm">{{ $recruitingMethodLabel }}</p>
                                </div>
                            </div>

                            <!-- Participant Requirements -->
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="users" class="w-4 h-4 text-green-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-2">Participant Requirements
                                    </h3>

                                    @if (!empty($event->participant_requirements))
                                        <div class="space-y-3">
                                            @foreach ($event->participant_requirements as $req)
                                                @if (isset($req['filter_types']) && $req['filter_types'] === 'gender')
                                                    <div class="bg-white border border-gray-200 rounded-md p-3">
                                                        <div class="text-sm font-medium text-gray-700 mb-2">Gender
                                                            Distribution
                                                        </div>
                                                        <div class="grid grid-cols-3 gap-2 text-center text-xs">
                                                            <div class="bg-gray-50 rounded p-2">
                                                                <div class="font-bold text-gray-800">
                                                                    {{ $req['male_participants'] ?? 0 }}</div>
                                                                <div class="text-gray-600">Men</div>
                                                            </div>
                                                            <div class="bg-gray-50 rounded p-2">
                                                                <div class="font-bold text-gray-800">
                                                                    {{ $req['female_participants'] ?? 0 }}</div>
                                                                <div class="text-gray-600">Women</div>
                                                            </div>
                                                            <div class="bg-gray-50 rounded p-2">
                                                                <div class="font-bold text-gray-800">
                                                                    {{ $req['non_binary_participants'] ?? 0 }}</div>
                                                                <div class="text-gray-600">Non-Binary</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif (isset($req['filter_types']) && $req['filter_types'] === 'level')
                                                    <div class="bg-white border border-gray-200 rounded-md p-3">
                                                        <div class="text-sm font-medium text-gray-700 mb-2">Experience
                                                            Level
                                                        </div>
                                                        <div class="grid grid-cols-3 gap-2 text-center text-xs">
                                                            <div class="bg-gray-50 rounded p-2">
                                                                <div class="font-bold text-gray-800">
                                                                    {{ $req['beginner_participants'] ?? 0 }}</div>
                                                                <div class="text-gray-600">Beginner</div>
                                                            </div>
                                                            <div class="bg-gray-50 rounded p-2">
                                                                <div class="font-bold text-gray-800">
                                                                    {{ $req['intermediate_participants'] ?? 0 }}</div>
                                                                <div class="text-gray-600">Intermediate</div>
                                                            </div>
                                                            <div class="bg-gray-50 rounded p-2">
                                                                <div class="font-bold text-gray-800">
                                                                    {{ $req['advanced_participants'] ?? 0 }}</div>
                                                                <div class="text-gray-600">Advanced</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="bg-white border border-gray-200 rounded-md p-2">
                                                                    <span
                                                                        class="text-sm text-gray-700">{{ is_string($req) ? $req : 'Custom requirement' }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-sm text-gray-600">No specific requirements - Everyone
                                            is welcome!
                                        </div>
                                    @endif

                                    <!-- Minimum Age -->
                                    @if (isset($event->minimum_age))
                                        <div class="mt-3 bg-white border border-gray-200 rounded-md p-2">
                                            <div class="flex items-center gap-2">
                                                <i data-lucide="calendar" class="w-4 h-4 text-gray-600"></i>
                                                <span class="text-sm text-gray-700">Minimum Age: <span
                                                        class="font-semibold">{{ $event->minimum_age }}
                                                                    years</span></span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grid Layout for Content -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column: Event Details -->
                        <div class="lg:col-span-2 space-y-8">
                            <!-- About Event -->
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">Additional Notes</h2>
                                <div class="prose prose-gray max-w-none">
                                    <p class="text-gray-600 leading-relaxed">{{ $event->notes }}</p>
                                </div>
                            </div>

                            <!-- Map -->
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">Location</h2>
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <div class="flex items-start gap-3 mb-4">
                                        <i data-lucide="map-pin" class="w-5 h-5 text-gray-500 mt-1"></i>
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $city }}</p>
                                        </div>
                                    </div>
                                    <div
                                        class="bg-gray-100 rounded-lg h-64 flex items-center justify-center overflow-hidden mb-1">
                                        <iframe width="100%" height="100%" frameborder="0"
                                                style="border:0; min-height: 120px; border-radius: 0.5rem;"
                                                src="https://www.google.com/maps?q={{ $event->latitude }},{{ $event->longitude }}&hl=en&z=15&output=embed"
                                                allowfullscreen>
                                        </iframe>
                                    </div>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $event->latitude }},{{ $event->longitude }}"
                                       target="_blank"
                                       class="w-full btn btn-outline btn-sm flex items-center justify-center">
                                        <i data-lucide="navigation" class="w-4 h-4 mr-2"></i>
                                        Open in Google Maps
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
                                    <div
                                        class="w-12 h-12 rounded-full bg-blue-500 text-white flex items-center justify-center text-xl font-bold">
                                        {{ substr($event->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">{{ $event->user->name }}</h3>
                                        <p class="text-gray-600 text-sm">
                                            {{ $event->user->role->name ?? 'Community Organizer' }}
                                        </p>
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

                            <!-- Additional Info -->
                            <div class="mt-10">
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <h2 class="text-xl font-bold mb-4 flex text-left gap-2">
                                        <i data-lucide="phone" class="w-6 h-6"></i>
                                        Contact Information
                                    </h2>
                                    <div class="space-y-3">
                                        <div class="flex items-center gap-3">
                                            <i data-lucide="mail" class="w-5 h-5 text-gray-500"></i>
                                            <span class="text-gray-700 font-medium">Email:</span>
                                            <span class="text-gray-600">{{ $event->user->email }}</span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <i data-lucide="smartphone" class="w-5 h-5 text-gray-500"></i>
                                            <span class="text-gray-700 font-medium">Phone:</span>
                                            <span
                                                class="text-gray-600">{{ $event->user->contact_number ?? 'Not provided' }}</span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <i data-lucide="twitter" class="w-5 h-5 text-blue-400"></i>
                                            <span class="text-gray-700 font-medium">Social:</span>
                                            <a href="#" class="text-blue-600 hover:underline font-medium">Twitter</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($status == 'accepted')
                    <label class="tab">
                        <input type="radio" name="my_tabs_4"/>
                        <i data-lucide="book-check" class="w-4 h-4 mr-2"></i>
                        Workflows
                    </label>

                    <div class="tab-content bg-gray-100 border-base-300 p-6">
                        <livewire:common.workflow :eventId="$event->id"/>
                    </div>
                @endif

                {{-- Event Gallery--}}
                <label class="tab">
                    <input type="radio" name="my_tabs_4"/>
                    <i data-lucide="image" class="w-4 h-4 mr-2"></i>
                    Event Gallery
                </label>
                <div class="tab-content bg-base-100 border-base-300 p-6">

                    @if ($status == 'accepted')
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">Upload Your Memories with This
                                Event
                            </h2>
                            <p class="text-gray-600 text-lg mx-auto leading-relaxed">
                                Share your photos and videos from the event to inspire others and showcase the
                                impact of our community efforts. Your contributions help build a vibrant and
                                engaged
                                volunteer community.
                            </p>
                        </div>
                        <div class="mb-6">
                            <form wire:submit="save" class="flex flex-col sm:flex-row items-center gap-4">
                                <label
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg cursor-pointer text-sm text-gray-700 hover:bg-gray-50">
                                    <i data-lucide="upload" class="w-4 h-4"></i>
                                    <span>Choose photos</span>
                                    <input type="file" wire:model="photos" multiple accept="image/*" class="hidden">
                                </label>

                                <div class="ml-auto flex items-center gap-3">


                                    <button type="submit"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium shadow">
                                        <i data-lucide="save" class="w-4 h-4"></i>
                                        Save photos
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="mb-8">
                            {{-- <h2 class="text-2xl font-bold text-gray-800 mb-4">Event Gallery</h2> --}}
                            <p class="text-gray-600 text-lg mx-auto leading-relaxed">
                                Browse photos and videos from the event to see the impact of our community
                                efforts.
                                Join us in future events to contribute your own memories and help build a
                                vibrant
                                and engaged volunteer community.
                            </p>
                        </div>
                    @endif


                    @php
                        $images = [
                            'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80',
                            'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80',
                            'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=600&q=80',
                            'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80',
                        ];
                    @endphp
                    <div class="container mx-auto px-4 py-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($images as $img)
                                <div class="group relative overflow-hidden rounded-lg shadow-lg">
                                    <img src="{{ $img }}" alt="Gallery Image"
                                         class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Reviews --}}
                <label class="tab">
                    <input type="radio" name="my_tabs_4"/>
                    <i data-lucide="star" class="w-4 h-4 mr-2"></i>
                    Reviews
                </label>
                <div class="tab-content bg-base-100 border-base-300 p-6">
                    {{-- Reviews section for this event --}}
                    <div class="container mx-auto px-4 py-8 flex-2">
                        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">Reviews</h3>
                                    @php
                                        $eventReviews = $event->reviews ?? collect();
                                        $reviewCount = is_countable($eventReviews)
                                            ? count($eventReviews)
                                            : $eventReviews->count() ?? 0;
                                        $avgRating = $reviewCount
                                            ? round(collect($eventReviews)->avg(fn($r) => $r->rating ?? 0), 1)
                                            : null;
                                    @endphp
                                    <div class="text-sm text-gray-500">{{ $reviewCount }}
                                        review{{ $reviewCount !== 1 ? 's' : '' }}{{ $avgRating ? ' • ' . $avgRating . '/5' : '' }}
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    {{-- @if ($reviewbutton) --}}
                                    <!-- Event-level review modal (unique per event) -->
                                    <button onclick="my_modal_4.showModal()"
                                            class="btn inline-flex items-center gap-3 px-6 py-3 rounded-full border border-gray-200 bg-white hover:shadow-md transition-shadow duration-200 text-sm font-medium text-gray-700"
                                            for="event_review_modal_{{ $event->id }}">
                                        <i data-lucide="message-circle" class="w-5 h-5 text-emerald-600"></i>
                                        <span>Review</span>
                                    </button>
                                    <dialog id="my_modal_4" class="modal">
                                        <div
                                            class="modal-box w-full max-w-lg p-8 bg-white rounded-2xl shadow-xl relative">
                                            <button onclick="my_modal_4.close()" type="button"
                                                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 focus:outline-none">
                                                <i data-lucide="x" class="w-6 h-6"></i>
                                            </button>
                                            <h2 class="text-2xl font-bold text-gray-800 mb-2 flex items-center gap-2">
                                                <i data-lucide="star" class="w-6 h-6 text-yellow-400"></i>
                                                Leave a Review
                                            </h2>
                                            <p class="text-gray-500 mb-6">Share your experience and help
                                                others!</p>
                                            <form method="dialog" wire:submit="submitReview" class="space-y-5">
                                                <div>
                                                    <label for="rating"
                                                           class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                                    {{-- <input type="number" min="1" max="5" wire:model="rating"
                                                        id="rating"
                                                        class="w-24 px-3 py-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 outline-none"
                                                        placeholder="1-5"> --}}
                                                    <div class="rating rating-lg rating-half">
                                                        <input type="radio" wire:model="rating" name="rating-11"
                                                               class="rating-hidden"/>
                                                        <input type="radio" wire:model="rating" value="0.5"
                                                               name="rating-11"
                                                               class="mask mask-star-2 mask-half-1 bg-green-500"
                                                               aria-label="0.5 star"/>
                                                        <input type="radio" wire:model="rating" value="1"
                                                               name="rating-11"
                                                               class="mask mask-star-2 mask-half-2 bg-green-500"
                                                               aria-label="1 star"/>
                                                        <input type="radio" wire:model="rating" value="1.5"
                                                               name="rating-11"
                                                               class="mask mask-star-2 mask-half-1 bg-green-500"
                                                               aria-label="1.5 star"/>
                                                        <input type="radio" wire:model="rating" value="2"
                                                               name="rating-11"
                                                               class="mask mask-star-2 mask-half-2 bg-green-500"
                                                               aria-label="2 star"/>
                                                        <input type="radio" wire:model="rating" value="2.5"
                                                               name="rating-11"
                                                               class="mask mask-star-2 mask-half-1 bg-green-500"
                                                               aria-label="2.5 star"/>
                                                        <input type="radio" wire:model="rating" value="3"
                                                               name="rating-11"
                                                               class="mask mask-star-2 mask-half-2 bg-green-500"
                                                               aria-label="3 star"/>
                                                        <input type="radio" wire:model="rating" value="3.5"
                                                               name="rating-11"
                                                               class="mask mask-star-2 mask-half-1 bg-green-500"
                                                               aria-label="3.5 star"/>
                                                        <input type="radio" wire:model="rating" value="4"
                                                               name="rating-11"
                                                               class="mask mask-star-2 mask-half-2 bg-green-500"
                                                               aria-label="4 star"/>
                                                        <input type="radio" wire:model="rating" value="4.5"
                                                               name="rating-11"
                                                               class="mask mask-star-2 mask-half-1 bg-green-500"
                                                               aria-label="4.5 star"/>
                                                        <input type="radio" wire:model="rating" value="5"
                                                               name="rating-11"
                                                               class="mask mask-star-2 mask-half-2 bg-green-500"
                                                               aria-label="5 star"/>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="review"
                                                           class="block text-sm font-medium text-gray-700 mb-1">Your
                                                        Review</label>
                                                    <textarea wire:model="review" id="review" rows="4"
                                                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 outline-none resize-none"
                                                              placeholder="Write your review..."></textarea>
                                                </div>
                                                <div class="flex justify-end gap-2 mt-6">

                                                    <button onclick="my_modal_4.close()"
                                                            class="btn bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-semibold shadow"
                                                            type="submit">Send
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </dialog>
                                    {{-- @endif --}}
                                </div>
                            </div>

                            @if ($reviewCount)
                                <div class="grid grid-cols-1 gap-4">
                                    @foreach ($eventReviews as $review)
                                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-100">
                                            <div class="flex items-start gap-4">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 flex-shrink-0">
                                                    @if (isset($review->user) && isset($review->user->profile_photo_url))
                                                        <img src="{{ $review->user->profile_photo_url }}"
                                                             alt="{{ $review->user->name }}"
                                                             class="w-full h-full object-cover rounded-full">
                                                    @else
                                                        <span
                                                            class="font-semibold">{{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}</span>
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between">
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-800">
                                                                {{ $review->user->name ?? 'Anonymous' }}
                                                            </div>
                                                            <div class="text-xs text-gray-500">
                                                                {{ $review->created_at?->format('M j, Y') ?? '' }}
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center gap-2">
                                                            <div class="rating rating-lg rating-half">
                                                                {{-- 1 full opacity ,0.2 almost transparert --}}
                                                                <div class="mask mask-star-2 mask-half-1 bg-green-500"
                                                                     aria-label="0.5 star"
                                                                     style="opacity:{{ $review->rating >= 0.5 ? 1 : 0.2 }}">
                                                                </div>
                                                                <div class="mask mask-star-2 mask-half-2 bg-green-500"
                                                                     aria-label="1 star"
                                                                     style="opacity:{{ $review->rating >= 1 ? 1 : 0.2 }}">
                                                                </div>
                                                                <div class="mask mask-star-2 mask-half-1 bg-green-500"
                                                                     aria-label="1.5 star"
                                                                     style="opacity:{{ $review->rating >= 1.5 ? 1 : 0.2 }}">
                                                                </div>
                                                                <div class="mask mask-star-2 mask-half-2 bg-green-500"
                                                                     aria-label="2 star"
                                                                     style="opacity:{{ $review->rating >= 2 ? 1 : 0.2 }}">
                                                                </div>
                                                                <div class="mask mask-star-2 mask-half-1 bg-green-500"
                                                                     aria-label="2.5 star"
                                                                     style="opacity:{{ $review->rating >= 2.5 ? 1 : 0.2 }}">
                                                                </div>
                                                                <div class="mask mask-star-2 mask-half-2 bg-green-500"
                                                                     aria-label="3 star"
                                                                     style="opacity:{{ $review->rating >= 3 ? 1 : 0.2 }}">
                                                                </div>
                                                                <div class="mask mask-star-2 mask-half-1 bg-green-500"
                                                                     aria-label="3.5 star"
                                                                     style="opacity:{{ $review->rating >= 3.5 ? 1 : 0.2 }}">
                                                                </div>
                                                                <div class="mask mask-star-2 mask-half-2 bg-green-500"
                                                                     aria-label="4 star"
                                                                     style="opacity:{{ $review->rating >= 4 ? 1 : 0.2 }}">
                                                                </div>
                                                                <div class="mask mask-star-2 mask-half-1 bg-green-500"
                                                                     aria-label="4.5 star"
                                                                     style="opacity:{{ $review->rating >= 4.5 ? 1 : 0.2 }}">
                                                                </div>
                                                                <div class="mask mask-star-2 mask-half-2 bg-green-500"
                                                                     aria-label="5 star"
                                                                     style="opacity:{{ $review->rating == 5 ? 1 : 0.2 }}">
                                                                </div>
                                                            </div>
                                                            <div class="text-sm text-gray-600">
                                                                {{ $review->rating ?? '-' }}/5
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="mt-3 text-gray-700 text-sm">{{ $review->review ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Chat --}}
                @if ($status == 'accepted')
                    <label class="tab">
                        <input type="radio" name="my_tabs_4"/>
                        <i data-lucide="message-circle" class="w-4 h-4 mr-2"></i>
                        Chat
                    </label>
                    <div class="tab-content bg-base-100 border-base-300 p-0">
                        <livewire:common.group-chat :eventId="$event->id"/>
                    </div>
                @endif
            </div>

        </div>

    </div>
</x-volunteer.dashboard-layout>
