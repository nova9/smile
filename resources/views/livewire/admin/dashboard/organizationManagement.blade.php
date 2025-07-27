<x-admin.dashboard-layout>
    <!-- Header Section (Organization Management style) -->
    <div class="mb-8 mt-8 ml-4 lg:ml-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                    Organization
                    <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                        Management
                    </span>
                </h1>
                <p class="text-slate-600 text-lg">Track and manage all organizations and their activities
                </p>
            </div>
            <!-- Optionally, you can add a badge or quick action here if needed -->
        </div>
    </div>
    <!-- Stats Section -->
    <div class="ml-4 lg:ml-8">
        <x-admin.stats-card :stats="[
        [
            'icon' => 'building-2',
            'title' => 'Total Organizations',
            'value' => number_format($stats['total_organizations']),
            'description' => 'Registered NGOs'
        ],
        [
            'icon' => 'shield-check',
            'title' => 'Total Events',
            'value' => number_format($stats['total_events']),
            'description' => 'Events by organizations'
        ],
        [
            'icon' => 'clock',
            'title' => 'Pending Approval',
            'value' => '6',
            'description' => 'Awaiting Review'
        ],
        [
            'icon' => 'ban',
            'title' => 'Suspended',
            'value' => '0',
            'description' => 'Restricted Access'
        ]
    ]" />
    </div>

    <div class="px-4 sm:px-6 lg:px-8 py-8 ml-4 lg:ml-8">
        <div class="tabs tabs-lift">
            <label class="tab flex gap-1">
                <input type="radio" name="org_mgmt_tabs" checked="checked" />
                <i class="fas fa-list mr-2 text-primary"></i>
                <span class="font-semibold">All Organizations</span>
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-8 rounded-2xl shadow-lg">
                <!-- Search & Filters -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div class="flex gap-2 w-full md:w-auto">
                        <input id="orgSearch" type="text" placeholder="Search organizations..."
                            class="input input-bordered w-full md:w-64 rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent" />
                        <select id="orgStatusFilter"
                            class="select select-bordered rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent">
                            <option value="">All Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Registered">Registered</option>
                        </select>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table id="orgTable" class="min-w-full bg-white rounded-3xl shadow-xl">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tl-3xl">Id</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Organization Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Email</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Registered On</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Opportunities</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tr-3xl">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($organizations as $org)
                                <tr>
                                    <td class="px-6 py-4">{{ $org->id }}</td>
                                    <td class="px-6 py-4">{{ $org->name }}</td>
                                    <td class="px-6 py-4">{{ $org->email }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="badge {{ $org->status === 'active' ? 'badge-success' : 'badge-warning' }}">
                                            {{ ucfirst($org->status ?? 'Pending') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $org->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4">{{ $org->organizing_events_count }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <x-admin.action-button type="view"
                                            url="{{ url('/admin/dashboard/organization-details/' . $org->id) }}" />
                                        <x-admin.action-button type="delete" />
                                    </td>
                                </tr>
                            @endforeach
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
                <!-- Search & Filters for New Registrations -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div class="flex gap-2 w-full md:w-auto">
                        <input id="newOrgSearch" type="text" placeholder="Search new registrations..."
                            class="input input-bordered w-full md:w-64 rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent" />
                        <select id="newOrgStatusFilter"
                            class="select select-bordered rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent">
                            <option value="">All Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Registered">Registered</option>
                        </select>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table id="newOrgTable" class="min-w-full bg-white rounded-3xl shadow-xl">
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
                                    <x-admin.action-button type="view"
                                        url="{{ url('/admin/dashboard/organization-details/25') }}" />
                                    <x-admin.action-button type="approve" />

                                    <x-admin.action-button type="delete" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
    </div>

    <script>
        // Search & Filter logic for All Organizations
        function filterOrgTable() {
            const search = document.getElementById('orgSearch').value.toLowerCase();
            const status = document.getElementById('orgStatusFilter').value;
            document.querySelectorAll('#orgTable tbody tr').forEach(function (row) {
                let text = row.textContent.toLowerCase();
                let matchesSearch = text.includes(search);
                let matchesStatus = !status || (row.querySelector('.badge') && row.querySelector('.badge').textContent.trim() === status);
                row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });
        }
        document.getElementById('orgSearch').addEventListener('input', filterOrgTable);
        document.getElementById('orgStatusFilter').addEventListener('change', filterOrgTable);

        // Search & Filter logic for New Registrations
        function filterNewOrgTable() {
            const search = document.getElementById('newOrgSearch').value.toLowerCase();
            const status = document.getElementById('newOrgStatusFilter').value;
            document.querySelectorAll('#newOrgTable tbody tr').forEach(function (row) {
                let text = row.textContent.toLowerCase();
                let matchesSearch = text.includes(search);
                let matchesStatus = !status || (row.querySelector('.badge') && row.querySelector('.badge').textContent.trim() === status);
                row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });
        }
        document.getElementById('newOrgSearch').addEventListener('input', filterNewOrgTable);
        document.getElementById('newOrgStatusFilter').addEventListener('change', filterNewOrgTable);
    </script>
</x-admin.dashboard-layout>