<x-admin.dashboard-layout>
    <!-- Main Dashboard Header -->
   

    <!-- User & Account Overview -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">User & Account Overview</h2>
        <x-admin.stats-card :stats="[
        [
            'icon' => 'users',
            'title' => 'Total Users',
            'value' => '3,240',
            'description' => 'All registered users'
        ],
        [
            'icon' => 'user-check',
            'title' => 'Active Users',
            'value' => '1,850',
            'description' => 'Last 30 days'
        ],
        [
            'icon' => 'user-plus',
            'title' => 'New Registrations',
            'value' => '125',
            'description' => 'This month'
        ],
        [
            'icon' => 'shield-check',
            'title' => 'Pending Verifications',
            'value' => '42',
            'description' => 'Awaiting approval'
        ]
    ]" />
    </div>

    <!-- Critical Actions Required -->
    <div class="mb-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Pending Actions Table -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pending Actions Required</h3>
                <x-admin.data-table :columns="[
        ['key' => 'type', 'label' => 'Type', 'type' => 'text'],
        ['key' => 'count', 'label' => 'Count', 'type' => 'text'],
        ['key' => 'priority', 'label' => 'Priority', 'type' => 'badge']
    ]" :data="[
        [
            'type' => 'Org Verification',
            'count' => '22',
            'priority' => ['class' => 'badge-error', 'text' => 'High']
        ],
        [
            'type' => 'Flagged Content',
            'count' => '8',
            'priority' => ['class' => 'badge-warning', 'text' => 'Medium']
        ],
        [
            'type' => 'Hour Approvals',
            'count' => '156',
            'priority' => ['class' => 'badge-info', 'text' => 'Normal']
        ]
    ]" />
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Admin Actions</h3>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Organization Approved</p>
                            <p class="text-xs text-gray-500">GreenHope Foundation - 2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-flag text-blue-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Content Moderated</p>
                            <p class="text-xs text-gray-500">Inappropriate comment removed - 4 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Hours Approved</p>
                            <p class="text-xs text-gray-500">45 volunteer hours approved - 6 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>