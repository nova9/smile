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
    <div class="min-h-screen  via-white to-primary/10">
        <div class="container mx-auto px-4 py-10">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-5xl font-extrabold text-accent mb-2 tracking-tight">
                        Community
                        <span class="bg-clip-text ">Space</span>
                    </h1>
                    <p class="text-lg text-gray-500">Connect, collaborate, and make an impact together.</p>
                </div>
            </div>
            @isset($event)
                <div class="bg-white rounded-3xl shadow-2xl  overflow-hidden">
                    <!-- Hero/Event Header -->
                    <div class="relative h-72 sm:h-96">
                        <img src="https://picsum.photos/seed/{{ $event->id }}/1200/800" alt="Event Image"
                            class="w-full h-full object-cover opacity-80">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <h1 class="text-4xl sm:text-5xl font-bold text-white drop-shadow-xl">{{ $event->name }}
                                </h1>
                                <div
                                    class="mt-3 px-5 py-2 bg-white/80 rounded-full text-base font-semibold text-amber-800 inline-block shadow">
                                    {{ $event->category->name }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Main Content -->
                    <div class="p-8 sm:p-12">
                        <!-- Event Overview -->
                        <div class="mb-10">
                            <p class="text-gray-700 text-xl text-center max-w-3xl mx-auto leading-relaxed">
                                {{ Str::limit($event->description, 220) }}</p>
                        </div>
                        <!-- Quick Info Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                            <div class="bg-gray-50 rounded-xl p-5 text-center shadow">
                                <i data-lucide="calendar" class="w-8 h-8 text-amber-600 mx-auto mb-2"></i>
                                <div class="text-sm text-gray-500">Date</div>
                                <div class="font-bold text-gray-800 text-lg">{{ $event->starts_at->format('M j') }} -
                                    {{ $event->ends_at->format('M j') }}</div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-5 text-center shadow">
                                <i data-lucide="clock" class="w-8 h-8 text-amber-600 mx-auto mb-2"></i>
                                <div class="text-sm text-gray-500">Time</div>
                                <div class="font-bold text-gray-800 text-lg">{{ $event->starts_at->format('h:i A') }}</div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-5 text-center shadow">
                                <i data-lucide="map-pin" class="w-8 h-8 text-amber-600 mx-auto mb-2"></i>
                                <div class="text-sm text-gray-500">Location</div>
                                <div class="font-bold text-gray-800 text-lg">{{ $event->location ?? 'TBD' }}</div>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-5 text-center shadow">
                                <i data-lucide="users" class="w-8 h-8 text-amber-600 mx-auto mb-2"></i>
                                <div class="text-sm text-gray-500">Spots</div>
                                <div class="font-bold text-gray-800 text-lg">{{ $event->users->count() }} /
                                    {{ $event->maximum_participants ?? 'Unlimited' }}</div>
                            </div>
                        </div>
                        <!-- Main Content Grid -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- Left Column -->
                            <div class="lg:col-span-2 space-y-8">

                                <!-- Community Chat -->
                                <div class="mt-12 rounded-xl p-8 bg-gray-50 shadow">
                                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Community Chat</h2>
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6"
                                        id="chatThread">
                                        <div class="avatar-group -space-x-6 flex flex-row">
                                            <div class="avatar">
                                                <div class="w-14">
                                                    <img
                                                        src="https://img.daisyui.com/images/profile/demo/batperson@192.webp" />
                                                </div>
                                            </div>
                                            <div class="avatar">
                                                <div class="w-14">
                                                    <img
                                                        src="https://img.daisyui.com/images/profile/demo/spiderperson@192.webp" />
                                                </div>
                                            </div>
                                            <div class="avatar">
                                                <div class="w-14">
                                                    <img
                                                        src="https://img.daisyui.com/images/profile/demo/averagebulk@192.webp" />
                                                </div>
                                            </div>
                                            <div class="avatar avatar-placeholder">
                                                <div
                                                    class="bg-amber-400 text-neutral-content w-14 flex items-center justify-center text-lg font-bold">
                                                    <span>+99</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex justify-center sm:mt-0 mt-8">
                                            <button class="w-full btn btn-outline btn-lg font-semibold">

                                                <i data-lucide="users" class="w-6 h-6 mr-2"></i>
                                                Join the Community
                                            </button>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Right Column -->
                            <div class="space-y-8">
                                <!-- Organizer Card -->
                                <div class="bg-gray-50 rounded-xl p-8 shadow">
                                    <h3 class="text-xl font-bold text-gray-800 mb-5">Hosted By</h3>
                                    <div class="flex items-center gap-5 mb-5">
                                        <div
                                            class="w-14 h-14 rounded-full bg-amber-400 text-white flex items-center justify-center text-2xl font-extrabold">
                                            {{ strtoupper(substr($event->user->name, 0, 1)) }}</div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-lg">{{ $event->user->name }}</h4>
                                        </div>
                                    </div>

                                </div>
                                <!-- Action Buttons -->
                                <div class="space-y-4">
                                    <button class="w-full btn btn-outline btn-lg font-semibold">
                                        <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
                                        Message Host
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endisset
        </div>
    </div>
</x-volunteer.dashboard-layout>
