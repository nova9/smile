<x-admin.dashboard-layout>
    <!-- Organization Header -->
    <div class="bg-white shadow-sm">
        <div class="px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-purple-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">GreenHope Foundation</h1>
                        <p class="text-gray-600">ID: ORG-001</p>
                        <p class="text-gray-600">Registered: June 10, 2025</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-full">
                        Pending Approval
                    </span>
                    <button class="btn btn-md btn-success w-full sm:w-auto">Approve</button>

                    <button class="btn btn-md btn-error w-full sm:w-auto">Reject</button>
                    <button class="btn btn-md btn-warning w-full sm:w-auto">Suspend</button>

                </div>
            </div>
        </div>
    </div>
    </ <!-- Main Content -->
    <div class="px-4 sm:px-6 lg:px-8 py-6">
        <div x-data="{ activeTab: 'profile' }">
            <!-- Navigation Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="flex space-x-8">
                    <button @click="activeTab = 'profile'"
                        :class="activeTab === 'profile' ? 'border-purple-500 text-purple-600 bg-purple-50' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="py-2 px-4 border-b-2 font-medium text-sm transition-colors rounded-t-lg">
                        <i class="fas fa-user mr-2"></i>Profile & Verification
                    </button>
                    <button @click="activeTab = 'opportunities'"
                        :class="activeTab === 'opportunities' ? 'border-purple-500 text-purple-600 bg-purple-50' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="py-2 px-4 border-b-2 font-medium text-sm transition-colors rounded-t-lg">
                        <i class="fas fa-calendar-alt mr-2"></i>Opportunities
                    </button>
                    <button @click="activeTab = 'documents'"
                        :class="activeTab === 'documents' ? 'border-purple-500 text-purple-600 bg-purple-50' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="py-2 px-4 border-b-2 font-medium text-sm transition-colors rounded-t-lg">
                        <i class="fas fa-file-alt mr-2"></i>Documents
                    </button>
                    <button @click="activeTab = 'audit'"
                        :class="activeTab === 'audit' ? 'border-purple-500 text-purple-600 bg-purple-50' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="py-2 px-4 border-b-2 font-medium text-sm transition-colors rounded-t-lg">
                        <i class="fas fa-history mr-2"></i>Audit Log
                    </button>
                </nav>
            </div>

            <!-- Profile & Verification Tab -->
            <div x-show="activeTab === 'profile'" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Organization Details -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Organization Details</h2>
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Organization Name</label>
                            <p class="text-gray-900">GreenHope Foundation</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <p class="text-gray-900">info@greenhope.org</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <p class="text-gray-900">+1 (555) 123-4567</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <p class="text-gray-900">123 Green Street, Eco City, EC 12345</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <p class="text-gray-900">A non-profit organization dedicated to environmental conservation
                                and sustainable development practices.</p>
                        </div>
                    </div>
                </div>

                <!-- Verification Status -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Verification Status</h2>
                    <div class="space-y-4">

                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Documents Submitted</span>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                Complete
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Background Check</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                                In Progress
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Legal Verification</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-full">
                                Pending
                            </span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rejection Reason (if
                            applicable)</label>
                        <textarea
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            rows="3" placeholder="Enter reason for rejection..."></textarea>
                    </div>

                    <div class="mt-6 flex space-x-3">
                        <button class="btn btn-md btn-success w-full sm:w-auto">Approve</button>

                        <button class="btn btn-md btn-error w-full sm:w-auto">Reject</button>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Opportunities Tab -->
            <div x-show="activeTab === 'opportunities'" class="bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Volunteer Opportunities</h2>
                    <x-admin.data-table  :columns="[
        ['key' => 'id', 'label' => 'Id', 'type' => 'text'],
        ['key' => 'title', 'label' => 'Title', 'type' => 'text'],
        ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
        ['key' => 'start_date', 'label' => 'Start Date', 'type' => 'text'],
        ['key' => 'end_date', 'label' => 'End Date', 'type' => 'text'],
        ['key' => 'volunteers', 'label' => 'Volunteers', 'type' => 'text'],
        ['key' => 'promotions', 'label' => 'Promotions', 'type' => 'custom'],
        ['key' => 'actions', 'label' => 'Actions', 'type' => 'actions']
    ]" :data="[
        [
            'id' => '1',
            'title' => 'Tree Planting 2025',
            'status' => ['class' => 'badge-success', 'text' => 'Active'],
            'start_date' => '2025-08-01',
            'end_date' => '2025-08-10',
            'volunteers' => '20',
            'promotions' => 'boosted',
            'actions' => [
                ['type' => 'button', 'class' => 'btn-info', 'text' => 'View'],
                ['type' => 'button', 'class' => 'btn-error', 'text' => 'Reject']
            ]
        ],
        [
            'id' => '2',
            'title' => 'Beach Cleanup Drive',
            'status' => ['class' => 'badge-warning', 'text' => 'Draft'],
            'start_date' => '2025-09-15',
            'end_date' => '2025-09-15',
            'volunteers' => '0',
            'promotions' => 'boosted',
            'actions' => [
                ['type' => 'button', 'class' => 'btn-info', 'text' => 'View'],
                ['type' => 'button', 'class' => 'btn-error', 'text' => 'Reject']
            ]
        ]
    ]" />
                </div>
            </div>

            <!-- Documents Tab -->
            <div x-show="activeTab === 'documents'" class="bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Legal Documents</h2>
                    <p class="text-sm text-gray-600 mb-4">Uploaded Documents (7/10 files uploaded)</p>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-file-pdf text-red-500"></i>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">registration.pdf</p>
                                    <p class="text-xs text-gray-500">Uploaded: 2025-01-10</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">PDF</span>
                                <button class="text-blue-600 hover:text-blue-900 text-sm">Download</button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-file-pdf text-red-500"></i>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">tax_exemption.pdf</p>
                                    <p class="text-xs text-gray-500">Uploaded: 2025-01-10</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">PDF</span>
                                <button class="text-blue-600 hover:text-blue-900 text-sm">Download</button>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-red-600 mt-4">Max 10 files allowed per opportunity.</p>
                </div>
            </div>

            <!-- Audit Log Tab -->
            <div x-show="activeTab === 'audit'" class="bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Audit Log</h2>
                    <x-admin.data-table :columns="[
        ['key' => 'id', 'label' => 'Id', 'type' => 'text'],
        ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
        ['key' => 'changed_by', 'label' => 'Changed By', 'type' => 'text'],
        ['key' => 'date_time', 'label' => 'Date/Time', 'type' => 'text'],
        ['key' => 'reason', 'label' => 'Reason', 'type' => 'text']
    ]" :data="[
        [
            'id' => '1',
            'status' => ['class' => 'badge-success', 'text' => 'Verified'],
            'changed_by' => 'AdminUser',
            'date_time' => '2025-06-12 10:30 AM',
            'reason' => 'Legal docs verified'
        ],
        [
            'id' => '2',
            'status' => ['class' => 'badge-warning', 'text' => 'Pending'],
            'changed_by' => 'System',
            'date_time' => '2025-06-10 09:15 AM',
            'reason' => 'Initial registration submitted'
        ]
    ]" />
                </div>
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>