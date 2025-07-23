<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\User;

class VolunteerDetails extends Component
{
    public $volunteer;
    public $events;

    public function mount($id)
    {
        $this->volunteer = User::with('attributes')->findOrFail($id);
        $attributes = $this->volunteer->attributes()->get()->pluck('pivot.value', 'name')->all();

        $this->setAttributesForView($attributes);

        // Get all events the volunteer participated in
        $this->events = $this->volunteer->participatingEvents()->withCount('users')->get();
    }

    protected $attributesForView = [];

    protected function setAttributesForView($attributes)
    {
        $this->attributesForView = $attributes;
    }

    public function render()
    {
        return view('livewire.admin.dashboard.volunteerDetails', [
            'volunteer' => $this->volunteer,
            'attributes' => $this->attributesForView,
            'events' => $this->events,
        ]);
    }
}
