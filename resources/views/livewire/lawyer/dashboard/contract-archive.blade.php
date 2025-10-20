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

    <!-- Signed Contract View Modal -->
    <div id="signedViewModal" class="fixed inset-0 bg-white/95 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden border border-gray-200">
            <div class="bg-gray-800 text-white p-6">
                <div class="flex justify-between items-center">
                    <h2 id="signedViewModalTitle" class="text-2xl font-bold">Contract Preview</h2>
                    <button onclick="closeSignedViewModal()" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <p id="signedViewModalSubtitle" class="text-gray-300 mt-2">Review signed contract</p>
            </div>
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <div id="signedContractPreview" class="prose max-w-none"></div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <button onclick="closeSignedViewModal()" class="btn btn-outline">Close</button>
                <button id="signedDownloadBtn" class="btn btn-success">
                    <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                    Download
                </button>
            </div>
        </div>
    </div>
</x-lawyer.dashboard-layout>

<script>
    // Avoid redeclaration error on Livewire navigate swaps
    var currentSignedContract = window.currentSignedContract || null;
    window.currentSignedContract = currentSignedContract;

    // Resolve a contract from element (data-contract-b64) or plain object
    function resolveContractArg(arg) {
        if (arg && arg.dataset && arg.dataset.contractB64) {
            try {
                const json = atob(arg.dataset.contractB64);
                return JSON.parse(json);
            } catch (e) {
                console.warn('Failed to decode/parse data-contract-b64', e);
            }
        }
        return arg;
    }

    function viewSignedContract(arg) {
        const contract = resolveContractArg(arg);
        currentSignedContract = contract;
        document.getElementById('signedViewModalTitle').textContent = contract.title || 'Contract Preview';
        document.getElementById('signedViewModalSubtitle').textContent = `${contract.type || ''} • ${contract.organization || ''}`.trim();
        document.getElementById('signedContractPreview').innerHTML = generateContractHTML(contract);
        document.getElementById('signedDownloadBtn').onclick = () => downloadContract(contract);
        document.getElementById('signedViewModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeSignedViewModal() {
        document.getElementById('signedViewModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentSignedContract = null;
    }

    function downloadContract(arg) {
        const contract = resolveContractArg(arg);
        alert(`Downloading signed contract: "${contract.title}"\n\nThe PDF file would be generated and downloaded in a real implementation.`);
    }

    // Same template generator used on Digital Signature page
    function generateContractHTML(contract) {
        if ((contract.type || '') === 'Volunteer Service Agreement') {
            const org = {
                name: contract.organization || 'Acme Goodwill Foundation',
                event: contract.event || 'Community Clean-up Drive 2025',
                start: contract.start_date || (contract.created_at ? ('' + contract.created_at).split(' ')[0] : '2025-02-01'),
                end: contract.end_date || '2025-02-28',
                duration: contract.duration || '4 weeks',
                contact: contract.contact || contract.phone || '+1 (555) 012-3456',
            };
            const vol = {
                name: contract.volunteer_name || '[VOLUNTEER_NAME]',
                address: contract.volunteer_address || '[VOLUNTEER_ADDRESS]',
                email: contract.volunteer_email || '[VOLUNTEER_EMAIL]',
                nic: contract.volunteer_nic || '[VOLUNTEER_NIC]',
            };
            return `
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">VOLUNTEER SERVICE AGREEMENT</h2>
                    <p class="text-gray-600 mt-2">Contract No: ${contract.contract_number || 'VSA-2025-001'}</p>
                </div>

                <div class="space-y-6 text-sm text-gray-700 leading-relaxed">
                    <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="font-semibold text-green-800 mb-3">Organization / Requestor</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <p><strong>Organization / Requestor:</strong> <span class="bg-green-200 px-1 rounded font-medium">${org.name}</span></p>
                            <p><strong>Event:</strong> <span class="bg-green-200 px-1 rounded font-medium">${org.event}</span></p>
                            <p><strong>Start Date:</strong> <span class="bg-green-200 px-1 rounded font-medium">${org.start}</span></p>
                            <p><strong>End Date:</strong> <span class="bg-green-200 px-1 rounded font-medium">${org.end}</span></p>
                            <p><strong>Duration:</strong> <span class="bg-green-200 px-1 rounded font-medium">${org.duration}</span></p>
                            <p><strong>Contact Number:</strong> <span class="bg-green-200 px-1 rounded font-medium">${org.contact}</span></p>
                        </div>
                    </div>

                    <div class="p-4 bg-gray-100 border border-gray-300 rounded-lg">
                        <p class="font-semibold text-gray-700 mb-3">Volunteer Information</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <p><strong>Name:</strong> <span class="bg-gray-200 px-1 rounded font-medium">${vol.name}</span></p>
                            <p><strong>Address:</strong> <span class="bg-gray-200 px-1 rounded font-medium">${vol.address}</span></p>
                            <p><strong>Email:</strong> <span class="bg-gray-200 px-1 rounded font-medium">${vol.email}</span></p>
                            <p><strong>NIC:</strong> <span class="bg-gray-200 px-1 rounded font-medium">${vol.nic}</span></p>
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold text-gray-800 mb-2">Terms and Conditions</p>
                        <div class="ml-4 whitespace-pre-wrap">
1. The volunteer agrees to perform assigned duties diligently and responsibly.
2. The organization will provide necessary guidance and a safe work environment.
3. Confidential information must not be disclosed without consent.
4. Either party may terminate this agreement with prior notice.
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="text-center">
                            <p class="text-sm font-medium mb-2 text-gray-700">Lawyer Signature</p>
                            <div class="border-b-2 border-gray-400 mb-3 h-16 flex items-center justify-center">
                                ${contract.status === 'signed' ?
                                    '<span class="text-green-700 text-sm">Digitally signed</span>' :
                                    '<span class="text-yellow-700 text-sm">Awaiting signature</span>'}
                            </div>
                            <p class="text-xs text-gray-500">${contract.status === 'signed' ? 'Signed by ' + '{{ auth()->user()->name }}' + ' on ' + (contract.signed_at || 'recently') : 'Uploaded signature on file'}</p>
                        </div>
                        <div class="text-sm text-gray-700">
                            <div class="flex items-start gap-3">
                                <input type="checkbox" disabled class="mt-1 w-4 h-4 text-green-600 border-gray-300 rounded">
                                <p>I, <span class="font-medium">${vol.name}</span> (NIC: <span class="font-mono">${vol.nic}</span>), agree to the terms and conditions stated in this contract.</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">This section is non-editable.</p>
                        </div>
                    </div>
                </div>
            `;
        }

        // Default template
        return `
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">${(contract.type || '').toUpperCase()}</h2>
                <p class="text-gray-600 mt-2">Contract No: ${contract.contract_number || 'GEN-2024-001'}</p>
            </div>
            <div class="space-y-4 text-sm text-gray-700 leading-relaxed">
                <p><strong>Contract Title:</strong> ${contract.title || '-'}</p>
                <p><strong>Organization:</strong> ${contract.organization || '-'}</p>
                <p><strong>Contract Value:</strong> ${contract.value || '-'}</p>
                <p><strong>Status:</strong> ${contract.status === 'signed' ? '✓ Signed' : '⚠ Awaiting Signature'}</p>
                <p><strong>Signed Date:</strong> ${contract.signed_at || contract.signed_date || '-'}</p>
            </div>
        `;
    }

    // Close modal when clicking outside (guard once)
    if (!window.__lawyerArchiveListenersAdded) {
        document.addEventListener('click', function(e) {
            if (e.target.id === 'signedViewModal') closeSignedViewModal();
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeSignedViewModal();
        });

        window.__lawyerArchiveListenersAdded = true;
    }
</script>