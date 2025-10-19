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
                        Manage and customize your contract templates
                    </p>
                </div>
            </div>

            <!-- Incoming Change Requests -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Incoming Change Requests</h3>
                    <span class="text-sm text-gray-500">Showing {{ count($changeRequests ?? []) }} requests</span>
                </div>

                @if(($changeRequests ?? []) && count($changeRequests))
                <div class="space-y-4">
                    @foreach($changeRequests as $req)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200"
                        data-request-id="{{ $req['id'] }}">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <h4 class="font-semibold text-gray-800 text-lg">
                                        {{ $req['template_name'] }}
                                    </h4>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full
                                            @if($req['status'] === 'pending') bg-yellow-100 text-yellow-700
                                            @elseif($req['status'] === 'approved') bg-green-100 text-green-700
                                            @else bg-red-100 text-red-700 @endif js-status-badge">
                                        {{ ucfirst($req['status']) }}
                                    </span>
                                    <span class="px-2 py-0.5 text-[10px] rounded-full
                                            @if(($req['priority'] ?? 'low') === 'high') bg-red-100 text-red-700
                                            @elseif(($req['priority'] ?? 'low') === 'medium') bg-yellow-100 text-yellow-700
                                            @else bg-gray-100 text-gray-700 @endif">
                                        {{ strtoupper($req['priority'] ?? 'low') }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium text-gray-800">{{ $req['organization'] }}</span>
                                    <span class="text-gray-400 mx-1">•</span>
                                    Requested at {{ $req['requested_at'] }}
                                </p>
                                <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                    <span class="font-medium">Reason:</span> {{ $req['reason'] }}
                                </p>
                            </div>
                            <div class="flex gap-2">
                                <button class="btn btn-outline btn-sm"
                                    onclick='openRequestModal(@json($req))'>
                                    <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                    View
                                </button>
                                <button class="btn btn-success btn-sm"
                                    onclick='approveChangeRequest(@json(["id"=>$req["id"]]))'>
                                    <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                                    Approve
                                </button>
                                <button class="btn btn-error btn-sm"
                                    onclick='rejectChangeRequest(@json(["id"=>$req["id"]]))'>
                                    <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                                    Reject
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="inbox" class="w-8 h-8 text-gray-400"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-600 mb-2">No Incoming Requests</h4>
                    <p class="text-gray-500">Organizations can submit change requests to appear here</p>
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- New: Request Details Modal -->
    <div id="requestModal" class="fixed inset-0 bg-white/95 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-5xl w-full max-h-[90vh] overflow-hidden border border-gray-200">
            <div class="bg-gray-800 text-white p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 id="reqModalTitle" class="text-2xl font-bold">Request Details</h2>
                        <p id="reqModalSubtitle" class="text-gray-300 mt-1">Review proposed changes before approval</p>
                    </div>
                    <button onclick="closeRequestModal()" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
            <div class="p-6 overflow-y-auto max-h-[70vh] space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Organization</p>
                        <p id="reqOrg" class="font-medium text-gray-800">-</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Contact</p>
                        <p id="reqContact" class="font-medium text-gray-800">-</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Requested At</p>
                        <p id="reqRequestedAt" class="font-medium text-gray-800">-</p>
                    </div>
                </div>

                <div>
                    <p class="text-gray-700 font-semibold mb-1">Reason</p>
                    <p id="reqReason" class="text-sm text-gray-700 bg-gray-50 border border-gray-200 rounded p-3">-</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border rounded-lg">
                        <div class="px-4 py-2 bg-gray-50 border-b text-sm font-medium text-gray-700">Current Terms</div>
                        <pre id="reqCurrentTerms" class="p-4 text-sm overflow-auto whitespace-pre-wrap bg-white">-</pre>
                    </div>
                    <div class="border rounded-lg">
                        <div class="px-4 py-2 bg-green-50 border-b text-sm font-medium text-green-700">Proposed Terms</div>
                        <pre id="reqProposedTerms" class="p-4 text-sm overflow-auto whitespace-pre-wrap bg-white">-</pre>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <button onclick="closeRequestModal()" class="btn btn-outline">Close</button>
                <div class="flex gap-2">
                    <button id="reqRejectBtn" class="btn btn-error">
                        <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                        Reject
                    </button>
                    <button id="reqApproveBtn" class="btn btn-success">
                        <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                        Approve
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-lawyer.dashboard-layout>

<script>
    // Keep only request-related globals
    var currentRequest = window.currentRequest || null;
    window.currentRequest = currentRequest;

    // Request interactions
    function openRequestModal(request) {
        currentRequest = request;
        window.currentRequest = currentRequest;

        // Header
        const t = request.template_name || 'Request Details';
        document.getElementById('reqModalTitle').textContent = t;
        document.getElementById('reqModalSubtitle').textContent = (request.organization || '-') + ' • ' + (request.priority || 'low').toUpperCase();

        // Meta
        document.getElementById('reqOrg').textContent = request.organization || '-';
        document.getElementById('reqContact').textContent = `${request.contact_person || '-'} (${request.contact_email || '-'})`;
        document.getElementById('reqRequestedAt').textContent = request.requested_at || '-';

        // Content
        document.getElementById('reqReason').textContent = request.reason || '-';
        document.getElementById('reqCurrentTerms').textContent = request.current_terms || '-';
        document.getElementById('reqProposedTerms').textContent = request.proposed_terms || '-';

        // Bind footer actions
        const approve = () => approveChangeRequest({
            id: request.id
        });
        const reject = () => rejectChangeRequest({
            id: request.id
        });
        document.getElementById('reqApproveBtn').onclick = approve;
        document.getElementById('reqRejectBtn').onclick = reject;

        // Show modal
        const modal = document.getElementById('requestModal');
        if (modal) modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeRequestModal() {
        const modal = document.getElementById('requestModal');
        if (modal) modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentRequest = null;
        window.currentRequest = null;
    }

    function setStatusBadge(el, status) {
        el.textContent = status.charAt(0).toUpperCase() + status.slice(1);
        el.classList.remove('bg-yellow-100', 'text-yellow-700', 'bg-green-100', 'text-green-700', 'bg-red-100', 'text-red-700');
        if (status === 'approved') {
            el.classList.add('bg-green-100', 'text-green-700');
        } else if (status === 'rejected') {
            el.classList.add('bg-red-100', 'text-red-700');
        } else {
            el.classList.add('bg-yellow-100', 'text-yellow-700');
        }
    }

    function approveChangeRequest(payload) {
        const id = (payload && payload.id) ? payload.id : (currentRequest && currentRequest.id);
        if (!id) return;
        if (!confirm('Approve this change request?')) return;

        const card = document.querySelector(`[data-request-id="${id}"]`);
        if (card) {
            const badge = card.querySelector('.js-status-badge');
            if (badge) setStatusBadge(badge, 'approved');
        }

        alert('Change request has been approved. (Front-end only)');
        closeRequestModal();
    }

    function rejectChangeRequest(payload) {
        const id = (payload && payload.id) ? payload.id : (currentRequest && currentRequest.id);
        if (!id) return;
        if (!confirm('Reject this change request?')) return;

        const card = document.querySelector(`[data-request-id="${id}"]`);
        if (card) {
            const badge = card.querySelector('.js-status-badge');
            if (badge) setStatusBadge(badge, 'rejected');
        }

        alert('Change request has been rejected. (Front-end only)');
        closeRequestModal();
    }

    // Guarded listeners to avoid duplicates
    if (!window.__contractCustomizationListenersAdded) {
        // Close request modal when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target && e.target.id === 'requestModal') closeRequestModal();
        });
        // Close modals with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeRequestModal();
        });
        window.__contractCustomizationListenersAdded = true;
    }
</script>