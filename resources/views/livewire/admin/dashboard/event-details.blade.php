<x-admin.dashboard-layout>
    <div class="p-6">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="/admin/dashboard" wire:navigate
                class="inline-flex items-center gap-2 text-gray-600 hover:text-accent transition-colors">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('message') }}</span>
            </div>
        @endif

        <!-- Event Header -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $event->name }}</h1>
                    <div class="flex items-center gap-4 text-gray-600">
                        <span class="inline-flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Organized by: <strong class="ml-1">{{ $event->user->name ?? 'N/A' }}</strong>
                        </span>
                        <span class="inline-flex items-center">
                            <i class="fas fa-tag mr-2"></i>
                            {{ $event->category->name ?? 'N/A' }}
                        </span>
                        <span class="inline-flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $event->city }}
                        </span>
                    </div>
                </div>

                <!-- Status Badge -->
                <div>
                    @if($event->is_active)
                        <span
                            class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium inline-flex items-center">
                            <i class="fas fa-eye mr-2"></i>
                            Active
                        </span>
                    @else
                        <span
                            class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-medium inline-flex items-center">
                            <i class="fas fa-eye-slash mr-2"></i>
                            Hidden
                        </span>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="flex gap-3 border-t border-gray-200 pt-6">
                @if($event->is_active)
                    <button wire:click="toggleEventStatus"
                        wire:confirm="{{ $event->reports_count >= 3 ? 'Are you sure you want to hide this event from volunteers?' : 'Warning: This event has only ' . $event->reports_count . ' report(s). Events typically require 3+ reports to be hidden. Hide anyway?' }}"
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium inline-flex items-center">
                        <i class="fas fa-ban mr-2"></i>
                        Disable Event
                    </button>
                @else
                    <button wire:click="toggleEventStatus"
                        wire:confirm="Are you sure you want to show this event to volunteers?"
                        class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium inline-flex items-center">
                        <i class="fas fa-check mr-2"></i>
                        Enable Event
                    </button>
                @endif

                @if($event->reports_count > 0)
                    <button wire:click="dismissReports" wire:confirm="Dismiss all pending reports for this event?"
                        class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-medium inline-flex items-center">
                        <i class="fas fa-times mr-2"></i>
                        Dismiss {{ $event->reports_count }} {{ Str::plural('Report', $event->reports_count) }}
                    </button>
                @endif
            </div>
        </div>

        <!-- Reports Section (if any) -->
        @if($event->reports->where('status', 'pending')->count() > 0)
            <div class="bg-red-50 border-2 border-red-200 rounded-2xl shadow-xl p-8 mb-6">
                <h2 class="text-2xl font-bold text-red-700 mb-4 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle"></i>
                    Reports ({{ $event->reports->where('status', 'pending')->count() }})
                </h2>

                <div class="space-y-4">
                    @foreach($event->reports->where('status', 'pending') as $report)
                        <div class="bg-white rounded-lg p-4 border-l-4 border-red-500">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <span class="font-semibold text-gray-900">{{ $report->user->name }}</span>
                                    <span class="text-gray-500 text-sm ml-2">{{ $report->created_at->diffForHumans() }}</span>
                                </div>
                                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">
                                    {{ $report->reason }}
                                </span>
                            </div>
                            @if($report->details)
                                <p class="text-gray-700 mt-2 italic">"{{ $report->details }}"</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Event Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Description -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Description</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $event->description }}</p>
                </div>

                <!-- Event Details -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Event Details</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-calendar text-blue-600 w-5"></i>
                            <span class="text-gray-700">Starts:
                                <strong>{{ $event->starts_at->format('M d, Y h:i A') }}</strong></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-calendar-check text-green-600 w-5"></i>
                            <span class="text-gray-700">Ends:
                                <strong>{{ $event->ends_at->format('M d, Y h:i A') }}</strong></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-users text-purple-600 w-5"></i>
                            <span class="text-gray-700">Max Participants:
                                <strong>{{ $event->maximum_participants }}</strong></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-user-check text-orange-600 w-5"></i>
                            <span class="text-gray-700">Current Volunteers:
                                <strong>{{ $event->users->count() }}</strong></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-child text-pink-600 w-5"></i>
                            <span class="text-gray-700">Minimum Age: <strong>{{ $event->minimum_age }}
                                    years</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Skills & Tags -->
                @if($event->skills || $event->tags->count() > 0)
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Skills & Tags</h3>

                        @if($event->skills)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Required Skills:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(is_array($event->skills) ? $event->skills : explode(',', $event->skills) as $skill)
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                            {{ trim($skill) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($event->tags->count() > 0)
                            <div>
                                <p class="text-sm text-gray-600 mb-2">Tags:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($event->tags as $tag)
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Volunteers List -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        Volunteers ({{ $event->users->count() }})
                    </h3>

                    @if($event->users->count() > 0)
                        <div class="space-y-3 max-h-96 overflow-y-auto">
                            @foreach($event->users as $volunteer)
                                <div
                                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($volunteer->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $volunteer->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $volunteer->email }}</p>
                                        </div>
                                    </div>
                                    <span
                                        class="px-3 py-1 bg-{{ $volunteer->pivot->status === 'accepted' ? 'green' : ($volunteer->pivot->status === 'pending' ? 'yellow' : 'red') }}-100 text-{{ $volunteer->pivot->status === 'accepted' ? 'green' : ($volunteer->pivot->status === 'pending' ? 'yellow' : 'red') }}-800 rounded-full text-xs font-medium capitalize">
                                        {{ $volunteer->pivot->status }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No volunteers yet</p>
                    @endif
                </div>

                <!-- Additional Notes -->
                @if($event->notes)
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Additional Notes</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $event->notes }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>