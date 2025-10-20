<x-volunteer.dashboard-layout>
    <div class="min-h-screen p-6">
        <!-- Filters -->
        <div class="mb-6">
            <div class="flex flex-wrap gap-4 items-center">
                <div class="flex flex-wrap gap-3 flex-1">
                    <div class="flex gap-1 flex-1">
                        <label class="input w-full">
                            <i data-lucide="search" class="w-4 h-4"></i>
                            <input type="text" wire:model.live="search" class="grow">

                            {{-- <ul>
                                        @foreach ($users as $user)
                                            <li wire:key="{{ $user->id }}">{{ $user->name }}</li>
                                        @endforeach
                                    </ul> --}}
                        </label>
                        <label class="flex items-center gap-2 ml-2 select-none">
                            <input type="checkbox" class="checkbox checkbox-accent checkbox-sm"
                                wire:model.change="favouriteEventsFilter">
                            <span class="text-sm text-slate-700">favourites</span>
                        </label>

                    </div>
                    <select class="select" wire:model.change="statusFilter">
                        <option value="">All Status</option>
                        <option value="accepted">Confirmed</option>
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                        <option value="rejected">Cancelled</option>

                    </select>
                    <select class="select" wire:model.change="categoryFilter">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                        @endforeach

                    </select>

                    <button class="flex btn btn-ghost">
                        <i data-lucide="x" class="w-4 h-4"></i>
                        Clear
                    </button>
                </div>

            </div>
        </div>

        <!-- Events List (Desktop) -->
        <div class="border border-slate-200 overflow-hidden rounded-2xl shadow-sm">
            <!-- Table Header -->
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">
                <div class="grid grid-cols-12 gap-4 text-sm font-semibold text-slate-700">
                    <div class="col-span-4">Event Details</div>
                    <div class="col-span-2">Date & Time</div>
                    <div class="col-span-2">Location</div>
                    <div class="col-span-1">Status</div>
                    <div class="col-span-2">Organizer</div>

                </div>
            </div>

            <!-- Events List Items -->
            <div class="px-6">
         
                @forelse ($this->participatingEvents as $item)
                    <div class="hover:bg-white/60 transition-all duration-200 group" wire:key="{{ $item->id }}">
                        <div class="grid grid-cols-12 gap-4 items-center">

                            <!-- Event Details -->
                            <div class="col-span-4">
                                <div class="flex items-start gap-4">
                                    <div class="min-w-0 flex-1">
                                        <a href="/volunteer/dashboard/my-events/{{ $item->id }}"
                                            class="font-bold text-slate-900 mb-2 text-lg transition-colors duration-200">
                                            {{ $item->name }}
                                            @php
                                                $favoriteIds = $favouriteEvents->pluck('event_id')->toArray();
                                            @endphp
                                            @if (in_array($item->id, $favoriteIds))
                                                <span class="inline-flex items-center">
                                                    <i data-lucide="heart" class="w-4 h-4 mr-1 text-red-500"></i>
                                                </span>
                                            @endif
                                        </a>
                                        <p class="text-sm text-slate-600 line-clamp-2 mb-3">
                                            {{ $item->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Date & Time -->
                            <div class="col-span-2">
                                <div class="bg-white/50 rounded-xl p-3">
                                    <div class="text-sm font-bold text-slate-900 mb-1">
                                        {{ date('M j, Y', strtotime($item->starts_at ?? null)) }}
                                    </div>
                                    <div class="text-sm text-slate-600 flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3 h-3"></i>
                                        {{ $item->starts_at->format('h:i A') }} -
                                        {{ $item->ends_at->format('h:i A') }}
                                    </div>
                                    <div class="text-xs text-slate-400 mt-2 flex items-center gap-1">
                                        <i data-lucide="calendar-plus" class="w-3 h-3"></i>
                                        Applied {{ date('M j', strtotime($item->pivot->created_at ?? null)) }}
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-span-2">
                                <div class="flex items-center gap-2 text-sm text-slate-600 bg-white/50 rounded-xl">
                                    <div
                                        class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i data-lucide="map-pin" class="w-4 h-4 text-slate-500"></i>
                                    </div>
                                    <span class="font-medium">{{ $item->city }}</span>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-span-1">
                            @if(isset($item->pivot['status']))
                                @if ($item->pivot['status'] == 'accepted')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-700 shadow-sm">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></div>
                                        Confirmed
                                    </span>
                                @elseif($item->pivot['status'] == 'pending')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700 shadow-sm">
                                        <div class="w-2 h-2 bg-amber-500 rounded-full mr-2 animate-pulse"></div>
                                        Pending
                                    </span>
                                @elseif($item->pivot['status'] == 'completed')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-violet-100 to-purple-100 text-violet-700 shadow-sm">
                                        <i data-lucide="check-circle" class="w-3 h-3 mr-2"></i>
                                        Completed
                                    </span>
                                @elseif($item->pivot['status'] === 'rejected' || $item->pivot->status === 'cancelled')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-rose-100 to-red-100 text-rose-700 shadow-sm">
                                        <i data-lucide="x-circle" class="w-3 h-3 mr-2"></i>
                                        Cancelled
                                    </span>
                                @endif
                            @endif
                            </div>

                            <!-- Organizer -->
                            <div class="col-span-2">
                                <div class="flex items-center gap-3 bg-white/50 rounded-xl">
                                    <div class="relative">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-sm font-bold text-white shadow-md">
                                            {{ $item->user->name ? substr($item->user->name, 0, 1) : '' }} </div>
                                        <div
                                            class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white">
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-sm font-semibold text-slate-900">{{ $item->user->name }}
                                        </div>
                                        <div class="text-xs text-slate-500">Event Organizer</div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                @empty
                    <div class="py-6 text-center text-slate-600">
                        No events found.
                    </div>
                @endforelse
                @if (session('message'))
                    <div class="toast toast-end">
                        <div class="alert alert-success">
                            <span>
                                <div class="mb-3 text-center">{{ session('message') }}</div>
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Pagination -->
        {{-- <div
            class="mt-8 flex items-center justify-between bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
            <div class="flex items-center gap-2 text-sm text-slate-600">
                <i data-lucide="list" class="w-4 h-4"></i>
                <span>Showing <span class="font-semibold text-slate-900">1-5</span> of <span
                        class="font-semibold text-slate-900">5</span> events</span>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i data-lucide="chevron-left" class="w-4 h-4 mr-1"></i>
                    Previous
                </button>
                <div class="flex items-center gap-2">
                    <button class="w-10 h-10 bg-black text-white rounded-xl text-sm font-semibold shadow-lg">1</button>
                    <button
                        class="w-10 h-10 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">2</button>
                    <button
                        class="w-10 h-10 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">3</button>
                    <span class="text-slate-400">...</span>
                    <button
                        class="w-10 h-10 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">10</button>
                </div>
                <button
                    class="px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">
                    Next
                    <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                </button>
            </div>
        </div> --}}

        <!-- Quick Actions FAB -->
        {{-- <div class="fixed bottom-6 right-6 flex flex-col gap-3 z-10">

            <button
                class="w-12 h-12 bg-white/90 backdrop-blur-sm text-slate-600 rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 border border-white/20 flex items-center justify-center md:hidden">
                <i data-lucide="filter" class="w-5 h-5"></i>
            </button>
        </div> --}}

    </div>
</x-volunteer.dashboard-layout>
