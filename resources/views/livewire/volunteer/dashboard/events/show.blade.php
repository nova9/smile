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

        <!-- Contract Agreement Modal -->
        @if($showContractModal && $signedContract)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] flex flex-col">

                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-t-2xl">
                    <div>
                        <h3 class="text-2xl font-bold flex items-center">
                            <i data-lucide="file-text" class="w-7 h-7 mr-3"></i>
                            Contract Agreement Required
                        </h3>
                        <p class="text-sm text-blue-100 mt-2">
                            Please review and agree to the contract terms before joining this event
                        </p>
                    </div>
                    <button wire:click="cancelContractAgreement" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-7 h-7"></i>
                    </button>
                </div>

                <!-- Modal Body (Scrollable) -->
                <div class="p-6 overflow-y-auto flex-1">
                    <!-- Contract Info -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <i data-lucide="info" class="w-5 h-5 text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">{{ $signedContract->agreement->topic }}</h4>
                                <p class="text-sm text-gray-600">
                                    This event requires volunteers to agree to the contract terms established by the organizer and lawyer.
                                </p>
                                <div class="mt-2 text-xs text-gray-500">
                                    <span class="font-medium">Signed by lawyer on:</span> {{ $signedContract->signed_at->format('M j, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contract Terms -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                            <i data-lucide="scroll-text" class="w-5 h-5 mr-2 text-blue-600"></i>
                            Contract Terms & Conditions
                        </h4>
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 max-h-96 overflow-y-auto">
                            <div class="prose prose-sm max-w-none text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $signedContract->agreement->terms }}</div>
                        </div>
                    </div>

                    <!-- Agreement Checkbox -->
                    <div class="bg-yellow-50 border-2 border-yellow-300 rounded-lg p-4">
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <input type="checkbox" wire:model="agreedToTerms"
                                class="checkbox checkbox-primary mt-1 flex-shrink-0">
                            <div class="flex-1">
                                <span class="font-semibold text-gray-800 group-hover:text-primary transition-colors">
                                    I have read and agree to the contract terms and conditions
                                </span>
                                <p class="text-sm text-gray-600 mt-1">
                                    By checking this box, you acknowledge that you have reviewed the contract and agree to abide by all terms and conditions outlined above.
                                </p>
                            </div>
                        </label>
                        @error('agreedToTerms')
                        <p class="text-sm text-red-600 mt-2 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-between p-6 border-t border-gray-200 bg-gray-50 rounded-b-2xl gap-4">
                    <button wire:click="cancelContractAgreement" class="btn btn-outline btn-neutral flex-1">
                        <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                        Cancel
                    </button>

                    <button wire:click="agreeAndJoin"
                        class="btn btn-primary flex-1"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-50 cursor-not-allowed">
                        <span wire:loading.remove>
                            <i data-lucide="check-circle" class="w-4 h-4 mr-2 inline"></i>
                            Agree & Join Event
                        </span>
                        <span wire:loading>
                            <i data-lucide="loader" class="w-4 h-4 mr-2 inline animate-spin"></i>
                            Processing...
                        </span>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="min-h-screen bg-gradient-to-br from-white via-gray-50 to-white">
            <!-- Flash Messages -->
            @if(session()->has('message'))
            <div class="p-6 pb-0">
                <div class="alert alert-success rounded-lg shadow-lg animate-fade-in">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    <span>{{ session('message') }}</span>
                </div>
            </div>
            @endif

            @if(session()->has('event_full'))
            <div class="p-6 pb-0">
                <div class="alert alert-warning rounded-lg shadow-lg animate-fade-in">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    <span>{{ session('event_full') }}</span>
                </div>
            </div>
            @endif

            <!-- Back Button -->
            <div class="p-6 pb-0">
                <a href="/volunteer/dashboard/events" wire:navigate
                    class="inline-flex items-center gap-2 text-gray-600 hover:text-accent transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
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
                                    {{ $event->maximum_participants }}
                                </div>
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
                                    <div>
                                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Resources Required</h2>
                                        <div class="space-y-3">
                                            @foreach ($event->resources as $resource)
                                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                                <div class="flex items-start justify-between gap-4">
                                                    <div class="flex-1">
                                                        <h3 class="font-semibold text-gray-800 mb-1">
                                                            {{ $resource->name }}
                                                        </h3>
                                                        <p class="text-sm text-gray-600">
                                                            {{ $resource->description }}
                                                        </p>
                                                    </div>
                                                    <div class="text-right flex-shrink-0">
                                                        <div class="text-lg font-bold text-gray-800">
                                                            {{ $resource->pivot->quantity }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">{{ $resource->unit }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Eligibility & Selection Criteria
                                    </h2>

                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 space-y-4">
                                        <!-- Recruiting Method -->
                                        <div class="flex items-start gap-3">
                                            <div
                                                class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <i data-lucide="user-check" class="w-4 h-4 text-blue-600"></i>
                                            </div>
                                            <div class="flex-1">
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
                                                        <div class="text-sm font-medium text-gray-700 mb-2">
                                                            Gender Distribution
                                                        </div>
                                                        <div class="grid grid-cols-3 gap-2 text-center text-xs">
                                                            <div class="bg-gray-50 rounded p-2">
                                                                <div class="font-bold text-gray-800">
                                                                    {{ $req['male_participants'] ?? 0 }}
                                                                </div>
                                                                <div class="text-gray-600">Men</div>
                                                            </div>
                                                            <div class="bg-gray-50 rounded p-2">
                                                                <div class="font-bold text-gray-800">
                                                                    {{ $req['female_participants'] ?? 0 }}
                                                                </div>
                                                                <div class="text-gray-600">Women</div>
                                                            </div>
                                                            <div class="bg-gray-50 rounded p-2">
                                                                <div class="font-bold text-gray-800">
                                                                    {{ $req['non_binary_participants'] ?? 0 }}
                                                                </div>
                                                                <div class="text-gray-600">Non-Binary</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @elseif (isset($req['filter_types']) && $req['filter_types'] === 'level')
                                                    <div class="bg-white border border-gray-200 rounded-md p-3">
                                                        <div class="text-sm font-medium text-gray-700 mb-2">
                                                            Experience Level
                                                        </div>
                                                        <div class="grid grid-cols-3 gap-2 text-center text-xs">
                                                            <div class="bg-gray-50 rounded p-2">
                                                                <div class="font-bold text-gray-800">
                                                                    {{ $req['beginner_participants'] ?? 0 }}
                                                                </div>
                                                                <div class="text-gray-600">Beginner</div>
                                                            </div>
                                                            <div class="bg-gray-50 rounded p-2">
                                                                <div class="font-bold text-gray-800">
                                                                    {{ $req['intermediate_participants'] ?? 0 }}
                                                                </div>
                                                                <div class="text-gray-600">Intermediate</div>
                                                            </div>
                                                            <div class="bg-gray-50 rounded p-2">
                                                                <div class="font-bold text-gray-800">
                                                                    {{ $req['advanced_participants'] ?? 0 }}
                                                                </div>
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
                                                    is welcome!</div>
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
                                <div class="mt-8">
                                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Additional Notes</h2>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 space-y-2">
                                        <p class="text-gray-700 text-base">
                                            <span class="font-semibold">Notes:</span>
                                            {{ $event->notes }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Location Card -->
                                <div class="mt-8">
                                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Location</h2>
                                    <div class="bg-white border border-gray-100 rounded-xl p-6">
                                        <div class="space-y-3">
                                            <div class="flex items-start gap-3">
                                                <i data-lucide="map-pin" class="w-5 h-5 text-gray-400 mt-0.5"></i>
                                                <div>
                                                    <p class="font-medium text-gray-800">{{ $city }}</p>
                                                </div>
                                            </div>
                                            <div class="bg-gray-100 rounded-lg h-64 flex items-center justify-center overflow-hidden">
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
                                        Dedicated to marine conservation with over 50 successful cleanup events
                                        and
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
                                        @livewire('volunteer.dashboard.eventz.report-event', [
                                        'eventId' =>
                                        $event->id
                                        ])
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