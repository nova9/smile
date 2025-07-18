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
                                <td class="px-6 py-4">Jane Doe</td>
                                <td class="px-6 py-4">Volunteer</td>
                                <td class="px-6 py-4">Inappropriate behavior</td>
                                <td class="px-6 py-4">2024-06-20</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button class="btn btn-neutral font-bold">View</button>
                                    <button class="btn btn-outline btn-success font-bold">Resolve</button>
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
                                    <button class="btn btn-outline btn-success font-bold">Resolve</button>
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
                <i class="fas fa-undo mr-2 text-accent"></i>
                <span class="font-semibold">Reactivation Requests</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-3xl shadow-xl">
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
                                <td class="px-6 py-4">John Smith</td>
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
</x-admin.dashboard-layout>
