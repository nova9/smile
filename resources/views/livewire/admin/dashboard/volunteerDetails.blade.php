<x-admin.dashboard-layout>
    <!-- Volunteer Header -->
    <div class="bg-gradient-to-r from-accent/10 to-green-600/10 shadow-lg rounded-3xl mt-6">
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div class="flex items-center space-x-4">
                    <div>
                        <h1
                            class="text-3xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                            John Perera</h1>
                        <p class="text-gray-600 font-medium">ID: VOL-001</p>
                        <p class="text-gray-600 font-medium">Joined: May 15, 2025</p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-2 items-end sm:items-center">
                    <span
                        class="px-4 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full shadow">Active</span>
                    <div class="flex gap-2 mt-2 sm:mt-0">
                        <button class="btn btn-neutral font-bold">Suspend</button>
                        <button class="btn btn-outline btn-error font-bold">Remove</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content -->
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="tabs tabs-lift">
            <label class="tab flex gap-1">
                <input type="radio" name="vol_tabs" checked="checked" />
                <i class="fas fa-user mr-2 text-accent"></i>
                <span class="font-semibold">Profile & Verification</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Profile & Verification Tab -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Volunteer Details -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h2
                                class="text-xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                                Volunteer Details</h2>
                           
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                                <p class="text-gray-900 font-medium">John Perera</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                <p class="text-gray-900 font-medium">johnPerera@email.com</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Phone</label>
                                <p class="text-gray-900 font-medium">+1 (555) 987-6543</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Address</label>
                                <p class="text-gray-900 font-medium">456 Volunteer Ave, Help City, HC 54321</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Bio</label>
                                <p class="text-gray-900 font-medium">Passionate about community service and
                                    environmental conservation.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Verification Status -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-8">
                       
                        <div class="space-y-4">
                       
                           
                        </div>
                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Suspension Reason (if
                                applicable)</label>
                            <textarea
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent"
                                rows="3" placeholder="Enter reason for rejection..."></textarea>
                        </div>
                        <div class="mt-6 flex gap-3">
                            <button class="btn btn-neutral font-bold w-full sm:w-auto">Approve</button>
                            <button class="btn btn-outline btn-error font-bold w-full sm:w-auto">Suspend</button>
                        </div>
                    </div>
                </div>
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="vol_tabs" />
                <i class="fas fa-calendar-alt mr-2 text-primary"></i>
                <span class="font-semibold">Opportunities</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Opportunities Tab -->
                <h2
                    class="text-xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent mb-6">
                    Participated Opportunities</h2>
                <x-admin.data-table :columns=" [
        ['key' => 'id', 'label' => 'Id', 'type' => 'text'],
        ['key' => 'title', 'label' => 'Title', 'type' => 'text'],
        ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
        ['key' => 'start_date', 'label' => 'Start Date', 'type' => 'text'],
        ['key' => 'end_date', 'label' => 'End Date', 'type' => 'text'],
        ['key' => 'role', 'label' => 'Role', 'type' => 'text'],
        ['key' => 'actions', 'label' => 'Actions', 'type' => 'actions']
    ]" :data=" [
        [
            'id' => '1',
            'title' => 'Tree Planting 2025',
            'status' => ['class' => 'badge-success', 'text' => 'Completed'],
            'start_date' => '2025-08-01',
            'end_date' => '2025-08-10',
            'role' => 'Volunteer',
            'actions' => [
                ['type' => 'button', 'class' => 'btn-info', 'text' => 'View']
            ]
        ],
        [
            'id' => '2',
            'title' => 'Beach Cleanup Drive',
            'status' => ['class' => 'badge-warning', 'text' => 'Ongoing'],
            'start_date' => '2025-09-15',
            'end_date' => '2025-09-15',
            'role' => 'Team Lead',
            'actions' => [
                ['type' => 'button', 'class' => 'btn-info', 'text' => 'View']
            ]
        ]
    ]" />
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="vol_tabs" />
                <i class="fas fa-file-alt mr-2 text-accent"></i>
                <span class="font-semibold">Documents</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Documents Tab -->
                <h2
                    class="text-xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent mb-6">
                    Uploaded Documents</h2>
                <p class="text-sm text-gray-600 mb-4">Uploaded Documents (2/5 files uploaded)</p>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl shadow">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-file-pdf text-red-500"></i>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">id_card.pdf</p>
                                <p class="text-xs text-gray-500">Uploaded: 2025-05-15</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded">PDF</span>
                            <button class="btn btn-outline btn-accent btn-sm font-semibold">Download</button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl shadow">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-file-pdf text-red-500"></i>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">background_check.pdf</p>
                                <p class="text-xs text-gray-500">Uploaded: 2025-05-16</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded">PDF</span>
                            <button class="btn btn-outline btn-accent btn-sm font-semibold">Download</button>
                        </div>
                    </div>
                </div>
                <p class="text-sm text-red-600 mt-4 font-semibold">Max 5 files allowed per volunteer.</p>
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="vol_tabs" />
                <i class="fas fa-history mr-2 text-primary"></i>
                <span class="font-semibold">Audit Log</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Audit Log Tab -->
                <h2
                    class="text-xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent mb-6">
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
            'date_time' => '2025-05-16 11:00 AM',
            'reason' => 'Background check completed'
        ],
        [
            'id' => '2',
            'status' => ['class' => 'badge-warning', 'text' => 'Pending'],
            'changed_by' => 'System',
            'date_time' => '2025-05-15 09:00 AM',
            'reason' => 'Initial registration submitted'
        ]
    ]" />
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>