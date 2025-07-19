<x-admin.dashboard-layout>
    <!-- Stats Section -->
    <x-admin.stats-card :stats="[
        [
            'icon' => 'users',
            'title' => 'Total Volunteers',
            'value' => '2,350',
            'description' => 'Active as of today'
        ],
       
        [
            'icon' => 'award',
            'title' => 'Badges Awarded',
            'value' => '1,120',
            'description' => 'Total this year'
        ],
        [
            'icon' => 'clock',
            'title' => 'Hours Logged',
            'value' => '6,800',
            'description' => 'Across all volunteers'
        ]
    ]" />

    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search & Filters -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div class="flex gap-2">
                <input id="volSearch" type="text" placeholder="Search volunteers..." class="input input-bordered w-full md:w-64" />
                <select id="volStatusFilter" class="select select-bordered">
                    <option value="">All Status</option>
                    <option value="Active">Active</option>
                    <option value="Suspended">Suspended</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto mt-8">
            <table id="volTable" class="min-w-full bg-white rounded-3xl shadow-xl">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tl-3xl">Id</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Hours</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent">Badges</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-accent rounded-tr-3xl">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach([
                            [
                                'id' => '1',
                                'name' => 'John Perera',
                                'email' => 'johnperera20@email.com',
                                'status' => ['class' => 'badge-success', 'text' => 'Active'],
                                'hours' => '54',
                                'badges' => '3',
                                'actions' => [
                                    ['type' => 'button', 'class' => 'btn-info', 'text' => 'View'],

                                    ['type' => 'button', 'class' => 'btn-error', 'text' => 'Delete']
                                ]
                            ],
                            [
                                'id' => '2',
                                'name' => 'Jane Fernando',
                                'email' => 'janefdo12@email.com',
                                'status' => ['class' => 'badge-warning', 'text' => 'Suspended'],
                                'applications' => '5',
                                'hours' => '22',
                                'badges' => '1',
                                'actions' => [
                                    ['type' => 'button', 'class' => 'btn-info', 'text' => 'View'],

                                    ['type' => 'button', 'class' => 'btn-error', 'text' => 'Delete']
                                ]
                            ]

                        ] as $vol)
                                    <tr class="hover:bg-accent/10 transition-all duration-200">
                                        <td class="px-6 py-4 font-semibold text-gray-900">{{ $vol['id'] }}</td>
                                        <td class="px-6 py-4 font-bold text-primary">{{ $vol['name'] }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ $vol['email'] }}</td>
                                        <td class="px-6 py-4">
                                            <span class="badge {{ $vol['status']['class'] }} px-4 py-2 text-base font-semibold rounded-full">
                                                {{ $vol['status']['text'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-700">{{ $vol['hours'] }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ $vol['badges'] }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-2">
                                                <a href="{{ url('/admin/dashboard/volunteer-details') }}" class="btn btn-neutral font-bold">View</a>

                                                <button class="btn btn-outline btn-error font-bold">Delete</button>
                                                {{-- Add other actions here if needed --}}
                                            </div>
                                        </td>
                                    </tr>

                    @endforeach
                </tbody>
            </table>
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
            document.querySelectorAll('#volTable tbody tr').forEach(function(row) {
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

