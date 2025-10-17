<x-volunteer.dashboard-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto px-4 py-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">My Reviews</h1>
                <p class="text-sm text-gray-500">Showing reviews you have left for events.</p>
            </div>

            @if (isset($reviews) && $reviews->count())
                <div class="grid grid-cols-1 gap-6">
                    @foreach ($reviews as $review)
                        <div
                            class="group bg-white rounded-xl p-5 border border-gray-100 hover:shadow-lg transform hover:-translate-y-1 transition">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-16 h-16 rounded-full overflow-hidden bg-gray-100 flex-shrink-0 flex items-center justify-center">
                                    @if (isset($review->user) && isset($review->user->profile_photo_url))
                                        <img src="{{ $review->user->profile_photo_url }}"
                                            alt="{{ $review->user->name ?? 'User' }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center text-gray-400 bg-gradient-to-br from-gray-200 to-gray-100">
                                            <span
                                                class="text-sm font-semibold text-gray-600">{{ strtoupper(substr($review->user->name ?? 'Y', 0, 1)) }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0">
                                            <a href="{{ isset($review->event) ? url('/volunteer/dashboard/my-events/' . $review->event->id) : '#' }}"
                                                class="text-md font-semibold text-gray-800 hover:text-emerald-600 truncate">{{ $review->event->name ?? 'Event #' . ($review->event_id ?? '—') }}</a>
                                            <div class="text-sm text-gray-500">by <span
                                                    class="font-medium text-gray-700">{{ $review->user->name ?? 'You' }}</span>
                                            </div>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $review->updated_at?->format('M j, Y') ?? '' }}</div>
                                    </div>

                                    <div class="mt-3 flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="flex items-center text-yellow-400">
                                                @php $r = (int) ($review->rating ?? 0); @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $r)
                                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                    @else
                                                        <i data-lucide="star" class="w-4 h-4 text-gray-300"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <div class="text-sm text-gray-600">{{ $review->rating ?? '-' }}/5</div>
                                        </div>
                                        <div
                                            class="bg-emerald-50 text-emerald-700 px-2 py-1 rounded-md text-xs font-semibold">
                                            Verified</div>
                                    </div>

                                    <p class="mt-3 text-gray-700 text-sm leading-relaxed">{{ $review->review ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm p-8 text-center border border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">You haven't left any reviews yet</h2>
                    <p class="text-gray-500">When you submit reviews for events, they'll appear here.</p>
                    <div class="mt-4">
                        <a href="/volunteer/dashboard/my-events"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700">Browse
                            events</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-volunteer.dashboard-layout>
