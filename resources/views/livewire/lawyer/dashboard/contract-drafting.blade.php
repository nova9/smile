<x-lawyer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500/10 to-green-600/10 text-black rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-green-500/20">
                    <i data-lucide="edit-3" class="w-5 h-5 mr-2 text-green-600"></i>
                    Contract Drafting
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-800 leading-tight relative">
                        Contract <span class="text-accent">Drafting</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-green-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Create and manage legal contracts efficiently
                    </p>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="flex justify-between items-center">
                <button class="btn btn-accent" onclick="openContractModal()">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    New Contract
                </button>
            </div>

            <div class="flex justify-between items-center">
                <button class="btn btn-accent" onclick="openContractModal()">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    New Contract Testing
                </button>
            </div>
            
            <!-- Current Contracts -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Current Drafts</h3>
                <div class="space-y-4">
                    @foreach($contracts as $contract)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-semibold text-gray-800 text-lg">{{ $contract['title'] }}</h4>
                                <p class="text-sm text-gray-600">{{ $contract['type'] }}</p>
                            </div>
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                @if($contract['status'] == 'in_progress') bg-green-100 text-green-700
                                @elseif($contract['status'] == 'draft') bg-gray-100 text-gray-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst(str_replace('_', ' ', $contract['status'])) }}
                            </span>
                        </div>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Progress</span>
                                <span>{{ $contract['progress'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ $contract['progress'] }}%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Created: {{ $contract['created_at'] }}</span>
                            <div class="flex gap-2">
                                <button class="btn btn-accent btn-sm" onclick="openContractModalWithData({{ json_encode($contract) }}, 'edit')">Edit</button>
                                <button class="btn btn-outline btn-sm" onclick="openContractModalWithData({{ json_encode($contract) }}, 'view')">View</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Templates -->
            <div class="bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Contract Templates</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($templates as $template)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all duration-200 cursor-pointer hover:border-green-300">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-green-100 rounded-full">
                                <i data-lucide="file-text" class="w-4 h-4 text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">{{ $template['name'] }}</h4>
                                <p class="text-xs text-gray-500">{{ $template['category'] }}</p>
                            </div>
                        </div>
                        <button class="btn btn-accent btn-sm w-full" onclick="openContractModalWithTemplate('{{ $template['name'] }}')">Use Template</button>
                    </div>
                    @endforeach
                </div>
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
                <!-- Contract Form -->
                <form class="space-y-6">
                    <!-- Client Information Section -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="building-2" class="w-5 h-5 text-green-600"></i>
                            Client Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Client Name</label>
                                <input type="text" id="clientName" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Enter client name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                                <input type="text" id="company" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Enter company name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="client@example.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <input type="tel" id="phone" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="+1 (555) 123-4567">
                            </div>
                        </div>
                    </div>

                    <!-- Contract Details Section -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-5 h-5 text-green-600"></i>
                            Contract Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Contract Type</label>
                                <select id="contractType" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option>Volunteer Service Agreement</option>
                                    <option>Employment Contract</option>
                                    <option>NDA</option>
                                    <option>Partnership Agreement</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Contract Value</label>
                                <input type="number" id="contractValue" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="0">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                                <input type="date" id="startDate" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                                <input type="date" id="endDate" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            </div>
                        </div>
                    </div>

                    <!-- Contract Template Preview -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i data-lucide="eye" class="w-5 h-5 text-green-600"></i>
                            Contract Template Preview
                        </h3>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <div class="prose max-w-none">
                                <div class="text-center mb-6">
                                    <h2 class="text-2xl font-bold text-gray-800">SERVICE AGREEMENT</h2>
                                    <p class="text-gray-600 mt-2">Contract No: SA-2024-001</p>
                                </div>

                                <div class="space-y-4 text-sm text-gray-700 leading-relaxed">
                                    <p><strong>This Service Agreement</strong> ("Agreement") is entered into on <span class="bg-yellow-200 px-1 rounded preview-start-date">[START_DATE]</span> between:</p>

                                    <div class="ml-4 space-y-4 mb-6">
                                        <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                                            <p class="font-semibold text-green-800 mb-3">REQUESTING ORGANIZATION (Pre-filled):</p>
                                            <div class="grid grid-cols-2 gap-4 text-sm">
                                                <div>
                                                    <p><strong>Organization:</strong> <span class="bg-green-200 px-1 rounded font-medium">[ORGANIZATION_NAME]</span></p>
                                                    <p><strong>Representative:</strong> <span class="bg-green-200 px-1 rounded font-medium">[ORGANIZATION_HEAD]</span></p>
                                                </div>
                                                <div>
                                                    <p><strong>Email:</strong> <span class="bg-green-200 px-1 rounded font-medium">[ORGANIZATION_EMAIL]</span></p>
                                                    <p><strong>Phone:</strong> <span class="bg-green-200 px-1 rounded font-medium">[ORGANIZATION_PHONE]</span></p>
                                                </div>
                                            </div>
                                            <p class="mt-2"><strong>Service Type:</strong> <span class="bg-green-200 px-1 rounded font-medium">[SERVICE_TYPE]</span></p>
                                            <p><strong>Duration:</strong> <span class="bg-green-200 px-1 rounded font-medium">[DURATION]</span></p>
                                        </div>

                                        <div class="p-4 bg-gray-100 border border-gray-300 rounded-lg">
                                            <p class="font-semibold text-gray-700 mb-3">VOLUNTEER INFORMATION (To be completed by volunteer):</p>
                                            <div class="grid grid-cols-2 gap-4 text-sm">
                                                <div>
                                                    <p><strong>Full Name:</strong> <span class="bg-yellow-200 px-1 rounded preview-client-name">____________________</span></p>
                                                    <p><strong>Email:</strong> <span class="bg-yellow-200 px-1 rounded preview-email">____________________</span></p>
                                                    <p><strong>Emergency Contact:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">____________________</span></p>
                                                </div>
                                                <div>
                                                    <p><strong>Phone:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">____________________</span></p>
                                                    <p><strong>Address:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">____________________</span></p>
                                                    <p><strong>Date of Birth:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">____________________</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <p><strong>1. SERVICE DESCRIPTION</strong></p>
                                    <p class="ml-4">The Volunteer agrees to provide voluntary services as described: <span class="bg-green-200 px-1 rounded">[SERVICE_DESCRIPTION]</span></p>

                                    <p><strong>2. DURATION AND COMMITMENT</strong></p>
                                    <p class="ml-4">Service Period: From <span class="bg-yellow-200 px-1 rounded preview-start-date">[START_DATE]</span> to <span class="bg-yellow-200 px-1 rounded preview-end-date">[END_DATE]</span></p>

                                    <p><strong>3. VOLUNTEER RESPONSIBILITIES</strong></p>
                                    <p class="ml-4">• Attend scheduled volunteer activities punctually<br>
                                        • Follow all organizational guidelines and safety protocols<br>
                                        • Maintain confidentiality of sensitive information<br>
                                        • Notify the organization of any absences in advance<br>
                                        • Complete any required training sessions</p>

                                    <p><strong>4. ORGANIZATION RESPONSIBILITIES</strong></p>
                                    <p class="ml-4">• Provide necessary training, materials, and supervision<br>
                                        • Ensure a safe working environment for volunteers<br>
                                        • Provide liability insurance coverage during service activities<br>
                                        • Issue certificate of completion upon successful service<br>
                                        • Maintain volunteer records and provide references when requested</p>

                                    <p><strong>5. COMPENSATION</strong></p>
                                    <p class="ml-4">This is a voluntary service agreement. No monetary compensation will be provided. The organization may provide non-monetary recognition, certificates, meals during service, or transportation reimbursement as applicable.</p>

                                    <p><strong>6. LIABILITY AND INSURANCE</strong></p>
                                    <p class="ml-4">The Organization shall provide appropriate liability coverage for volunteers during service activities. Volunteers must disclose any medical conditions that may affect their ability to perform duties safely.</p>

                                    <p><strong>7. TERMINATION</strong></p>
                                    <p class="ml-4">Either party may terminate this agreement with 7 days written notice. The Organization may terminate immediately for cause, including violation of policies or unsafe behavior.</p>

                                    <p><strong>8. CONFIDENTIALITY</strong></p>
                                    <p class="ml-4">All parties agree to maintain strict confidentiality regarding sensitive information shared during the course of this agreement.</p>
                                </div>

                                <div class="mt-8 border-t-2 border-gray-300 pt-6">
                                    <div class="grid grid-cols-2 gap-8">
                                        <div class="text-center">
                                            <p class="text-sm font-medium mb-8 text-gray-700">LEGAL WITNESS</p>
                                            <div class="border-b-2 border-gray-400 mb-3 h-12"></div>
                                            <p class="text-xs text-gray-600 font-medium">Lawyer Signature & Date</p>
                                            <p class="text-xs text-gray-500 mt-1">[LAWYER_NAME]</p>
                                            <p class="text-xs text-gray-400 mt-1">License No: [LICENSE_NUMBER]</p>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-sm font-medium mb-8 text-gray-700">VOLUNTEER</p>
                                            <div class="border-b-2 border-gray-400 mb-3 h-12"></div>
                                            <p class="text-xs text-gray-600 font-medium">Volunteer Signature & Date</p>
                                            <p class="text-xs text-gray-500 mt-1">(To be signed by volunteer)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-400 rounded-r-lg">
                                    <p class="text-sm font-semibold text-blue-800">Signing Process:</p>
                                    <ol class="text-xs text-blue-700 mt-2 ml-4 list-decimal space-y-1">
                                        <li>Volunteer completes personal information section above</li>
                                        <li>Volunteer signs in designated area</li>
                                        <li>Lawyer reviews and provides legal witness signature</li>
                                        <li>Organization receives completed agreement for records</li>
                                    </ol>
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
                    <button class="btn btn-outline">
                        <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                        Preview
                    </button>
                    <button class="btn btn-accent">
                        <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                        Save Draft
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-lawyer.dashboard-layout>

<script>
    let currentMode = 'edit';
    let currentContractType = 'Service Agreement';
    let isTemplate = false; // Track if using a template

    function openContractModal() {
        // Clear form for new contract
        clearContractForm();
        setModalMode('edit');
        currentContractType = 'Volunteer Service Agreement';
        isTemplate = false; // Not using a template
        updateContractPreview();
        document.getElementById('contractModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function openContractModalWithTemplate(templateName) {
        // Clear form for new contract
        clearContractForm();
        setModalMode('edit');
        isTemplate = true; // Using a template

        // Extract contract type from template name
        if (templateName.includes('Service Agreement') || templateName.includes('Volunteer Service Agreement')) {
            currentContractType = 'Volunteer Service Agreement';
            document.getElementById('contractType').value = 'Volunteer Service Agreement';
        } else if (templateName.includes('Employment Contract')) {
            currentContractType = 'Employment Contract';
            document.getElementById('contractType').value = 'Employment Contract';
        } else if (templateName.includes('NDA')) {
            currentContractType = 'NDA';
            document.getElementById('contractType').value = 'NDA';
        } else if (templateName.includes('Partnership Agreement')) {
            currentContractType = 'Partnership Agreement';
            document.getElementById('contractType').value = 'Partnership Agreement';
        }

        // Disable contract type field when using template
        document.getElementById('contractType').disabled = true;
        document.getElementById('contractType').classList.add('bg-gray-100', 'cursor-not-allowed');

        // Update modal title and subtitle
        document.getElementById('modalTitle').textContent = `New Contract - ${templateName}`;
        document.getElementById('modalSubtitle').textContent = currentContractType;

        updateContractPreview();
        document.getElementById('contractModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function openContractModalWithData(contractData, mode = 'edit') {
        currentMode = mode;
        currentContractType = contractData.type;
        isTemplate = true; // Existing contracts are like templates - type shouldn't change
        // Pre-fill form with existing contract data
        fillContractForm(contractData);
        setModalMode(mode);
        document.getElementById('contractModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function setModalMode(mode) {
        const isViewMode = mode === 'view';

        // Get all form inputs
        const inputs = document.querySelectorAll('#contractModal input, #contractModal select');
        inputs.forEach(input => {
            if (input.id === 'contractType' && (isTemplate || isViewMode)) {
                // Keep contract type disabled for templates and view mode
                input.disabled = true;
                input.classList.add('bg-gray-100', 'cursor-not-allowed');
            } else {
                input.disabled = isViewMode;
                if (isViewMode) {
                    input.classList.add('bg-gray-100', 'cursor-not-allowed');
                } else {
                    input.classList.remove('bg-gray-100', 'cursor-not-allowed');
                }
            }
        });

        // Update modal buttons
        const saveBtn = document.querySelector('#contractModal .btn-accent');
        const cancelBtn = document.querySelector('#contractModal .btn-outline');

        if (isViewMode) {
            saveBtn.style.display = 'none';
            cancelBtn.textContent = 'Close';

            // Update modal title
            const title = document.getElementById('modalTitle').textContent;
            document.getElementById('modalTitle').textContent = title.replace('Edit Contract', 'View Contract').replace('New Contract', 'View Contract');
        } else {
            saveBtn.style.display = 'inline-flex';
            cancelBtn.textContent = 'Cancel';
        }
    }

    function clearContractForm() {
        // Clear all form fields for new contract
        document.getElementById('clientName').value = '';
        document.getElementById('company').value = '';
        document.getElementById('email').value = '';
        document.getElementById('phone').value = '';
        document.getElementById('contractType').value = 'Volunteer Service Agreement';
        document.getElementById('contractValue').value = '';
        document.getElementById('startDate').value = '';
        document.getElementById('endDate').value = '';

        // Re-enable contract type field for new contracts
        document.getElementById('contractType').disabled = false;
        document.getElementById('contractType').classList.remove('bg-gray-100', 'cursor-not-allowed');

        // Update header
        document.getElementById('modalTitle').textContent = 'New Contract Template';
        document.getElementById('modalSubtitle').textContent = 'Volunteer Service Agreement Template';
    }

    function getDummyDataForContract(contractData) {
        // Handle service agreements differently with organization details pre-filled
        if (contractData.contract_type === 'service_agreement') {
            return {
                // Organization details (pre-filled from approval)
                organizationName: contractData.organization,
                organizationHead: contractData.organization_head,
                organizationEmail: contractData.organization_email,
                organizationPhone: contractData.organization_phone,
                serviceType: contractData.service_type,
                duration: contractData.duration,
                description: contractData.description,
                // Form values for editing (volunteer details - blank)
                clientName: '[Volunteer Name - To be completed]',
                company: contractData.organization,
                email: '[volunteer@email.com]',
                phone: '[Volunteer Phone]',
                contractValue: 'Volunteer Service (No monetary compensation)',
                startDate: '2024-02-01',
                endDate: '2024-12-31'
            };
        }

        const dummyDataMap = {
            'Service Agreement - TechCorp Ltd': {
                clientName: 'TechCorp Ltd',
                company: 'TechCorp Ltd',
                email: 'contact@techcorp.com',
                phone: '+1 (555) 123-4567',
                contractValue: '15000',
                startDate: '2024-01-15',
                endDate: '2024-12-15'
            },
            'Employment Contract - Jane Smith': {
                clientName: 'Jane Smith',
                company: 'HR Department',
                email: 'jane.smith@company.com',
                phone: '+1 (555) 987-6543',
                contractValue: '75000',
                startDate: '2024-02-01',
                endDate: '2025-01-31'
            },
            'Partnership Agreement - ABC Corp': {
                clientName: 'ABC Corp',
                company: 'ABC Corporation',
                email: 'partnerships@abccorp.com',
                phone: '+1 (555) 456-7890',
                contractValue: '250000',
                startDate: '2024-03-01',
                endDate: '2026-02-28'
            }
        };

        return dummyDataMap[contractData.title] || {
            clientName: 'Sample Client',
            company: 'Sample Company',
            email: 'client@example.com',
            phone: '+1 (555) 000-0000',
            contractValue: '10000',
            startDate: '2024-01-01',
            endDate: '2024-12-31'
        };
    }

    function generateContractPreview(contractType, clientName, company, email, contractValue, startDate, endDate, contractData = null) {
        const contractTemplates = {
            'Volunteer Service Agreement': {
                title: 'VOLUNTEER SERVICE AGREEMENT',
                number: 'VSA-2024-001',
                content: `
                    <p><strong>This Volunteer Service Agreement</strong> ("Agreement") is entered into on <span class="bg-yellow-200 px-1 rounded">${startDate}</span> for volunteer services between:</p>
                    
                    <div class="ml-4 space-y-4 mb-6">
                        <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                            <p class="font-semibold text-green-800 mb-3">REQUESTING ORGANIZATION (Pre-filled):</p>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p><strong>Organization:</strong> <span class="bg-green-200 px-1 rounded font-medium">${getOrgData('name', contractData) || company}</span></p>
                                    <p><strong>Representative:</strong> <span class="bg-green-200 px-1 rounded font-medium">${getOrgData('head', contractData)}</span></p>
                                </div>
                                <div>
                                    <p><strong>Email:</strong> <span class="bg-green-200 px-1 rounded font-medium">${getOrgData('email', contractData)}</span></p>
                                    <p><strong>Phone:</strong> <span class="bg-green-200 px-1 rounded font-medium">${getOrgData('phone', contractData)}</span></p>
                                </div>
                            </div>
                            <p class="mt-2"><strong>Service Type:</strong> <span class="bg-green-200 px-1 rounded font-medium">${getOrgData('serviceType', contractData)}</span></p>
                            <p><strong>Duration:</strong> <span class="bg-green-200 px-1 rounded font-medium">${getOrgData('duration', contractData)}</span></p>
                        </div>
                        
                        <div class="p-4 bg-gray-100 border border-gray-300 rounded-lg">
                            <p class="font-semibold text-gray-700 mb-3">VOLUNTEER INFORMATION (To be completed by volunteer):</p>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p><strong>Full Name:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">${clientName.includes('Volunteer') ? '____________________' : clientName}</span></p>
                                    <p><strong>Email:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">${email.includes('volunteer') ? '____________________' : email}</span></p>
                                    <p><strong>Emergency Contact:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">____________________</span></p>
                                </div>
                                <div>
                                    <p><strong>Phone:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">${document.getElementById('phone')?.value?.includes('Volunteer') ? '____________________' : (document.getElementById('phone')?.value || '____________________')}</span></p>
                                    <p><strong>Address:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">____________________</span></p>
                                    <p><strong>Date of Birth:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">____________________</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <p><strong>1. SERVICE DESCRIPTION</strong></p>
                    <p class="ml-4">The Volunteer agrees to provide voluntary services as described: <span class="bg-green-200 px-1 rounded">${getOrgData('description', contractData)}</span></p>
                    
                    <p><strong>2. DURATION AND COMMITMENT</strong></p>
                    <p class="ml-4">Service Period: From <span class="bg-yellow-200 px-1 rounded">${startDate}</span> to <span class="bg-yellow-200 px-1 rounded">${endDate}</span><br>
                    Service Duration: <span class="bg-green-200 px-1 rounded">${getOrgData('duration', contractData)}</span></p>
                    
                    <p><strong>3. VOLUNTEER RESPONSIBILITIES</strong></p>
                    <p class="ml-4">• Attend scheduled volunteer activities punctually<br>
                    • Follow all organizational guidelines and safety protocols<br>
                    • Maintain confidentiality of sensitive information<br>
                    • Notify the organization of any absences in advance<br>
                    • Complete any required training sessions</p>
                    
                    <p><strong>4. ORGANIZATION RESPONSIBILITIES</strong></p>
                    <p class="ml-4">• Provide necessary training, materials, and supervision<br>
                    • Ensure a safe working environment for volunteers<br>
                    • Provide liability insurance coverage during service activities<br>
                    • Issue certificate of completion upon successful service<br>
                    • Maintain volunteer records and provide references when requested</p>
                    
                    <p><strong>5. COMPENSATION</strong></p>
                    <p class="ml-4">This is a voluntary service agreement. No monetary compensation will be provided. The organization may provide non-monetary recognition, certificates, meals during service, or transportation reimbursement as applicable.</p>
                    
                    <p><strong>6. LIABILITY AND INSURANCE</strong></p>
                    <p class="ml-4">The Organization shall provide appropriate liability coverage for volunteers during service activities. Volunteers must disclose any medical conditions that may affect their ability to perform duties safely.</p>
                    
                    <p><strong>7. TERMINATION</strong></p>
                    <p class="ml-4">Either party may terminate this agreement with 7 days written notice. The Organization may terminate immediately for cause, including violation of policies or unsafe behavior.</p>
                `
            },
            'Employment Contract': {
                title: 'EMPLOYMENT CONTRACT',
                number: 'EC-2024-001',
                content: `
                    <p><strong>This Employment Contract</strong> ("Contract") is entered into on <span class="bg-yellow-200 px-1 rounded">${startDate}</span> between:</p>
                    <div class="ml-4">
                        <p><strong>Employer:</strong> [Your Company Name]<br>Address: [Your Address]<br>Email: [Your Email]</p>
                        <p class="mt-3"><strong>Employee:</strong> <span class="bg-yellow-200 px-1 rounded">${clientName}</span><br>Email: <span class="bg-yellow-200 px-1 rounded">${email}</span></p>
                    </div>
                    <p><strong>1. POSITION AND DUTIES</strong></p>
                    <p class="ml-4">The Employee shall serve as [Position Title] and perform duties as assigned by the Employer.</p>
                    <p><strong>2. COMPENSATION</strong></p>
                    <p class="ml-4">The Employee shall receive an annual salary of <span class="bg-yellow-200 px-1 rounded">${contractValue ? '$' + contractValue : '[SALARY_AMOUNT]'}</span>.</p>
                    <p><strong>3. TERM OF EMPLOYMENT</strong></p>
                    <p class="ml-4">This employment shall commence on <span class="bg-yellow-200 px-1 rounded">${startDate}</span> and continue until <span class="bg-yellow-200 px-1 rounded">${endDate}</span>.</p>
                `
            },
            'NDA': {
                title: 'NON-DISCLOSURE AGREEMENT',
                number: 'NDA-2024-001',
                content: `
                    <p><strong>This Non-Disclosure Agreement</strong> ("Agreement") is entered into on <span class="bg-yellow-200 px-1 rounded">${startDate}</span> between:</p>
                    <div class="ml-4">
                        <p><strong>Disclosing Party:</strong> [Your Company Name]<br>Address: [Your Address]<br>Email: [Your Email]</p>
                        <p class="mt-3"><strong>Receiving Party:</strong> <span class="bg-yellow-200 px-1 rounded">${clientName}</span><br>Company: <span class="bg-yellow-200 px-1 rounded">${company}</span><br>Email: <span class="bg-yellow-200 px-1 rounded">${email}</span></p>
                    </div>
                    <p><strong>1. CONFIDENTIAL INFORMATION</strong></p>
                    <p class="ml-4">The Receiving Party acknowledges that it may receive confidential information from the Disclosing Party.</p>
                    <p><strong>2. OBLIGATIONS</strong></p>
                    <p class="ml-4">The Receiving Party agrees to maintain strict confidentiality of all disclosed information.</p>
                    <p><strong>3. TERM</strong></p>
                    <p class="ml-4">This agreement shall remain in effect from <span class="bg-yellow-200 px-1 rounded">${startDate}</span> until <span class="bg-yellow-200 px-1 rounded">${endDate}</span>.</p>
                `
            },
            'Partnership Agreement': {
                title: 'PARTNERSHIP AGREEMENT',
                number: 'PA-2024-001',
                content: `
                    <p><strong>This Partnership Agreement</strong> ("Agreement") is entered into on <span class="bg-yellow-200 px-1 rounded">${startDate}</span> between:</p>
                    <div class="ml-4">
                        <p><strong>Partner 1:</strong> [Your Company Name]<br>Address: [Your Address]<br>Email: [Your Email]</p>
                        <p class="mt-3"><strong>Partner 2:</strong> <span class="bg-yellow-200 px-1 rounded">${clientName}</span><br>Company: <span class="bg-yellow-200 px-1 rounded">${company}</span><br>Email: <span class="bg-yellow-200 px-1 rounded">${email}</span></p>
                    </div>
                    <p><strong>1. PARTNERSHIP PURPOSE</strong></p>
                    <p class="ml-4">The partners agree to form a partnership for the purpose of conducting business activities as mutually agreed.</p>
                    <p><strong>2. CAPITAL CONTRIBUTION</strong></p>
                    <p class="ml-4">The total partnership capital shall be <span class="bg-yellow-200 px-1 rounded">${contractValue ? '$' + contractValue : '[CAPITAL_AMOUNT]'}</span>.</p>
                    <p><strong>3. TERM</strong></p>
                    <p class="ml-4">This partnership shall commence on <span class="bg-yellow-200 px-1 rounded">${startDate}</span> and continue until <span class="bg-yellow-200 px-1 rounded">${endDate}</span>.</p>
                `
            },
            'Volunteer Service Agreement': {
                title: 'VOLUNTEER SERVICE AGREEMENT',
                number: 'VSA-2024-001',
                content: `
                    <p><strong>This Volunteer Service Agreement</strong> ("Agreement") is entered into on <span class="bg-yellow-200 px-1 rounded">${startDate}</span> for volunteer services between:</p>
                    
                    <div class="ml-4 space-y-4 mb-6">
                        <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                            <p class="font-semibold text-green-800 mb-3">REQUESTING ORGANIZATION (Pre-filled):</p>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p><strong>Organization:</strong> <span class="bg-green-200 px-1 rounded font-medium">${getOrgData('name', contractData) || company}</span></p>
                                    <p><strong>Representative:</strong> <span class="bg-green-200 px-1 rounded font-medium">${getOrgData('head', contractData)}</span></p>
                                </div>
                                <div>
                                    <p><strong>Email:</strong> <span class="bg-green-200 px-1 rounded font-medium">${getOrgData('email', contractData)}</span></p>
                                    <p><strong>Phone:</strong> <span class="bg-green-200 px-1 rounded font-medium">${getOrgData('phone', contractData)}</span></p>
                                </div>
                            </div>
                            <p class="mt-2"><strong>Service Type:</strong> <span class="bg-green-200 px-1 rounded font-medium">${getOrgData('serviceType', contractData)}</span></p>
                            <p><strong>Duration:</strong> <span class="bg-green-200 px-1 rounded font-medium">${getOrgData('duration', contractData)}</span></p>
                        </div>
                        
                        <div class="p-4 bg-gray-100 border border-gray-300 rounded-lg">
                            <p class="font-semibold text-gray-700 mb-3">VOLUNTEER INFORMATION (To be completed by volunteer):</p>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p><strong>Full Name:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">${clientName.includes('Volunteer') ? '____________________' : clientName}</span></p>
                                    <p><strong>Email:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">${email.includes('volunteer') ? '____________________' : email}</span></p>
                                    <p><strong>Emergency Contact:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">____________________</span></p>
                                </div>
                                <div>
                                    <p><strong>Phone:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">${document.getElementById('phone')?.value?.includes('Volunteer') ? '____________________' : (document.getElementById('phone')?.value || '____________________')}</span></p>
                                    <p><strong>Address:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">____________________</span></p>
                                    <p><strong>Date of Birth:</strong> <span class="inline-block bg-gray-300 px-3 py-1 rounded min-w-[150px]">____________________</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <p><strong>1. SERVICE DESCRIPTION</strong></p>
                    <p class="ml-4">The Volunteer agrees to provide voluntary services as described: <span class="bg-green-200 px-1 rounded">${getOrgData('description', contractData)}</span></p>
                    
                    <p><strong>2. DURATION AND COMMITMENT</strong></p>
                    <p class="ml-4">Service Period: From <span class="bg-yellow-200 px-1 rounded">${startDate}</span> to <span class="bg-yellow-200 px-1 rounded">${endDate}</span><br>
                    Service Duration: <span class="bg-green-200 px-1 rounded">${getOrgData('duration', contractData)}</span></p>
                    
                    <p><strong>3. VOLUNTEER RESPONSIBILITIES</strong></p>
                    <p class="ml-4">• Attend scheduled volunteer activities punctually<br>
                    • Follow all organizational guidelines and safety protocols<br>
                    • Maintain confidentiality of sensitive information<br>
                    • Notify the organization of any absences in advance<br>
                    • Complete any required training sessions</p>
                    
                    <p><strong>4. ORGANIZATION RESPONSIBILITIES</strong></p>
                    <p class="ml-4">• Provide necessary training, materials, and supervision<br>
                    • Ensure a safe working environment for volunteers<br>
                    • Provide liability insurance coverage during service activities<br>
                    • Issue certificate of completion upon successful service<br>
                    • Maintain volunteer records and provide references when requested</p>
                    
                    <p><strong>5. COMPENSATION</strong></p>
                    <p class="ml-4">This is a voluntary service agreement. No monetary compensation will be provided. The organization may provide non-monetary recognition, certificates, meals during service, or transportation reimbursement as applicable.</p>
                    
                    <p><strong>6. LIABILITY AND INSURANCE</strong></p>
                    <p class="ml-4">The Organization shall provide appropriate liability coverage for volunteers during service activities. Volunteers must disclose any medical conditions that may affect their ability to perform duties safely.</p>
                    
                    <p><strong>7. TERMINATION</strong></p>
                    <p class="ml-4">Either party may terminate this agreement with 7 days written notice. The Organization may terminate immediately for cause, including violation of policies or unsafe behavior.</p>
                    
                    <p><strong>8. CONFIDENTIALITY</strong></p>
                    <p class="ml-4">All parties agree to maintain strict confidentiality regarding sensitive information shared during the course of this agreement.</p>
                `
            }
        };

        const template = contractTemplates[contractType] || contractTemplates['Volunteer Service Agreement'];

        // Different signature sections based on contract type
        const signatureSection = contractType === 'Volunteer Service Agreement' ? `
            <div class="mt-8 border-t-2 border-gray-300 pt-6">
                <div class="grid grid-cols-2 gap-8">
                    <div class="text-center">
                        <p class="text-sm font-medium mb-8 text-gray-700">LEGAL WITNESS</p>
                        <div class="border-b-2 border-gray-400 mb-3 h-12"></div>
                        <p class="text-xs text-gray-600 font-medium">Lawyer Signature & Date</p>
                        <p class="text-xs text-gray-500 mt-1">[LAWYER_NAME]</p>
                        <p class="text-xs text-gray-400 mt-1">License No: [LICENSE_NUMBER]</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm font-medium mb-8 text-gray-700">VOLUNTEER</p>
                        <div class="border-b-2 border-gray-400 mb-3 h-12"></div>
                        <p class="text-xs text-gray-600 font-medium">Volunteer Signature & Date</p>
                        <p class="text-xs text-gray-500 mt-1">(To be signed by volunteer)</p>
                    </div>
                </div>
            </div>
            <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-400 rounded-r-lg">
                <p class="text-sm font-semibold text-blue-800">Signing Process:</p>
                <ol class="text-xs text-blue-700 mt-2 ml-4 list-decimal space-y-1">
                    <li>Volunteer completes personal information section above</li>
                    <li>Volunteer signs in designated area</li>
                    <li>Lawyer reviews and provides legal witness signature</li>
                    <li>Organization receives completed agreement for records</li>
                </ol>
            </div>
        ` : `
            <div class="mt-8 grid grid-cols-2 gap-8">
                <div class="text-center">
                    <div class="border-t border-gray-400 pt-2">
                        <p class="text-sm font-medium">Party 1 Signature</p>
                        <p class="text-xs text-gray-500">Date: _______________</p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="border-t border-gray-400 pt-2">
                        <p class="text-sm font-medium">Party 2 Signature</p>
                        <p class="text-xs text-gray-500">Date: _______________</p>
                    </div>
                </div>
            </div>
        `;

        return `
            <div class="prose max-w-none">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">${template.title}</h2>
                    <p class="text-gray-600 mt-2">Contract No: ${template.number}</p>
                </div>
                <div class="space-y-4 text-sm text-gray-700 leading-relaxed">
                    ${template.content}
                    <p><strong>${contractType === 'Volunteer Service Agreement' ? '8' : '4'}. CONFIDENTIALITY</strong></p>
                    <p class="ml-4">All parties agree to maintain strict confidentiality regarding sensitive information shared during the course of this agreement.</p>
                </div>
                ${signatureSection}
            </div>
        `;
    }

    // Helper function to get organization data
    function getOrgData(field, contractData) {
        if (!contractData || !contractData.contract_type || contractData.contract_type !== 'service_agreement') {
            return `[${field.toUpperCase()}]`;
        }

        const mapping = {
            name: contractData.organization || '[ORGANIZATION_NAME]',
            head: contractData.organization_head || '[ORGANIZATION_HEAD]',
            email: contractData.organization_email || '[ORGANIZATION_EMAIL]',
            phone: contractData.organization_phone || '[ORGANIZATION_PHONE]',
            serviceType: contractData.service_type || '[SERVICE_TYPE]',
            duration: contractData.duration || '[DURATION]',
            description: contractData.description || '[SERVICE_DESCRIPTION]'
        };

        return mapping[field] || `[${field.toUpperCase()}]`;
    }

    function updateContractPreview() {
        const clientName = document.getElementById('clientName').value || '[CLIENT_NAME]';
        const company = document.getElementById('company').value || '[COMPANY_NAME]';
        const email = document.getElementById('email').value || '[CLIENT_EMAIL]';
        const contractValue = document.getElementById('contractValue').value || '[CONTRACT_VALUE]';
        const startDate = document.getElementById('startDate').value || '[START_DATE]';
        const endDate = document.getElementById('endDate').value || '[END_DATE]';

        // Get current contract type
        const selectedType = document.getElementById('contractType').value;
        currentContractType = selectedType;

        // Pass current contract data for organization details
        const contractData = window.currentContractData || null;

        // Update contract preview based on type
        const previewContainer = document.querySelector('.bg-gray-50.border.border-gray-200.rounded-lg.p-6');
        previewContainer.innerHTML = generateContractPreview(selectedType, clientName, company, email, contractValue, startDate, endDate, contractData);
    }

    function fillContractForm(contractData) {
        // Store contract data globally for preview updates
        window.currentContractData = contractData;

        // Fill form with dummy data based on contract
        const dummyData = getDummyDataForContract(contractData);

        document.getElementById('clientName').value = dummyData.clientName;
        document.getElementById('company').value = dummyData.company;
        document.getElementById('email').value = dummyData.email;
        document.getElementById('phone').value = dummyData.phone;
        document.getElementById('contractType').value = contractData.type;
        document.getElementById('contractValue').value = dummyData.contractValue;
        document.getElementById('startDate').value = dummyData.startDate;
        document.getElementById('endDate').value = dummyData.endDate;

        // Update header based on mode
        const modeText = currentMode === 'view' ? 'View Contract' : 'Edit Contract';
        document.getElementById('modalTitle').textContent = `${modeText} - ${contractData.title}`;
        document.getElementById('modalSubtitle').textContent = contractData.type;

        // Update preview with filled data
        updateContractPreview();
    }

    // Update contract type options to include Volunteer Service Agreement
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners to form fields to update preview in real-time
        const formFields = ['clientName', 'company', 'email', 'contractValue', 'startDate', 'endDate', 'contractType'];
        formFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.addEventListener('input', updateContractPreview);
                field.addEventListener('change', updateContractPreview);
            }
        });
    });

    function closeContractModal() {
        document.getElementById('contractModal').classList.add('hidden');
        document.body.style.overflow = 'auto';

        // Reset form state
        const inputs = document.querySelectorAll('#contractModal input, #contractModal select');
        inputs.forEach(input => {
            input.disabled = false;
            input.classList.remove('bg-gray-100', 'cursor-not-allowed');
        });

        // Reset template flag
        isTemplate = false;

        // Reset buttons
        const saveBtn = document.querySelector('#contractModal .btn-accent');
        const cancelBtn = document.querySelector('#contractModal .btn-outline');
        saveBtn.style.display = 'inline-flex';
        cancelBtn.textContent = 'Cancel';
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