<x-requester.dashboard-layout>
    <div class="p-2 bg-gray-50">

        <!-- Tabs Section -->
        <div class="p-4">
            <div class="tabs tabs-lift">
                {{-- Volunteers Tab --}}
                <label class="tab">
                    <input type="radio" name="my_tabs_4" checked />
                    <div class="flex gap-1">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <span>Event Details</span>
                    </div>
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
                            </div>

                        </div>

                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Resources Required</h2>
                        <div class="space-y-3 mb-2">
                            @foreach ($event->resources as $resource)
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-800 mb-1">{{ $resource->name }}</h3>
                                            <p class="text-sm text-gray-600">{{ $resource->description }}</p>
                                        </div>
                                        <div class="text-right flex-shrink-0">
                                            <div class="text-lg font-bold text-gray-800">
                                                {{ $resource->pivot->quantity }}</div>
                                            <div class="text-xs text-gray-500">{{ $resource->unit }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Volunteers</h2>

                    <!-- Filters -->
                    <div class="mb-8 flex flex-wrap gap-4 items-center justify-between">
                        <div class="flex gap-3 flex-wrap">
                            <!-- Search Input -->
                            <div class="relative">
                                <input type="text" wire:model.live="searchFilter" placeholder="Search volunteers..."
                                    class="w-64 bg-white border border-gray-200 rounded-lg pl-10 pr-4 py-2.5 text-sm font-medium text-gray-700 placeholder-gray-500 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:ring-opacity-5 focus:border-black transition-all">
                                <i data-lucide="search"
                                    class="absolute left-3 top-3 w-4 h-4 text-gray-400 pointer-events-none"></i>
                            </div>
                            <!-- Gender Filter -->
                            <div class="relative">
                                <select wire:model.change="genderFilter"
                                    class="appearance-none bg-white border border-gray-200 rounded-lg px-4 py-2.5 pr-8 text-sm font-medium text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:ring-opacity-5 focus:border-black transition-all">
                                    <option value="">All Genders</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="non_binary">Non-Binary</option>
                                    <option value="prefer_not_to_say">Prefer not to say</option>
                                </select>
                                <i data-lucide="chevron-down"
                                    class="absolute right-2.5 top-3 w-4 h-4 text-gray-400 pointer-events-none"></i>
                            </div>
                            <!-- Level Filter -->
                            <div class="relative">
                                <select wire:model.change="levelFilter"
                                    class="appearance-none bg-white border border-gray-200 rounded-lg px-4 py-2.5 pr-8 text-sm font-medium text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:ring-opacity-5 focus:border-black transition-all">
                                    <option value="">All Levels</option>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                                <i data-lucide="chevron-down"
                                    class="absolute right-2.5 top-3 w-4 h-4 text-gray-400 pointer-events-none"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Volunteers List -->
                    <div class="space-y-3">
                        @forelse ($volunteers as $user)
                            <div
                                class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-sm transition-all duration-200 group">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4 flex-1">
                                        <div class="relative">
                                            <x-common.avatar size="50" :src="\App\Services\Profile::getProfilePictureUrl($user)" :name="$user->name" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-3 mb-1">
                                                <a href="{{ route('requester.dashboard.volunteers.show', $user->id) }}"
                                                    class="text-lg font-semibold text-gray-900 hover:text-gray-700 transition-colors">
                                                    {{ $user->name }}
                                                </a>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                    {{ $user->getCustomAttribute('level') }}
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-4 text-sm text-gray-600">
                                                <span>{{ $user->role->name ?? 'Volunteer' }}</span>
                                                <div class="flex items-center gap-1">
                                                    <i data-lucide="star"
                                                        class="w-4 h-4 fill-current text-yellow-400"></i>
                                                    <span
                                                        class="font-medium">{{ number_format($user->getCustomAttribute('rating') ?? 4.6, 1) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($user->pivot->status === 'pending')
                                        <div class="flex items-center gap-2 ml-4">
                                            <button wire:click="decline({{ $user->id }})"
                                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                                                <i data-lucide="x" class="w-4 h-4"></i>
                                                Decline
                                            </button>
                                            <button wire:click="approve({{ $user->id }})"
                                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-black hover:bg-gray-800 rounded-lg transition-all duration-200">
                                                <i data-lucide="check" class="w-4 h-4"></i>
                                                Approve
                                            </button>
                                        </div>
                                    @else
                                        <div class="flex items-center gap-2 ml-4">
                                            <span
                                                class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm rounded-full font-medium">
                                                <i data-lucide="check-circle" class="w-4 h-4"></i> Approved
                                            </span>
                                            <button wire:click="removeUser({{ $user->id }})"
                                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-all duration-200">
                                                <i data-lucide="user-minus" class="w-4 h-4"></i>
                                                Remove
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                    <i data-lucide="users" class="w-8 h-8 text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No pending requests</h3>
                                <p class="text-gray-600">There are currently no volunteer requests to review.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Workflows Tab --}}
                <label class="tab">
                    <input type="radio" name="my_tabs_4" />
                    <div class="flex gap-1">
                        <i data-lucide="book-check" class="w-4 h-4"></i>
                        <span>Workflows</span>
                    </div>
                </label>
                <div class="tab-content overflow-scroll bg-gray-100 border-base-300 p-6">
                    <livewire:common.workflow :eventId="$event->id" />
                </div>

                <label class="tab">
                    <input type="radio" name="my_tabs_4" />
                    <div class="flex gap-1">
                        <i data-lucide="book-check" class="w-4 h-4"></i>
                        <span>Chat</span>
                    </div>
                </label>
                <div class="tab-content p-0">
                    <livewire:common.group-chat :eventId="$event->id" />
                </div>

                {{-- Certificates Tab --}}
                <label class="tab">
                    <input type="radio" name="my_tabs_4" />
                    <div class="flex gap-1">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                        <span>Certificates</span>
                    </div>
                </label>
                <div class="tab-content bg-base-100 border-base-300 p-6">
                    @if ($deadline < now() && $volunteers->count() > 0)
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold mb-6 flex items-center gap-2 text-gray-900">
                                <i data-lucide="award" class="w-6 h-6 text-gray-600"></i> Issue Certificates
                            </h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white rounded-xl shadow-sm border border-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                Volunteer
                                            </th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th
                                                class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($volunteers as $volunteer)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center gap-3">
                                                        <img src="{{ $volunteer->getProfilePicture() ?? 'https://randomuser.me/api/portraits/men/' . $volunteer->id . '.jpg' }}"
                                                            alt="{{ $volunteer->name }}"
                                                            class="w-10 h-10 rounded-full border-2 border-gray-200">
                                                        <span
                                                            class="font-semibold text-gray-900">{{ $volunteer->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-100 text-gray-700 text-xs font-medium rounded-lg">
                                                        <i data-lucide="award" class="w-3.5 h-3.5"></i>
                                                        @if( $volunteer->isCertificateIssued())
                                                            Certificate Issued
                                                        @else
                                                            Not Issued
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    <form method="GET"
                                                        action="{{ route('certificate.show', ['id' => $event->id, 'volunteerid' => $volunteer->id]) }}"
                                                        class="inline">
                                                        <button type="submit"
                                                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 rounded-lg transition-colors">
                                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                                            View Certificate
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="clock" class="w-8 h-8 text-gray-400"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Event In Progress</h3>
                            <p class="text-gray-600 max-w-md mx-auto">Certificates can only be issued after the event
                                has concluded. Please wait until the event ends to generate certificates for volunteers.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-requester.dashboard-layout>
