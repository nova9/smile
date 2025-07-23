<x-requester.dashboard-layout>
    <div class="min-h-screen bg-gradient-to-br from-white via-gray-50 to-white">
        <!-- Back Button -->
        <div class="p-6 pb-0">
            <a href="/requester/dashboard/my-events" wire:navigate
                class="inline-flex items-center gap-2 text-gray-600 hover:text-primary transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:-translate-x-1 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to My Events
            </a>
        </div>

        <!-- Event Header -->
        <div class="p-6">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-8">
                <div class="relative h-64 bg-gradient-to-r from-primary to-green-600">
                    <img src="https://picsum.photos/seed/event123/1024/480" alt="Event Cover"
                        class="w-full h-full object-cover opacity-80">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <h1 class="text-4xl font-bold mb-2">{{ $event->name }}</h1>
                        <div class="flex items-center gap-4 text-white/90">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                March 15, 2025
                            </span>
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Negombo Beach
                            </span>
                        </div>
                    </div>
                    <div class="absolute top-6 right-6">
                        <div
                            class="px-4 py-2 bg-white/90 backdrop-blur-sm rounded-full text-sm font-medium text-primary">
                            Environmental
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Total Applications</p>
                            <p class="text-3xl font-bold text-primary">24</p>
                        </div>
                        <div class="p-3 bg-primary/10 rounded-full">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Approved</p>
                            <p class="text-3xl font-bold text-success">18</p>
                        </div>
                        <div class="p-3 bg-success/10 rounded-full">
                            <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Pending Review</p>
                            <p class="text-3xl font-bold text-warning">6</p>
                        </div>
                        <div class="p-3 bg-warning/10 rounded-full">
                            <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Max Capacity</p>
                            <p class="text-3xl font-bold text-accent">25</p>
                        </div>
                        <div class="p-3 bg-accent/10 rounded-full">
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Volunteers Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Approved Volunteers -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-bold text-accent flex items-center gap-3">
                                <div class="p-2 bg-success/10 rounded-lg">
                                    <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                Approved Volunteers
                            </h2>
                            <span class="px-3 py-1 bg-success/10 text-success rounded-full text-sm font-medium">{{ $acceptedUsers->count() }}
                                confirmed</span>
                        </div>
                    </div>

                    <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                        <!-- Volunteer Card -->
                        @foreach($acceptedUsers as $item)
                            <div
                                class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                <div class="relative">
                                    <img src="https://picsum.photos/seed/volunteer1/120/120" alt="Sarah Johnson"
                                         class="w-12 h-12 rounded-full object-cover border-2 border-success">
                                    <div
                                        class="absolute -bottom-1 -right-1 w-5 h-5 bg-success rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-accent">Sarah Johnson</h3>
                                    <p class="text-sm text-gray-600">Environmental Activist • 4.9★</p>
                                    <div class="flex gap-2 mt-1">
                                    <span
                                        class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Experienced</span>
                                        <span
                                            class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Local</span>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-2">
                                    <button class="p-2 bg-primary/10 hover:bg-primary/20 rounded-lg transition-colors">
                                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </button>
                                    <span class="text-xs text-gray-500">Joined 2h ago</span>
                                </div>
                            </div>

                        @endforeach




                    </div>
                </div>

                <!-- Pending Approval -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-bold text-accent flex items-center gap-3">
                                <div class="p-2 bg-warning/10 rounded-lg">
                                    <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                Pending Approval
                            </h2>
                            <span class="px-3 py-1 bg-warning/10 text-warning rounded-full text-sm font-medium">{{ $pendingUsers->count() }}
                                waiting</span>
                        </div>
                    </div>

                    <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                        <!-- Pending Volunteer Card -->
                        @foreach($pendingUsers as $item)
                            <div class="flex items-center gap-4 p-4 bg-amber-50 rounded-xl border border-amber-200">
                                <div class="relative">
                                    <img src="https://picsum.photos/seed/pending1/120/120" alt="Alex Rodriguez"
                                         class="w-12 h-12 rounded-full object-cover border-2 border-warning">
                                    <div
                                        class="absolute -bottom-1 -right-1 w-5 h-5 bg-warning rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-accent">{{ $item->name }}</h3>
{{--                                    <p class="text-sm text-gray-600">Community Organizer • 4.6★</p>--}}
                                    <div class="flex gap-2 mt-1">
                                    <span
                                        class="px-2 py-1 bg-orange-100 text-orange-700 text-xs rounded-full">Leadership</span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">3
                                        Events</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <div class="flex gap-2">
                                        <button
                                            wire:click="approve({{ $item->id }})"
                                            class="px-3 py-1 bg-success hover:bg-success/80 text-white rounded-lg text-sm font-medium transition-colors flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M5 13l4 4L19 7" />
                                            </svg>
                                            Approve
                                        </button>
                                        <button
                                            class="px-3 py-1 bg-error hover:bg-error/80 text-white rounded-lg text-sm font-medium transition-colors flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Decline
                                        </button>
                                    </div>
                                    <span class="text-xs text-gray-500 text-center">Applied 3h ago</span>
                                </div>
                            </div>

                        @endforeach

                        <!-- Bulk Actions -->
                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex gap-2">
                                <button
                                    class="flex-1 px-4 py-2 bg-success hover:bg-success/80 text-white rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Approve All
                                </button>
{{--                                <button--}}
{{--                                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors">--}}
{{--                                    Review Later--}}
{{--                                </button>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
                <h3 class="text-xl font-bold text-accent mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <button
                        class="flex items-center gap-3 p-4 bg-primary/10 hover:bg-primary/20 rounded-xl transition-colors group">
                        <div class="p-2 bg-primary/20 rounded-lg group-hover:bg-primary/30 transition-colors">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-semibold text-accent">Send Message</p>
                            <p class="text-sm text-gray-600">Broadcast to all volunteers</p>
                        </div>
                    </button>

                    <button
                        class="flex items-center gap-3 p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors group">
                        <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-semibold text-accent">Export List</p>
                            <p class="text-sm text-gray-600">Download volunteer data</p>
                        </div>
                    </button>

                    <button
                        class="flex items-center gap-3 p-4 bg-purple-50 hover:bg-purple-100 rounded-xl transition-colors group">
                        <div class="p-2 bg-purple-100 rounded-lg group-hover:bg-purple-200 transition-colors">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="font-semibold text-accent">Event Settings</p>
                            <p class="text-sm text-gray-600">Modify requirements</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-requester.dashboard-layout>
