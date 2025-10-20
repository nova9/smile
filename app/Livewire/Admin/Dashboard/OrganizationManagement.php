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
            ->withCount([
                'organizingEvents',
                'organizingEvents as hidden_events_count' => function ($query) {
                    $query->where('is_active', false);
                }
            ])
            // Load restricted first, then recent
            ->orderByDesc('is_restricted')
            ->orderBy('created_at', 'desc')
            ->get();

        $total_organizations = $organizations->count();
        $total_events = $organizations->sum('organizing_events_count');

        $restricted_count = $organizations->where('is_restricted', true)->count();

        $stats = [
            'total_organizations' => $total_organizations,
            'total_events' => $total_events,
            'restricted_count' => $restricted_count,
        ];

        return view('livewire.admin.dashboard.organizationManagement', [
            'organizations' => $organizations,
            'stats' => $stats,
        ]);
    }

    public function toggleRestriction($userId)
    {
        $user = User::findOrFail($userId);

        // Direct database update instead of mass assignment
        $newStatus = !$user->is_restricted;
        \DB::table('users')->where('id', $userId)->update(['is_restricted' => $newStatus]);

        $status = $newStatus ? 'restricted' : 'unrestricted';
        session()->flash('message', "User '{$user->name}' has been {$status} successfully.");
        session()->flash('message_type', 'success');
    }
}
