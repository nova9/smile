<x-admin.dashboard-layout>
    <div class="min-h-screen p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-accent mb-2">
                        Volunteer
                        <span class="bg-gradient-to-r from-primary to-green-600 bg-clip-text text-transparent">
                            Management
                        </span>
                    </h1>
                    <p class="text-slate-600 text-lg">Track and manage all volunteer activities and registrations
                    </p>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="mb-8">
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
        </div>

        <!-- Volunteers Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-white/20 p-6">
            <!-- Search & Filters -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div class="flex gap-2 w-full md:w-auto">
                    <input type="text" wire:model.live="search" placeholder="Search volunteers..."
                        class="input input-bordered w-full md:w-64 rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all duration-200 border border-slate-200 focus:border-accent bg-white" />
                    <select wire:model.live="statusFilter"
                        class="select select-bordered rounded-xl px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all duration-200 border border-slate-200 focus:border-accent bg-white">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>

            <!-- Volunteers Table -->
            <div class="border border-slate-200 overflow-hidden rounded-2xl shadow-sm">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Badges</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Activities</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Joined</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($volunteers as $volunteer)
                            <tr class="border-t border-slate-100 hover:bg-slate-50/50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">#{{ $volunteer->id }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $volunteer->name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $volunteer->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-medium 
                                            @if($volunteer->status === 'active') bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-700
                                            @elseif($volunteer->status === 'suspended') bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-700
                                            @elseif($volunteer->status === 'inactive') bg-gradient-to-r from-rose-100 to-red-100 text-rose-700
                                            @else bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 @endif">
                                        {{ ucfirst($volunteer->status ?? 'Active') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $volunteer->badges->count() }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $volunteer->participatingEvents->count() }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $volunteer->created_at->format('M j, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ url('/admin/dashboard/volunteer-details/' . $volunteer->id) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white text-slate-600 hover:bg-slate-100 transition-colors border border-slate-200 shadow-sm group relative"
                                            title="View Details">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                            <span
                                                class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">View
                                                Details</span>
                                        </a>
                                        <button
                                            onclick="openDeleteModal({{ $volunteer->id }}, '{{ $volunteer->name }}', '{{ $volunteer->email }}', '{{ $volunteer->status ?? 'Active' }}')"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white text-slate-600 hover:bg-red-50 hover:text-red-600 transition-colors border border-slate-200 shadow-sm group relative"
                                            title="Delete">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            <span
                                                class="absolute left-1/2 -translate-x-1/2 -top-8 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center">
                                            <i data-lucide="users-x" class="w-8 h-8 text-slate-400"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-slate-900">No volunteers found</h3>
                                            <p class="text-sm text-slate-500 mt-1">No volunteers match your current filters.
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $volunteers->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <dialog id="deleteModal" class="modal">
        <div class="modal-box w-11/12 max-w-2xl bg-white/90 backdrop-blur-sm border border-white/20 rounded-2xl">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-xl text-accent">Delete Volunteer</h3>
                <button onclick="closeDeleteModal()" class="btn btn-sm btn-circle btn-ghost hover:bg-slate-100">✕
                </button>
            </div>

            <!-- Volunteer Information -->
            <div class="mb-6">
                <h4 class="font-semibold text-base text-slate-700 mb-3">Volunteer Information</h4>
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <div class="space-y-2">
                        <p class="text-sm"><span class="font-medium text-slate-600">Name:</span> <span
                                class="text-slate-900" id="modalName"></span></p>
                        <p class="text-sm"><span class="font-medium text-slate-600">Email:</span> <span
                                class="text-slate-900" id="modalEmail"></span></p>
                        <p class="text-sm"><span class="font-medium text-slate-600">Current Status:</span> <span
                                class="text-slate-900" id="modalStatus"></span></p>
                    </div>
                </div>
            </div>

            <!-- Delete Reason -->
            <div class="mb-6">
                <label for="deleteReason" class="block text-sm font-medium text-slate-700 mb-2">
                    Reason for Deletion <span class="text-red-500">*</span>
                </label>
                <textarea id="deleteReason"
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all duration-200 bg-white"
                    placeholder="Please provide a detailed reason for deletion..." rows="4" required></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="modal-action flex gap-3">
                <button onclick="viewFullProfile()" class="btn btn-ghost rounded-xl">View Full Profile</button>
                <button onclick="confirmDelete()" class="btn btn-error rounded-xl">Delete Volunteer</button>
            </div>
        </div>
        <div class="modal-backdrop" onclick="closeDeleteModal()"></div>
    </dialog>

    <script>
        function openDeleteModal(id, name, email, status) {
            document.getElementById('modalName').textContent = name;
            document.getElementById('modalEmail').textContent = email;
            document.getElementById('modalStatus').textContent = status;
            document.getElementById('deleteModal').showModal();
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').close();
        }

        function viewFullProfile() {
            // Implementation for viewing full profile
            closeDeleteModal();
        }

        function confirmDelete() {
            const reason = document.getElementById('deleteReason').value;
            if (!reason.trim()) {
                alert('Please provide a reason for deletion.');
                return;
            }
            // Implementation for delete confirmation
            closeDeleteModal();
        }
    </script>
</x-admin.dashboard-layout>