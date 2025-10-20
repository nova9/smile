<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <i data-lucide="settings" class="w-5 h-5 mr-2 text-green-600"></i>
                    Contract Customization
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Contract <span class="text-accent">Customization</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Review and respond to custom contract requirements
                    </p>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if (session()->has('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
            @endif
            @if (session()->has('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
            @endif

            <!-- Customization Requests -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Pending Customization Requests</h3>
                    <span class="text-sm text-gray-500">Showing {{ $customizationRequests->count() }} requests</span>
                </div>

                @if($customizationRequests->count() > 0)
                <div class="space-y-4">
                    @foreach($customizationRequests as $contractRequest)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200 bg-yellow-50">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-semibold text-gray-800 text-lg">{{ $contractRequest->event->name }} - {{ $contractRequest->agreement->topic }}</h4>
                                <div class="flex items-center gap-3 mt-2">
                                    <p class="text-sm text-gray-600">{{ $contractRequest->requester->name ?? $contractRequest->requester_details['organization'] ?? 'N/A' }}</p>
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="scroll-text" class="w-3 h-3 text-yellow-600"></i>
                                        <span class="text-sm text-yellow-600 font-medium">Custom Requirements</span>
                                    </div>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">Pending Review</span>
                        </div>
                        <div class="mb-4">
                            <div class="text-sm text-gray-600 space-y-2">
                                <p><span class="font-medium">Event:</span> {{ $contractRequest->event->name }}</p>
                                <p><span class="font-medium">Event Date:</span> {{ $contractRequest->event->starts_at->format('M d, Y') }}</p>
                                <p><span class="font-medium">Requested:</span> {{ $contractRequest->created_at->diffForHumans() }}</p>
                                <div class="mt-3 p-3 bg-white rounded border border-yellow-200">
                                    <p class="font-medium text-gray-700 mb-1">Additional Requirements:</p>
                                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $contractRequest->notes }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button wire:click="openReviewModal({{ $contractRequest->id }})"
                                class="btn btn-outline btn-sm">
                                <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                Review
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12 text-gray-500">
                    <i data-lucide="inbox" class="w-16 h-16 mx-auto mb-4 text-gray-300"></i>
                    <p class="text-lg font-medium">No pending customization requests</p>
                    <p class="text-sm mt-2">Custom requirement requests will appear here.</p>
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Review Modal -->
    @if($showReviewModal && $selectedRequestId)
    @php
    $contractRequest = \App\Models\ContractRequest::with(['event', 'requester', 'agreement'])->find($selectedRequestId);
    @endphp
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-5xl w-full max-h-[90vh] overflow-hidden border border-gray-200">
            <div class="bg-gray-800 text-white p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold">Review Contract Customization</h2>
                        <p class="text-gray-300 mt-1">{{ $contractRequest->event->name }}</p>
                    </div>
                    <button wire:click="closeReviewModal" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
            <div class="p-6 overflow-y-auto max-h-[60vh] space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Organization</p>
                        <p class="font-medium text-gray-800">{{ $contractRequest->requester->name ?? $contractRequest->requester_details['organization'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Contact</p>
                        <p class="font-medium text-gray-800">{{ $contractRequest->requester_details['email'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Event Date</p>
                        <p class="font-medium text-gray-800">{{ $contractRequest->event->starts_at->format('M d, Y') }}</p>
                    </div>
                </div>

                <div class="p-3 bg-yellow-50 rounded border border-yellow-200">
                    <p class="font-semibold text-gray-700 mb-2">Additional Requirements from Requester:</p>
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $contractRequest->notes }}</p>
                </div>

                <div class="p-4 bg-blue-50 rounded border border-blue-200">
                    <h5 class="font-semibold text-blue-800 mb-2 flex items-center">
                        <i data-lucide="info" class="w-4 h-4 mr-2"></i>
                        Default Contract Terms
                    </h5>
                    <div class="bg-white p-3 rounded border border-blue-200 max-h-64 overflow-y-auto text-sm text-gray-700 whitespace-pre-wrap font-mono">
                        {{ $contractRequest->agreement->terms }}
                    </div>
                    <p class="text-xs text-blue-700 mt-2">
                        <i data-lucide="arrow-down" class="w-3 h-3 inline mr-1"></i>
                        If approved, the additional requirements above will be added to this contract.
                    </p>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <button wire:click="closeReviewModal" class="btn btn-outline">Cancel</button>
                <div class="flex gap-2">
                    <button wire:click="rejectCustomization" class="btn btn-error">
                        <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                        Reject (Use Default Only)
                    </button>
                    <button wire:click="approveCustomization" class="btn btn-success">
                        <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                        Approve & Add Requirements
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-lawyer.dashboard-layout>