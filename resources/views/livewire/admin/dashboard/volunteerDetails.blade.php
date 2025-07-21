<x-admin.dashboard-layout>
    <!-- Volunteer Header -->
    <div class="bg-gradient-to-r from-accent/10 to-green-600/10 shadow-lg rounded-3xl mt-6">
        <div class="px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div class="flex items-center space-x-4">
                    <div>
                        <h1
                            class="text-3xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                            {{ $volunteer->name }}
                        </h1>
                        <p class="text-gray-600 font-medium">ID: VOL-{{ $volunteer->id }}</p>
                        <p class="text-gray-600 font-medium">Joined: {{ $volunteer->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-2 items-end sm:items-center">
                    <span class="px-4 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full shadow">
                        {{ ucfirst($volunteer->status ?? 'Active') }}
                    </span>
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
                                <p class="text-gray-900 font-medium">{{ $volunteer->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                <p class="text-gray-900 font-medium">{{ $volunteer->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Phone</label>
                                <p class="text-gray-900 font-medium">{{ $attributes['contact_number'] ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Location</label>
                                <p class="text-gray-900 font-medium">
                                    @php
                                        $lat = $attributes['latitude'] ?? null;
                                        $lng = $attributes['longitude'] ?? null;
                                    @endphp
                                    @if($lat && $lng)
                                        Latitude: {{ $lat }}, Longitude: {{ $lng }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Skills</label>
                                <p class="text-gray-900 font-medium">
                                    @php
                                        $skills = $attributes['skills'] ?? null;
                                        $skillsArr = [];
                                        if ($skills) {
                                            // If already array, use as is. If JSON, decode. If string, split by comma.
                                            if (is_array($skills)) {
                                                $skillsArr = $skills;
                                            } elseif (is_string($skills)) {
                                                $decoded = json_decode($skills, true);
                                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                    $skillsArr = $decoded;
                                                } else {
                                                    // fallback: comma separated string
                                                    $skillsArr = array_map('trim', explode(',', $skills));
                                                }
                                            }
                                        }
                                    @endphp
                                    @if(!empty($skillsArr))
                                        <span class="flex flex-wrap gap-2">
                                            @foreach($skillsArr as $skill)
                                                <span class="badge badge-info px-2 py-1 rounded">{{ $skill }}</span>
                                            @endforeach
                                        </span>
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Bio</label>
                                <p class="text-gray-900 font-medium">{{ $attributes['bio'] ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Gender</label>
                                <p class="text-gray-900 font-medium">{{ $attributes['gender'] ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Age</label>
                                <p class="text-gray-900 font-medium">{{ $attributes['age'] ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Documents Card (moved from Documents tab) -->
                    <div class="bg-white/90 rounded-2xl shadow-xl p-8">
                        <h2
                            class="text-xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent mb-6">
                            Uploaded Documents
                        </h2>
                        <p class="text-sm text-gray-600 mb-4">Uploaded Documents (2/5 files uploaded)</p>
                        <div class="space-y-3">
                            <!-- Example static, replace with dynamic if available -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl shadow">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-file-pdf text-red-500"></i>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">id_card.pdf</p>
                                        <p class="text-xs text-gray-500">Uploaded: 2025-05-15</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded">PDF</span>
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
                                    <span
                                        class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded">PDF</span>
                                    <button class="btn btn-outline btn-accent btn-sm font-semibold">Download</button>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm text-red-600 mt-4 font-semibold">Max 5 files allowed per volunteer.</p>
                    </div>
                </div>
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="vol_tabs" />
                <i class="fas fa-calendar-alt mr-2 text-primary"></i>
                <span class="font-semibold">Events</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Opportunities Tab -->
                <h2
                    class="text-xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent mb-6">
                    Participated Events</h2>
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

            <label class="tab flex gap-1">
                <input type="radio" name="vol_tabs" />
                <i class="fas fa-exclamation-triangle mr-2 text-error"></i>
                <span class="font-semibold">Reports/Complaints</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <h2
                    class="text-xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent mb-6">
                    Reports for Volunteer: John Perera
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Report Card 1 -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col gap-3">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-accent">Report ID: RPT-003</span>
                            <span
                                class="px-3 py-1 bg-red-100 text-red-800 text-xs font-bold rounded-full shadow">Open</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Type:</span>
                            <span class="text-gray-900">Volunteer</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Reason:</span>
                            <span class="text-gray-900">Missed deadline</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Date:</span>
                            <span class="text-gray-900">2025-06-20</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Details:</span>
                            <span class="text-gray-900">Did not submit required report on time.</span>
                        </div>
                        <div class="flex gap-2 mt-2">
                            <button class="btn btn-neutral font-bold">View</button>
                            <button class="btn btn-outline btn-success font-bold">Resolve</button>
                            <button class="btn btn-outline btn-error font-bold">Dismiss</button>
                        </div>
                    </div>
                    <!-- Report Card 2 -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col gap-3">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-accent">Report ID: RPT-004</span>
                            <span
                                class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full shadow">Closed</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Type:</span>
                            <span class="text-gray-900">Volunteer</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Reason:</span>
                            <span class="text-gray-900">Late attendance</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Date:</span>
                            <span class="text-gray-900">2025-05-10</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Details:</span>
                            <span class="text-gray-900">Arrived late to scheduled activity.</span>
                        </div>
                        <div class="flex gap-2 mt-2">
                            <button class="btn btn-neutral font-bold">View</button>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end">
                    <button class="btn btn-error font-bold">Suspend Volunteer</button>
                </div>
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>