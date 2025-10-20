<x-admin.dashboard-layout>
    <div class="min-h-screen p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                        Report
                        <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                            Handling
                        </span>
                    </h1>
                    <p class="text-slate-600 text-lg">Manage reported events and critical actions</p>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform translate-y-2"
                class="mb-6 {{ session('message_type') === 'info' ? 'bg-blue-50 border-blue-200 text-blue-700' : 'bg-green-50 border-green-200 text-green-700' }} border px-4 py-3 rounded-lg flex items-center shadow-lg">
                <i class="fas fa-{{ session('message_icon', 'check-circle') }} mr-2 text-xl"></i>
                <span class="font-medium">{{ session('message') }}</span>
                <button @click="show = false" class="ml-auto text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Events Table -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6">
            <!-- Search & Filters -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div class="flex gap-2 w-full md:w-auto">
                    <input type="text" id="searchInput" placeholder="Search events..."
                        class="input input-bordered w-full md:w-64 rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all duration-200 border border-slate-200 focus:border-accent bg-white" />
                    <select id="statusFilter"
                        class="select select-bordered rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all duration-200 border border-slate-200 focus:border-accent bg-white">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="hidden">Hidden</option>
                    </select>
                    <select id="reportFilter"
                        class="select select-bordered rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all duration-200 border border-slate-200 focus:border-accent bg-white">
                        <option value="">All Events</option>
                        <option value="reported">Reported (3+ Reports)</option>
                        <option value="low">Low Reports (1-2)</option>
                        <option value="none">No Reports</option>
                    </select>
                </div>
            </div>

            <!-- Table -->
            <div class="border border-slate-200 overflow-hidden rounded-2xl shadow-sm">
                <table class="min-w-full bg-white" id="eventsTable">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Event Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Organizer</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Category</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Date</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Reports</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $allEvents = $reportedEvents->concat($otherEvents)->sortByDesc('reports_count');
                        @endphp
                        @forelse($allEvents as $event)
                            <tr class="border-t border-slate-100 hover:bg-slate-50/50 transition-colors duration-200"
                                data-event-name="{{ strtolower($event->name) }}"
                                data-organizer="{{ strtolower($event->user->name ?? 'N/A') }}"
                                data-category="{{ strtolower($event->category->name ?? 'N/A') }}"
                                data-status="{{ $event->is_active ? 'active' : 'hidden' }}"
                                data-reports="{{ $event->reports_count }}" x-data="{ loading: false }"
                                x-on:event-status-changed.window="if ($event.detail.eventId === {{ $event->id }}) { loading = false; }"
                                x-on:reports-dismissed.window="if ($event.detail.eventId === {{ $event->id }}) { loading = false; }">

                                <!-- Event Name with Priority Badge -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="font-medium text-slate-900">{{ $event->name }}</span>
                                        @if($event->reports_count >= 5)
                                            <span
                                                class="px-2 py-0.5 bg-red-600 text-white rounded-full text-xs font-bold animate-pulse">
                                                PRIORITY
                                            </span>
                                        @endif
                                    </div>
                                    @if($event->reports_count >= 3)
                                        <div class="text-xs text-gray-500 mt-1">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Recent: {{ $event->reports->first()->reason ?? 'N/A' }}
                                        </div>
                                    @endif
                                </td>

                                <!-- Organizer -->
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $event->user->name ?? 'N/A' }}
                                </td>

                                <!-- Category -->
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $event->category->name ?? 'N/A' }}
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $event->starts_at->format('M j, Y') }}
                                </td>

                                <!-- Reports Count -->
                                <td class="px-6 py-4">
                                    @if($event->reports_count >= 3)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-bold bg-gradient-to-r from-red-100 to-red-200 text-red-800">
                                            <i class="fas fa-exclamation-triangle mr-1.5"></i>
                                            {{ $event->reports_count }} {{ Str::plural('Report', $event->reports_count) }}
                                        </span>
                                    @elseif($event->reports_count > 0)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700">
                                            <i class="fas fa-flag mr-1.5"></i>
                                            {{ $event->reports_count }} {{ Str::plural('Report', $event->reports_count) }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium bg-gradient-to-r from-green-100 to-emerald-100 text-green-700">
                                            <i class="fas fa-check-circle mr-1.5"></i>
                                            No Reports
                                        </span>
                                    @endif
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @if($event->is_active)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-700">
                                            <i class="fas fa-eye mr-1.5"></i>
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium bg-gradient-to-r from-gray-100 to-slate-100 text-gray-700">
                                            <i class="CircleX mr-1.5"></i>
                                            Hidden
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex gap-2 relative">
                                        <!-- Loading Overlay -->
                                        <div x-show="loading" x-cloak
                                            class="absolute inset-0 bg-white/80 backdrop-blur-sm rounded-lg flex items-center justify-center z-10">
                                            <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-primary"></div>
                                        </div>

                                        <!-- View Event -->
                                        <a href="/admin/dashboard/event-details/{{ $event->id }}"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition-colors border border-slate-200 shadow-sm group relative"
                                            title="View Details">
                                            <i data-lucide="file-text" class="w-4 h-4"></i>
                                            <span
                                                class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-20">
                                                View Details
                                            </span>
                                        </a>

                                        <!-- Toggle Status -->
                                        @if($event->is_active)
                                            <button wire:click="toggleEventStatus({{ $event->id }})" x-on:click="loading = true"
                                                wire:confirm="{{ $event->reports_count >= 3 ? 'Are you sure you want to hide this event?' : 'Warning: This event has only ' . $event->reports_count . ' report(s). Events typically require 3+ reports to be hidden. Hide anyway?' }}"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white text-slate-600 hover:bg-red-50 hover:text-red-600 transition-colors border border-slate-200 shadow-sm group relative"
                                                title="Hide Event">
                                                <i data-lucide="eye-off" class="w-4 h-4"></i>
                                                <span
                                                    class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-20">
                                                    Hide Event
                                                </span>
                                            </button>
                                        @else
                                            <button wire:click="toggleEventStatus({{ $event->id }})" x-on:click="loading = true"
                                                wire:confirm="Are you sure you want to show this event?"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white text-slate-600 hover:bg-green-50 hover:text-green-600 transition-colors border border-slate-200 shadow-sm group relative"
                                                title="Show Event">
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                                <span
                                                    class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-20">
                                                    Show Event
                                                </span>
                                            </button>
                                        @endif

                                        <!-- Dismiss Reports (only if has reports) -->
                                        @if($event->reports_count > 0)
                                            <button wire:click="dismissReports({{ $event->id }})" x-on:click="loading = true"
                                                wire:confirm="Dismiss all {{ $event->reports_count }} reports for this event?"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors border border-slate-200 shadow-sm group relative"
                                                title="Dismiss Reports">
                                                <i data-lucide="x-circle" class="w-4 h-4"></i>
                                                <span
                                                    class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Dismiss
                                                    Reports</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center">
                                            <i data-lucide="calendar-x" class="w-8 h-8 text-slate-400"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-slate-900">No events found</h3>
                                            <p class="text-sm text-slate-500 mt-1">No events match your current filters.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Search and filter functionality
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const reportFilter = document.getElementById('reportFilter');
            const tableRows = document.querySelectorAll('#eventsTable tbody tr[data-event-name]');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedStatus = statusFilter.value.toLowerCase();
                const selectedReport = reportFilter.value;

                tableRows.forEach(row => {
                    const eventName = row.getAttribute('data-event-name');
                    const organizer = row.getAttribute('data-organizer');
                    const category = row.getAttribute('data-category');
                    const status = row.getAttribute('data-status');
                    const reportsCount = parseInt(row.getAttribute('data-reports'));

                    // Search filter
                    const matchesSearch = !searchTerm ||
                        eventName.includes(searchTerm) ||
                        organizer.includes(searchTerm) ||
                        category.includes(searchTerm);

                    // Status filter
                    const matchesStatus = !selectedStatus || status === selectedStatus;

                    // Report filter
                    let matchesReport = true;
                    if (selectedReport === 'reported') {
                        matchesReport = reportsCount >= 3;
                    } else if (selectedReport === 'low') {
                        matchesReport = reportsCount > 0 && reportsCount < 3;
                    } else if (selectedReport === 'none') {
                        matchesReport = reportsCount === 0;
                    }

                    // Show/hide row
                    if (matchesSearch && matchesStatus && matchesReport) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Attach event listeners
            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
            reportFilter.addEventListener('change', filterTable);

            // Initialize Lucide icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        // Reinitialize Lucide icons after Livewire updates
        document.addEventListener('livewire:navigated', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</x-admin.dashboard-layout>