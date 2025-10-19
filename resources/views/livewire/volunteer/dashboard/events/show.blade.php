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

    <!-- Open the modal using ID.showModal() method -->
    <div x-data="{
        profileCompletionPercentage: {{ $profileCompletionPercentage }},
        openModal() {
            this.$refs.profile_completion_modal.showModal();
        },
        closeModal() {
            console.log('closing modal');
            this.$refs.profile_completion_modal.close();
        },
        join() {
            console.log(this.profileCompletionPercentage)
            if (this.profileCompletionPercentage < 1) {
                this.openModal();
            } else {
                this.$wire.join();
            }
            console.log('join', this.profileCompletionPercentage)
        }
    }">
        <dialog class="modal" x-ref="profile_completion_modal">
            <div class="modal-box bg-base-100 text-base-content rounded-2xl shadow-2xl border border-base-200">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-warning text-shadow-warning-content rounded-full p-2">
                        <i data-lucide="info" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold">Please Complete Your Profile</h3>
                </div>
                <p class="mb-6 text-base text-base-content/70">
                    🚀 Almost there! Complete your profile to unlock this awesome event. We want every volunteer to
                    shine
                    and make a real splash together! 🌊✨
                </p>
                <div class="relative flex items-center justify-center">
                    <progress class="progress w-full h-8 text-primary" x-bind:value="profileCompletionPercentage"
                              max="1"></progress>
                    <span class="absolute text-white text-sm font-medium bg-primary px-1 rounded-sm"
                          x-text="`${profileCompletionPercentage * 100}%`"></span>
                </div>
                <div class="modal-action flex gap-2">
                    <form method="dialog" class="basis-1/2">
                        <button class="btn btn-primary w-full">
                            <i data-lucide="arrow-left-circle" class="w-5 h-5 mr-2"></i>
                            Close
                        </button>
                    </form>
                    <a href="/volunteer/dashboard/profile" class="btn btn-outline btn-accent basis-1/2">
                        <i data-lucide="user" class="w-5 h-5 mr-2"></i>
                        Complete Profile
                    </a>
                </div>
            </div>
        </dialog>

        <div class="min-h-screen bg-gradient-to-br from-white via-gray-50 to-white">
            <!-- Back Button -->
            <div class="p-6 pb-0">
                <a href="/volunteer/dashboard/events" wire:navigate
                   class="inline-flex items-center gap-2 text-gray-600 hover:text-accent transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5 group-hover:-translate-x-1 transition-transform" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Opportunities
                </a>
            </div>

            <!-- Hero Section -->
            <div class="p-6">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <!-- Event Content -->
                    <div class="p-8">
                        <!-- Header -->
                        <div class="mb-6 flex items-center justify-between">
                            <h1 class="text-4xl font-bold text-accent mb-3">
                                {{ $event->name }}
                            </h1>

                            <div>
                                <div class="px-4 py-2 text-white backdrop-blur-sm rounded-full text-sm font-medium"
                                     style="background-color: {{ $event->category->color }}">
                                    {{ $event->category->name }}
                                </div>
                            </div>
                        </div>

                        <!-- Quick Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <div
                                    class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i data-lucide="calendar" class="w-6 h-6 text-blue-600"></i>
                                </div>
                                <div class="text-sm text-gray-500">Date</div>
                                <div class="font-semibold text-gray-700">{{ $event->starts_at->format('F j') }}
                                    - {{ $event->ends_at->format('F j') }}</div>
                            </div>


                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <div
                                    class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i data-lucide="map-pin" class="w-6 h-6 text-purple-600"></i>
                                </div>
                                <div class="text-sm text-gray-500">Location</div>
                                <div class="font-semibold text-gray-700">{{ $city }}</div>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <div
                                    class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i data-lucide="users" class="w-6 h-6 text-orange-600"></i>
                                </div>
                                <div class="text-sm text-gray-500">Volunteers</div>
                                <div class="font-semibold text-gray-700">{{ count($Volunteers) }} /
                                    {{ $event->maximum_participants }}</div>
                            </div>
                        </div>

                        <!-- Main Content Grid -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- Left Column - Event Details -->
                            <div class="lg:col-span-2 space-y-8">
                                <!-- About Event -->
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800 mb-4">About This Event</h2>
                                    <div class="prose prose-gray max-w-none">
                                        <p class="text-gray-600 leading-relaxed mb-4">
                                            {{ $event->description }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Skills & Tags -->
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Tags</h2>
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        @foreach ($event->tags as $tag)
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 border border-blue-200 text-blue-800 text-xs font-semibold shadow-sm">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                    @if (!empty($event->skills))
                                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Skills</h2>
                                        <div class="flex flex-wrap gap-2 mb-6">
                                            @foreach (is_array($event->skills) ? $event->skills : explode(',', $event->skills) as $skill)
                                                @if (trim($skill) !== '')
                                                    <span
                                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-gradient-to-r from-green-100 to-blue-100 border border-green-200 text-green-800 text-xs font-semibold shadow-sm">
                                                        {{ trim($skill) }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Resources Required</h2>
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        @foreach ($event->resources as $resource)
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 border border-blue-200 text-blue-800 text-xs font-semibold shadow-sm">
                                                {{ $resource->name }}
                                            </span>
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 border border-blue-200 text-blue-800 text-xs font-semibold shadow-sm">
                                                {{ $resource->description }}
                                            </span>
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 border border-blue-200 text-blue-800 text-xs font-semibold shadow-sm">
                                                {{ $resource->unit }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                                        Eligibility & Selection Criteria
                                    </h2>
                                    <div
                                        class="bg-gradient-to-br from-gray-50 to-white border border-gray-100 rounded-xl p-6">
                                        <!-- Recruiting Method -->
                                        <div class="flex items-center gap-4">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center">
                                                    <i data-lucide="user-plus" class="w-6 h-6 text-blue-500"
                                                       aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div>
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
                                                <div class="text-sm font-medium text-gray-500">
                                                    We will be recruiting based on {{ $recruitingMethodLabel }} </div>
                                            </div>
                                        </div>

                                        <!-- Participant Requirements -->
                                        <div class="flex items-start gap-4">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="w-12 h-12 bg-yellow-50 rounded-full flex items-center justify-center">
                                                    <i data-lucide="users" class="w-6 h-6 text-yellow-500"
                                                       aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <div class="w-full">
                                                @if (!empty($event->participant_requirements))
                                                    <div class="flex flex-wrap gap-2 mt-2">
                                                        @foreach ($event->participant_requirements as $req)
                                                            @if (isset($req['filter_types']) && $req['filter_types'] === 'gender')
                                                                <span
                                                                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-800 text-sm font-medium">
                                                                    <i data-lucide="venus-and-mars"
                                                                       class="w-4 h-4 text-blue-400"
                                                                       aria-hidden="true"></i>
                                                                    <span class="flex items-center gap-1">
                                                                        Men: <span
                                                                            class="font-bold text-blue-700">{{ $req['male_participants'] ?? 0 }}</span>
                                                                    </span>
                                                                    <span class="flex items-center gap-1">
                                                                        Women: <span
                                                                            class="font-bold text-pink-700">{{ $req['female_participants'] ?? 0 }}</span>
                                                                    </span>
                                                                    <span class="flex items-center gap-1">
                                                                        Non-Binary: <span
                                                                            class="font-bold text-purple-700">{{ $req['non_binary_participants'] ?? 0 }}</span>
                                                                    </span>
                                                                </span>
                                                            @elseif (isset($req['filter_types']) && $req['filter_types'] === 'level')
                                                                <span
                                                                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-50 border border-yellow-200 text-yellow-800 text-sm font-medium">
                                                                    <i data-lucide="bar-chart"
                                                                       class="w-4 h-4 text-yellow-400"
                                                                       aria-hidden="true"></i>
                                                                    Level:
                                                                    <span>Beginner <span
                                                                            class="font-bold text-yellow-700">{{ $req['beginner_participants'] ?? 0 }}</span></span>,
                                                                    <span>Intermediate <span
                                                                            class="font-bold text-orange-700">{{ $req['intermediate_participants'] ?? 0 }}</span></span>,
                                                                    <span>Advanced <span
                                                                            class="font-bold text-green-700">{{ $req['advanced_participants'] ?? 0 }}</span></span>
                                                                </span>
                                                            @else
                                                                <span
                                                                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-50 border border-gray-200 text-gray-700 text-sm font-medium">
                                                                    {{ is_string($req) ? $req : 'Custom requirement' }}
                                                                </span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="mt-2 text-gray-600 text-sm">No specific participant
                                                        requirements.
                                                    </div>
                                                @endif

                                                <!-- Minimum Age -->
                                                @if (isset($event->minimum_age))
                                                    <div class="mt-3">
                                                        <span
                                                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-50 border border-green-200 text-green-800 text-sm font-medium">
                                                            <i data-lucide="calendar" class="w-4 h-4 text-green-500"
                                                               aria-hidden="true"></i>
                                                            Minimum Age: <span
                                                                class="font-bold text-green-700">{{ $event->minimum_age }}</span>
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Additional Notes</h2>
                                    <div class=" p-4 space-y-2">
                                        <p class="text-gray-700 text-base"><span class="font-semibold">Notes:</span>
                                            {{ $event->notes }}</p>

                                    </div>
                                </div>


                                <!-- Location Card -->
                                <div class="bg-white border border-gray-100 rounded-xl p-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-4">Location</h3>
                                    <div class="space-y-3">
                                        <div class="flex items-start gap-3">
                                            <i data-lucide="map-pin" class="w-5 h-5 text-gray-400 mt-0.5"></i>
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $city }}</p>
                                            </div>
                                        </div>
                                        <div
                                            class="bg-gray-100 rounded-lg h-64 flex items-center justify-center overflow-hidden">
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

                            <!-- Right Column - Organizer & Actions -->
                            <div class="space-y-6">
                                <!-- Organizer Card -->
                                <div
                                    class="bg-gradient-to-br from-gray-50 to-white border border-gray-100 rounded-xl p-6">
                                    <h3 class="text-lg font-bold text-gray-800 mb-4">Event Organizer</h3>
                                    <div class="flex items-center gap-4 mb-4">
                                        <div
                                            class="w-16 h-16 rounded-full aspect-square bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white text-xl font-bold">
                                            {{ ucfirst(substr($organizer->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">{{ $organizer->name }}</h4>
                                            {{-- <p class="text-gray-600 text-sm">Environmental Organization</p> --}}
                                            <div class="flex items-center gap-1 mt-1">
                                                <div class="flex text-yellow-400">
                                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                </div>
                                                <span class="text-sm text-gray-600 ml-1">4.8 (124 reviews)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-4">
                                        Dedicated to marine conservation with over 50 successful cleanup events and
                                        1000+
                                        volunteers mobilized.
                                    </p>
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <i data-lucide="calendar" class="w-4 h-4"></i>
                                            <span> events organized</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <i data-lucide="users" class="w-4 h-4"></i>
                                            <span>{{ count($Volunteers) }} volunteers reached</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="space-y-3">
                                    @if ($event->users->contains(auth()->user()))
                                        <button class="w-full btn btn-secondary btn-lg" disabled>
                                            <i data-lucide="check" class="w-5 h-5 mr-2"></i>
                                            {{-- get status from event_user table --}}
                                            <span
                                                class="capitalize">{{ $event->users->where('id', auth()->user()->id)->first()->pivot->status }}</span>
                                        </button>
                                    @else
                                        <button class="w-full btn btn-primary btn-lg" x-on:click="join">
                                            <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                                            Join This Event
                                        </button>
                                        @if (session()->has('event_full'))
                                            <div role="alert" class="alert alert-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-6 w-6 shrink-0 stroke-current" fill="none"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                </svg>
                                                <span>{{ session('event_full') }}</span>
                                            </div>
                                        @endif
                                    @endif
                                    <button class="w-full btn btn-outline" wire:click="chat">
                                        <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
                                        Contact Organizer
                                    </button>
                                    <button class="w-full btn btn-outline">
                                        <i data-lucide="share-2" class="w-5 h-5 mr-2"></i>
                                        Share Event
                                    </button>
                                    <!-- Report Event Button -->
                                    <div class="w-full">
                                        @livewire('volunteer.dashboard.eventz.report-event', ['eventId' => $event->id])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-volunteer.dashboard-layout>
