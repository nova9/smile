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
            'icon' => 'files',
            'title' => 'Applications This Month',
            'value' => '480',
            'description' => '↗︎ 8% from last month'
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

    <label class="input">
        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
            </g>
        </svg>
        <input type="search" class="grow" placeholder="Search" />

    </label>


    <x-admin.data-table :columns="[
        ['key' => 'id', 'label' => 'Id', 'type' => 'text'],
        ['key' => 'name', 'label' => 'Name', 'type' => 'text'],
        ['key' => 'email', 'label' => 'Email', 'type' => 'text'],
        ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
        ['key' => 'hours', 'label' => 'Hours', 'type' => 'text'],
        ['key' => 'badges', 'label' => 'Badges', 'type' => 'text'],
        ['key' => 'actions', 'label' => 'Actions', 'type' => 'actions']
    ]" :data="[
        [
            'id' => '1',
            'name' => 'John Perera',
            'email' => 'johnperera20@email.com',
            'status' => ['class' => 'badge-success', 'text' => 'Active'],
            'hours' => '54',
            'badges' => '3',
            'actions' => [
                ['type' => 'button', 'class' => 'btn-warning suspend-btn', 'text' => 'Suspend', 'data-id' => '1', 'data-name' => 'John Perera', 'data-email' => 'johnperera20@email.com', 'data-status' => 'Active', 'data-hours' => '54', 'data-badges' => '3'],
                ['type' => 'button', 'class' => 'btn-error', 'text' => 'Delete'],
                ['type' => 'button', 'class' => 'btn-info', 'text' => 'View']
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
                ['type' => 'button', 'class' => 'btn-success', 'text' => 'Reactivate'],
                ['type' => 'button', 'class' => 'btn-error', 'text' => 'Delete'],
                ['type' => 'button', 'class' => 'btn-info', 'text' => 'View']
            ]
        ]
    ]" />

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


    <!-- Suspend modal -->


    <div id="suspendModal" class="modal hidden">
        <div class="modal-box w-11/12 max-w-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-lg">Suspend Volunteer</h3>
                <button onclick="closeSuspendModal()" class="btn btn-sm btn-circle btn-ghost">✕</button>
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

            <!-- Recent Activity -->
            <div class="mb-4">
                <h4 class="font-semibold text-base-content mb-2">Recent Activity</h4>
                <div class="bg-base-200 p-4 rounded-lg">
                    <div class="space-y-1 text-sm">
                        <p><span class="font-medium">Events Participated:</span> 8 this month</p>
                        <p><span class="font-medium">Hours Logged:</span> <span id="modalHours"></span> hours</p>
                        <p><span class="font-medium">Badges Earned:</span> <span id="modalBadges"></span></p>
                    </div>
                </div>
            </div>

            <!-- Suspension Reason -->
            <div class="mb-6">
                <label for="suspensionReason" class="label">
                    <span class="label-text font-medium">Reason for Suspension <span class="text-error">*</span></span>
                </label>
                <textarea id="suspensionReason" class="textarea textarea-bordered w-full h-24"
                    placeholder="Please provide a detailed reason for suspension..." required></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="modal-action">
                <button onclick="viewFullProfile()" class="btn btn-info">View Full Profile</button>
                <button onclick="confirmSuspension()" class="btn btn-error">Suspend</button>
            </div>
        </div>
        <div class="modal-backdrop" onclick="closeSuspendModal()"></div>
    </div>






    <script>
        let currentVolunteerId = null;
        const modal = document.getElementById('suspendModal');

        document.addEventListener('DOMContentLoaded', function () {
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('suspend-btn')) {
                    e.preventDefault();
                    const dataset = e.target.dataset;
                    showSuspendModal(dataset.id, dataset.name, dataset.email, dataset.status, dataset.hours, dataset.badges);
                }
            });
        });

        function showSuspendModal(id, name, email, status, hours, badges) {
            currentVolunteerId = id;

            const elements = {
                name: document.getElementById('modalName'),
                email: document.getElementById('modalEmail'),
                status: document.getElementById('modalStatus'),
                hours: document.getElementById('modalHours'),
                badges: document.getElementById('modalBadges'),
                reason: document.getElementById('suspensionReason')
            };

            elements.name.textContent = name;
            elements.email.textContent = email;
            elements.status.textContent = status;
            elements.hours.textContent = hours;
            elements.badges.textContent = badges;
            elements.reason.value = '';

            modal.classList.remove('hidden');
            modal.classList.add('modal-open');
        }

        function closeSuspendModal() {
            modal.classList.add('hidden');
            modal.classList.remove('modal-open');
            currentVolunteerId = null;
        }

        function confirmSuspension() {
            const reason = document.getElementById('suspensionReason').value.trim();
            if (!reason) {
                alert('Please provide a reason for suspension.');
                return;
            }
            alert(`Volunteer ${currentVolunteerId} will be suspended. Reason: ${reason}`);
            closeSuspendModal();
        }

        function viewFullProfile() {
            window.location.href = `/admin/volunteers/${currentVolunteerId}/profile`;
        }
    </script>
</x-admin.dashboard-layout>