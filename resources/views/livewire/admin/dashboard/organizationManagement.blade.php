<x-admin.dashboard-layout>
    <!-- Stats Section -->
    <x-admin.stats-card :stats="[
        [
            'icon' => 'building-2',
            'title' => 'Total Organizations',
            'value' => '120',
            'description' => 'Registered NGOs'
        ],
        [
            'icon' => 'shield-check',
            'title' => 'Verified',
            'value' => '85',
            'description' => 'Active & Approved'
        ],
        [
            'icon' => 'clock',
            'title' => 'Pending Approval',
            'value' => '22',
            'description' => 'Awaiting Review'
        ],
        [
            'icon' => 'ban',
            'title' => 'Suspended',
            'value' => '13',
            'description' => 'Restricted Access'
        ]
    ]" />

    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <div class="tabs tabs-lift">
            <label class="tab flex gap-1">
                <input type="radio" name="org_mgmt_tabs" checked="checked" />
                <i class="fas fa-list mr-2 text-primary"></i>
                <span class="font-semibold">All Organizations</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-3xl shadow-xl">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tl-3xl">Id
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Organization Name
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Email</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Registered On</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Opportunities</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tr-3xl">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-6 py-4">1</td>
                                <td class="px-6 py-4">GreenHope Foundation</td>
                                <td class="px-6 py-4">info@greenhope.org</td>
                                <td class="px-6 py-4">
                                    <span class="badge badge-warning">Pending</span>
                                </td>
                                <td class="px-6 py-4">2025-06-10</td>
                                <td class="px-6 py-4">5</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ url('/admin/dashboard/organization-details') }}"
                                        class="btn btn-neutral font-bold">View</a>


                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">2</td>
                                <td class="px-6 py-4">EcoFuture Org</td>
                                <td class="px-6 py-4">contact@ecofuture.org</td>
                                <td class="px-6 py-4">
                                    <span class="badge badge-warning">Pending</span>
                                </td>
                                <td class="px-6 py-4">2025-07-01</td>
                                <td class="px-6 py-4">0</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="#" class="btn btn-neutral font-bold">View</a>

                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">3</td>
                                <td class="px-6 py-4">RiverCare Trust</td>
                                <td class="px-6 py-4">info@rivercare.org</td>
                                <td class="px-6 py-4">
                                    <span class="badge badge-success">Registered</span>
                                </td>
                                <td class="px-6 py-4">2025-05-20</td>
                                <td class="px-6 py-4">2</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="#" class="btn btn-neutral font-bold">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="org_mgmt_tabs" />
                <i class="fas fa-user-plus mr-2 text-accent"></i>
                <span class="font-semibold">New Registrations</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-3xl shadow-xl">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tl-3xl">Id
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Organization Name
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Email</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Registered On</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Opportunities</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tr-3xl">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            {{-- Example new registrations --}}
                            <tr class="hover:bg-primary/10 transition-all duration-200">
                                <td class="px-6 py-4 font-semibold text-gray-900">2</td>
                                <td class="px-6 py-4 font-bold text-accent">EcoFuture Org</td>
                                <td class="px-6 py-4 text-gray-700">contact@ecofuture.org</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="badge badge-warning px-4 py-2 text-base font-semibold rounded-full">Pending</span>
                                </td>
                                <td class="px-6 py-4 text-gray-700">2025-07-01</td>
                                <td class="px-6 py-4 text-gray-700">0</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="#" class="btn btn-neutral font-bold">View</a>
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
    </div>
</x-admin.dashboard-layout>