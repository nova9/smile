<x-admin.dashboard-layout>
    <!-- Header Section (Dispute Handling style) -->
    <div class="mb-8 mt-8 ml-4 lg:ml-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                    Dispute
                    <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                        Handling
                    </span>
                </h1>
                <p class="text-slate-600 text-lg">Manage and resolve all account reports, reactivation requests, and
                    feedback
                </p>
            </div>
            <!-- Optionally, you can add a badge or quick action here if needed -->
        </div>
    </div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 ml-4 lg:ml-8">
        <div class="tabs tabs-lift">
            <!-- Account Reports Tab -->
            <label class="tab flex gap-1">
                <input type="radio" name="dispute_tabs" checked="checked" />
                <i class="fas fa-flag mr-2 text-error"></i>
                <span class="font-semibold">Account Reports</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Search & Filters -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div class="flex gap-2 w-full md:w-auto">
                        <input id="reportSearch" type="text" placeholder="Search reports..."
                            class="input input-bordered w-full md:w-64 rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent" />
                        <select id="reportTypeFilter"
                            class="select select-bordered rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent">
                            <option value="">All Types</option>
                            <option value="Volunteer">Volunteer</option>
                            <option value="Organization">Organization</option>
                        </select>
                        <select id="reportStatusFilter"
                            class="select select-bordered rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent">
                            <option value="">All Status</option>
                            <option value="Open">Open</option>
                            <option value="Closed">Closed</option>
                        </select>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table id="reportsTable" class="min-w-full bg-white rounded-3xl shadow-xl">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tl-3xl">Report
                                    ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">User</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Type</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Reason</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tr-3xl">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-6 py-4">RPT-001</td>
                                <td class="px-6 py-4">Libbie Konopelski</td>
                                <td class="px-6 py-4">Volunteer</td>
                                <td class="px-6 py-4">Inappropriate behavior</td>
                                <td class="px-6 py-4">2024-06-20</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <x-admin.action-button type="view"
                                        url="{{ url('/admin/dashboard/volunteer-details/8') }}?tab=reports"
                                        title="View Reports/Complaints" />
                                    <button wire:click="$set('showResolveModal', true); $set('resolveReport', {
                                        id: 'RPT-001',
                                        user: 'Libbie Konopelski',
                                        type: 'Volunteer',
                                        reason: 'Inappropriate behavior',
                                        date: '2024-06-20'
                                    })" class="resolve-btn font-bold flex items-center justify-center w-10 h-10 rounded-xl bg-white text-black hover:bg-black/10 transition group relative"
                                        title="Resolve">
                                        <i data-lucide="circle-alert" class="w-5 h-5"></i>
                                        <span
                                            class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Resolve</span>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">RPT-002</td>
                                <td class="px-6 py-4">GreenHope Foundation</td>
                                <td class="px-6 py-4">Organization</td>
                                <td class="px-6 py-4">Spam activity</td>
                                <td class="px-6 py-4">2024-06-19</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <x-admin.action-button type="view"
                                        url="{{ url('/admin/dashboard/organization-details/25') }}" />
                                    <button
                                        class="resolve-btn font-bold flex items-center justify-center w-10 h-10 rounded-xl bg-white text-black hover:bg-black/10 transition group relative"
                                        data-report-id="RPT-002" data-user="GreenHope Foundation"
                                        data-type="Organization" data-reason="Spam activity" data-date="2024-06-19"
                                        title="Resolve">
                                        <i data-lucide="circle-alert" class="w-5 h-5"></i>
                                        <span
                                            class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Resolve</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Reactivation Requests Tab -->
            <label class="tab flex gap-1">
                <input type="radio" name="dispute_tabs" />
                <i class="fas fa-undo mr-2 text-accent"></i>
                <span class="font-semibold">Reactivation Requests</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Search & Filters -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div class="flex gap-2 w-full md:w-auto">
                        <input id="requestSearch" type="text" placeholder="Search requests..."
                            class="input input-bordered w-full md:w-64 rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent" />
                        <select id="requestTypeFilter"
                            class="select select-bordered rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent">
                            <option value="">All Types</option>
                            <option value="Volunteer">Volunteer</option>
                            <option value="Organization">Organization</option>
                        </select>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table id="requestsTable" class="min-w-full bg-white rounded-3xl shadow-xl">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tl-3xl">
                                    Request ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">User</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Type</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Reason</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tr-3xl">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-6 py-4">REQ-101</td>
                                <td class="px-6 py-4">Jeanie Muller</td>
                                <td class="px-6 py-4">Volunteer</td>
                                <td class="px-6 py-4">Appeal suspension</td>
                                <td class="px-6 py-4">2024-06-18</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <x-admin.action-button type="view"
                                        url="{{ url('/admin/dashboard/volunteer-details/15') }}" />
                                    <x-admin.action-button type="approve" />
                                    <x-admin.action-button type="reject" />
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">REQ-102</td>
                                <td class="px-6 py-4">EcoFuture Org</td>
                                <td class="px-6 py-4">Organization</td>
                                <td class="px-6 py-4">Account review</td>
                                <td class="px-6 py-4">2024-06-17</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <x-admin.action-button type="view"
                                        url="{{ url('/admin/dashboard/organization-details/25') }}" />
                                    <x-admin.action-button type="approve" />
                                    <x-admin.action-button type="reject" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Feedback Tab -->
            <label class="tab flex gap-1">
                <input type="radio" name="dispute_tabs" />
                <i class="fas fa-comment-dots mr-2 text-warning"></i>
                <span class="font-semibold">Feedback</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Search & Filters -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div class="flex gap-2 w-full md:w-auto">
                        <input id="feedbackSearch" type="text" placeholder="Search feedback..."
                            class="input input-bordered w-full md:w-64 rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent" />
                        <select id="feedbackTypeFilter"
                            class="select select-bordered rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent">
                            <option value="">All Types</option>
                            <option value="Volunteer">Volunteer</option>
                        </select>
                        <select id="feedbackCategoryFilter"
                            class="select select-bordered rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent">
                            <option value="">All Categories</option>
                            <option value="App Experience">App Experience</option>
                            <option value="Support">Support</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <!-- Feedback Table -->
                <div class="overflow-x-auto">
                    <table id="feedbackTable" class="min-w-full bg-white rounded-3xl shadow-xl">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tl-3xl">
                                    Feedback ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Event Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Comments</th>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tr-3xl">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-6 py-4">FB-201</td>
                                <td class="px-6 py-4">Beach Cleanup</td>
                                <td class="px-6 py-4">It was really impactful</td>

                                <td class="px-6 py-4 flex gap-2">
                                    <x-admin.action-button type="view" />

                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">FB-202</td>
                                <td class="px-6 py-4">Elder's home renovations</td>
                                <td class="px-6 py-4">it was a great experience</td>

                                <td class="px-6 py-4 flex gap-2">
                                    <x-admin.action-button type="view" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Resolve Modal -->
    @if($showResolveModal)
        <div id="resolveModal" class="modal modal-open">
            <div class="modal-box w-11/12 max-w-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-lg">Resolve Report</h3>
                    <button wire:click="$set('showResolveModal', false)" class="btn btn-sm btn-circle btn-ghost">✕</button>
                </div>
                <!-- Report Details -->
                <div class="mb-4">
                    <h4 class="font-semibold text-base-content mb-2">Report Details</h4>
                    <div class="bg-base-200 p-4 rounded-lg">
                        <div class="space-y-1">
                            <p class="text-sm"><span class="font-medium">Report ID:</span>
                                <span>{{ $resolveReport['id'] ?? '' }}</span>
                            </p>
                            <p class="text-sm"><span class="font-medium">User/Organization:</span>
                                <span>{{ $resolveReport['user'] ?? '' }}</span>
                            </p>
                            <p class="text-sm"><span class="font-medium">Type:</span>
                                <span>{{ $resolveReport['type'] ?? '' }}</span>
                            </p>
                            <p class="text-sm"><span class="font-medium">Reason:</span>
                                <span>{{ $resolveReport['reason'] ?? '' }}</span>
                            </p>
                            <p class="text-sm"><span class="font-medium">Date:</span>
                                <span>{{ $resolveReport['date'] ?? '' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Profile & Status -->
                <div class="mb-4">
                    <h4 class="font-semibold text-base-content mb-2">Profile & Status</h4>
                    <div class="bg-base-200 p-4 rounded-lg">
                        <p class="text-sm"><span class="font-medium">Total volunteer hours:</span> 50</p>
                        <p class="text-sm"><span class="font-medium">Badges:</span> 1</p>
                        <p class="text-sm"><span class="font-medium">Completed work :</span> Community development project
                        </p>
                    </div>
                </div>
                <!-- History -->
                <div class="mb-4">
                    <h4 class="font-semibold text-base-content mb-2">History</h4>
                    <div class="bg-base-200 p-4 rounded-lg">
                        <p class="text-sm">Total number of reports : 1</p>
                        <p class="text-sm">Previous report: Late attendance (2024-05-10)</p>
                    </div>
                </div>
                <!-- Admin Notes -->
                <div class="mb-6">
                    <label for="adminNotes" class="label">
                        <span class="label-text font-medium">Admin Notes</span>
                    </label>
                    <textarea id="adminNotes" class="textarea textarea-bordered w-full h-24"
                        placeholder="Optional notes..."></textarea>
                </div>
                <!-- Action Buttons -->
                <div class="modal-action flex gap-2">
                    <button wire:click="suspendAccount" class="btn btn-outline btn-error">Suspend Account</button>
                    <button wire:click="dismissReport" class="btn btn-outline btn-black">Dismiss Report</button>
                </div>
            </div>
            <div class="modal-backdrop" wire:click="$set('showResolveModal', false)"></div>
        </div>
    @endif

    <script>
        // Search & Filter logic for Account Reports
        function filterReportsTable() {
            const search = document.getElementById('reportSearch').value.toLowerCase();
            const type = document.getElementById('reportTypeFilter').value;
            const status = document.getElementById('reportStatusFilter').value;
            document.querySelectorAll('#reportsTable tbody tr').forEach(function (row) {
                let text = row.textContent.toLowerCase();
                let matchesSearch = text.includes(search);
                let matchesType = !type || row.querySelector('td:nth-child(3)').textContent === type;
                let matchesStatus = !status || (row.querySelector('span[data-status]') && row.querySelector('span[data-status]').textContent === status);
                row.style.display = (matchesSearch && matchesType && matchesStatus) ? '' : 'none';
            });
        }
        document.getElementById('reportSearch').addEventListener('input', filterReportsTable);
        document.getElementById('reportTypeFilter').addEventListener('change', filterReportsTable);
        document.getElementById('reportStatusFilter').addEventListener('change', filterReportsTable);

        // Search & Filter logic for Reactivation Requests
        function filterRequestsTable() {
            const search = document.getElementById('requestSearch').value.toLowerCase();
            const type = document.getElementById('requestTypeFilter').value;
            document.querySelectorAll('#requestsTable tbody tr').forEach(function (row) {
                let text = row.textContent.toLowerCase();
                let matchesSearch = text.includes(search);
                let matchesType = !type || row.querySelector('td:nth-child(3)').textContent === type;
                row.style.display = (matchesSearch && matchesType) ? '' : 'none';
            });
        }
        document.getElementById('requestSearch').addEventListener('input', filterRequestsTable);
        document.getElementById('requestTypeFilter').addEventListener('change', filterRequestsTable);
    </script>
</x-admin.dashboard-layout>