<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <i data-lucide="edit-3" class="w-5 h-5 mr-2 text-green-600"></i>
                    Contract Drafting
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Contract <span class="text-accent">Drafting</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Create and manage legal contracts efficiently
                    </p>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="flex justify-between items-center">
                <button class="btn btn-accent">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    New Contract
                </button>
            </div>

            <!-- Current Contracts -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Current Drafts</h3>
                <div class="space-y-4">
                    @foreach($contracts as $contract)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-semibold text-gray-800 text-lg">{{ $contract['title'] }}</h4>
                                <p class="text-sm text-gray-600">{{ $contract['type'] }}</p>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                @if($contract['status'] == 'in_progress') bg-green-100 text-green-700
                                @elseif($contract['status'] == 'draft') bg-gray-100 text-gray-700
                                @else bg-orange-100 text-orange-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $contract['status'])) }}
                            </span>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Progress</span>
                                <span>{{ $contract['progress'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ $contract['progress'] }}%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Created: {{ $contract['created_at'] }}</span>
                            <div class="flex gap-2">
                                <button class="btn btn-accent btn-sm">Edit</button>
                                <button class="btn btn-outline btn-sm">View</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Templates -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Contract Templates</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($templates as $template)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all duration-200 cursor-pointer hover:border-green-300">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-green-100 rounded-full">
                                <i data-lucide="file-text" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">{{ $template['name'] }}</h4>
                                <p class="text-xs text-gray-500">{{ $template['category'] }}</p>
                            </div>
                        </div>
                        <button class="btn btn-accent btn-sm w-full">Use Template</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</x-lawyer.dashboard-layout>