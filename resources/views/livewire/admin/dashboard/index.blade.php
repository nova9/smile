<x-admin.dashboard-layout>
    <!-- Main Dashboard Header -->
    <div class="text-center mt-10 mb-8">
        <h2
            class="text-4xl sm:text-5xl font-bold text-accent leading-tight relative bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent">
            Admin Dashboard
            <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-32 h-3 text-primary/30"
                viewBox="0 0 100 12" fill="none">
                <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" />
            </svg>
        </h2>
        <p class="text-lg text-gray-600 mt-2">Overview of users, organizations, and critical actions</p>
    </div>

    <!-- Loading Overlay -->
    <div wire:loading.flex class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-xl">
            <div class="flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-primary"></div>
                <span class="text-gray-700">Loading dashboard data...</span>
            </div>
        </div>
    </div>

    <!-- Error Message -->
    @if($errorMessage)
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span>{{ $errorMessage }}</span>
                <button wire:click="retryLoad" class="ml-auto text-red-600 hover:text-red-800">
                    <i class="fas fa-redo"></i> Retry
                </button>
            </div>
        </div>
    @endif

    <!-- User & Account Overview -->
    <div class="mb-10">
        <div class="bg-white/90 rounded-3xl shadow-xl p-8">
            <div wire:loading.remove wire:target="loadStats">
                <x-admin.stats-card :stats="$userStats" />
            </div>
            <div wire:loading wire:target="loadStats" class="text-center py-8">
                <div class="animate-pulse space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @for($i = 0; $i < 4; $i++)
                            <div class="bg-gray-200 h-24 rounded-lg"></div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div 
            x-data="{ show: true }" 
            x-show="show"
            x-init="setTimeout(() => show = false, 5000)"
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

    <!-- Quick Event Controls -->
    <div class="mb-10">
        <!-- Reported Events Section (Priority) -->
        @if($reportedEvents->count() > 0)
            <div class="bg-red-50 border-2 border-red-200 rounded-3xl shadow-xl p-8 mb-6">
                <div class="flex items-center gap-3 mb-6">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                    <h3 class="text-2xl font-bold text-red-700">
                        Reported Events ({{ $reportedEvents->sum('reports_count') }} Reports)
                    </h3>
                </div>
                
                <div class="space-y-3">
                    @foreach($reportedEvents as $event)
                        <div 
                            x-data="{ loading: false }" 
                            x-on:event-status-changed.window="if ($event.detail.eventId === {{ $event->id }}) { loading = false; }"
                            x-on:reports-dismissed.window="if ($event.detail.eventId === {{ $event->id }}) { loading = false; }"
                            class="bg-white border-2 border-red-300 rounded-lg p-5 shadow-md transition-all duration-300 hover:shadow-xl"
                            :class="{ 'opacity-50': loading }">
                            
                            <!-- Loading Overlay -->
                            <div x-show="loading" x-cloak class="absolute inset-0 bg-white/80 backdrop-blur-sm rounded-lg flex items-center justify-center z-10">
                                <div class="flex items-center gap-2">
                                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-primary"></div>
                                    <span class="text-sm font-medium text-gray-600">Processing...</span>
                                </div>
                            </div>
                            
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h4 class="font-bold text-gray-900 text-xl">{{ $event->name }}</h4>
                                        <span class="px-3 py-1 bg-red-600 text-white rounded-full text-sm font-bold inline-flex items-center">
                                            <i class="fas fa-flag mr-1.5"></i>
                                            {{ $event->reports_count }} {{ Str::plural('Report', $event->reports_count) }}
                                        </span>
                                        @if($event->reports_count >= 5)
                                            <span class="px-3 py-1 bg-red-700 text-white rounded-full text-xs font-bold animate-pulse">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                PRIORITY
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-sm text-gray-600 space-y-1">
                                        <div class="flex items-center gap-4">
                                            <span class="inline-flex items-center">
                                                <i class="fas fa-user text-gray-400 mr-2"></i>
                                                By: {{ $event->user->name ?? 'N/A' }}
                                            </span>
                                            <span class="inline-flex items-center">
                                                <i class="fas fa-tag text-gray-400 mr-2"></i>
                                                {{ $event->category->name ?? 'N/A' }}
                                            </span>
                                            <span class="inline-flex items-center">
                                                <i class="fas fa-calendar text-gray-400 mr-2"></i>
                                                {{ $event->starts_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Report Reasons -->
                                    <div class="mt-3 p-3 bg-red-50 rounded-lg">
                                        <div class="text-sm font-semibold text-red-800 mb-2">Report Reasons:</div>
                                        <div class="space-y-1">
                                            @foreach($event->reports->take(3) as $report)
                                                <div class="text-sm text-gray-700">
                                                    <i class="fas fa-circle text-red-400 mr-2" style="font-size: 6px;"></i>
                                                    <span class="font-medium">{{ $report->user->name }}:</span> {{ $report->reason }}
                                                    @if($report->details)
                                                        - "{{ Str::limit($report->details, 50) }}"
                                                    @endif
                                                </div>
                                            @endforeach
                                            @if($event->reports_count > 3)
                                                <div class="text-sm text-red-600 font-medium mt-1">
                                                    + {{ $event->reports_count - 3 }} more reports
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col gap-2 ml-4 min-w-[200px]">
                                    @if($event->is_active)
                                        <span class="px-3 py-1.5 bg-green-100 text-green-800 rounded-lg text-sm font-medium text-center">
                                            <i class="fas fa-eye mr-1.5"></i>
                                            Active
                                        </span>
                                    @else
                                        <span class="px-3 py-1.5 bg-gray-100 text-gray-800 rounded-lg text-sm font-medium text-center">
                                            <i class="fas fa-eye-slash mr-1.5"></i>
                                            Hidden
                                        </span>
                                    @endif
                                    
                                    <a href="/admin/dashboard/event-details/{{ $event->id }}" 
                                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 font-medium text-center transform hover:scale-105 active:scale-95 shadow-md hover:shadow-lg">
                                        <i class="fas fa-search mr-2"></i>
                                        View Event
                                    </a>
                                    
                                    @if($event->is_active)
                                        <button 
                                            wire:click="toggleEventStatus({{ $event->id }})"
                                            x-on:click="loading = true"
                                            wire:confirm="Are you sure you want to disable this reported event?"
                                            wire:loading.attr="disabled"
                                            wire:loading.class="opacity-50 cursor-not-allowed"
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 font-medium transform hover:scale-105 active:scale-95">
                                            <span wire:loading.remove wire:target="toggleEventStatus({{ $event->id }})">
                                                <i class="fas fa-ban mr-2"></i>
                                                Disable Event
                                            </span>
                                            <span wire:loading wire:target="toggleEventStatus({{ $event->id }})" class="flex items-center justify-center">
                                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                                Processing...
                                            </span>
                                        </button>
                                    @else
                                        <button 
                                            wire:click="toggleEventStatus({{ $event->id }})"
                                            x-on:click="loading = true"
                                            wire:confirm="Are you sure you want to enable this reported event?"
                                            wire:loading.attr="disabled"
                                            wire:loading.class="opacity-50 cursor-not-allowed"
                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 font-medium transform hover:scale-105 active:scale-95">
                                            <span wire:loading.remove wire:target="toggleEventStatus({{ $event->id }})">
                                                <i class="fas fa-check mr-2"></i>
                                                Enable Event
                                            </span>
                                            <span wire:loading wire:target="toggleEventStatus({{ $event->id }})" class="flex items-center justify-center">
                                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                                Processing...
                                            </span>
                                        </button>
                                    @endif
                                    
                                    <button 
                                        wire:click="dismissReports({{ $event->id }})"
                                        x-on:click="loading = true"
                                        wire:confirm="Dismiss all reports for this event?"
                                        wire:loading.attr="disabled"
                                        wire:loading.class="opacity-50 cursor-not-allowed"
                                        class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all duration-200 font-medium transform hover:scale-105 active:scale-95">
                                        <span wire:loading.remove wire:target="dismissReports({{ $event->id }})">
                                            <i class="fas fa-times mr-2"></i>
                                            Dismiss Reports
                                        </span>
                                        <span wire:loading wire:target="dismissReports({{ $event->id }})" class="flex items-center justify-center">
                                            <i class="fas fa-spinner fa-spin mr-2"></i>
                                            Dismissing...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        
        <!-- Regular Events Section -->
        <div class="bg-white/90 rounded-3xl shadow-xl p-8">
            <h3 class="text-2xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent mb-6">
                Other Events
            </h3>
            
            <div class="space-y-3">
                @forelse($otherEvents as $event)
                    <div 
                        x-data="{ loading: false }" 
                        x-on:event-status-changed.window="if ($event.detail.eventId === {{ $event->id }}) { loading = false; }"
                        class="flex items-center justify-between p-4 border border-gray-200 rounded-lg transition-all duration-300 hover:bg-gray-50 hover:shadow-md hover:border-gray-300"
                        :class="{ 'opacity-50': loading }">
                        
                        <!-- Loading Overlay -->
                        <div x-show="loading" x-cloak class="absolute inset-0 bg-white/80 backdrop-blur-sm rounded-lg flex items-center justify-center z-10">
                            <div class="flex items-center gap-2">
                                <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-primary"></div>
                                <span class="text-sm font-medium text-gray-600">Processing...</span>
                            </div>
                        </div>
                        
                        <div class="flex-1">
                            <div class="font-semibold text-gray-900 text-lg">{{ $event->name }}</div>
                            <div class="text-sm text-gray-500 mt-1">
                                <span class="inline-flex items-center">
                                    <i class="fas fa-user text-gray-400 mr-1"></i>
                                    By: {{ $event->user->name ?? 'N/A' }}
                                </span>
                                <span class="mx-2">|</span>
                                <span class="inline-flex items-center">
                                    <i class="fas fa-tag text-gray-400 mr-1"></i>
                                    {{ $event->category->name ?? 'N/A' }}
                                </span>
                                <span class="mx-2">|</span>
                                <span class="inline-flex items-center">
                                    <i class="fas fa-calendar text-gray-400 mr-1"></i>
                                    {{ $event->starts_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 ml-4">
                            @if($event->is_active)
                                <span class="px-3 py-1.5 bg-green-100 text-green-800 rounded-full text-sm font-medium inline-flex items-center transition-all duration-200">
                                    <i class="fas fa-eye mr-1.5"></i>
                                    Active
                                </span>
                                <button 
                                    wire:click="toggleEventStatus({{ $event->id }})"
                                    x-on:click="loading = true"
                                    wire:confirm="Are you sure you want to hide this event from volunteers?"
                                    wire:loading.attr="disabled"
                                    wire:loading.class="opacity-50 cursor-not-allowed"
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 font-medium inline-flex items-center transform hover:scale-105 active:scale-95">
                                    <span wire:loading.remove wire:target="toggleEventStatus({{ $event->id }})">
                                        <i class="fas fa-eye-slash mr-2"></i>
                                        Hide
                                    </span>
                                    <span wire:loading wire:target="toggleEventStatus({{ $event->id }})" class="flex items-center">
                                        <i class="fas fa-spinner fa-spin mr-2"></i>
                                        Hiding...
                                    </span>
                                </button>
                            @else
                                <span class="px-3 py-1.5 bg-red-100 text-red-800 rounded-full text-sm font-medium inline-flex items-center transition-all duration-200">
                                    <i class="fas fa-eye-slash mr-1.5"></i>
                                    Hidden
                                </span>
                                <button 
                                    wire:click="toggleEventStatus({{ $event->id }})"
                                    x-on:click="loading = true"
                                    wire:confirm="Are you sure you want to show this event to volunteers?"
                                    wire:loading.attr="disabled"
                                    wire:loading.class="opacity-50 cursor-not-allowed"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 font-medium inline-flex items-center transform hover:scale-105 active:scale-95">
                                    <span wire:loading.remove wire:target="toggleEventStatus({{ $event->id }})">
                                        <i class="fas fa-eye mr-2"></i>
                                        Show
                                    </span>
                                    <span wire:loading wire:target="toggleEventStatus({{ $event->id }})" class="flex items-center">
                                        <i class="fas fa-spinner fa-spin mr-2"></i>
                                        Showing...
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-calendar-times text-4xl text-gray-400 mb-4"></i>
                        <p>No events found</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Critical Actions Required & Recent Admin Actions -->
    <div class="mb-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Pending Actions Table -->
            <div class="bg-white/90 rounded-3xl shadow-xl p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3
                        class="text-2xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent">
                        Pending Actions Required
                    </h3>
                    <button wire:click="refreshPendingActions" class="text-gray-500 hover:text-primary">
                        <i class="fas fa-sync-alt {{ $refreshing ? 'animate-spin' : '' }}"></i>
                    </button>
                </div>

                <div wire:loading.remove wire:target="loadPendingActions">
                    @if(count($pendingActions) > 0)
                                    <x-admin.data-table :columns="[
                            ['key' => 'type', 'label' => 'Type', 'type' => 'text'],
                            ['key' => 'count', 'label' => 'Count', 'type' => 'text'],
                            ['key' => 'priority', 'label' => 'Priority', 'type' => 'badge']
                        ]" :data="$pendingActions" />
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-check-circle text-4xl text-green-500 mb-4"></i>
                            <p>No pending actions required</p>
                        </div>
                    @endif
                </div>

                <div wire:loading wire:target="loadPendingActions" class="text-center py-8">
                    <div class="animate-pulse space-y-3">
                        @for($i = 0; $i < 3; $i++)
                            <div class="bg-gray-200 h-12 rounded"></div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Recent Admin Actions -->
            <div class="bg-white/90 rounded-3xl shadow-xl p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3
                        class="text-2xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent">
                        Recent Admin Actions
                    </h3>
                    <button wire:click="refreshRecentActions" class="text-gray-500 hover:text-primary">
                        <i class="fas fa-sync-alt {{ $refreshing ? 'animate-spin' : '' }}"></i>
                    </button>
                </div>

                <div wire:loading.remove wire:target="loadRecentActions">
                    <div class="space-y-4">
                        @forelse($recentActions as $action)
                            <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-xl shadow">
                                <div
                                    class="w-10 h-10 {{ $action['icon_bg'] }} rounded-full flex items-center justify-center">
                                    <i class="{{ $action['icon'] }} {{ $action['icon_color'] }} text-lg"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-base font-semibold text-gray-900">{{ $action['title'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $action['description'] }} -
                                        {{ $action['time_ago'] }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-history text-4xl text-gray-400 mb-4"></i>
                                <p>No recent admin actions</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div wire:loading wire:target="loadRecentActions" class="text-center py-8">
                    <div class="animate-pulse space-y-4">
                        @for($i = 0; $i < 3; $i++)
                            <div class="flex items-center space-x-3 p-4">
                                <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
                                <div class="flex-1 space-y-2">
                                    <div class="bg-gray-200 h-4 rounded w-3/4"></div>
                                    <div class="bg-gray-200 h-3 rounded w-1/2"></div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Auto-refresh indicator -->
    <div class="fixed bottom-4 right-4 z-40">
        <div class="bg-white rounded-lg shadow-lg p-3 flex items-center space-x-2 text-sm text-gray-600">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <span>Auto-refreshing every {{ $refreshInterval }}s</span>
        </div>
    </div>

    <!-- Keep Session Alive Script -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Keep session alive by pinging the server every 3 minutes
            setInterval(function() {
                fetch('{{ route('dashboard') }}', {
                    method: 'HEAD',
                    credentials: 'same-origin',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).catch(function(error) {
                    console.log('Keep-alive ping failed');
                });
            }, 180000); // 3 minutes

            // Auto-reload on 419 errors (CSRF token mismatch)
            window.addEventListener('livewire:request', () => {
                // Request started
            });

            window.addEventListener('livewire:request-error', (event) => {
                if (event.detail && (event.detail.status === 419 || event.detail.status === 401)) {
                    // Show a friendly message before reload
                    if (confirm('Your session has expired. Would you like to refresh the page?')) {
                        window.location.reload();
                    }
                }
            });

            // Prevent browser back button from showing expired pages
            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    window.location.reload();
                }
            });
        });
    </script>
    @endpush
</x-admin.dashboard-layout>