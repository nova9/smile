<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Analytics extends Component
{
    public function render()
    {
        // User Analytics
        $totalUsers = User::count();
        $totalVolunteers = User::whereHas('role', function ($query) {
            $query->where('name', 'volunteer');
        })->count();

        $totalOrganizations = User::whereHas('role', function ($query) {
            $query->where('name', 'organization');
        })->count();

        $totalLawyers = User::whereHas('role', function ($query) {
            $query->where('name', 'lawyer');
        })->count();

        // Monthly Registration Data - SQLite compatible
        $monthlyRegistrations = User::select(
            DB::raw("CAST(strftime('%m', created_at) AS INTEGER) as month"),
            DB::raw("CAST(strftime('%Y', created_at) AS INTEGER) as year"),
            DB::raw('COUNT(*) as count')
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw("strftime('%m', created_at)"), DB::raw("strftime('%Y', created_at)"))
            ->orderBy(DB::raw("strftime('%m', created_at)"))
            ->get();

        // User Status Distribution
        $userStatuses = User::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        // Event Analytics
        $totalEvents = Event::count();
        $activeEvents = Event::where('status', 'active')->count();
        $completedEvents = Event::where('status', 'completed')->count();
        $pendingEvents = Event::where('status', 'pending')->count();

        // Monthly Events Data - SQLite compatible
        $monthlyEvents = Event::select(
            DB::raw("CAST(strftime('%m', created_at) AS INTEGER) as month"),
            DB::raw("CAST(strftime('%Y', created_at) AS INTEGER) as year"),
            DB::raw('COUNT(*) as count')
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw("strftime('%m', created_at)"), DB::raw("strftime('%Y', created_at)"))
            ->orderBy(DB::raw("strftime('%m', created_at)"))
            ->get();

        // Event Participation Data
        $eventParticipation = Event::withCount('users')
            ->orderBy('users_count', 'desc')
            ->limit(10)
            ->get();

        // Top Organizations by Events
        $topOrganizations = User::whereHas('role', function ($query) {
            $query->where('name', 'organization');
        })
            ->withCount('organizingEvents')
            ->orderBy('organizing_events_count', 'desc')
            ->limit(5)
            ->get();

        // Volunteer Activity
        $volunteerActivity = User::whereHas('role', function ($query) {
            $query->where('name', 'volunteer');
        })
            ->withCount(['participatingEvents', 'badges'])
            ->orderBy('participating_events_count', 'desc')
            ->limit(10)
            ->get();

        // Badge Distribution
        $badgeStats = User::whereHas('role', function ($query) {
            $query->where('name', 'volunteer');
        })
            ->withCount('badges')
            ->get()
            ->groupBy(function ($user) {
                if ($user->badges_count == 0)
                    return '0 badges';
                if ($user->badges_count <= 2)
                    return '1-2 badges';
                if ($user->badges_count <= 5)
                    return '3-5 badges';
                return '5+ badges';
            })
            ->map(function ($group) {
                return $group->count();
            });

        // Recent Activity
        $recentEvents = Event::orderBy('created_at', 'desc')->limit(5)->get();
        $recentUsers = User::orderBy('created_at', 'desc')->limit(5)->get();

        return view('livewire.admin.dashboard.analytics', [
            'stats' => [
                'total_users' => $totalUsers,
                'total_volunteers' => $totalVolunteers,
                'total_organizations' => $totalOrganizations,
                'total_lawyers' => $totalLawyers,
                'total_events' => $totalEvents,
                'active_events' => $activeEvents,
                'completed_events' => $completedEvents,
                'pending_events' => $pendingEvents,
            ],
            'monthlyRegistrations' => $monthlyRegistrations,
            'userStatuses' => $userStatuses,
            'monthlyEvents' => $monthlyEvents,
            'eventParticipation' => $eventParticipation,
            'topOrganizations' => $topOrganizations,
            'volunteerActivity' => $volunteerActivity,
            'badgeStats' => $badgeStats,
            'recentEvents' => $recentEvents,
            'recentUsers' => $recentUsers,
        ]);
    }
}
