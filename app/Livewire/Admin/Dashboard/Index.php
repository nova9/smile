<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\Event;
use App\Models\EventReport;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    public $userStats = [];
    public $pendingActions = [];
    public $recentActions = [];
    public $errorMessage = null;
    public $refreshing = false;
    public $refreshInterval = 30; // seconds

    protected $listeners = ['refreshDashboard' => 'loadAllData'];

    public function mount()
    {
        $this->loadAllData();
    }

    public function loadAllData()
    {
        try {
            $this->errorMessage = null;
            $this->loadStats();
            $this->loadPendingActions();
            $this->loadRecentActions();
        } catch (\Exception $e) {
            Log::error('Dashboard data loading failed: ' . $e->getMessage());
            $this->errorMessage = 'Failed to load dashboard data. Please try again.';
        }
    }

    public function loadStats()
    {
        try {
            $cacheKey = 'admin_dashboard_stats';
            $this->userStats = Cache::remember($cacheKey, 300, function () { // 5 minutes cache
                $totalUsers = User::count();

                // Count users who haven't verified their email
                $unverifiedUsers = User::whereNull('email_verified_at')->count();

                $newRegistrations = User::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();

                // For now, we'll use a placeholder for pending verifications
                // This can be updated when organization verification is implemented
                $pendingVerifications = 0;

                return [
                    [
                        'icon' => 'users',
                        'title' => 'Total Users',
                        'value' => number_format($totalUsers),
                        'description' => 'All registered users'
                    ],
                    [
                        'icon' => 'user-check',
                        'title' => 'Unverified Users',
                        'value' => number_format($unverifiedUsers),
                        'description' => 'Email not verified'
                    ],
                    [
                        'icon' => 'user-plus',
                        'title' => 'New Registrations',
                        'value' => number_format($newRegistrations),
                        'description' => 'This month'
                    ],
                    [
                        'icon' => 'shield-check',
                        'title' => 'Pending Verifications',
                        'value' => number_format($pendingVerifications),
                        'description' => 'Awaiting approval'
                    ]
                ];
            });
        } catch (\Exception $e) {
            Log::error('Failed to load stats: ' . $e->getMessage());
            throw $e;
        }
    }

    public function loadPendingActions()
    {
        try {
            $cacheKey = 'admin_dashboard_pending_actions';
            $this->pendingActions = Cache::remember($cacheKey, 180, function () { // 3 minutes cache
                $actions = [];

                // Check for unverified users
                $unverifiedUsers = User::whereNull('email_verified_at')->count();
                if ($unverifiedUsers > 0) {
                    $actions[] = [
                        'type' => 'Email Verification',
                        'count' => number_format($unverifiedUsers),
                        'priority' => ['class' => 'badge-warning', 'text' => 'Medium']
                    ];
                }

                // Placeholder for other pending actions - can be updated when models are available
                // Future: Organization verifications, content reports, volunteer hours, etc.

                return $actions;
            });
        } catch (\Exception $e) {
            Log::error('Failed to load pending actions: ' . $e->getMessage());
            throw $e;
        }
    }

    public function loadRecentActions()
    {
        try {
            $cacheKey = 'admin_dashboard_recent_actions';
            $this->recentActions = Cache::remember($cacheKey, 120, function () { // 2 minutes cache
                // For now, we'll create some sample recent actions based on user registrations
                $recentUsers = User::latest()->limit(3)->get();

                $actions = [];
                foreach ($recentUsers as $user) {
                    $actions[] = [
                        'title' => 'New User Registration',
                        'description' => "{$user->name} joined the platform",
                        'time_ago' => $user->created_at->diffForHumans(),
                        'icon' => 'fas fa-user-plus',
                        'icon_color' => 'text-green-600',
                        'icon_bg' => 'bg-green-100',
                    ];
                }

                // Add some sample actions if no recent users
                if (empty($actions)) {
                    $actions = [
                        [
                            'title' => 'System Maintenance',
                            'description' => 'Database optimization completed',
                            'time_ago' => '2 hours ago',
                            'icon' => 'fas fa-cog',
                            'icon_color' => 'text-blue-600',
                            'icon_bg' => 'bg-blue-100',
                        ],
                        [
                            'title' => 'Security Update',
                            'description' => 'Security patches applied successfully',
                            'time_ago' => '1 day ago',
                            'icon' => 'fas fa-shield-alt',
                            'icon_color' => 'text-green-600',
                            'icon_bg' => 'bg-green-100',
                        ]
                    ];
                }

                return $actions;
            });
        } catch (\Exception $e) {
            Log::error('Failed to load recent actions: ' . $e->getMessage());
            throw $e;
        }
    }

    public function refreshPendingActions()
    {
        $this->refreshing = true;
        Cache::forget('admin_dashboard_pending_actions');
        $this->loadPendingActions();
        $this->refreshing = false;
        $this->dispatch('notify', message: 'Pending actions refreshed', type: 'success');
    }

    public function refreshRecentActions()
    {
        $this->refreshing = true;
        Cache::forget('admin_dashboard_recent_actions');
        $this->loadRecentActions();
        $this->refreshing = false;
        $this->dispatch('notify', message: 'Recent actions refreshed', type: 'success');
    }

    public function retryLoad()
    {
        Cache::flush();
        $this->loadAllData();
        $this->dispatch('notify', message: 'Dashboard data reloaded', type: 'success');
    }

    public function toggleEventStatus($eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->update(['is_active' => !$event->is_active]);
        
        $status = $event->is_active ? 'visible' : 'hidden';
        session()->flash('message', "Event is now {$status} to volunteers!");
    }

    public function dismissReports($eventId)
    {
        EventReport::where('event_id', $eventId)
            ->where('status', 'pending')
            ->update(['status' => 'dismissed']);
        
        session()->flash('message', 'Reports dismissed successfully!');
    }

    public function render()
    {
        // Get events with 3 or more reports, sorted by most reported first
        $reportedEvents = Event::withCount(['reports' => function ($query) {
                $query->where('status', 'pending');
            }])
            ->with(['user', 'category', 'reports' => function ($query) {
                $query->where('status', 'pending')->with('user')->latest();
            }])
            ->get()
            ->filter(function ($event) {
                return $event->reports_count >= 3;
            })
            ->sortByDesc('reports_count')
            ->sortByDesc('created_at')
            ->take(10);

        // Get other events (with less than 3 reports or no reports)
        $otherEvents = Event::withCount(['reports' => function ($query) {
                $query->where('status', 'pending');
            }])
            ->with(['user', 'category'])
            ->latest()
            ->get()
            ->filter(function ($event) {
                return $event->reports_count < 3;
            })
            ->take(10);

        // Auto-refresh every 30 seconds
        $this->dispatch('startAutoRefresh', interval: $this->refreshInterval * 1000);

        return view('livewire.admin.dashboard.index', [
            'reportedEvents' => $reportedEvents,
            'otherEvents' => $otherEvents,
        ]);
    }
}
