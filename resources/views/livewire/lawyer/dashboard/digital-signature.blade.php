<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <i data-lucide="pen-tool" class="w-5 h-5 mr-2 text-green-600"></i>
                    Digital Signature
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Digital <span class="text-accent">Signature</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Sign and finalize legal contracts digitally
                    </p>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if (session()->has('success'))
            <div class="alert alert-success shadow-lg">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if (session()->has('error'))
            <div class="alert alert-error shadow-lg">
                <i data-lucide="alert-circle" class="w-5 h-5"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            <!-- Contracts Awaiting Signature -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Contracts Awaiting Signature</h3>

                @if($pendingContracts->count() > 0)
                <div class="space-y-4">
                    @foreach($pendingContracts as $contractRequest)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800 text-lg">{{ $contractRequest->event->name }} - {{ $contractRequest->agreement->topic }}</h4>
                                <div class="flex items-center gap-3 mt-2">
                                    <p class="text-sm text-gray-600">{{ $contractRequest->requester->name ?? $contractRequest->requester_details['organization'] ?? 'N/A' }}</p>
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="scroll-text" class="w-3 h-3 text-green-600"></i>
                                        <span class="text-sm text-green-600 font-medium">Sign Request</span>
                                    </div>
                                </div>
                                <div class="mt-3 text-sm text-gray-600">
                                    <p><strong>Email:</strong> {{ $contractRequest->requester->email }}</p>
                                    <p><strong>Event Date:</strong> {{ $contractRequest->event->starts_at->format('M d, Y') }} - {{ $contractRequest->event->ends_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">
                                Awaiting Signature
                            </span>
                        </div>

                        <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                            <h5 class="font-medium text-gray-700 mb-2">Organization Details (Pre-filled)</h5>
                            <div class="grid grid-cols-2 gap-3 text-sm text-gray-600">
                                <p><span class="font-medium">Organization:</span> {{ $contractRequest->requester_details['organization'] ?? $contractRequest->requester->name }}</p>
                                <p><span class="font-medium">Contact:</span> {{ $contractRequest->requester_details['phone'] ?? 'N/A' }}</p>
                                <p><span class="font-medium">Email:</span> {{ $contractRequest->requester_details['email'] ?? $contractRequest->requester->email }}</p>
                                <p><span class="font-medium">Address:</span> {{ $contractRequest->requester_details['address'] ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-500">
                                <p>Requested {{ $contractRequest->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex gap-2">
                                <button
                                    wire:click="openSignatureModal({{ $contractRequest->id }})"
                                    class="btn btn-accent btn-sm">
                                    <i data-lucide="pen-tool" class="w-4 h-4 mr-2"></i>
                                    Sign Contract
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12 text-gray-500">
                    <i data-lucide="inbox" class="w-16 h-16 mx-auto mb-4 text-gray-300"></i>
                    <p class="text-lg font-medium">No pending contracts</p>
                    <p class="text-sm mt-2">All contracts have been signed or there are no new requests.</p>
                </div>
                @endif
            </div>

            <!-- Recently Signed Contracts -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Recently Signed Contracts</h3>
                    <a href="/lawyer/contract-archive" class="text-sm text-blue-600 hover:text-blue-800 flex items-center gap-1">
                        View All Archive
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                @if($signedContracts->count() > 0)
                <div class="space-y-4">
                    @foreach($signedContracts as $contractRequest)
                    <div class="border border-green-200 rounded-lg p-6 hover:shadow-md transition-all duration-200 bg-green-50">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800 text-lg">{{ $contractRequest->event->name }} - {{ $contractRequest->agreement->topic }}</h4>
                                <div class="flex items-center gap-3 mt-2">
                                    <p class="text-sm text-gray-600">{{ $contractRequest->requester->name ?? $contractRequest->requester_details['organization'] ?? 'N/A' }}</p>
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="check-circle" class="w-3 h-3 text-green-600"></i>
                                        <span class="text-sm text-green-600 font-medium">Signed</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Completed</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                                <p><span class="font-medium">Signed Date:</span> {{ $contractRequest->signed_at->format('M d, Y H:i') }}</p>
                                <p><span class="font-medium">Event Published:</span> {{ $contractRequest->event->is_active ? 'Yes ✓' : 'No' }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="text-sm text-green-600 font-medium">
                                <p>✓ Legally executed contract</p>
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

    <!-- Signature Upload Modal -->
    @if($showSignatureModal)
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        wire:click="closeSignatureModal">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
            wire:click.stop onclick="event.stopPropagation()">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Upload Digital Signature</h2>
                    <button wire:click="closeSignatureModal" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <p class="text-green-100 mt-2">Upload your signature image to finalize the contract</p>
            </div>

            <!-- Modal Content -->
            <div class="p-6">
                <form wire:submit.prevent="signContract" class="space-y-6">
                    <!-- Contract Info -->
                    @if($signingContractId)
                    @php
                    $contract = $pendingContracts->firstWhere('id', $signingContractId);
                    @endphp
                    @if($contract)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-800 mb-2">Contract Information</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <p><span class="font-medium">Event:</span> {{ $contract->event->name }}</p>
                            <p><span class="font-medium">Organization:</span> {{ $contract->requester->name }}</p>
                            <p><span class="font-medium">Template:</span> {{ $contract->agreement->topic }}</p>
                            <p><span class="font-medium">Date:</span> {{ $contract->event->starts_at->format('M d, Y') }}</p>
                        </div>

                        <!-- Display Contract Terms -->
                        <div class="mt-4">
                            <h4 class="font-medium text-gray-700 mb-2">Contract Terms:</h4>
                            <div class="bg-white border border-gray-200 rounded p-4 max-h-64 overflow-y-auto text-sm text-gray-700 whitespace-pre-wrap">
                                {{ $contract->customized_terms ?? $contract->agreement->terms }}
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif

                    <!-- Signature Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Your Signature Image *
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-green-500 transition-colors">
                            <input type="file"
                                wire:model="signatureImage"
                                accept="image/*"
                                class="hidden"
                                id="signature-upload">
                            <label for="signature-upload" class="cursor-pointer">
                                <i data-lucide="upload" class="w-12 h-12 mx-auto text-gray-400 mb-3"></i>
                                <p class="text-sm text-gray-600 mb-1">Click to upload or drag and drop</p>
                                <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                            </label>
                        </div>

                        @if ($signatureImage)
                        <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                                    <span class="text-sm text-gray-700">Signature uploaded successfully</span>
                                </div>
                                <button type="button" wire:click="$set('signatureImage', null)" class="text-red-600 hover:text-red-800 text-sm">
                                    Remove
                                </button>
                            </div>
                            <div class="mt-3 flex justify-center">
                                <img src="{{ $signatureImage->temporaryUrl() }}" alt="Signature Preview" class="max-h-32 border border-gray-200 rounded">
                            </div>
                        </div>
                        @endif

                        @error('signatureImage')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lawyer Info -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <h4 class="font-semibold text-green-800 mb-2">Legal Credentials</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <p><span class="font-medium">Lawyer:</span> {{ auth()->user()->name }}</p>
                            <p><span class="font-medium">Email:</span> {{ auth()->user()->email }}</p>
                            <p><span class="font-medium">Signature Date:</span> {{ now()->format('Y-m-d H:i:s') }}</p>
                            <p><span class="font-medium">Status:</span> <span class="text-green-600">Active</span></p>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                        <button type="button" wire:click="closeSignatureModal" class="btn btn-outline">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-accent" @if(!$signatureImage) disabled @endif>
                            <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                            Sign & Publish Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</x-lawyer.dashboard-layout>