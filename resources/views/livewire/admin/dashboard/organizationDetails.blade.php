<x-admin.dashboard-layout>
    <!-- Organization Header -->
    <div class="bg-gradient-to-r from-primary/10 to-green-600/10 shadow-lg rounded-3xl mt-6">
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div class="flex items-center space-x-4">

                    <div>
                        <h1
                            class="text-3xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent">
                            GreenHope Foundation</h1>
                        <p class="text-gray-600 font-medium">ID: ORG-001</p>
                        <p class="text-gray-600 font-medium">Registered: June 10, 2025</p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-2 items-end sm:items-center">
                    <span
                        class="px-4 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full shadow">Pending
                        Approval</span>
                    <div class="flex gap-2 mt-2 sm:mt-0">
                        <button class="btn btn-neutral font-bold">Approve</button>
                        <button class="btn btn-outline btn-error font-bold">Reject</button>
                        <button class="btn btn-outline btn-warning font-bold">Suspend</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content -->
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="tabs tabs-lift">
            <label class="tab flex gap-1">
                <input type="radio" name="org_tabs" checked="checked" />
                <i class="fas fa-user mr-2 text-primary"></i>
                <span class="font-semibold">Profile & Verification</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Profile & Verification Tab -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Organization Details -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h2
                                class="text-xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent">
                                Organization Details</h2>
                            <button class="btn btn-outline btn-primary font-semibold">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Organization Name</label>
                                <p class="text-gray-900 font-medium">GreenHope Foundation</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                <p class="text-gray-900 font-medium">info@greenhope.org</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Phone</label>
                                <p class="text-gray-900 font-medium">+1 (555) 123-4567</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Address</label>
                                <p class="text-gray-900 font-medium">123 Green Street, Eco City, EC 12345</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                                <p class="text-gray-900 font-medium">A non-profit organization dedicated to
                                    environmental
                                    conservation and sustainable development practices.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Verification Status -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-8">
                        <h2
                            class="text-xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent mb-6">
                            Verification Status</h2>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-700">Documents Submitted</span>
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-800 text-sm font-bold rounded-full shadow">Complete</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-700">Background Check</span>
                                <span
                                    class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-bold rounded-full shadow">In
                                    Progress</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-700">Legal Verification</span>
                                <span
                                    class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-bold rounded-full shadow">Pending</span>
                            </div>
                        </div>
                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Rejection Reason (if
                                applicable)</label>
                            <textarea
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                rows="3" placeholder="Enter reason for rejection..."></textarea>
                        </div>
                        <div class="mt-6 flex gap-3">
                            <button class="btn btn-neutral font-bold w-full sm:w-auto">Approve</button>
                            <button class="btn btn-outline btn-error font-bold w-full sm:w-auto">Reject</button>
                        </div>
                    </div>
                </div>
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="org_tabs" />
                <i class="fas fa-calendar-alt mr-2 text-accent"></i>
                <span class="font-semibold">Opportunities</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Opportunities Tab -->
                <h2
                    class="text-xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent mb-6">
                    Volunteer Opportunities</h2>
                <x-admin.data-table :columns=" [
        ['key' => 'id', 'label' => 'Id', 'type' => 'text'],
        ['key' => 'title', 'label' => 'Title', 'type' => 'text'],
        ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
        ['key' => 'start_date', 'label' => 'Start Date', 'type' => 'text'],
        ['key' => 'end_date', 'label' => 'End Date', 'type' => 'text'],
        ['key' => 'volunteers', 'label' => 'Volunteers', 'type' => 'text'],
        ['key' => 'promotions', 'label' => 'Promotions', 'type' => 'custom'],
        ['key' => 'actions', 'label' => 'Actions', 'type' => 'actions']
    ]" :data=" [
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

            <label class="tab flex gap-1">
                <input type="radio" name="org_tabs" />
                <i class="fas fa-file-alt mr-2 text-primary"></i>
                <span class="font-semibold">Documents</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Documents Tab -->
                <h2
                    class="text-xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent mb-6">
                    Legal Documents</h2>
                <p class="text-sm text-gray-600 mb-4">Uploaded Documents (7/10 files uploaded)</p>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl shadow">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-file-pdf text-red-500"></i>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">registration.pdf</p>
                                <p class="text-xs text-gray-500">Uploaded: 2025-01-10</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded">PDF</span>
                            <button class="btn btn-outline btn-primary btn-sm font-semibold">Download</button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl shadow">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-file-pdf text-red-500"></i>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">tax_exemption.pdf</p>
                                <p class="text-xs text-gray-500">Uploaded: 2025-01-10</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded">PDF</span>
                            <button class="btn btn-outline btn-primary btn-sm font-semibold">Download</button>
                        </div>
                    </div>
                </div>
                <p class="text-sm text-red-600 mt-4 font-semibold">Max 10 files allowed per opportunity.</p>
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="org_tabs" />
                <i class="fas fa-history mr-2 text-accent"></i>
                <span class="font-semibold">Audit Log</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Audit Log Tab -->
                <h2
                    class="text-xl font-bold bg-gradient-to-r from-accent to-primary bg-clip-text text-transparent mb-6">
                    Audit Log</h2>
                <x-admin.data-table :columns=" [
        ['key' => 'id', 'label' => 'Id', 'type' => 'text'],
        ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
        ['key' => 'changed_by', 'label' => 'Changed By', 'type' => 'text'],
        ['key' => 'date_time', 'label' => 'Date/Time', 'type' => 'text'],
        ['key' => 'reason', 'label' => 'Reason', 'type' => 'text']
    ]" :data=" [
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
</x-admin.dashboard-layout>
