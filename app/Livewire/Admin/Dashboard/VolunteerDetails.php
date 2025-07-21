<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\User;

class VolunteerDetails extends Component
{
    public $volunteer;

    public function mount($id)
    {
        $this->volunteer = User::with('attributes')->findOrFail($id);
        $attributes = $this->volunteer->attributes()->get()->pluck('pivot.value', 'name')->all();

        $this->setAttributesForView($attributes);
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
        ]);
    }
}
