<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\Event;
use App\Models\EventReport;
use App\Models\User;
use App\Models\SupportTicket;

class DashboardHome extends Component
{
    public function render()
    {
        // Key statistics
        $totalVolunteers = User::whereHas('role', function ($query) {
            $query->where('name', 'volunteer');
        })->count();

        $totalOrganizations = User::whereHas('role', function ($query) {
            $query->where('name', 'requester');
        })->count();

        $totalLawyers = User::whereHas('role', function ($query) {
            $query->where('name', 'lawyer');
        })->count();

        $totalEvents = Event::count();
        $activeEvents = Event::where('is_active', true)->count();
        $hiddenEvents = Event::where('is_active', false)->count();

        $pendingReports = EventReport::where('status', 'pending')->count();
        $openHelpRequests = SupportTicket::where('status', 'open')->count();
        $restrictedOrganizations = User::whereHas('role', function ($query) {
            $query->where('name', 'requester');
        })->where('is_restricted', true)->count();

        // Recent activity
        $recentReports = EventReport::with('event', 'user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentHelpRequests = SupportTicket::with('user')
            ->where('status', 'open')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('livewire.admin.dashboard.dashboardHome', [
            'totalVolunteers' => $totalVolunteers,
            'totalOrganizations' => $totalOrganizations,
            'totalLawyers' => $totalLawyers,
            'totalEvents' => $totalEvents,
            'activeEvents' => $activeEvents,
            'hiddenEvents' => $hiddenEvents,
            'pendingReports' => $pendingReports,
            'openHelpRequests' => $openHelpRequests,
            'restrictedOrganizations' => $restrictedOrganizations,
            'recentReports' => $recentReports,
            'recentHelpRequests' => $recentHelpRequests,
        ]);
    }
}
