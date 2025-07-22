
<x-volunteer.dashboard-layout>
    <div class="min-h-screen p-6">
        <div class="inline-flex items-center mb-10 px-6 py-3 bg-gradient-to-r from-primary/10 to-green-600/10 text-primary rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-primary/20">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Welcome to Your Volunteer Events
        </div>
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                      <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                My Volunteer
                <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                    Events
                </span>
            </h1>
                    <p class="text-slate-600 text-lg">Track and manage your volunteer activities</p>
                </div>
                <div class="hidden md:flex items-center gap-3">
                    <button class="px-4 py-2 bg-white/80 backdrop-blur-sm border border-slate-200 rounded-xl text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">
                        <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                        Calendar View
                    </button>
                    <button class="px-4 py-2 bg-black text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Find Events
                    </button>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6 hover:shadow-lg hover:bg-white transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-slate-800">5</div>
                        <div class="text-sm text-slate-500 font-medium">Total Events</div>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center">
                        <i data-lucide="calendar-days" class="w-6 h-6 text-slate-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6 hover:shadow-lg hover:bg-white transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-emerald-600">2</div>
                        <div class="text-sm text-slate-500 font-medium">Confirmed</div>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-xl flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-6 h-6 text-emerald-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6 hover:shadow-lg hover:bg-white transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-amber-600">1</div>
                        <div class="text-sm text-slate-500 font-medium">Pending</div>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-100 to-amber-200 rounded-xl flex items-center justify-center">
                        <i data-lucide="clock" class="w-6 h-6 text-amber-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6 hover:shadow-lg hover:bg-white transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-violet-600">1</div>
                        <div class="text-sm text-slate-500 font-medium">Completed</div>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-violet-100 to-violet-200 rounded-xl flex items-center justify-center">
                        <i data-lucide="trophy" class="w-6 h-6 text-violet-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6 hover:shadow-lg hover:bg-white transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-rose-600">1</div>
                        <div class="text-sm text-slate-500 font-medium">Cancelled</div>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-rose-100 to-rose-200 rounded-xl flex items-center justify-center">
                        <i data-lucide="x-circle" class="w-6 h-6 text-rose-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6 mb-8">
            <div class="flex flex-wrap gap-4 items-center">
                <div class="flex items-center gap-2">
                    <i data-lucide="filter" class="w-5 h-5 text-slate-500"></i>
                    <span class="text-sm font-semibold text-slate-700">Filters</span>
                </div>
                <div class="flex flex-wrap gap-3 flex-1">
                    <select class="px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-white/80 backdrop-blur-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                        <option>All Status</option>
                        <option>Confirmed</option>
                        <option>Pending</option>
                        <option>Completed</option>
                        <option>Cancelled</option>
                    </select>
                    <select class="px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-white/80 backdrop-blur-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                        <option>All Categories</option>
                        <option>Environment</option>
                        <option>Community</option>
                        <option>Education</option>
                        <option>Healthcare</option>
                    </select>
                    <div class="relative flex-1 min-w-64">
                        <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="search" placeholder="Search events..."
                               class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-white/80 backdrop-blur-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                    </div>
                </div>
                <button class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-sm transition-all duration-200">
                    <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                    Clear
                </button>
            </div>
        </div>

        <!-- View Toggle & Sort -->
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-slate-700">View:</span>
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-1 border border-slate-200">
                        <button class="px-3 py-1.5 bg-black text-white rounded-lg text-sm font-medium transition-all duration-200">
                            <i data-lucide="list" class="w-4 h-4 mr-1"></i>
                            List
                        </button>
                        <button class="px-3 py-1.5 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-100 transition-all duration-200">
                            <i data-lucide="grid-3x3" class="w-4 h-4 mr-1"></i>
                            Grid
                        </button>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-slate-700">Sort by:</span>
                    <select class="px-3 py-1.5 border border-slate-200 rounded-lg text-sm bg-white/80 backdrop-blur-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200">
                        <option>Date (Newest)</option>
                        <option>Date (Oldest)</option>
                        <option>Status</option>
                        <option>Category</option>
                    </select>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-2 text-sm text-slate-600">
                <i data-lucide="calendar-check" class="w-4 h-4"></i>
                <span>Last updated: 2 hours ago</span>
            </div>
        </div>

        <!-- Events List (Desktop) -->
        <div class="hidden md:block bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-slate-50 to-slate-100/80 px-6 py-5 border-b border-slate-200/50">
                <div class="grid grid-cols-12 gap-4 text-sm font-semibold text-slate-700">
                    <div class="col-span-4">Event Details</div>
                    <div class="col-span-2">Date & Time</div>
                    <div class="col-span-2">Location</div>
                    <div class="col-span-1">Status</div>
                    <div class="col-span-2">Organizer</div>
                    <div class="col-span-1">Actions</div>
                </div>
            </div>

            <!-- Events List Items -->
            <div class="divide-y divide-slate-200/50">
                @foreach($participatingEvents as $item)
                    <div class="px-6 py-5 hover:bg-white/60 transition-all duration-200 group">
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <!-- Event Details -->
                            <div class="col-span-4">
                                <div class="flex items-start gap-4">
                                    <div class="relative">
                                        @php
                                             $gradientClass = $item->category->id ?? 'from-slate-400 to-slate-600';
                                        @endphp
                                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $gradientClass }} flex-shrink-0 flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                                            @if($item->category->id == '1')
                                                <i data-lucide="leaf" class="w-7 h-7 text-white"></i>
                                            @elseif($item->category->id == '2')
                                                <i data-lucide="users" class="w-7 h-7 text-white"></i>
                                            @elseif($item->category->id == '3')
                                                <i data-lucide="book" class="w-7 h-7 text-white"></i>
                                            @elseif($item->category->id == '4')
                                                <i data-lucide="heart" class="w-7 h-7 text-white"></i>
                                            @elseif($item->category->id == '5')
                                                <i data-lucide="heart" class="w-7 h-7 text-white"></i>
                                            @elseif($item->category->id == '6')
                                                <i data-lucide="heart" class="w-7 h-7 text-white"></i>
                                            @elseif($item->category->id == '7')
                                                <i data-lucide="heart" class="w-7 h-7 text-white"></i>

                                            @endif
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-white rounded-full flex items-center justify-center shadow-sm">
                                            @if($item->pivot->status == 'confirmed')
                                                <i data-lucide="check" class="w-3 h-3 text-emerald-500"></i>
                                            @elseif($item->pivot->status === 'pending')
                                                <i data-lucide="clock" class="w-3 h-3 text-amber-500"></i>
                                            @elseif($item->pivot->status === 'completed')
                                                <i data-lucide="trophy" class="w-3 h-3 text-violet-500"></i>
                                            @elseif($item->pivot->status === 'cancelled')
                                                <i data-lucide="x" class="w-3 h-3 text-rose-500"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h3 class="font-bold text-slate-900 mb-2 text-lg group-hover:text-blue-600 transition-colors duration-200">{{$item->name}}</h3>
                                        <p class="text-sm text-slate-600 line-clamp-2 mb-3">{{$item->description}}</p>
                                        <div class="flex items-center gap-3 text-xs">
                                            @php

                                                $badgeClass = $item->category->color ?? 'from-slate-100 to-slate-200 text-slate-700';
                                            @endphp
                                            <span class="px-3 py-1.5 bg-gradient-to-r {{ $badgeClass }} rounded-full font-medium"></span>
                                            <span class="flex items-center gap-1 text-slate-500">
                                                <i data-lucide="clock" class="w-3 h-3"></i>
                                                {{$item->starts_at->diffForHumans($item->ends_at)}}

                                            </span>
                                            <span class="flex items-center gap-1 text-slate-500">
                                                <i data-lucide="users" class="w-3 h-3"></i>
                                            {{$item->maximum_participants}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Date & Time -->
                            <div class="col-span-2">
                                <div class="bg-white/50 rounded-xl p-3 border border-slate-100">
                                    <div class="text-sm font-bold text-slate-900 mb-1">
                                        {{ date('M j, Y', strtotime($item->starts_at)) }}
                                    </div>
                                    <div class="text-sm text-slate-600 flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3 h-3"></i>
                                        {{ $item->starts_at->format('h:i A') }} - {{ $item->ends_at->format('h:i A') }}
                                    </div>
                                    <div class="text-xs text-slate-400 mt-2 flex items-center gap-1">
                                        <i data-lucide="calendar-plus" class="w-3 h-3"></i>
                                        Applied {{ date('M j', strtotime($item->pivot->created_at)) }}
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-span-2">
                                <div class="flex items-center gap-2 text-sm text-slate-600 bg-white/50 rounded-xl p-3 border border-slate-100">
                                    <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i data-lucide="map-pin" class="w-4 h-4 text-slate-500"></i>
                                    </div>
                                    <span class="font-medium">{{ $item->location }}</span>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-span-1">
                                @if($item->pivot->status === 'confirmed')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-700 shadow-sm">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></div>
                                        Confirmed
                                    </span>
                                @elseif($item->pivot->status === 'pending')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700 shadow-sm">
                                        <div class="w-2 h-2 bg-amber-500 rounded-full mr-2 animate-pulse"></div>
                                        Pending
                                    </span>
                                @elseif($item->pivot->status === 'completed')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-violet-100 to-purple-100 text-violet-700 shadow-sm">
                                        <i data-lucide="check-circle" class="w-3 h-3 mr-2"></i>
                                        Completed
                                    </span>
                                @elseif($item->pivot->status === 'cancelled')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-rose-100 to-red-100 text-rose-700 shadow-sm">
                                        <i data-lucide="x-circle" class="w-3 h-3 mr-2"></i>
                                        Cancelled
                                    </span>
                                @endif
                            </div>

                            <!-- Organizer -->
                            <div class="col-span-2">
                                <div class="flex items-center gap-3 bg-white/50 rounded-xl p-3 border border-slate-100">
                                    <div class="relative">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-sm font-bold text-white shadow-md">
                                                {{ $item->user->name ? substr($item->user->name, 0, 1) : '' }}                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-sm font-semibold text-slate-900">{{ $item->user->name }}</div>
                                        <div class="text-xs text-slate-500">Event Organizer</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="col-span-1">
                                <div class="flex items-center gap-2">
                                    @if($item->pivot->status === 'pending')
                                        <button class="group relative p-2.5 text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl transition-all duration-200 hover:shadow-lg" title="Cancel">
                                            <i data-lucide="x" class="w-4 h-4"></i>
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Cancel</div>
                                        </button>
                                        <button class="group relative p-2.5 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition-all duration-200 hover:shadow-lg" title="Message">
                                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Message</div>
                                        </button>
                                    @elseif($item->pivot->status === 'confirmed')
                                        <button class="group relative p-2.5 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition-all duration-200 hover:shadow-lg" title="View Details">
                                            <i data-lucide="external-link" class="w-4 h-4"></i>
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Details</div>
                                        </button>
                                        <button class="group relative p-2.5 text-green-600 bg-green-50 hover:bg-green-100 rounded-xl transition-all duration-200 hover:shadow-lg" title="Message">
                                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Message</div>
                                        </button>
                                    @elseif($item->pivot->status === 'completed')
                                        <button class="group relative p-2.5 text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-xl transition-all duration-200 hover:shadow-lg" title="Rate Event">
                                            <i data-lucide="star" class="w-4 h-4"></i>
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Rate</div>
                                        </button>
                                        <button class="group relative p-2.5 text-violet-600 bg-violet-50 hover:bg-violet-100 rounded-xl transition-all duration-200 hover:shadow-lg"
                                                title="Download Certificate">
                                            <i data-lucide="download" class="w-4 h-4"></i>
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Certificate</div>
                                        </button>
                                    @else
                                        <button class="group relative p-2.5 text-slate-400 bg-slate-50 hover:bg-slate-100 rounded-xl transition-all duration-200 hover:shadow-lg" title="View Details">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">View</div>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Mobile Card View (Hidden on larger screens) -->
        <div class="md:hidden space-y-4 mb-8">
            @foreach($participatingEvents as $item)
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 overflow-hidden">
                    <!-- Card Header -->
                    <div class="p-5 border-b border-slate-100">
                        <div class="flex items-start gap-4">
                            @php
                                $categoryColors = [
                                    1 => 'from-emerald-400 to-teal-600',
                                    2 => 'from-blue-400 to-indigo-600',
                                    3 => 'from-violet-400 to-purple-600',
                                    4 => 'from-rose-400 to-pink-600'
                                ];
                                $gradientClass = $categoryColors[$item->category->id ?? null] ?? 'from-slate-400 to-slate-600';
                            @endphp
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $gradientClass }} flex items-center justify-center shadow-lg">
                                @if($item->category->id == 1)
                                    <i data-lucide="leaf" class="w-6 h-6 text-white"></i>
                                @elseif($item->category->id == 2)
                                    <i data-lucide="users" class="w-6 h-6 text-white"></i>
                                @elseif($item->category->id == 3)
                                    <i data-lucide="book" class="w-6 h-6 text-white"></i>
                                @elseif($item->category->id == 4)
                                    <i data-lucide="heart" class="w-6 h-6 text-white"></i>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-slate-900 text-lg mb-1">{{ $item->name }}</h3>
                                <p class="text-sm text-slate-600 line-clamp-2">{{ $item->description }}</p>
                            </div>
                            @if($item->pivot->status === 'confirmed')
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-bold bg-emerald-100 text-emerald-700">
                                    <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1"></div>
                                    Confirmed
                                </span>
                            @elseif($item->pivot->status === 'pending')
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-bold bg-amber-100 text-amber-700">
                                    <div class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1"></div>
                                    Pending
                                </span>
                            @elseif($item->pivot->status === 'completed')
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-bold bg-violet-100 text-violet-700">
                                    <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                    Completed
                                </span>
                            @elseif($item->pivot->status === 'cancelled')
                                <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-bold bg-rose-100 text-rose-700">
                                    <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                    Cancelled
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 space-y-4">
                        <!-- Date & Location -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center gap-2 text-sm">
                                <i data-lucide="calendar" class="w-4 h-4 text-slate-500"></i>
                                <div>
                                    <div class="font-medium text-slate-900">{{ $item->starts_at ? $item->starts_at->format('M j, Y') : '' }}</div>
                                    <div class="text-slate-500">{{ $item->starts_at ? $item->starts_at->format('h:i A') : '' }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <i data-lucide="map-pin" class="w-4 h-4 text-slate-500"></i>
                                <div>
                                    <div class="font-medium text-slate-900">{{ $item->location }}</div>
                                    <div class="text-slate-500">Location</div>
                                </div>
                            </div>
                        </div>

                        <!-- Event Info -->
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-4">
                                @php
                                    $badgeColors = [
                                        1 => 'from-emerald-100 to-teal-100 text-emerald-700',
                                        2 => 'from-blue-100 to-indigo-100 text-blue-700',
                                        3 => 'from-violet-100 to-purple-100 text-violet-700',
                                        4 => 'from-rose-100 to-pink-100 text-rose-700'
                                    ];
                                    $badgeClass = $badgeColors[$item->category->id ?? null] ?? 'from-slate-100 to-slate-200 text-slate-700';
                                @endphp
                                <span class="px-2 py-1 bg-gradient-to-r {{ $badgeClass }} rounded-lg font-medium">{{ $item->category->name ?? '' }}</span>
                                <span class="text-slate-500">{{ $item->duration ?? '' }}</span>
                            </div>
                            <span class="text-slate-500">{{ $item->maximum_participants }} volunteers</span>
                        </div>

                        <!-- Organizer -->
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-sm font-bold text-white">
                                {{ $item->user->name ? substr($item->user->name, 0, 1) : '' }}
                            </div>
                            <div>
                                <div class="text-sm font-medium text-slate-900">{{ $item->user->name ?? '' }}</div>
                                <div class="text-xs text-slate-500">Event Organizer</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="px-5 py-4 bg-slate-50/50 border-t border-slate-100">
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-slate-500">
                                Applied {{ $item->pivot->created_at ? $item->pivot->created_at->format('M j') : '' }}
                            </div>
                            <div class="flex items-center gap-2">
                                @if($item->pivot->status === 'pending')
                                    <button class="p-2 text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg transition-all duration-200">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                    <button class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200">
                                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                                    </button>
                                @elseif($item->pivot->status === 'confirmed')
                                    <button class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200">
                                        <i data-lucide="external-link" class="w-4 h-4"></i>
                                    </button>
                                    <button class="p-2 text-green-600 bg-green-50 hover:bg-green-100 rounded-lg transition-all duration-200">
                                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                                    </button>
                                @elseif($item->pivot->status === 'completed')
                                    <button class="p-2 text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg transition-all duration-200">
                                        <i data-lucide="star" class="w-4 h-4"></i>
                                    </button>
                                    <button class="p-2 text-violet-600 bg-violet-50 hover:bg-violet-100 rounded-lg transition-all duration-200">
                                        <i data-lucide="download" class="w-4 h-4"></i>
                                    </button>
                                @else
                                    <button class="p-2 text-slate-400 bg-slate-50 hover:bg-slate-100 rounded-lg transition-all duration-200">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex items-center justify-between bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
            <div class="flex items-center gap-2 text-sm text-slate-600">
                <i data-lucide="list" class="w-4 h-4"></i>
                <span>Showing <span class="font-semibold text-slate-900">1-5</span> of <span class="font-semibold text-slate-900">5</span> events</span>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i data-lucide="chevron-left" class="w-4 h-4 mr-1"></i>
                    Previous
                </button>
                <div class="flex items-center gap-2">
                    <button class="w-10 h-10 bg-black text-white rounded-xl text-sm font-semibold shadow-lg">1</button>
                    <button class="w-10 h-10 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">2</button>
                    <button class="w-10 h-10 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">3</button>
                    <span class="text-slate-400">...</span>
                    <button class="w-10 h-10 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">10</button>
                </div>
                <button
                    class="px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-600 hover:bg-white hover:shadow-md transition-all duration-200">
                    Next
                    <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                </button>
            </div>
        </div>

        <!-- Quick Actions FAB -->
        <div class="fixed bottom-6 right-6 flex flex-col gap-3 z-10">
            <button class="group w-14 h-14 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center">
                <i data-lucide="plus" class="w-6 h-6 group-hover:rotate-90 transition-transform duration-300"></i>
            </button>
            <button class="w-12 h-12 bg-white/90 backdrop-blur-sm text-slate-600 rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 border border-white/20 flex items-center justify-center md:hidden">
                <i data-lucide="filter" class="w-5 h-5"></i>
            </button>
        </div>
    </div>
</x-volunteer.dashboard-layout>
