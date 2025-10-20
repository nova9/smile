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

        // After toggling, update owner's restricted flag if they have 2 or more hidden events
        try {
            $owner = $event->user;
            if ($owner) {
                $hiddenCount = Event::where('user_id', $owner->id)->where('is_active', false)->count();
                $shouldRestrict = $hiddenCount >= 2;
                if ($owner->is_restricted !== $shouldRestrict) {
                    $owner->update(['is_restricted' => $shouldRestrict]);
                }
            }
        } catch (\Exception $e) {
            Log::warning('Failed to update owner restricted flag: ' . $e->getMessage());
        }

        // Dispatch browser event for smooth UI updates
        $this->dispatch('event-status-changed', eventId: $eventId, isActive: $event->is_active);
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
