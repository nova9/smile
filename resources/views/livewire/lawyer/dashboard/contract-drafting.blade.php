<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Success Message -->
            @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
            @endif

            <!-- Error Message -->
            @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <i data-lucide="edit-3" class="w-5 h-5 mr-2 text-green-600"></i>
                    Contract Templates
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Contract <span class="text-accent">Templates</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Create and customize legal contract templates efficiently
                    </p>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="flex justify-between items-center">
                <button class="btn btn-accent" onclick="openContractModal()">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    Create New Template
                </button>
            </div>

            <!-- Saved Agreements Section -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Saved Contract Agreements</h3>
                        <p class="text-gray-600">Recently created contract agreements</p>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <i data-lucide="file-check" class="w-4 h-4"></i>
                        <span>{{ $savedAgreements->count() }} Agreements</span>
                    </div>
                </div>

                @if($savedAgreements->count() > 0)
                <div class="space-y-4">
                    @foreach($savedAgreements as $agreement)
                    <div class="bg-gradient-to-r from-white to-gray-50 border-2 border-gray-200 rounded-2xl p-6 hover:border-blue-300 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="font-bold text-gray-800 text-xl">{{ $agreement->topic }}</h4>
                                    <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                                        Saved
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm mb-3">
                                    Created: {{ $agreement->created_at->format('F d, Y \a\t h:i A') }}
                                </p>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-700 font-medium mb-2">Agreement Terms:</p>
                                    <p class="text-sm text-gray-600 whitespace-pre-line">{{ Str::limit($agreement->terms, 200) }}</p>
                                    @if(strlen($agreement->terms) > 200)
                                    <button class="text-blue-600 text-sm mt-2 hover:underline" onclick="alert('{{ addslashes($agreement->terms) }}')">
                                        Read more...
                                    </button>
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <button wire:click="editAgreement({{ $agreement->id }})"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center gap-2">
                                    <i data-lucide="edit-2" class="w-4 h-4"></i>
                                    Edit
                                </button>
                                <button wire:click="deleteAgreement({{ $agreement->id }})"
                                    wire:confirm="Are you sure you want to delete this agreement?"
                                    class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition-colors duration-200 flex items-center gap-2">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12 text-gray-500">
                    <i data-lucide="file-text" class="w-16 h-16 mx-auto mb-4 text-gray-300"></i>
                    <p class="text-lg font-medium">No contract templates yet</p>
                    <p class="text-sm mt-2">Create your first contract template to get started.</p>
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Contract Template Modal -->
    <div id="contractModal" class="fixed inset-0 bg-white/95 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden border border-gray-200">
            <!-- Modal Header -->
            <div class="bg-green-600 text-white p-6">
                <div class="flex justify-between items-center">
                    <h2 id="modalTitle" class="text-2xl font-bold">New Contract Template</h2>
                    <button onclick="closeContractModal()" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
                <p id="modalSubtitle" class="text-green-100 mt-2">Service Agreement Template</p>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <form class="space-y-8">
                    <!-- Contract Topic (editable by lawyer) -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-5 h-5 text-green-600"></i>
                            Contract Topic
                        </h3>
                        <input type="text"
                            id="contractTopic"
                            wire:model="topic"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            placeholder="e.g., Volunteer Service Agreement for [EVENT]">
                        @error('topic') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Organization / Requestor (read-only placeholders) -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="building-2" class="w-5 h-5 text-green-600"></i>
                            Organization / Requestor Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Organization / Requestor</label>
                                <input id="orgName" type="text" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed" value="[ORGANIZATION_NAME]" disabled>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Event</label>
                                <input id="eventName" type="text" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed" value="[EVENT]" disabled>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                                <input id="orgStartDate" type="text" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed" value="[START_DATE]" disabled>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                                <input id="orgEndDate" type="text" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed" value="[END_DATE]" disabled>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                                <input id="orgDuration" type="text" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed" value="[DURATION]" disabled>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                                <input id="orgContact" type="text" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed" value="[CONTACT_NUMBER]" disabled>
                            </div>
                        </div>
                    </div>

                    <!-- Volunteer Information (read-only placeholders) -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-5 h-5 text-green-600"></i>
                            Volunteer Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                <input id="volName" type="text" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed" value="[VOLUNTEER_NAME]" disabled>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <input id="volAddress" type="text" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed" value="[VOLUNTEER_ADDRESS]" disabled>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input id="volEmail" type="text" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed" value="[VOLUNTEER_EMAIL]" disabled>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">NIC</label>
                                <input id="volNic" type="text" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed" value="[VOLUNTEER_NIC]" disabled>
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions (editable) -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="edit-3" class="w-5 h-5 text-green-600"></i>
                            Agreement Terms (Editable)
                        </h3>
                        <textarea id="termsContent"
                            wire:model="terms"
                            rows="10"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            placeholder="Enter terms and conditions here..."></textarea>
                        @error('terms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>



                    <!-- Signature and Volunteer Acceptance (non-editable placeholders) -->
                    <div class="pt-2">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-5 h-5 text-green-600"></i>
                            Signatures and Acceptance
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lawyer Signature</label>
                                <div class="h-24 border-2 border-dashed border-gray-300 rounded-lg bg-white flex items-center justify-center text-gray-400 text-sm select-none">
                                    Signature image will appear here (non-editable)
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Volunteer Agreement</label>
                                <div class="p-4 border border-gray-200 rounded-lg bg-white text-sm text-gray-700">
                                    <div class="flex items-start gap-3">
                                        <input type="checkbox" disabled class="mt-1 w-4 h-4 text-green-600 border-gray-300 rounded">
                                        <p>
                                            I, <span class="font-medium">[VOLUNTEER_NAME]</span> (NIC: <span class="font-mono">[VOLUNTEER_NIC]</span>), agree to the terms and conditions stated in this contract.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <button onclick="closeContractModal()" class="btn btn-outline">
                    Cancel
                </button>
                <div class="flex gap-3">

                    <button type="button" wire:click="saveAgreement" class="btn btn-accent">
                        <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                        Save Template
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-lawyer.dashboard-layout>

<script>
    // Listen for Livewire events
    document.addEventListener('livewire:init', () => {
        Livewire.on('agreementSaved', () => {
            closeContractModal();
            // Show success message (already handled by session flash)
        });

        Livewire.on('editAgreement', (event) => {
            // Wait a brief moment for Livewire to update the form fields
            setTimeout(() => {
                // Open modal in edit mode
                const modal = document.getElementById('contractModal');
                if (modal) modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';

                // Update modal header
                const titleEl = document.getElementById('modalTitle');
                const subEl = document.getElementById('modalSubtitle');
                if (titleEl) titleEl.textContent = 'Edit Contract Agreement';
                if (subEl) subEl.textContent = 'Update existing agreement';

                // Update button text
                updateSaveButtonText('Update');

                // Make sure lucide icons are initialized
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }, 100);
        });
    });

    function updateSaveButtonText(text) {
        const saveBtn = document.querySelector('#contractModal .btn-accent');
        if (saveBtn) {
            if (text === 'Update') {
                saveBtn.innerHTML = '<i data-lucide="save" class="w-4 h-4 mr-2"></i>Update Agreement';
            } else {
                saveBtn.innerHTML = '<i data-lucide="save" class="w-4 h-4 mr-2"></i>Save Template';
            }
            // Re-initialize lucide icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }
    }

    function openContractModal() {
        clearContractForm();
        setModalMode('edit');
        updateContractPreview();
        const modal = document.getElementById('contractModal');
        if (modal) modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Update modal header for new agreement
        const titleEl = document.getElementById('modalTitle');
        const subEl = document.getElementById('modalSubtitle');
        if (titleEl) titleEl.textContent = 'New Contract Template';
        if (subEl) subEl.textContent = 'Service Agreement Template';

        // Update button text
        updateSaveButtonText('Save');
    }

    function openContractModalWithTemplate(templateName) {
        clearContractForm();
        setModalMode('edit');

        // Prefill topic with the selected template name
        const topicEl = document.getElementById('contractTopic');
        if (topicEl && templateName) topicEl.value = templateName;

        // Update modal header
        const titleEl = document.getElementById('modalTitle');
        const subEl = document.getElementById('modalSubtitle');
        if (titleEl) titleEl.textContent = `New Template - ${templateName}`;
        if (subEl) subEl.textContent = 'Service Agreement Template';

        updateContractPreview();
        const modal = document.getElementById('contractModal');
        if (modal) modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function setModalMode(mode) {
        const isViewMode = mode === 'view';

        // Only topic and terms are editable
        const editableIds = new Set(['contractTopic', 'termsContent']);
        const alwaysReadOnlyIds = new Set([
            'orgName', 'eventName', 'orgStartDate', 'orgEndDate', 'orgDuration', 'orgContact',
            'volName', 'volAddress', 'volEmail', 'volNic'
        ]);

        const fields = document.querySelectorAll('#contractModal input, #contractModal textarea, #contractModal select');
        fields.forEach(el => {
            const id = el.id || '';
            if (editableIds.has(id)) {
                el.disabled = isViewMode;
                if (isViewMode) {
                    el.classList.add('bg-gray-100', 'cursor-not-allowed');
                } else {
                    el.classList.remove('bg-gray-100', 'cursor-not-allowed');
                }
            } else if (alwaysReadOnlyIds.has(id)) {
                el.disabled = true;
                el.classList.add('bg-gray-50', 'cursor-not-allowed');
            }
        });

        // Buttons
        const saveBtn = document.querySelector('#contractModal .btn-accent');
        const cancelBtn = document.querySelector('#contractModal .btn-outline');

        if (saveBtn && cancelBtn) {
            if (isViewMode) {
                saveBtn.style.display = 'none';
                cancelBtn.textContent = 'Close';
            } else {
                saveBtn.style.display = 'inline-flex';
                cancelBtn.textContent = 'Cancel';
                saveBtn.innerHTML = '<i data-lucide="save" class="w-4 h-4 mr-2"></i>Save Template';
            }
        }
    }

    function clearContractForm() {
        // Topic and terms (editable) - Let Livewire handle clearing via reset
        // Just clear the input elements for visual feedback
        const topicEl = document.getElementById('contractTopic');
        const termsEl = document.getElementById('termsContent');

        // Set default values
        if (termsEl && !termsEl.value.trim()) {
            termsEl.value = `1. The volunteer agrees to perform assigned duties diligently and responsibly.
2. The organization will provide necessary guidance and a safe work environment.
3. Confidential information must not be disclosed without consent.
4. Either party may terminate this agreement with prior notice.`;
        }

        // Read-only placeholders for backend autofill later
        const setVal = (id, val) => {
            const el = document.getElementById(id);
            if (el) {
                el.value = val;
                el.disabled = true;
                el.classList.add('bg-gray-50', 'cursor-not-allowed');
            }
        };
        setVal('orgName', '[ORGANIZATION_NAME]');
        setVal('eventName', '[EVENT]');
        setVal('orgStartDate', '[START_DATE]');
        setVal('orgEndDate', '[END_DATE]');
        setVal('orgDuration', '[DURATION]');
        setVal('orgContact', '[CONTACT_NUMBER]');
        setVal('volName', '[VOLUNTEER_NAME]');
        setVal('volAddress', '[VOLUNTEER_ADDRESS]');
        setVal('volEmail', '[VOLUNTEER_EMAIL]');
        setVal('volNic', '[VOLUNTEER_NIC]');

        // Header
        const titleEl = document.getElementById('modalTitle');
        const subEl = document.getElementById('modalSubtitle');
        if (titleEl) titleEl.textContent = 'Create New Contract Template';
        if (subEl) subEl.textContent = 'Contract Template';
    }

    function updateContractPreview() {
        const get = id => document.getElementById(id)?.value || '';
        const topic = (get('contractTopic').trim()) || '[CONTRACT_TOPIC]';

        const org = {
            name: get('orgName') || '[ORGANIZATION_NAME]',
            event: get('eventName') || '[EVENT]',
            start: get('orgStartDate') || '[START_DATE]',
            end: get('orgEndDate') || '[END_DATE]',
            duration: get('orgDuration') || '[DURATION]',
            contact: get('orgContact') || '[CONTACT_NUMBER]',
        };

        const vol = {
            name: get('volName') || '[VOLUNTEER_NAME]',
            address: get('volAddress') || '[VOLUNTEER_ADDRESS]',
            email: get('volEmail') || '[VOLUNTEER_EMAIL]',
            nic: get('volNic') || '[VOLUNTEER_NIC]',
        };

        const terms = get('termsContent') || '';

        const previewContainer = document.getElementById('templatePreview');
        if (!previewContainer) return;

        previewContainer.innerHTML = `
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">${topic}</h2>
                <p class="text-gray-600 mt-2">Contract Template Preview</p>
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
                    <div class="ml-4 whitespace-pre-wrap">${terms || '<span class="text-gray-500">Enter terms and conditions above...</span>'}</div>
                </div>
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="text-center">
                        <p class="text-sm font-medium mb-2 text-gray-700">Lawyer Signature</p>
                        <div class="border-b-2 border-gray-400 mb-3 h-16"></div>
                        <p class="text-xs text-gray-500">Signature image will appear here</p>
                    </div>
                    <div class="text-sm text-gray-700">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" disabled class="mt-1 w-4 h-4 text-green-600 border-gray-300 rounded">
                            <p>I, <span class="font-medium">${vol.name}</span> (NIC: <span class="font-mono">${vol.nic}</span>), agree to the terms and conditions stated in this contract.</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">This section is non-editable in the template.</p>
                    </div>
                </div>
            </div>
        `;
    }

    // Update listeners to reflect editable fields for the template
    document.addEventListener('DOMContentLoaded', function() {
        // Only track editable fields
        const formFields = ['contractTopic', 'termsContent'];
        formFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.addEventListener('input', updateContractPreview);
                field.addEventListener('change', updateContractPreview);
            }
        });
        updateContractPreview();
    });

    function closeContractModal() {
        const modal = document.getElementById('contractModal');
        if (modal) modal.classList.add('hidden');
        document.body.style.overflow = 'auto';

        // Reset form state (do not re-enable read-only placeholders)
        const editableIds = ['contractTopic', 'termsContent'];
        editableIds.forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.disabled = false;
                el.classList.remove('bg-gray-100', 'cursor-not-allowed');
            }
        });

        const saveBtn = document.querySelector('#contractModal .btn-accent');
        const cancelBtn = document.querySelector('#contractModal .btn-outline');
        if (saveBtn) saveBtn.style.display = 'inline-flex';
        if (cancelBtn) cancelBtn.textContent = 'Cancel';

        // Call Livewire method to cancel edit mode
        Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id')).call('cancelEdit');
    }

    // Close modal when clicking outside
    document.getElementById('contractModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeContractModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeContractModal();
        }
    });
</script>