<?php

namespace App\Livewire\Requester\Dashboard\MyEvents;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate]
    public $name;

    public $category_id;
    public $max_participants;

    #[Validate]
    public $description;

    #[Validate]
    public $starts_at;

    #[Validate]
    public $ends_at;
    public $latitude;
    public $longitude;

    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'max_participants' => 'required|integer|min:1',
            'starts_at' => 'required|date|after_or_equal:today',
            'ends_at' => 'required|date|after:starts_at',
        ];
    }

    public function render()
    {
        return view('livewire.requester.dashboard.my-events.create');
    }
}
