<x-admin.dashboard-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="tabs tabs-lift">
            <!-- Account Reports Tab -->
            <label class="tab flex gap-1">
                <input type="radio" name="dispute_tabs" checked="checked" />
                <i class="fas fa-flag mr-2 text-error"></i>
                <span class="font-semibold">Account Reports</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-3xl shadow-xl">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-primary rounded-tl-3xl">Report
                                    ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-primary">User</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-primary">Type</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-primary">Reason</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-primary">Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-primary rounded-tr-3xl">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-6 py-4">RPT-001</td>
                                <td class="px-6 py-4">john fernando</td>
                                <td class="px-6 py-4">Volunteer</td>
                                <td class="px-6 py-4">Inappropriate behavior</td>
                                <td class="px-6 py-4">2024-06-20</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button class="btn btn-neutral font-bold">View</button>
                                    <button class="btn btn-outline btn-success font-bold resolve-btn"
                                        data-report-id="RPT-001" data-user="john fernando" data-type="Volunteer"
                                        data-reason="Inappropriate behavior" data-date="2024-06-20">Resolve</button>
                                    <button class="btn btn-outline btn-error font-bold">Dismiss</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">RPT-002</td>
                                <td class="px-6 py-4">GreenHope Foundation</td>
                                <td class="px-6 py-4">Organization</td>
                                <td class="px-6 py-4">Spam activity</td>
                                <td class="px-6 py-4">2024-06-19</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button class="btn btn-neutral font-bold">View</button>
                                    <button class="btn btn-outline btn-success font-bold resolve-btn"
                                        data-report-id="RPT-002" data-user="GreenHope Foundation"
                                        data-type="Organization" data-reason="Spam activity"
                                        data-date="2024-06-19">Resolve</button>
                                    <button class="btn btn-outline btn-error font-bold">Dismiss</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Reactivation Requests Tab -->
            <label class="tab flex gap-1">
                <input type="radio" name="dispute_tabs" />
                <i class="fas fa-undo mr-2 text-primary"></i>
                <span class="font-semibold">Reactivation Requests</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-3xl shadow-xl">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-primary rounded-tl-3xl">
                                    Request ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-primary">User</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-primary">Type</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-primary">Reason</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-primary">Date</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-primary rounded-tr-3xl">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-6 py-4">REQ-101</td>
                                <td class="px-6 py-4">John Perera</td>
                                <td class="px-6 py-4">Volunteer</td>
                                <td class="px-6 py-4">Appeal suspension</td>
                                <td class="px-6 py-4">2024-06-18</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button class="btn btn-neutral font-bold">View</button>
                                    <button class="btn btn-outline btn-success font-bold">Approve</button>
                                    <button class="btn btn-outline btn-error font-bold">Reject</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">REQ-102</td>
                                <td class="px-6 py-4">EcoFuture Org</td>
                                <td class="px-6 py-4">Organization</td>
                                <td class="px-6 py-4">Account review</td>
                                <td class="px-6 py-4">2024-06-17</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button class="btn btn-neutral font-bold">View</button>
                                    <button class="btn btn-outline btn-success font-bold">Approve</button>
                                    <button class="btn btn-outline btn-error font-bold">Reject</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Resolve Modal -->
    <div id="resolveModal" class="modal hidden">
        <div class="modal-box w-11/12 max-w-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-lg">Resolve Report</h3>
                <button onclick="closeResolveModal()" class="btn btn-sm btn-circle btn-ghost">✕</button>
            </div>
            <!-- Report Details -->
            <div class="mb-4">
                <h4 class="font-semibold text-base-content mb-2">Report Details</h4>
                <div class="bg-base-200 p-4 rounded-lg">
                    <div class="space-y-1">
                        <p class="text-sm"><span class="font-medium">Report ID:</span> <span id="modalReportId"></span>
                        </p>
                        <p class="text-sm"><span class="font-medium">User/Organization:</span> <span
                                id="modalUser"></span>
                        </p>
                        <p class="text-sm"><span class="font-medium">Type:</span> <span id="modalType"></span></p>
                        <p class="text-sm"><span class="font-medium">Reason:</span> <span id="modalReason"></span></p>
                        <p class="text-sm"><span class="font-medium">Date:</span> <span id="modalDate"></span></p>
                    </div>
                </div>
            </div>
            <!-- Profile & Status -->
            <div class="mb-4">
                <h4 class="font-semibold text-base-content mb-2">Profile & Status</h4>
                <div class="bg-base-200 p-4 rounded-lg">
                    <p class="text-sm"><span class="font-medium">Status:</span> Active</p>
                    <p class="text-sm"><span class="font-medium">Prior Reports:</span> 1</p>
                </div>
            </div>
            <!-- History -->
            <div class="mb-4">
                <h4 class="font-semibold text-base-content mb-2">History</h4>
                <div class="bg-base-200 p-4 rounded-lg">
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
                <button onclick="suspendAccount()" class="btn btn-error">Suspend Account</button>
                <button onclick="markResolved()" class="btn btn-success">Mark as Resolved</button>
                <button onclick="dismissReport()" class="btn btn-outline">Dismiss Report</button>
            </div>
        </div>
        <div class="modal-backdrop" onclick="closeResolveModal()"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.resolve-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    document.getElementById('modalReportId').textContent = btn.dataset.reportId;
                    document.getElementById('modalUser').textContent = btn.dataset.user;
                    document.getElementById('modalType').textContent = btn.dataset.type;
                    document.getElementById('modalReason').textContent = btn.dataset.reason;
                    document.getElementById('modalDate').textContent = btn.dataset.date;
                    document.getElementById('adminNotes').value = '';
                    document.getElementById('resolveModal').classList.remove('hidden');
                    document.getElementById('resolveModal').classList.add('modal-open');
                });
            });
        });

        function closeResolveModal() {
            document.getElementById('resolveModal').classList.add('hidden');
            document.getElementById('resolveModal').classList.remove('modal-open');
        }
        function suspendAccount() {
            alert('Account will be suspended.');
            closeResolveModal();
        }
        function markResolved() {
            alert('Report marked as resolved.');
            closeResolveModal();
        }
        function dismissReport() {
            alert('Report dismissed.');
            closeResolveModal();
        }
    </script>
</x-admin.dashboard-layout>