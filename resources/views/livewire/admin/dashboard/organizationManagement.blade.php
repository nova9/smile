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

    <div class="overflow-x-auto mt-8">
        <table class="min-w-full bg-white rounded-3xl shadow-xl">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-4 text-left text-sm font-semibold text-primary rounded-tl-3xl">Id</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-primary">Organization Name</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-primary">Email</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-primary">Status</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-primary">Registered On</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-primary">Opportunities</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-primary rounded-tr-3xl">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach([
                        [
                            'id' => '1',
                            'name' => 'GreenHope Foundation',
                            'email' => 'info@greenhope.org',
                            'status' => ['class' => 'badge-warning', 'text' => 'Pending'],
                            'registered' => '2025-06-10',
                            'opportunities' => '5',
                            'actions' => [
                                [
                                    'type' => 'link',
                                    'url' => 'http://127.0.0.1:8000/admin/dashboard/organization-details',
                                    'class' => 'btn-neutral font-bold',
                                    'text' => 'View'
                                ],
                                [
                                    'type' => 'button',
                                    'class' => 'btn-outline btn-success font-bold',
                                    'text' => 'Approve'
                                ],
                                [
                                    'type' => 'button',
                                    'class' => 'btn-outline btn-error font-bold',
                                    'text' => 'Reject'
                                ]
                            ]
                        ]
                    ] as $org)
                    <tr class="hover:bg-accent/10 transition-all duration-200">
                        <td class="px-6 py-4 font-semibold text-gray-900">{{ $org['id'] }}</td>
                        <td class="px-6 py-4 font-bold text-primary">{{ $org['name'] }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $org['email'] }}</td>
                        <td class="px-6 py-4">
                            <span class="badge {{ $org['status']['class'] }} px-4 py-2 text-base font-semibold rounded-full">
                                {{ $org['status']['text'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ $org['registered'] }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $org['opportunities'] }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ $org['actions'][0]['url'] }}" class="btn btn-neutral font-bold">View</a>
                            <button class="btn btn-outline btn-success font-bold">{{ $org['actions'][1]['text'] }}</button>
                            <button class="btn btn-outline btn-error font-bold">{{ $org['actions'][2]['text'] }}</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin.dashboard-layout>