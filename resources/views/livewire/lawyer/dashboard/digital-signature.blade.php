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
                <div class="space-y-4">
                    @foreach($contracts as $contract)
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
                                <button class="btn btn-outline btn-sm" onclick="viewContract({{ json_encode($contract) }})">
                                    <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                    View
                                </button>
                                @if($contract['status'] != 'signed')
                                <button class="btn btn-accent btn-sm" onclick="openSignatureModal({{ json_encode($contract) }})">
                                    <i data-lucide="pen-tool" class="w-4 h-4 mr-2"></i>
                                    Sign Contract
                                </button>
                                @endif
                                @if($contract['status'] == 'signed')
                                <button class="btn btn-success btn-sm" onclick="downloadContract({{ json_encode($contract) }})">
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
                <div class="space-y-4">
                    @foreach($signedContracts as $contract)
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
                                <p><span class="font-medium">Contract Value:</span> {{ $contract['value'] }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-green-600 font-medium">
                                <p>✓ Legally executed contract</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="btn btn-outline btn-sm" onclick="viewContract({{ json_encode($contract) }})">
                                    <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                    View
                                </button>
                                <button class="btn btn-success btn-sm" onclick="downloadContract({{ json_encode($contract) }})">
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

                    <!-- Signature Canvas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Digital Signature</label>
                        <div class="border-2 border-gray-300 rounded-lg p-4 bg-white">
                            <canvas id="signatureCanvas" width="500" height="200" class="w-full border border-gray-200 rounded cursor-crosshair"></canvas>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-xs text-gray-500">Sign above to add your digital signature</p>
                            <button type="button" onclick="clearSignature()" class="text-red-600 hover:text-red-800 text-sm">
                                Clear Signature
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
    let currentContract = null;
    let signatureCanvas = null;
    let ctx = null;
    let isDrawing = false;
    let hasSignature = false;

    // Initialize signature canvas when modal opens
    function initializeSignatureCanvas() {
        signatureCanvas = document.getElementById('signatureCanvas');
        ctx = signatureCanvas.getContext('2d');

        // Set up drawing
        ctx.strokeStyle = '#000000';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';

        // Mouse events
        signatureCanvas.addEventListener('mousedown', startDrawing);
        signatureCanvas.addEventListener('mousemove', draw);
        signatureCanvas.addEventListener('mouseup', stopDrawing);
        signatureCanvas.addEventListener('mouseout', stopDrawing);

        // Touch events for mobile
        signatureCanvas.addEventListener('touchstart', handleTouch);
        signatureCanvas.addEventListener('touchmove', handleTouch);
        signatureCanvas.addEventListener('touchend', stopDrawing);
    }

    function startDrawing(e) {
        isDrawing = true;
        const rect = signatureCanvas.getBoundingClientRect();
        ctx.beginPath();
        ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
    }

    function draw(e) {
        if (!isDrawing) return;

        const rect = signatureCanvas.getBoundingClientRect();
        ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
        ctx.stroke();
        hasSignature = true;
    }

    function stopDrawing() {
        isDrawing = false;
        ctx.beginPath();
    }

    function handleTouch(e) {
        e.preventDefault();
        const touch = e.touches[0];
        const mouseEvent = new MouseEvent(e.type === 'touchstart' ? 'mousedown' :
            e.type === 'touchmove' ? 'mousemove' : 'mouseup', {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
        signatureCanvas.dispatchEvent(mouseEvent);
    }

    function clearSignature() {
        ctx.clearRect(0, 0, signatureCanvas.width, signatureCanvas.height);
        hasSignature = false;
    }

    function openSignatureModal(contract) {
        currentContract = contract;

        // Update contract details in modal
        document.getElementById('signContractTitle').textContent = contract.title;
        document.getElementById('signContractOrg').textContent = contract.organization;
        document.getElementById('signContractType').textContent = contract.type;
        document.getElementById('signContractValue').textContent = contract.value;

        // Show modal and initialize canvas
        document.getElementById('signatureModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Initialize canvas after modal is visible
        setTimeout(() => {
            initializeSignatureCanvas();
        }, 100);
    }

    function closeSignatureModal() {
        document.getElementById('signatureModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentContract = null;
        hasSignature = false;
    }

    function finalizeSignature() {
        if (!hasSignature) {
            alert('Please add your signature before finalizing.');
            return;
        }

        // Get signature as base64 image
        const signatureData = signatureCanvas.toDataURL();

        // Simulate contract signing process
        alert(`Contract "${currentContract.title}" has been successfully signed!\n\nThe contract is now legally executed and ready for download.`);

        // Close modal and refresh page (in real app, this would update the backend)
        closeSignatureModal();

        // Simulate status update
        setTimeout(() => {
            location.reload();
        }, 1000);
    }

    function viewContract(contract) {
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

    function downloadContract(contract) {
        // Simulate PDF download
        alert(`Downloading signed contract: "${contract.title}"\n\nThe PDF file would be generated and downloaded in a real implementation.`);

        // In a real implementation, this would trigger a PDF generation and download
        // window.open(`/lawyer/contracts/${contract.id}/download`, '_blank');
    }

    function generateContractHTML(contract) {
        if (contract.type === 'Volunteer Service Agreement') {
            return `
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">VOLUNTEER SERVICE AGREEMENT</h2>
                    <p class="text-gray-600 mt-2">Contract No: VSA-2024-001</p>
                </div>

                <div class="space-y-4 text-sm text-gray-700 leading-relaxed">
                    <p><strong>This Volunteer Service Agreement</strong> ("Agreement") is entered into on ${contract.created_at} between:</p>

                    <div class="ml-4 space-y-4 mb-6">
                        <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                            <p class="font-semibold text-green-800 mb-3">REQUESTING ORGANIZATION:</p>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p><strong>Organization:</strong> ${contract.organization}</p>
                                    <p><strong>Representative:</strong> ${contract.representative || 'John Smith'}</p>
                                </div>
                                <div>
                                    <p><strong>Email:</strong> ${contract.email || 'contact@organization.com'}</p>
                                    <p><strong>Phone:</strong> ${contract.phone || '+1 (555) 123-4567'}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p><strong>1. SERVICE DESCRIPTION</strong></p>
                    <p class="ml-4">The Volunteer agrees to provide voluntary services as described in the approved service request.</p>

                    <p><strong>2. DURATION AND COMMITMENT</strong></p>
                    <p class="ml-4">Service Period: As specified in the service agreement terms.</p>

                    <p><strong>3. LEGAL SIGNATURE</strong></p>
                    <div class="ml-4 p-4 ${contract.status === 'signed' ? 'bg-green-50 border-green-200' : 'bg-yellow-50 border-yellow-200'} border rounded-lg">
                        ${contract.status === 'signed' ? 
                            '<p class="text-green-800"><strong>✓ DIGITALLY SIGNED</strong></p><p class="text-sm text-green-600 mt-1">This contract has been legally executed with digital signature.</p><p class="text-xs text-green-500 mt-2">Lawyer: ' + '{{ auth()->user()->name }}' + '<br>License: [LICENSE_NUMBER]<br>Date: ' + (contract.signed_at || 'Recent') + '</p>' : 
                            '<p class="text-yellow-800"><strong>⚠ AWAITING SIGNATURE</strong></p><p class="text-sm text-yellow-600 mt-1">This contract requires legal signature to be finalized.</p>'
                        }
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

    // Close modals when clicking outside
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
</script>