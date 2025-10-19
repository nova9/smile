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
    public $showForm = true;
    public $showAlert = false;
    public $alertMessage = '';
    public $showPreviousRequests = false;

    protected $rules = [
        'category' => 'required',
        'priority' => 'required',
        'subject' => 'required|max:255',
        'message' => 'required|max:2000',
    ];

    public function submitConcern()
    {
        // Prevent admin users from submitting support requests
        if ($this->isAdmin()) {
            return;
        }

        $this->validate();

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

        // Show success alert and hide form
        $this->showAlert = true;
        $this->alertMessage = 'Support request submitted successfully!';
        $this->showForm = false;
    }

    public function showNewForm()
    {
        $this->showForm = true;
        $this->showAlert = false;
        $this->reset(['category', 'priority', 'subject', 'message']);
    }

    public function togglePreviousRequests()
    {
        $this->showPreviousRequests = !$this->showPreviousRequests;
    }

    public function getUserTickets()
    {
        // Don't return tickets for admin users
        if ($this->isAdmin()) {
            return collect();
        }

        return SupportTicket::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function formatCategoryName($category)
    {
        $categories = [
            'login_access' => 'Login & Access Issues',
            'profile_account' => 'Profile & Account Problems',
            'events_volunteering' => 'Events & Volunteering',
            'technical_bugs' => 'Technical Issues & Bugs',
            'payments_donations' => 'Payments & Donations',
            'reporting_content' => 'Report User/Content',
            'feature_request' => 'Feature Request',
            'other' => 'Other'
        ];

        return $categories[$category] ?? ucfirst(str_replace('_', ' ', $category));
    }

    public function formatPriorityName($priority)
    {
        $priorities = [
            'low' => 'Low - General question',
            'medium' => 'Medium - Issue affecting experience',
            'high' => 'High - Cannot use features',
            'urgent' => 'Urgent - Completely blocked'
        ];

        return $priorities[$priority] ?? ucfirst($priority);
    }

    public function resolveTicket($ticketId)
    {
        // Prevent admin users from resolving tickets through this component
        if ($this->isAdmin()) {
            return;
        }

        $ticket = SupportTicket::find($ticketId);

        if ($ticket && $ticket->user_id == Auth::id() && $ticket->status !== 'closed') {
            $ticket->update(['status' => 'resolved']);

            $this->showAlert = true;
            $this->alertMessage = 'Ticket marked as resolved successfully!';
        }
    }

    public function closeModal()
    {
        $this->modalOpen = false;
        $this->showForm = true;
        $this->showAlert = false;
        $this->reset();
    }

    public function isAdmin()
    {
        $user = Auth::user();
        return $user && $user->role && $user->role->name === 'admin';
    }

    public function render()
    {
        return view('livewire.common.help-support', [
            'userTickets' => $this->getUserTickets()
        ]);
    }
}
