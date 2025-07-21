<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\User;

class OrganizationManagement extends Component
{
    public function render()
    {
        $organizations = User::whereHas('role', function ($query) {
            $query->where('name', 'requester');
        })
            ->withCount('organizingEvents')
            ->get();

        $total_organizations = $organizations->count();
        $total_events = $organizations->sum('organizing_events_count');

        $stats = [
            'total_organizations' => $total_organizations,
            'total_events' => $total_events,
        ];

        return view('livewire.admin.dashboard.organizationManagement', [
            'organizations' => $organizations,
            'stats' => $stats,
        ]);
    }
}
