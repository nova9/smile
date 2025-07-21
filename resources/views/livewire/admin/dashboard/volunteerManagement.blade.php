<x-admin.dashboard-layout>
    <!-- Stats Section -->
    <x-admin.stats-card :stats="[
        [
            'icon' => 'users',
            'title' => 'Total Volunteers',
            'value' => number_format($stats['total_volunteers']),
            'description' => 'Registered volunteers'
        ],
        [
            'icon' => 'award',
            'title' => 'Badges Awarded',
            'value' => number_format($stats['total_badges']),
            'description' => 'Total badges earned'
        ],
        [
            'icon' => 'clock',
            'title' => 'Hours Logged',
            'value' => number_format($stats['total_hours']),
            'description' => 'Across all volunteers'
        ]
    ]" />

    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search & Filters -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div class="flex gap-2 w-full md:w-auto">
                <input type="text" placeholder="Search volunteers..."
                    class="input input-bordered w-full md:w-64 rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent"
                    wire:model.live="search" />
                <select
                    class="select select-bordered rounded-full px-5 py-2.5 shadow focus:outline-none focus:ring-1 focus:ring-accent transition-all duration-200 border border-gray-200 focus:border-accent"
                    wire:model.live="statusFilter" style="height: 44px;">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="suspended">Suspended</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto mt-8">
            <table class="min-w-full bg-white rounded-3xl shadow-xl">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tl-3xl">Id</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Badges</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Activities</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Joined</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tr-3xl">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($volunteers as $volunteer)
                                    <tr class="hover:bg-accent/10 transition-all duration-200">
                                        <td class="px-6 py-4 font-semibold text-gray-900">{{ $volunteer->id }}</td>
                                        <td class="px-6 py-4 font-bold text-primary">{{ $volunteer->name }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ $volunteer->email }}</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="badge 
                                                                                                                                                                                                    {{ $volunteer->status === 'active' ? 'badge-success' :
                        ($volunteer->status === 'suspended' ? 'badge-warning' :
                            ($volunteer->status === 'inactive' ? 'badge-error' : 'badge-info')) }} 
                                                                                                                                                                                                    px-4 py-2 text-base font-semibold rounded-full">
                                                {{ ucfirst($volunteer->status ?? 'Active') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-700">{{ $volunteer->badges->count() }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ $volunteer->participatingEvents->count() }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ $volunteer->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-2">
                                                <x-admin.action-button type="view"
                                                    url="{{ url('/admin/dashboard/volunteer-details/' . $volunteer->id) }}" />
                                                <x-admin.action-button type="delete" />
                                            </div>
                                        </td>
                                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <i data-lucide="users-x" class="w-12 h-12 text-gray-400"></i>
                                    <p class="text-gray-500">No volunteers found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $volunteers->links() }}
        </div>
    </div>

    <!-- Delete Modal  -->

    <div id="deleteModal" class="modal hidden">
        <div class="modal-box w-11/12 max-w-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-lg">Delete Volunteer</h3>
                <button onclick="closeDeleteModal()" class="btn btn-sm btn-circle btn-ghost">✕</button>
            </div>

            <!-- Volunteer Information -->
            <div class="mb-4">
                <h4 class="font-semibold text-base-content mb-2">Volunteer Information</h4>
                <div class="bg-base-200 p-4 rounded-lg">
                    <div class="space-y-1">
                        <p class="text-sm"><span class="font-medium">Name:</span> <span id="modalName"></span></p>
                        <p class="text-sm"><span class="font-medium">Email:</span> <span id="modalEmail"></span></p>
                        <p class="text-sm"><span class="font-medium">Current Status:</span> <span
                                id="modalStatus"></span></p>
                    </div>
                </div>
            </div>

            <!-- Reports/Flags -->
            <div class="mb-4">
                <h4 class="font-semibold text-base-content mb-2">Reports & Flags</h4>
                <div class="bg-base-200 p-4 rounded-lg">
                    <p class="text-sm mb-2"><span class="font-medium">Total Reports:</span> <span
                            id="modalReports">2</span></p>
                    <div class="text-sm text-base-content/70 space-y-1">
                        <p>• Late attendance (1)</p>
                        <p>• Inappropriate behavior (1)</p>
                    </div>
                </div>
            </div>



            <!-- Delete Reason -->
            <div class="mb-6">
                <label for="deleteReason" class="label">
                    <span class="label-text font-medium">Reason for Deletion <span class="text-error">*</span></span>
                </label>
                <textarea id="deleteReason" class="textarea textarea-bordered w-full h-24"
                    placeholder="Please provide a detailed reason for deletion..." required></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="modal-action">
                <button onclick="viewFullProfile()" class="btn btn-info">View Full Profile</button>
                <button onclick="confirmDelete()" class="btn btn-error">Delete</button>
            </div>
        </div>
        <div class="modal-backdrop" onclick="closeDeleteModal()"></div>
    </div>

    <script>
        // Search & Filter logic for Volunteers
        function filterVolTable() {
            const search = document.getElementById('volSearch').value.toLowerCase();
            const status = document.getElementById('volStatusFilter').value;
            document.querySelectorAll('#volTable tbody tr').forEach(function (row) {
                let text = row.textContent.toLowerCase();
                let matchesSearch = text.includes(search);
                let matchesStatus = !status || (row.querySelector('.badge') && row.querySelector('.badge').textContent.trim() === status);
                row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });
        }
        document.getElementById('volSearch').addEventListener('input', filterVolTable);
        document.getElementById('volStatusFilter').addEventListener('change', filterVolTable);
    </script>
</x-admin.dashboard-layout>