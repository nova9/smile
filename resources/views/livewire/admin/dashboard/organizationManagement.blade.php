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

    <x-admin.data-table  :columns="[
        ['key' => 'id', 'label' => 'Id', 'type' => 'text'],
        ['key' => 'name', 'label' => 'Organization Name', 'type' => 'text'],
        ['key' => 'email', 'label' => 'Email', 'type' => 'text'],
        ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
        ['key' => 'registered', 'label' => 'Registered On', 'type' => 'text'],
        ['key' => 'opportunities', 'label' => 'Opportunities', 'type' => 'text'],
        ['key' => 'actions', 'label' => 'Actions', 'type' => 'actions']
    ]" :data="[
        [
            'id' => '1',
            'name' => 'GreenHope Foundation',
            'email' => 'info@greenhope.org',
            'status' => ['class' => 'badge-warning', 'text' => 'Pending'],
            'registered' => '2025-06-10',
            'opportunities' => '5',
            'actions' => [
                ['type' => 'link', 'url' => 'http://127.0.0.1:8000/admin/dashboard/organization-details', 'class' => 'btn-info', 'text' => 'View'],
                ['type' => 'button', 'class' => 'btn-success', 'text' => 'Approve'],
                ['type' => 'button', 'class' => 'btn-error', 'text' => 'Reject']
            ]
        ]
    ]" />
</x-admin.dashboard-layout>