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
                        Review and approve volunteer service agreements
                    </p>
                </div>
            </div>

            <!-- Pending Approvals -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Pending Service Agreement Reviews</h3>
                <div class="space-y-4">
                    @foreach($pendingApprovals as $approval)
                    <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50 hover:shadow-xl transition-all duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800 text-lg">{{ $approval['title'] }}</h4>
                                <div class="flex items-center gap-3 mt-2">
                                    <p class="text-sm text-gray-600">{{ $approval['organization'] }}</p>
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="scroll-text" class="w-3 h-3 text-green-600"></i>
                                        <span class="text-sm text-green-600 font-medium">Volunteer Service Agreement</span>
                                    </div>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                @if($approval['status'] == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($approval['status'] == 'approved') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst($approval['status']) }}
                            </span>
                        </div>
                        <div class="flex gap-3">
                            <button class="btn btn-accent btn-sm" onclick="openApprovalModal({{ json_encode($approval) }}, 'approve')">
                                <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
                                Approve
                            </button>
                            <button class="btn btn-outline btn-sm" onclick="openApprovalModal({{ json_encode($approval) }}, 'changes')">
                                <i data-lucide="edit-3" class="w-4 h-4 mr-1"></i>
                                Request Changes
                            </button>
                            <button class="btn bg-red-600 text-white btn-sm hover:bg-red-700" onclick="openApprovalModal({{ json_encode($approval) }}, 'reject')">
                                <i data-lucide="x-circle" class="w-4 h-4 mr-1"></i>
                                Reject
                            </button>
                            <button class="btn btn-outline btn-sm" onclick="viewServiceDetails({{ json_encode($approval) }})">
                                <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                View Details
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Approval History -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Recent Decisions</h3>
                <div class="space-y-4">
                    @foreach($approvalHistory as $history)
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">{{ $history['title'] }}</h4>
                            <p class="text-sm text-gray-600">{{ $history['organization'] }} • {{ $history['decided_at'] }}</p>
                            @if($history['reason'])
                            <p class="text-sm text-gray-500 mt-1">{{ $history['reason'] }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                @if($history['status'] == 'approved') bg-green-100 text-green-700
                                @elseif($history['status'] == 'changes_requested') bg-gray-100 text-gray-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $history['status'])) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <!-- Approval Modal -->
    <div id="approvalModal" class="fixed inset-0 bg-white/95 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden border border-gray-200">
            <!-- Modal Header -->
            <div id="modalHeader" class="bg-green-600 text-white p-6">
                <div class="flex justify-between items-center">
                    <h2 id="modalTitle" class="text-2xl font-bold">Approve Service Agreement</h2>
                    <button onclick="closeApprovalModal()" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <p id="modalSubtitle" class="text-green-100 mt-2">Community Clean-up Initiative</p>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto max-h-[60vh]">
                <form class="space-y-6">
                    <!-- Service Details Display -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-5 h-5 text-green-600"></i>
                            Service Agreement Details
                        </h3>
                        <div id="serviceDetails" class="bg-gray-50 border border-gray-200 rounded-lg p-4 space-y-3">
                            <!-- Details will be populated by JavaScript -->
                        </div>
                    </div>

                    <!-- Comments/Reason Section -->
                    <div id="commentSection" class="space-y-4">
                        <div class="flex items-center gap-2 mb-3">
                            <i data-lucide="message-square" class="w-5 h-5 text-green-600"></i>
                            <h3 id="commentTitle" class="text-lg font-semibold text-gray-800">Approval Comments</h3>
                        </div>
                        <div>
                            <label id="commentLabel" class="block text-sm font-medium text-gray-700 mb-2">Additional Comments (Optional)</label>
                            <textarea id="commentText" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                rows="4" placeholder="Add any additional comments or feedback..."></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <button onclick="closeApprovalModal()" class="btn btn-outline">
                    Cancel
                </button>
                <div class="flex gap-3">
                    <button id="confirmButton" class="btn btn-accent" onclick="submitDecision()">
                        <i id="confirmIcon" data-lucide="check" class="w-4 h-4 mr-2"></i>
                        <span id="confirmText">Approve</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Details Modal -->
    <div id="detailsModal" class="fixed inset-0 bg-white/95 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden border border-gray-200">
            <!-- Modal Header -->
            <div class="bg-gray-800 text-white p-6">
                <div class="flex justify-between items-center">
                    <h2 id="detailsTitle" class="text-2xl font-bold">Service Agreement Details</h2>
                    <button onclick="closeDetailsModal()" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <div id="fullServiceDetails" class="space-y-6">
                    <!-- Full details will be populated by JavaScript -->
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-center border-t border-gray-200">
                <button onclick="closeDetailsModal()" class="btn btn-outline">
                    Close
                </button>
            </div>
        </div>
    </div>
</x-lawyer.dashboard-layout>

