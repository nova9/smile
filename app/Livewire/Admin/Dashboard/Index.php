<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\Event;
use App\Models\EventReport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Index extends Component
{
    public $errorMessage = null;

    protected $listeners = ['refreshDashboard' => '$refresh', 'keepAlive' => '$refresh'];

    public function toggleEventStatus($eventId)
    {
        $event = Event::findOrFail($eventId);
        $previousStatus = $event->is_active;
        $event->update(['is_active' => !$event->is_active]);

        $action = $event->is_active ? 'enabled' : 'disabled';
        $icon = $event->is_active ? 'check-circle' : 'ban';

        session()->flash('message', "Event '{$event->name}' has been {$action} successfully!");
        session()->flash('message_type', 'success');
        session()->flash('message_icon', $icon);

        // Dispatch browser event for smooth UI updates
        $this->dispatch('event-status-changed', eventId: $eventId, isActive: $event->is_active);
    }

    public function dismissReports($eventId)
    {
        $event = Event::findOrFail($eventId);
        $reportCount = EventReport::where('event_id', $eventId)
            ->where('status', 'pending')
            ->count();

        EventReport::where('event_id', $eventId)
            ->where('status', 'pending')
            ->update(['status' => 'dismissed']);

        session()->flash('message', "{$reportCount} " . Str::plural('report', $reportCount) . " dismissed for '{$event->name}'");
        session()->flash('message_type', 'info');
        session()->flash('message_icon', 'check');

        // Dispatch browser event for smooth UI updates
        $this->dispatch('reports-dismissed', eventId: $eventId);
    }

    public function render()
    {
        // Get events with 3 or more reports, sorted by most reported first
        $reportedEvents = Event::withCount([
            'reports' => function ($query) {
                $query->where('status', 'pending');
            }
        ])
            ->with([
                'user',
                'category',
                'reports' => function ($query) {
                    $query->where('status', 'pending')->with('user')->latest();
                }
            ])
            ->get()
            ->filter(function ($event) {
                return $event->reports_count >= 3;
            })
            ->sortByDesc('reports_count')
            ->sortByDesc('created_at')
            ->take(10);

        // Get other events (with less than 3 reports or no reports)
        $otherEvents = Event::withCount([
            'reports' => function ($query) {
                $query->where('status', 'pending');
            }
        ])
            ->with(['user', 'category'])
            ->latest()
            ->get()
            ->filter(function ($event) {
                return $event->reports_count < 3;
            })
            ->take(10);

        return view('livewire.admin.dashboard.index', [
            'reportedEvents' => $reportedEvents,
            'otherEvents' => $otherEvents,
        ]);
    }
}
