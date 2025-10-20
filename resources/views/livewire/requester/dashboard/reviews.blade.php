<x-requester.dashboard-layout>
    <div class="min-h-screen bg-gray-50 p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 bg-gray-900 rounded-lg flex items-center justify-center">
                    <i data-lucide="star" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Event Reviews</h1>
                    <p class="text-gray-600">Reviews from volunteers across all your events</p>
                </div>
            </div>
        </div>

        @if (isset($reviews) && $reviews->count())
            <!-- Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">{{ $reviews->count() }}</div>
                            <div class="text-sm text-gray-600 font-medium">Total Reviews</div>
                        </div>
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                            <i data-lucide="message-square" class="w-6 h-6 text-gray-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">
                                {{ number_format($reviews->avg('rating'), 1) }}</div>
                            <div class="text-sm text-gray-600 font-medium">Average Rating</div>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i data-lucide="star" class="w-6 h-6 text-yellow-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">
                                {{ $reviews->where('rating', '>=', 4)->count() }}</div>
                            <div class="text-sm text-gray-600 font-medium">Positive Reviews</div>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i data-lucide="thumbs-up" class="w-6 h-6 text-green-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">
                                {{ $reviews->groupBy('event_id')->count() }}</div>
                            <div class="text-sm text-gray-600 font-medium">Events Reviewed</div>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i data-lucide="calendar" class="w-6 h-6 text-blue-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews List -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <i data-lucide="message-square" class="w-5 h-5"></i> All Reviews
                </h2>

                <div class="space-y-4">
                    @foreach ($reviews as $review)
                        <div class="border border-gray-200 rounded-xl p-5 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-4">
                                <!-- Reviewer Avatar -->
                                <div class="flex-shrink-0">
                                    @if ($review->user && $review->user->getProfilePicture())
                                        <img src="{{ $review->user->getProfilePicture() }}"
                                            alt="{{ $review->user->name }}"
                                            class="w-12 h-12 rounded-full border-2 border-gray-200">
                                    @else
                                        <div
                                            class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                                            <span class="text-lg font-semibold text-gray-600">
                                                {{ $review->user ? strtoupper(substr($review->user->name, 0, 1)) : 'V' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Review Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-4 mb-2">
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-900">
                                                {{ $review->user->name ?? 'Volunteer' }}</div>
                                            <a href="#"
                                                class="text-sm text-gray-600 hover:text-gray-900">
                                                {{ $review->event->name ?? 'Event' }}
                                            </a>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $review->created_at->diffForHumans() }}
                                        </div>
                                    </div>

                                    <!-- Star Rating -->
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($review->rating))
                                                    <i data-lucide="star"
                                                        class="w-4 h-4 text-yellow-400 fill-current"></i>
                                                @elseif ($i - 0.5 <= $review->rating)
                                                    <i data-lucide="star-half"
                                                        class="w-4 h-4 text-yellow-400 fill-current"></i>
                                                @else
                                                    <i data-lucide="star" class="w-4 h-4 text-gray-300"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span
                                            class="text-sm font-medium text-gray-700">{{ number_format($review->rating, 1) }}/5</span>
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                            <i data-lucide="check-circle" class="w-3 h-3"></i>
                                            Verified
                                        </span>
                                    </div>

                                    <!-- Review Text -->
                                    @if ($review->review)
                                        <p class="text-gray-700 leading-relaxed">{{ $review->review }}</p>
                                    @else
                                        <p class="text-gray-400 italic">No written review provided</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="star" class="w-8 h-8 text-gray-400"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">No Reviews Yet</h2>
                    <p class="text-gray-600 mb-6">Reviews from volunteers will appear here once your events are
                        completed.</p>
                    <a href="/requester/dashboard/my-events"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white font-medium rounded-lg transition-colors">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        View My Events
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-requester.dashboard-layout>
