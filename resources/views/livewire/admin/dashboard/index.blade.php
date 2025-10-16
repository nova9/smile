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
</x-admin.dashboard-layout>