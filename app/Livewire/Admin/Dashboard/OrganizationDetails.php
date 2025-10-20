<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\EventReport;

class OrganizationDetails extends Component
{
    public $organization;
    protected $attributesForView = [];
    public $events;
    public $reports;

    public function mount($id)
    {
        $this->organization = User::with('attributes')->findOrFail($id);
        $attributes = $this->organization->attributes()->get()->pluck('pivot.value', 'name')->all();
        $this->attributesForView = $attributes;

        // Fetch events organized by this organization
        $this->events = $this->organization->organizingEvents()->withCount('users')->get();

        // Fetch reports for events organized by this organization
        $eventIds = $this->events->pluck('id');
        $this->reports = EventReport::with(['event', 'user'])
            ->whereIn('event_id', $eventIds)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function suspendOrganization()
    {
        \DB::table('users')->where('id', $this->organization->id)->update(['is_restricted' => true]);
        $this->organization = User::with('attributes')->findOrFail($this->organization->id);
        session()->flash('success', 'Organization has been suspended.');
    }

    public function unrestrictOrganization()
    {
        \DB::table('users')->where('id', $this->organization->id)->update(['is_restricted' => false]);
        $this->organization = User::with('attributes')->findOrFail($this->organization->id);
        session()->flash('success', 'Organization has been unrestricted.');
    }

    public function render()
    {
        return view('livewire.admin.dashboard.organizationDetails', [
            'organization' => $this->organization,
            'attributes' => $this->attributesForView,
            'events' => $this->events,
            'reports' => $this->reports,
        ]);
    }
}
