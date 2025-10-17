<x-requester.dashboard-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="px-4 py-4 grid grid-cols-6 gap-5">
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden col-span-4">
                <!-- Hero -->
                <div class="relative overflow-hidden">
                    <div class="relative h-44 bg-gradient-to-r from-indigo-600 to-emerald-600 rounded-t-3xl">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="relative z-10 max-w-5xl mx-auto px-6 py-6 text-white">
                            <div class="flex items-center gap-4">
                                <img src="{{ $volunteer->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . $volunteer->id . '.jpg' }}"
                                    alt="{{ $volunteer->name }}"
                                    class="w-20 h-20 rounded-full ring-4 ring-white object-cover" />
                                <div>
                                    <h1 class="text-2xl font-extrabold">{{ $volunteer->name }}</h1>
                                    <div class="mt-1 text-sm text-white/90">
                                        {{ $volunteer->role->name ?? 'Volunteer' }} •
                                        @if($rating)
                                            <span class="font-semibold">{{ number_format($rating, 1) }} ★</span>
                                        @else
                                            <span class="text-sm">No rating yet</span>
                                        @endif
                                    </div>
                                    <div class="mt-2 text-sm text-white/90">
                                        <span
                                            class="inline-flex items-center gap-2 bg-white/10 px-3 py-1 rounded-full text-sm font-semibold">
                                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                                            {{ $volunteer->getCustomAttribute('city') ?? ($volunteer->address?->city ?? 'Location not set') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-8 lg:p-12">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Left: Profile & actions -->
                        <div class="col-span-1 bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Profile</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                {{ $volunteer->getCustomAttribute('bio') ?? ($volunteer->bio ?? 'No bio provided.') }}
                            </p>

                            <div class="space-y-3">
                                <div>
                                    <div class="text-xs text-gray-500">Contact</div>
                                    <div class="text-sm text-gray-800">
                                        {{ $volunteer->getCustomAttribute('contact_number') ?? $volunteer->email }}
                                    </div>
                                </div>

                                <div>
                                    <div class="text-xs text-gray-500">Gender</div>
                                    <div class="text-sm text-gray-800">
                                        {{ ucfirst(str_replace('_', ' ', $volunteer->getCustomAttribute('gender') ?? 'Not specified')) }}
                                    </div>
                                </div>

                                <div>
                                    <div class="text-xs text-gray-500">Level</div>
                                    <div class="text-sm text-gray-800">
                                        {{ ucfirst($volunteer->getCustomAttribute('level') ?? 'N/A') }}</div>
                                </div>

                                <div>
                                    <div class="text-xs text-gray-500">Skills</div>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @php
                                            $skillsRaw = $volunteer->getCustomAttribute('skills');
                                            $skills = is_array($skillsRaw) ? $skillsRaw : (is_string($skillsRaw) ? explode(',', $skillsRaw) : []);
                                        @endphp
                                        @forelse($skills as $skill)
                                            <span
                                                class="px-2 py-1 bg-indigo-50 text-indigo-700 text-xs rounded-full">{{ trim($skill, '\"[]') }}</span>
                                        @empty
                                            <span class="text-xs text-gray-400">No skills listed</span>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button class="btn" wire:click="initiateMessage({{ $volunteer->id }})">
                                        Message
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Middle: Activity & Events -->
                        <div class="col-span-1 md:col-span-2 space-y-6">
                            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Events</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @forelse($recentEvents as $event)
                                        <div class="p-3 rounded-lg border border-gray-100 bg-white flex items-start gap-3">
                                            <div class="flex-1">
                                                <a href="/requester/dashboard/my-events/{{ $event->id }}"
                                                    class="text-sm font-semibold text-gray-800">{{ $event->name }}</a>
                                                <div class="text-xs text-gray-500">
                                                    {{ $event->starts_at?->format('M j, Y') ?? 'TBA' }} •
                                                    {{ $event->address?->city ?? $event->city ?? 'Online' }}</div>
                                            </div>
                                            <div class="text-xs text-gray-500">{{ $event->pivot?->status ?? '' }}</div>
                                        </div>
                                    @empty
                                        <div class="text-gray-500 text-sm">No recent events</div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Reviews</h3>
                                @forelse($recentReviews as $review)
                                    <div class="py-3 border-b last:border-b-0">
                                        <div class="flex items-start gap-3">
                                            <img src="{{ $review->user?->profile_photo_url ?? 'https://randomuser.me/api/portraits/men/' . ($review->user?->id ?? 1) . '.jpg' }}"
                                                alt="" class="w-8 h-8 rounded-full object-cover" />
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <div class="text-sm font-semibold text-gray-800">
                                                        {{ $review->user?->name ?? 'Anonymous' }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ number_format($review->rating, 1) }} ★</div>
                                                </div>
                                                <div class="text-sm text-gray-600">{{ $review->comment }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-gray-500 text-sm">No reviews yet</div>
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Right column: summary cards -->
            <div class="col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h4 class="text-sm text-gray-500">Summary</h4>
                    <div class="mt-3 grid grid-cols-1 gap-3">
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-gray-500">Events</div>
                            <div class="font-semibold text-gray-800">{{ $volunteer->events->count() }}</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-gray-500">Badges</div>
                            <div class="font-semibold text-gray-800">{{ $volunteer->badges->count() }}</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-gray-500">Completed Tasks</div>
                            <div class="font-semibold text-gray-800">
                                {{ $volunteer->getCustomAttribute('completed_tasks') ?? 0 }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h4 class="text-sm text-gray-500">Contact</h4>
                    <div class="mt-3 text-sm text-gray-800">
                        <div>{{ $volunteer->email }}</div>
                        <div class="text-xs text-gray-500">{{ $volunteer->getCustomAttribute('contact_number') ?? '' }}
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h4 class="text-sm text-gray-500">Location</h4>
                    <div class="mt-3 text-sm text-gray-800">
                        {{ $volunteer->getCustomAttribute('city') ?? ($volunteer->address?->city ?? 'Not provided') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-requester.dashboard-layout>
