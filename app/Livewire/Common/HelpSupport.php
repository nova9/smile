<?php

namespace App\Livewire\Common;

use Livewire\Component;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;

class HelpSupport extends Component
{
    public $modalOpen = false;
    public $category = '';
    public $priority = '';
    public $subject = '';
    public $message = '';

    protected $rules = [
        'category' => 'required',
        'priority' => 'required',
        'subject' => 'required|max:255',
        'message' => 'required|max:2000',
    ];

    public function submitConcern()
    {
        $this->validate();

        $user = Auth::user();

        SupportTicket::create([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role ?? 'user',
            'category' => $this->category,
            'priority' => $this->priority,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset(['category', 'priority', 'subject', 'message']);
        $this->modalOpen = false;

        session()->flash('help-success', 'Support request submitted successfully!');
    }

    public function closeModal()
    {
        $this->modalOpen = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.common.help-support');
    }
}