<script>
    let currentApproval = null;
    let currentAction = null;

    function openApprovalModal(approval, action) {
        currentApproval = approval;
        currentAction = action;

        const modal = document.getElementById('approvalModal');
        const header = document.getElementById('modalHeader');
        const title = document.getElementById('modalTitle');
        const subtitle = document.getElementById('modalSubtitle');
        const commentTitle = document.getElementById('commentTitle');
        const commentLabel = document.getElementById('commentLabel');
        const commentText = document.getElementById('commentText');
        const confirmButton = document.getElementById('confirmButton');
        const confirmIcon = document.getElementById('confirmIcon');
        const confirmText = document.getElementById('confirmText');

        // Update modal based on action
        if (action === 'approve') {
            header.className = 'bg-green-600 text-white p-6';
            title.textContent = 'Approve Service Agreement';
            commentTitle.textContent = 'Approval Comments';
            commentLabel.textContent = 'Additional Comments (Optional)';
            commentText.placeholder = 'Add any additional comments or feedback...';
            confirmButton.className = 'btn btn-accent';
            confirmIcon.setAttribute('data-lucide', 'check');
            confirmText.textContent = 'Approve';
        } else if (action === 'changes') {
            header.className = 'bg-gray-600 text-white p-6';
            title.textContent = 'Request Changes';
            commentTitle.textContent = 'Required Changes';
            commentLabel.textContent = 'Please specify what changes are needed *';
            commentText.placeholder = 'Describe the changes required for approval...';
            confirmButton.className = 'btn btn-outline';
            confirmIcon.setAttribute('data-lucide', 'edit-3');
            confirmText.textContent = 'Request Changes';
        } else if (action === 'reject') {
            header.className = 'bg-red-600 text-white p-6';
            title.textContent = 'Reject Service Agreement';
            commentTitle.textContent = 'Rejection Reason';
            commentLabel.textContent = 'Please provide a reason for rejection *';
            commentText.placeholder = 'Explain why this service agreement is being rejected...';
            confirmButton.className = 'btn bg-red-600 text-white hover:bg-red-700';
            confirmIcon.setAttribute('data-lucide', 'x-circle');
            confirmText.textContent = 'Reject';
        }

        subtitle.textContent = approval.title;

        // Populate service details
        const serviceDetails = document.getElementById('serviceDetails');
        serviceDetails.innerHTML = `
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm"><strong>Organization:</strong> ${approval.organization}</p>
                <p class="text-sm"><strong>Service Type:</strong> ${approval.service_type}</p>
                <p class="text-sm"><strong>Duration:</strong> ${approval.duration}</p>
            </div>
            <div>
                <p class="text-sm"><strong>Contact Person:</strong> ${approval.contact_person}</p>
                <p class="text-sm"><strong>Email:</strong> ${approval.email}</p>
                <p class="text-sm"><strong>Priority:</strong> ${approval.priority}</p>
            </div>
        </div>
        <div class="mt-4">
            <p class="text-sm"><strong>Description:</strong></p>
            <p class="text-sm text-gray-600 mt-1">${approval.description}</p>
        </div>
    `;

        // Re-initialize Lucide icons
        lucide.createIcons();

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function viewServiceDetails(approval) {
        const modal = document.getElementById('detailsModal');
        const title = document.getElementById('detailsTitle');
        const details = document.getElementById('fullServiceDetails');

        title.textContent = approval.title;

        details.innerHTML = `
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Organization Information</h3>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-sm mb-2"><strong>Organization Name:</strong> ${approval.organization}</p>
                    <p class="text-sm mb-2"><strong>Contact Person:</strong> ${approval.contact_person}</p>
                    <p class="text-sm mb-2"><strong>Email:</strong> ${approval.email}</p>
                    <p class="text-sm mb-2"><strong>Phone:</strong> ${approval.phone || 'Not provided'}</p>
                </div>
                <div>
                    <p class="text-sm mb-2"><strong>Service Type:</strong> ${approval.service_type}</p>
                    <p class="text-sm mb-2"><strong>Duration:</strong> ${approval.duration}</p>
                    <p class="text-sm mb-2"><strong>Priority Level:</strong> ${approval.priority}</p>
                    <p class="text-sm mb-2"><strong>Submitted:</strong> ${approval.submitted_at}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Service Description</h3>
            <p class="text-sm text-gray-700 leading-relaxed">${approval.description}</p>
        </div>
        
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Requirements & Terms</h3>
            <ul class="text-sm text-gray-700 space-y-2">
                <li>• Volunteers must be available for the specified duration</li>
                <li>• Background verification may be required</li>
                <li>• Organization will provide necessary training and materials</li>
                <li>• Volunteers are expected to follow organization guidelines</li>
                <li>• Certificate of completion will be provided upon successful service</li>
            </ul>
        </div>
        
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Legal Considerations</h3>
            <ul class="text-sm text-gray-700 space-y-2">
                <li>• Liability coverage provided by the organization</li>
                <li>• Confidentiality agreement if handling sensitive information</li>
                <li>• Clear termination procedures for both parties</li>
                <li>• Dispute resolution mechanisms in place</li>
            </ul>
        </div>
    `;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function submitDecision() {
        const commentText = document.getElementById('commentText').value;

        if ((currentAction === 'changes' || currentAction === 'reject') && !commentText.trim()) {
            alert('Please provide a reason or specify the required changes.');
            return;
        }

        // Here you would typically send the decision to the backend
        console.log('Decision:', currentAction);
        console.log('Approval ID:', currentApproval.id);
        console.log('Comment:', commentText);

        // Show success message
        const actionText = currentAction === 'approve' ? 'approved' :
            currentAction === 'changes' ? 'sent back for changes' : 'rejected';
        alert(`Service agreement has been ${actionText} successfully!`);

        closeApprovalModal();

        // In a real application, you would reload the data or update the UI
        // For now, we'll just close the modal
    }

    function closeApprovalModal() {
        document.getElementById('approvalModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('commentText').value = '';
    }

    function closeDetailsModal() {
        document.getElementById('detailsModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modals when clicking outside
    document.getElementById('approvalModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeApprovalModal();
        }
    });

    document.getElementById('detailsModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetailsModal();
        }
    });

    // Close modals with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeApprovalModal();
            closeDetailsModal();
        }
    });
</script>