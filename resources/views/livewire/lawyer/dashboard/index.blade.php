<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Legal Dashboard
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Welcome <span class="text-accent">Back</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Your legal practice overview
                    </p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Contracts</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $stats['total_contracts'] }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <i data-lucide="file-text" class="w-6 h-6 text-green-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Pending</p>
                            <p class="text-3xl font-bold text-red-600">{{ $stats['pending_approval'] }}</p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-full">
                            <i data-lucide="clock" class="w-6 h-6 text-red-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Active</p>
                            <p class="text-3xl font-bold text-green-600">{{ $stats['active_contracts'] }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50 group hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">This Month</p>
                            <p class="text-3xl font-bold text-black">{{ $stats['completed_this_month'] }}</p>
                        </div>
                        <div class="p-3 bg-gray-100 rounded-full">
                            <i data-lucide="trending-up" class="w-6 h-6 text-black"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Processes -->
            <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Legal Services</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Contract Drafting -->
                    <a href="/lawyer/contract-drafting" class="p-4 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-300 transition-all duration-200 cursor-pointer">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-green-100 rounded-full">
                                <i data-lucide="edit-3" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <h4 class="font-medium text-gray-800">Contract Drafting</h4>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">Create legal contracts</p>
                        <span class="text-xs text-green-600 font-medium">15 in progress</span>
                    </a>

                    <!-- Contract Approval Workflow -->
                    <a href="/lawyer/approval-workflow" class="p-4 border border-gray-200 rounded-lg hover:bg-red-50 hover:border-red-300 transition-all duration-200 cursor-pointer">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-red-100 rounded-full">
                                <i data-lucide="workflow" class="w-5 h-5 text-red-600"></i>
                            </div>
                            <h4 class="font-medium text-gray-800">Approval Workflow</h4>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">Manage approvals</p>
                        <span class="text-xs text-red-600 font-medium">8 pending</span>
                    </a>

                    <!-- Digital Signature -->
                    <a href="/lawyer/digital-signature" class="p-4 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-300 transition-all duration-200 cursor-pointer">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-green-100 rounded-full">
                                <i data-lucide="pen-tool" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <h4 class="font-medium text-gray-800">Digital Signature</h4>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">Handle signatures</p>
                        <span class="text-xs text-green-600 font-medium">12 awaiting</span>
                    </a>

                    <!-- Contract Archive -->
                    <a href="/lawyer/contract-archive" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 cursor-pointer">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-gray-100 rounded-full">
                                <i data-lucide="archive" class="w-5 h-5 text-gray-600"></i>
                            </div>
                            <h4 class="font-medium text-gray-800">Contract Archive</h4>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">View archived contracts</p>
                        <span class="text-xs text-gray-600 font-medium">127 archived</span>
                    </a>

                    <!-- Contract Customization -->
                    <a href="/lawyer/contract-customization" class="p-4 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-300 transition-all duration-200 cursor-pointer">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-green-100 rounded-full">
                                <i data-lucide="settings" class="w-5 h-5 text-green-600"></i>
                            </div>
                            <h4 class="font-medium text-gray-800">Contract Customization</h4>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">Customize templates</p>
                        <span class="text-xs text-green-600 font-medium">25 templates</span>
                    </a>

                    <!-- Legal Q&A Support -->
                    <a href="/lawyer/legal-qa" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 cursor-pointer">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-gray-100 rounded-full">
                                <i data-lucide="help-circle" class="w-5 h-5 text-gray-600"></i>
                            </div>
                            <h4 class="font-medium text-gray-800">Legal Q&A Support</h4>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">Provide consultation</p>
                        <span class="text-xs text-gray-600 font-medium">5 pending</span>
                    </a>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Recent Activities</h3>
                    <button class="btn btn-accent btn-sm">View All</button>
                </div>
                <div class="space-y-3">
                    @foreach($recentActivities as $activity)
                    <div class="flex items-center gap-3 p-3 hover:bg-green-50 rounded-lg transition-colors">
                        <div class="p-2 rounded-full 
                            @if($activity['status'] == 'completed') bg-green-100 
                            @elseif($activity['status'] == 'pending') bg-red-100 
                            @else bg-gray-100 @endif">
                            <i data-lucide="
                            @if($activity['status'] == 'completed') check-circle 
                            @elseif($activity['status'] == 'pending') clock 
                            @else activity @endif" class="w-4 h-4 
                            @if($activity['status'] == 'completed') text-green-600 
                            @elseif($activity['status'] == 'pending') text-red-600 
                            @else text-gray-600 @endif"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800 text-sm">{{ $activity['title'] }}</p>
                            <p class="text-xs text-gray-500">{{ $activity['time'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</x-lawyer.dashboard-layout>