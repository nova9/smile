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

    <!-- Success Message -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-2"
            class="mb-6 ml-4 lg:ml-8 {{ session('message_type') === 'info' ? 'bg-blue-50 border-blue-200 text-blue-700' : 'bg-green-50 border-green-200 text-green-700' }} border px-4 py-3 rounded-lg flex items-center shadow-lg">
            <i class="fas fa-check-circle mr-2 text-xl"></i>
            <span class="font-medium">{{ session('message') }}</span>
            <button @click="show = false" class="ml-auto text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

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
            'icon' => 'ban',
            'title' => 'Restricted',
            'value' => number_format($stats['restricted_count']),
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
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Registered On</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Opportunities</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Restricted</th>
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
                                    <td class="px-6 py-4">{{ $org->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4">{{ $org->organizing_events_count }}</td>
                                    <td class="px-6 py-4">
                                        @if($org->is_restricted)
                                            <span
                                                class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold inline-flex items-center gap-1">
                                                <i data-lucide="shield-alert" class="w-3 h-3"></i>
                                                Restricted
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold inline-flex items-center gap-1">
                                                <i data-lucide="shield-check" class="w-3 h-3"></i>
                                                Active
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <x-admin.action-button type="view"
                                                url="{{ url('/admin/dashboard/organization-details/' . $org->id) }}" />

                                            @if($org->hidden_events_count >= 2)
                                                <button 
                                                    wire:click="toggleRestriction({{ $org->id }})"
                                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border transition-colors
                                                        {{ $org->is_restricted 
                                                            ? 'bg-green-50 border-green-200 text-green-700 hover:bg-green-100' 
                                                            : 'bg-red-50 border-red-200 text-red-700 hover:bg-red-100' 
                                                        }} shadow-sm">
                                                    <i data-lucide="{{ $org->is_restricted ? 'shield-check' : 'shield-off' }}" class="w-4 h-4"></i>
                                                    {{ $org->is_restricted ? 'Unrestrict' : 'Restrict' }}
                                                </button>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border bg-gray-50 border-gray-200 text-gray-400 shadow-sm cursor-not-allowed"
                                                    title="Requires 2+ hidden events">
                                                    <i data-lucide="shield-off" class="w-4 h-4"></i>
                                                    Not Eligible
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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

        // Initialize Lucide icons
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        // Reinitialize Lucide icons after Livewire updates
        document.addEventListener('livewire:navigated', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        // Reinitialize icons after any Livewire component update
        Livewire.hook('morph.updated', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</x-admin.dashboard-layout>