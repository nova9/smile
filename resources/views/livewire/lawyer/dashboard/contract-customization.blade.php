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

            <!-- Template Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Templates</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $stats['total_templates'] }}</p>
                        </div>
                        <div class="p-3 bg-gray-100 rounded-full">
                            <i data-lucide="file-text" class="w-6 h-6 text-gray-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Active Templates</p>
                            <p class="text-3xl font-bold text-green-600">{{ $stats['active_templates'] }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Most Used</p>
                            <p class="text-3xl font-bold text-accent">{{ $stats['most_used'] }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <i data-lucide="trending-up" class="w-6 h-6 text-accent"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/95 backdrop-blur-lg rounded-2xl p-6 shadow-lg border border-white/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Last Modified</p>
                            <p class="text-3xl font-bold text-black">{{ $stats['last_modified'] }}</p>
                        </div>
                        <div class="p-3 bg-gray-100 rounded-full">
                            <i data-lucide="clock" class="w-6 h-6 text-black"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="flex justify-between items-center">
                <div class="flex gap-4">
                    <select id="templateTypeFilter" class="select select-bordered select-sm" onchange="applyFilters()">
                        <option value="">All Types</option>
                        <option value="Volunteer Service Agreement">Volunteer Service Agreement</option>
                        <option value="Employment Contract">Employment Contract</option>
                        <option value="Partnership Agreement">Partnership Agreement</option>
                        <option value="NDA">NDA</option>
                        <option value="General Contract">General Contract</option>
                    </select>
                    <select id="statusFilter" class="select select-bordered select-sm" onchange="applyFilters()">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="draft">Draft</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
                <button class="btn btn-accent" onclick="openCreateTemplateModal()">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    New Template
                </button>
            </div>

            <!-- Contract Customization -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Contract Templates</h3>
                    <span id="resultCount" class="text-sm text-gray-500">Showing {{ count($templates) }} templates</span>
                </div>

                <div id="templatesList" class="space-y-4">
                    @foreach($templates as $template)
                    <div class="template-card border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200"
                        data-type="{{ $template['type'] }}"
                        data-status="{{ $template['status'] }}">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="font-semibold text-gray-800 text-lg">{{ $template['name'] }}</h4>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full 
                                        @if($template['status'] == 'active') bg-green-100 text-green-700
                                        @elseif($template['status'] == 'draft') bg-yellow-100 text-yellow-700
                                        @else bg-gray-100 text-gray-700 @endif">
                                        {{ ucfirst($template['status']) }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-4 text-sm text-gray-600 mb-2">
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="scroll-text" class="w-3 h-3 text-gray-500"></i>
                                        <span>{{ $template['type'] }}</span>
                                    </div>
                                    <span class="text-gray-400">•</span>
                                    <span>{{ $template['usage_count'] }} uses</span>
                                    <span class="text-gray-400">•</span>
                                    <span>Modified {{ $template['last_modified'] }}</span>
                                </div>
                                <p class="text-sm text-gray-600">{{ $template['description'] }}</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="btn btn-outline btn-sm" onclick="previewTemplate({{ json_encode($template) }})">
                                    <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                    Preview
                                </button>
                                <button class="btn btn-accent btn-sm" onclick="editTemplate({{ json_encode($template) }})">
                                    <i data-lucide="edit-3" class="w-4 h-4 mr-2"></i>
                                    Edit
                                </button>
                                <div class="dropdown dropdown-end">
                                    <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
                                        <i data-lucide="settings" class="w-4 h-4"></i>
                                    </div>
                                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                                        <li><a onclick="duplicateTemplate({{ json_encode($template) }})">
                                                <i data-lucide="files" class="w-4 h-4"></i>
                                                Duplicate
                                            </a></li>
                                        <li><a onclick="toggleTemplateStatus({{ json_encode($template) }})">
                                                <i data-lucide="archive" class="w-4 h-4"></i>
                                                {{ $template['status'] == 'active' ? 'Archive' : 'Activate' }}
                                            </a></li>
                                        <li><a onclick="exportTemplate({{ json_encode($template) }})">
                                                <i data-lucide="download" class="w-4 h-4"></i>
                                                Export
                                            </a></li>
                                        <li class="border-t pt-2 mt-2"><a onclick="deleteTemplate({{ json_encode($template) }})" class="text-red-600">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                Delete
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- No Results Message -->
                <div id="noResults" class="hidden text-center py-12">
                    <i data-lucide="file-text" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">No templates found</h3>
                    <p class="text-gray-500">Try adjusting your filters or create a new template</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Template Preview/Edit Modal -->
    <div id="templateModal" class="fixed inset-0 bg-white/95 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden border border-gray-200">
            <!-- Modal Header -->
            <div class="bg-green-600 text-white p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 id="modalTitle" class="text-2xl font-bold">Template Management</h2>
                        <p id="modalSubtitle" class="text-green-100 mt-1">Customize your contract template</p>
                    </div>
                    <button onclick="closeTemplateModal()" class="text-white hover:text-gray-200 transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto max-h-[70vh]">
                <form id="templateForm" class="space-y-6">
                    <!-- Template Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Template Name</label>
                            <input type="text" id="templateName" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Enter template name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Contract Type</label>
                            <select id="templateType" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option>General Contract</option>
                                <option>Volunteer Service Agreement</option>
                                <option>Employment Contract</option>
                                <option>Partnership Agreement</option>
                                <option>NDA</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea id="templateDescription" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Brief description of the template"></textarea>
                        </div>
                    </div>

                    <!-- Template Content -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Template Content</label>
                        <textarea id="templateContent" rows="15" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 font-mono text-sm" placeholder="Enter your template content here..."></textarea>
                        <p class="text-xs text-gray-500 mt-2">Use placeholders like [CLIENT_NAME], [DATE], [AMOUNT] for dynamic content</p>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t border-gray-200">
                <div class="flex items-center gap-4">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" id="templateActive" class="checkbox checkbox-sm checkbox-accent">
                        <span class="text-sm text-gray-700">Set as active template</span>
                    </label>
                </div>
                <div class="flex gap-3">
                    <button onclick="closeTemplateModal()" class="btn btn-outline">Cancel</button>
                    <button id="saveTemplateBtn" class="btn btn-accent">
                        <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                        Save Template
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-lawyer.dashboard-layout>

<script>
    let currentTemplate = null;
    let isEditMode = false;

    function applyFilters() {
        const typeFilter = document.getElementById('templateTypeFilter').value;
        const statusFilter = document.getElementById('statusFilter').value;

        const templateCards = document.querySelectorAll('.template-card');
        let visibleCount = 0;

        templateCards.forEach(card => {
            const cardType = card.getAttribute('data-type');
            const cardStatus = card.getAttribute('data-status');

            const typeMatch = !typeFilter || cardType === typeFilter;
            const statusMatch = !statusFilter || cardStatus === statusFilter;

            if (typeMatch && statusMatch) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        document.getElementById('resultCount').textContent = `Showing ${visibleCount} templates`;

        const noResults = document.getElementById('noResults');
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }

    function openCreateTemplateModal() {
        isEditMode = false;
        currentTemplate = null;

        document.getElementById('modalTitle').textContent = 'Create New Template';
        document.getElementById('modalSubtitle').textContent = 'Design a custom contract template';

        // Clear form
        document.getElementById('templateName').value = '';
        document.getElementById('templateType').value = 'General Contract';
        document.getElementById('templateDescription').value = '';
        document.getElementById('templateContent').value = '';
        document.getElementById('templateActive').checked = true;

        document.getElementById('templateModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function editTemplate(template) {
        isEditMode = true;
        currentTemplate = template;

        document.getElementById('modalTitle').textContent = 'Edit Template';
        document.getElementById('modalSubtitle').textContent = template.name;

        // Fill form with template data
        document.getElementById('templateName').value = template.name;
        document.getElementById('templateType').value = template.type;
        document.getElementById('templateDescription').value = template.description;
        document.getElementById('templateContent').value = template.content || getSampleTemplateContent(template.type);
        document.getElementById('templateActive').checked = template.status === 'active';

        document.getElementById('templateModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function previewTemplate(template) {
        editTemplate(template);

        // Make form read-only for preview
        const inputs = document.querySelectorAll('#templateForm input, #templateForm select, #templateForm textarea');
        inputs.forEach(input => input.disabled = true);

        document.getElementById('modalTitle').textContent = 'Preview Template';
        document.getElementById('saveTemplateBtn').style.display = 'none';
    }

    function closeTemplateModal() {
        document.getElementById('templateModal').classList.add('hidden');
        document.body.style.overflow = 'auto';

        // Re-enable form elements
        const inputs = document.querySelectorAll('#templateForm input, #templateForm select, #templateForm textarea');
        inputs.forEach(input => input.disabled = false);

        document.getElementById('saveTemplateBtn').style.display = 'inline-flex';
    }

    function duplicateTemplate(template) {
        if (confirm(`Create a copy of "${template.name}"?`)) {
            alert(`Template "${template.name}" has been duplicated successfully!`);
            // In real implementation, this would create a copy
        }
    }

    function toggleTemplateStatus(template) {
        const action = template.status === 'active' ? 'archive' : 'activate';
        if (confirm(`${action.charAt(0).toUpperCase() + action.slice(1)} template "${template.name}"?`)) {
            alert(`Template "${template.name}" has been ${action}d successfully!`);
            // In real implementation, this would update the status
        }
    }

    function exportTemplate(template) {
        alert(`Exporting template "${template.name}"...\n\nThe template would be downloaded as a file in a real implementation.`);
    }

    function deleteTemplate(template) {
        if (confirm(`Are you sure you want to delete template "${template.name}"?\n\nThis action cannot be undone.`)) {
            alert(`Template "${template.name}" has been deleted successfully!`);
            // In real implementation, this would delete the template
        }
    }

    function getSampleTemplateContent(type) {
        const templates = {
            'Volunteer Service Agreement': `VOLUNTEER SERVICE AGREEMENT

This Volunteer Service Agreement ("Agreement") is entered into on [DATE] between:

ORGANIZATION: [ORGANIZATION_NAME]
VOLUNTEER: [VOLUNTEER_NAME]

1. SERVICE DESCRIPTION
The Volunteer agrees to provide voluntary services as described in the service request.

2. DURATION
Service Period: From [START_DATE] to [END_DATE]

3. RESPONSIBILITIES
• Volunteer Responsibilities: [VOLUNTEER_RESPONSIBILITIES]
• Organization Responsibilities: [ORGANIZATION_RESPONSIBILITIES]

4. COMPENSATION
This is a voluntary service agreement. No monetary compensation will be provided.

5. TERMINATION
Either party may terminate this agreement with 7 days written notice.`,

            'Employment Contract': `EMPLOYMENT CONTRACT

This Employment Contract is entered into on [DATE] between:

EMPLOYER: [EMPLOYER_NAME]
EMPLOYEE: [EMPLOYEE_NAME]

1. POSITION
Position: [POSITION_TITLE]
Department: [DEPARTMENT]

2. COMPENSATION
Salary: [SALARY_AMOUNT] per [PERIOD]

3. BENEFITS
[BENEFITS_DESCRIPTION]

4. TERM
Start Date: [START_DATE]
Employment Type: [EMPLOYMENT_TYPE]`,

            'General Contract': `GENERAL CONTRACT

This Contract is entered into on [DATE] between:

PARTY 1: [PARTY1_NAME]
PARTY 2: [PARTY2_NAME]

1. PURPOSE
[CONTRACT_PURPOSE]

2. TERMS AND CONDITIONS
[TERMS_AND_CONDITIONS]

3. CONSIDERATION
[CONSIDERATION_AMOUNT]

4. DURATION
From [START_DATE] to [END_DATE]`
        };

        return templates[type] || templates['General Contract'];
    }

    // Save template functionality
    document.getElementById('saveTemplateBtn').addEventListener('click', function() {
        const templateData = {
            name: document.getElementById('templateName').value,
            type: document.getElementById('templateType').value,
            description: document.getElementById('templateDescription').value,
            content: document.getElementById('templateContent').value,
            active: document.getElementById('templateActive').checked
        };

        if (!templateData.name || !templateData.content) {
            alert('Please fill in the template name and content.');
            return;
        }

        const action = isEditMode ? 'updated' : 'created';
        alert(`Template "${templateData.name}" has been ${action} successfully!`);

        closeTemplateModal();
        // In real implementation, this would save to backend
    });

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.id === 'templateModal') closeTemplateModal();
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeTemplateModal();
    });
</script>