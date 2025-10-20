@php
use Illuminate\Support\Facades\Storage;
@endphp

<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <i data-lucide="archive" class="w-5 h-5 mr-2 text-green-600"></i>
                    Contract Archive
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Contract <span class="text-accent">Archive</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        View and manage completed legal contracts
                    </p>
                </div>
            </div>

            <!-- Signed Contracts -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Signed Contracts</h3>
                    <span class="text-sm text-gray-500">Showing {{ $signedContracts->count() }} contracts</span>
                </div>

                @if($signedContracts->count() > 0)
                <div class="space-y-4">
                    @foreach($signedContracts as $contractRequest)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200 bg-green-50">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-semibold text-gray-800 text-lg">{{ $contractRequest->event->name }} - {{ $contractRequest->agreement->topic }}</h4>
                                <div class="flex items-center gap-3 mt-2">
                                    <p class="text-sm text-gray-600">{{ $contractRequest->requester->name ?? $contractRequest->requester_details['organization'] ?? 'N/A' }}</p>
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="scroll-text" class="w-3 h-3 text-green-600"></i>
                                        <span class="text-sm text-green-600 font-medium">Volunteer Service Agreement</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Signed</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                                <p><span class="font-medium">Signed Date:</span> {{ $contractRequest->signed_at->format('M d, Y H:i') }}</p>
                                <p><span class="font-medium">Event:</span> {{ $contractRequest->event->name }}</p>
                                <p><span class="font-medium">Event Date:</span> {{ $contractRequest->event->starts_at->format('M d, Y') }}</p>
                                <p><span class="font-medium">Event Published:</span> {{ $contractRequest->event->is_active ? 'Yes ✓' : 'No' }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-green-600 font-medium">
                                <p>✓ Legally executed contract</p>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="viewContract({{ $contractRequest->id }})" class="btn btn-sm btn-outline">
                                    <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                    View
                                </button>
                                <button wire:click="downloadContract({{ $contractRequest->id }})" class="btn btn-sm btn-success">
                                    <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                                    Download PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12 text-gray-500">
                    <i data-lucide="file-check" class="w-16 h-16 mx-auto mb-4 text-gray-300"></i>
                    <p class="text-lg font-medium">No signed contracts yet</p>
                    <p class="text-sm mt-2">Sign your first contract to see it here.</p>
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Contract View Modal -->
    @if($showViewModal && $viewingContract)
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4" wire:click="closeViewModal">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden border border-gray-200" wire:click.stop onclick="event.stopPropagation()">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold">{{ $viewingContract->event->name }}</h2>
                        <p class="text-green-100 mt-1">{{ $viewingContract->agreement->topic }}</p>
                    </div>
                    <button wire:click="closeViewModal" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto max-h-[60vh] space-y-6">
                <!-- Contract Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Organization</p>
                        <p class="font-medium text-gray-800">{{ $viewingContract->requester_details['organization'] ?? $viewingContract->requester->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Contact</p>
                        <p class="font-medium text-gray-800">{{ $viewingContract->requester_details['phone'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Email</p>
                        <p class="font-medium text-gray-800">{{ $viewingContract->requester_details['email'] ?? $viewingContract->requester->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Address</p>
                        <p class="font-medium text-gray-800">{{ $viewingContract->requester_details['address'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Event Date</p>
                        <p class="font-medium text-gray-800">{{ $viewingContract->event->starts_at->format('M d, Y') }} - {{ $viewingContract->event->ends_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Signed Date</p>
                        <p class="font-medium text-gray-800">{{ $viewingContract->signed_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>

                <!-- Contract Terms -->
                <div>
                    <h3 class="font-semibold text-gray-800 mb-3 text-lg">Contract Terms</h3>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 max-h-64 overflow-y-auto">
                        <pre class="text-sm text-gray-700 whitespace-pre-wrap font-sans">{{ $viewingContract->customized_terms ?? $viewingContract->agreement->terms }}</pre>
                    </div>
                </div>

                <!-- Signature -->
                @if($viewingContract->signature_path)
                <div>
                    <h3 class="font-semibold text-gray-800 mb-3 text-lg">Digital Signature</h3>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-center gap-4">
                        <img src="{{ Storage::url($viewingContract->signature_path) }}" alt="Signature" class="h-20 border border-gray-300 rounded bg-white">
                        <div class="text-sm text-gray-700">
                            <p class="font-medium">Signed by: {{ auth()->user()->name }}</p>
                            <p class="text-gray-500">{{ $viewingContract->signed_at->format('F d, Y \a\t h:i A') }}</p>
                            <p class="text-green-600 font-medium mt-1">✓ Legally binding digital signature</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <button wire:click="closeViewModal" class="btn btn-outline">
                    Close
                </button>
                <button wire:click="downloadContract({{ $viewingContract->id }})" class="btn btn-success">
                    <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                    Download PDF
                </button>
            </div>
        </div>
    </div>
    @endif
</x-lawyer.dashboard-layout>