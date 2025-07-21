<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500/10 to-red-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-red-500/20">
                    <i data-lucide="workflow" class="w-5 h-5 mr-2 text-red-600"></i>
                    Approval Workflow
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Approval <span class="text-accent">Workflow</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Manage contract approval processes
                    </p>
                </div>
            </div>

            <!-- Pending Approvals -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Pending Approvals</h3>
                <div class="space-y-4">
                    @foreach($pendingApprovals as $approval)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $approval['contract_title'] }}</h4>
                                <p class="text-sm text-gray-600">Submitted by {{ $approval['submitted_by'] }}</p>
                                <p class="text-xs text-gray-500">{{ $approval['submitted_at'] }}</p>
                            </div>
                            <div class="flex gap-2">
                                <span class="px-3 py-1 text-xs font-medium rounded-full 
                                    @if($approval['priority'] == 'high') bg-red-100 text-red-700
                                    @elseif($approval['priority'] == 'medium') bg-gray-100 text-gray-700
                                    @else bg-green-100 text-green-700 @endif">
                                    {{ ucfirst($approval['priority']) }} Priority
                                </span>
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">
                                    {{ ucfirst(str_replace('_', ' ', $approval['status'])) }}
                                </span>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <button class="btn btn-accent btn-sm">Approve</button>
                            <button class="btn btn-outline btn-sm">Request Changes</button>
                            <button class="btn bg-red-600 text-white btn-sm hover:bg-red-700">Reject</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Approval History -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Recent History</h3>
                <div class="space-y-4">
                    @foreach($approvalHistory as $history)
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-800">{{ $history['contract_title'] }}</h4>
                            <p class="text-sm text-gray-500">{{ $history['approved_at'] }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium rounded-full 
                            @if($history['status'] == 'approved') bg-green-100 text-green-700
                            @else bg-red-100 text-red-700 @endif">
                            {{ ucfirst($history['status']) }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</x-lawyer.dashboard-layout>