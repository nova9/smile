<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\User;

class OrganizationDetails extends Component
{
    public $organization;
    protected $attributesForView = [];
    public $events;

    public function mount($id)
    {
        $this->organization = User::with('attributes')->findOrFail($id);
        $attributes = $this->organization->attributes()->get()->pluck('pivot.value', 'name')->all();
        $this->attributesForView = $attributes;

        // Fetch events organized by this organization
        $this->events = $this->organization->organizingEvents()->withCount('users')->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.organizationDetails', [
            'organization' => $this->organization,
            'attributes' => $this->attributesForView,
            'events' => $this->events,
        ]);
    }
}
