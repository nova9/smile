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

            <!-- Contracts Awaiting Signature -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Contracts Awaiting Signature</h3>
                @php
                $filteredAwaiting = array_values(array_filter($contracts ?? [], function ($c) {
                $type = $c['type'] ?? '';
                $title = $c['title'] ?? '';
                return stripos($type, 'Employment') === false && stripos($title, 'Employment') === false;
                }));
                @endphp
                <div class="space-y-4">
                    @foreach($filteredAwaiting as $contract)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-semibold text-gray-800 text-lg">{{ $contract['title'] }}</h4>
                                <div class="flex items-center gap-3 mt-2">
                                    <p class="text-sm text-gray-600">{{ $contract['organization'] }}</p>
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="scroll-text" class="w-3 h-3 text-green-600"></i>
                                        <span class="text-sm text-green-600 font-medium">{{ $contract['type'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                @if($contract['status'] == 'ready_to_sign') bg-green-100 text-green-700
                                @elseif($contract['status'] == 'signed') bg-blue-100 text-blue-700
                                @else bg-yellow-100 text-yellow-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $contract['status'])) }}
                            </span>
                        </div>
                        <div class="mb-4">
                            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                                <p><span class="font-medium">Created:</span> {{ $contract['created_at'] }}</p>
                                <p><span class="font-medium">Contract Value:</span> {{ $contract['value'] }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-500">
                                <p>Ready for legal signature</p>
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="btn btn-outline btn-sm"
                                    data-contract-b64="{{ base64_encode(json_encode($contract)) }}"
                                    onclick="viewContract(this)">
                                    <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                    View
                                </button>
                                @if($contract['status'] != 'signed')
                                <button
                                    class="btn btn-accent btn-sm"
                                    data-contract-b64="{{ base64_encode(json_encode($contract)) }}"
                                    onclick="openSignatureModal(this)">
                                    <i data-lucide="pen-tool" class="w-4 h-4 mr-2"></i>
                                    Sign Contract
                                </button>
                                @endif
                                @if($contract['status'] == 'signed')
                                <button
                                    class="btn btn-success btn-sm"
                                    data-contract-b64="{{ base64_encode(json_encode($contract)) }}"
                                    onclick="downloadContract(this)">
                                    <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                                    Download
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Signed Contracts Archive -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Recently Signed Contracts</h3>
                @php
                $filteredSigned = array_values(array_filter($signedContracts ?? [], function ($c) {
                return strcasecmp($c['type'] ?? '', 'Volunteer Service Agreement') === 0;
                }));
                $exampleSigned = [
                [
                'id' => 901,
                'title' => 'Community Cleanup Volunteer Agreement',
                'organization' => 'Acme Goodwill Foundation',
                'type' => 'Volunteer Service Agreement',
                'value' => '$0.00',
                'status' => 'signed',
                'signed_at' => date('Y-m-d'),
                'contract_number' => 'VSA-2025-001',
                'event' => 'Community Clean-up Drive 2025',
                'start_date' => date('Y-m-01'),
                'end_date' => date('Y-m-t'),
                'duration' => '4 weeks',
                'contact' => '+1 (555) 012-3456',
                'volunteer_name' => 'John Doe',
                'volunteer_address' => '123 Main St, Springfield',
                'volunteer_email' => 'john.doe@example.com',
                'volunteer_nic' => '901234567V',
                ],
                ];
                $displaySigned = count($filteredSigned) ? $filteredSigned : $exampleSigned;
                @endphp
                <div class="space-y-4">
                    @foreach($displaySigned as $contract)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200 bg-green-50">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-semibold text-gray-800 text-lg">{{ $contract['title'] }}</h4>
                                <div class="flex items-center gap-3 mt-2">
                                    <p class="text-sm text-gray-600">{{ $contract['organization'] }}</p>
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="scroll-text" class="w-3 h-3 text-green-600"></i>
                                        <span class="text-sm text-green-600 font-medium">{{ $contract['type'] }}</span>
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
                                <p><span class="font-medium">Signed Date:</span> {{ $contract['signed_at'] }}</p>
                                <p><span class="font-medium">Contract Value:</span> {{ $contract['value'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-green-600 font-medium">
                                <p>✓ Legally executed contract</p>
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="btn btn-outline btn-sm"
                                    data-contract-b64="{{ base64_encode(json_encode($contract)) }}"
                                    onclick="viewContract(this)">
                                    <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                    View
                                </button>
                                <button
                                    class="btn btn-success btn-sm"
                                    data-contract-b64="{{ base64_encode(json_encode($contract)) }}"
                                    onclick="downloadContract(this)">
                                    <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                                    Download
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <!-- Contract View Modal -->
    <div id="viewModal" class="fixed inset-0 bg-white/95 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden border border-gray-200">
            <!-- Modal Header -->
            <div class="bg-gray-800 text-white p-6">
                <div class="flex justify-between items-center">
                    <h2 id="viewModalTitle" class="text-2xl font-bold">Contract Preview</h2>
                    <button onclick="closeViewModal()" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <p id="viewModalSubtitle" class="text-gray-300 mt-2">Review contract before signing</p>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <div id="contractPreview" class="prose max-w-none">
                    <!-- Contract content will be loaded here -->
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <button onclick="closeViewModal()" class="btn btn-outline">Close</button>
                <div class="flex gap-3">
                    <button id="signFromViewBtn" class="btn btn-accent hidden">
                        <i data-lucide="pen-tool" class="w-4 h-4 mr-2"></i>
                        Sign Contract
                    </button>
                    <button id="downloadFromViewBtn" class="btn btn-success hidden">
                        <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                        Download
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Digital Signature Modal -->
    <div id="signatureModal" class="fixed inset-0 bg-white/95 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden border border-gray-200">
            <!-- Modal Header -->
            <div class="bg-green-600 text-white p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold">Digital Signature</h2>
                    <button onclick="closeSignatureModal()" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <p class="text-green-100 mt-2">Add your legal signature to finalize the contract</p>
            </div>

            <!-- Modal Content -->
            <div class="p-6">
                <div class="space-y-6">
                    <!-- Contract Info -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-800 mb-2">Contract Information</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <p><span class="font-medium">Contract:</span> <span id="signContractTitle">-</span></p>
                            <p><span class="font-medium">Organization:</span> <span id="signContractOrg">-</span></p>
                            <p><span class="font-medium">Type:</span> <span id="signContractType">-</span></p>
                            <p><span class="font-medium">Value:</span> <span id="signContractValue">-</span></p>
                        </div>
                    </div>

                    <!-- Signature Upload (replaces canvas) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Your Signature</label>
                        <div class="border-2 border-gray-300 rounded-lg p-4 bg-white">
                            <input id="signatureFile" type="file" accept="image/*" class="block w-full text-sm text-gray-700" onchange="handleSignatureFileChange(event)">
                            <div id="signaturePreviewWrapper" class="mt-3 hidden">
                                <img id="signaturePreview" alt="Signature preview" class="max-h-40 object-contain border border-gray-200 rounded p-2 bg-gray-50">
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-xs text-gray-500">Upload a clear image (PNG/JPG) of your signature</p>
                            <button type="button" onclick="clearSignature()" class="text-red-600 hover:text-red-800 text-sm">
                                Remove Signature
                            </button>
                        </div>
                    </div>

                    <!-- Lawyer Credentials -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <h4 class="font-semibold text-green-800 mb-2">Legal Credentials</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <p><span class="font-medium">Lawyer:</span> {{ auth()->user()->name }}</p>
                            <p><span class="font-medium">License:</span> [LICENSE_NUMBER]</p>
                            <p><span class="font-medium">Bar Association:</span> [BAR_ASSOCIATION]</p>
                            <p><span class="font-medium">Signature Date:</span> {{ date('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <button onclick="closeSignatureModal()" class="btn btn-outline">Cancel</button>
                <button onclick="finalizeSignature()" class="btn btn-accent">
                    <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                    Finalize Signature
                </button>
            </div>
        </div>
    </div>
</x-lawyer.dashboard-layout>

<script>
    // Replace let with var to avoid redeclaration on Livewire page swaps
    var currentContract = window.currentContract || null;
    // let signatureCanvas = null;
    // let ctx = null;
    // let isDrawing = false;
    var hasSignature = window.hasSignature || false;
    var signatureImageData = window.signatureImageData || null; // base64
    // Persist back on window for subsequent navigations
    window.currentContract = currentContract;
    window.hasSignature = hasSignature;
    window.signatureImageData = signatureImageData;

    // Removed: initializeSignatureCanvas, startDrawing, draw, stopDrawing, handleTouch
    // Add: file upload handlers
    function handleSignatureFileChange(e) {
        const file = e.target.files && e.target.files[0];
        if (!file) {
            clearSignature();
            return;
        }
        const reader = new FileReader();
        reader.onload = function(evt) {
            signatureImageData = evt.target.result;
            const preview = document.getElementById('signaturePreview');
            const wrapper = document.getElementById('signaturePreviewWrapper');
            if (preview && wrapper) {
                preview.src = signatureImageData;
                wrapper.classList.remove('hidden');
            }
            hasSignature = true;
        };
        reader.readAsDataURL(file);
    }

    function clearSignature() {
        const input = document.getElementById('signatureFile');
        const preview = document.getElementById('signaturePreview');
        const wrapper = document.getElementById('signaturePreviewWrapper');
        if (input) input.value = '';
        if (preview) preview.src = '';
        if (wrapper) wrapper.classList.add('hidden');
        signatureImageData = null;
        hasSignature = false;
    }

    // Helper to resolve a contract from either an element (data-contract-b64 / data-contract) or a plain object
    function resolveContractArg(arg) {
        if (arg && arg.dataset) {
            // Prefer base64 if present (robust against quotes/entities)
            if (arg.dataset.contractB64) {
                try {
                    const json = atob(arg.dataset.contractB64);
                    return JSON.parse(json);
                } catch (e) {
                    console.warn('Failed to decode/parse data-contract-b64', e);
                }
            }
            // Fallback: plain JSON in data-contract (handle potential HTML entities)
            if (arg.dataset.contract) {
                const raw = arg.dataset.contract;
                try {
                    return JSON.parse(raw);
                } catch (e1) {
                    try {
                        const ta = document.createElement('textarea');
                        ta.innerHTML = raw;
                        const decoded = ta.value;
                        return JSON.parse(decoded);
                    } catch (e2) {
                        console.warn('Failed to parse data-contract JSON', e2);
                    }
                }
            }
        }
        return arg; // assume it's already a plain object
    }

    function openSignatureModal(arg) {
        const contract = resolveContractArg(arg);
        currentContract = contract;

        // Update contract details in modal
        document.getElementById('signContractTitle').textContent = contract.title;
        document.getElementById('signContractOrg').textContent = contract.organization;
        document.getElementById('signContractType').textContent = contract.type;
        document.getElementById('signContractValue').textContent = contract.value;

        // Reset signature state
        clearSignature();

        // Show modal
        document.getElementById('signatureModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeSignatureModal() {
        document.getElementById('signatureModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentContract = null;
        clearSignature();
    }

    function finalizeSignature() {
        if (!hasSignature || !signatureImageData) {
            alert('Please upload your signature before finalizing.');
            return;
        }

        // Simulate contract signing process using uploaded image
        // signatureImageData contains the base64 image to submit to backend in a real implementation
        alert(`Contract "${currentContract.title}" has been successfully signed!\n\nThe contract is now legally executed and ready for download.`);

        // Close modal and refresh (frontend only)
        closeSignatureModal();
        setTimeout(() => {
            location.reload();
        }, 600);
    }

    function viewContract(arg) {
        const contract = resolveContractArg(arg);
        currentContract = contract;

        // Update modal title
        document.getElementById('viewModalTitle').textContent = contract.title;
        document.getElementById('viewModalSubtitle').textContent = `${contract.type} • ${contract.organization}`;

        // Generate contract preview based on type
        const contractHTML = generateContractHTML(contract);
        document.getElementById('contractPreview').innerHTML = contractHTML;

        // Show appropriate action buttons
        const signBtn = document.getElementById('signFromViewBtn');
        const downloadBtn = document.getElementById('downloadFromViewBtn');

        if (contract.status === 'signed') {
            signBtn.classList.add('hidden');
            downloadBtn.classList.remove('hidden');
        } else {
            signBtn.classList.remove('hidden');
            downloadBtn.classList.add('hidden');
            signBtn.onclick = () => {
                closeViewModal();
                openSignatureModal(contract);
            };
        }

        downloadBtn.onclick = () => downloadContract(contract);

        document.getElementById('viewModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeViewModal() {
        document.getElementById('viewModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function downloadContract(arg) {
        const contract = resolveContractArg(arg);
        // Simulate PDF download
        alert(`Downloading signed contract: "${contract.title}"\n\nThe PDF file would be generated and downloaded in a real implementation.`);

        // In a real implementation, this would trigger a PDF generation and download
        // window.open(`/lawyer/contracts/${contract.id}/download`, '_blank');
    }

    function generateContractHTML(contract) {
        if (contract.type === 'Volunteer Service Agreement') {
            // Filled org/requestor details with dummy fallbacks; removed representative/email/phone
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
                            <p class="text-xs text-gray-500">${contract.status === 'signed' ? 'Signed by ' + '{{ auth()->user()->name }}' + ' on ' + (contract.signed_at || 'recently') : 'Upload your signature to finalize'}</p>
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

        // Default contract template
        return `
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">${contract.type.toUpperCase()}</h2>
                <p class="text-gray-600 mt-2">Contract No: ${contract.contract_number || 'GEN-2024-001'}</p>
            </div>
            <div class="space-y-4 text-sm text-gray-700 leading-relaxed">
                <p><strong>Contract Title:</strong> ${contract.title}</p>
                <p><strong>Organization:</strong> ${contract.organization}</p>
                <p><strong>Contract Value:</strong> ${contract.value}</p>
                <p><strong>Status:</strong> ${contract.status === 'signed' ? '✓ Signed' : '⚠ Awaiting Signature'}</p>
            </div>
        `;
    }

    // Close modals when clicking outside (guard against duplicate listeners)
    if (!window.__lawyerDSListenersAdded) {
        document.addEventListener('click', function(e) {
            if (e.target.id === 'viewModal') closeViewModal();
            if (e.target.id === 'signatureModal') closeSignatureModal();
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeViewModal();
                closeSignatureModal();
            }
        });

        window.__lawyerDSListenersAdded = true;
    }
</script>