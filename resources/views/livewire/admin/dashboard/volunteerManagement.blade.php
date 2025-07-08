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

    <x-admin.data-table :columns="[
        ['key' => 'id', 'label' => 'Id', 'type' => 'text'],
        ['key' => 'name', 'label' => 'Name', 'type' => 'text'],
        ['key' => 'email', 'label' => 'Email', 'type' => 'text'],
        ['key' => 'status', 'label' => 'Status', 'type' => 'badge'],
        ['key' => 'applications', 'label' => 'Applications', 'type' => 'text'],
        ['key' => 'hours', 'label' => 'Hours', 'type' => 'text'],
        ['key' => 'badges', 'label' => 'Badges', 'type' => 'text'],
        ['key' => 'actions', 'label' => 'Actions', 'type' => 'actions']
    ]" :data="[
        [
            'id' => '1',
            'name' => 'John Perera',
            'email' => 'johnperera20@email.com',
            'status' => ['class' => 'badge-success', 'text' => 'Active'],
            'applications' => '12',
            'hours' => '54',
            'badges' => '3',
            'actions' => [
                ['type' => 'button', 'class' => 'btn-warning', 'text' => 'Suspend'],
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
</x-admin.dashboard-layout>