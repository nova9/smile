<x-admin.dashboard-layout>
    <!-- Main Dashboard Header -->
    <div class="text-center mt-10 mb-8">
        <h2
            class="text-4xl sm:text-5xl font-bold text-primary leading-tight relative bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
            Admin Dashboard
            <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-32 h-3 text-accent/30"
                viewBox="0 0 100 12" fill="none">
                <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" />
            </svg>
        </h2>
        <p class="text-lg text-gray-600 mt-2">Overview of users, organizations, and critical actions</p>
    </div>

    <!-- User & Account Overview -->
    <div class="mb-10">
        <div class="bg-white/90 rounded-3xl shadow-xl p-8">
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
    </div>

    <!-- Critical Actions Required & Recent Activity -->
    <div class="mb-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Pending Actions Table -->
            <div class="bg-white/90 rounded-3xl shadow-xl p-8">
                <h3
                    class="text-2xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent mb-6">
                    Pending Actions Required</h3>
                <x-admin.data-table :columns="[
        ['key' => 'type', 'label' => 'Type', 'type' => 'text'],
        ['key' => 'count', 'label' => 'Count', 'type' => 'text'],
        ['key' => 'priority', 'label' => 'Priority', 'type' => 'badge']
    ]"    :data="[
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
            <div class="bg-white/90 rounded-3xl shadow-xl p-8">
                <h3
                    class="text-2xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent mb-6">
                    Recent Admin Actions</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-xl shadow">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-base font-semibold text-gray-900">Organization Approved</p>
                            <p class="text-xs text-gray-500">GreenHope Foundation - 2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-xl shadow">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-flag text-blue-600 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-base font-semibold text-gray-900">Content Moderated</p>
                            <p class="text-xs text-gray-500">Inappropriate comment removed - 4 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-xl shadow">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-base font-semibold text-gray-900">Hours Approved</p>
                            <p class="text-xs text-gray-500">45 volunteer hours approved - 6 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.dashboard-layout>