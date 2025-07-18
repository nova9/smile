<?php

namespace App\Livewire\Requester\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateEvent extends Component
{
    public $title, $description, $date;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => 'required|date',
    ];

    public function create()
    {
        $this->validate();
        Auth::user()->events()->create([
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'status' => 'active',
        ]);
        session()->flash('success', 'Event created!');
        return redirect()->route('requester.events');
    }

    public function render()
    {
        return view('livewire.requester.dashboard.create-event');
    }
}
