<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SupportTicket;
use App\Models\User;
use App\Services\Messaging;

class HelpRequests extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'all';
    public $priorityFilter = 'all';
    public $categoryFilter = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => 'all'],
        'priorityFilter' => ['except' => 'all'],
        'categoryFilter' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingPriorityFilter()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function resolveTicket($ticketId)
    {
        $ticket = SupportTicket::findOrFail($ticketId);
        $ticket->update(['status' => 'resolved']);

        session()->flash('success', 'Ticket marked as resolved successfully.');
    }

    public function chatWithUser($ticketId)
    {
        $ticket = SupportTicket::findOrFail($ticketId);
        $user = User::findOrFail($ticket->user_id);
        $currentUser = auth()->user();

        // Get or create a direct chat with the user
        $existingChat = Messaging::getDirectChatTo($currentUser, $user);

        if (!$existingChat) {
            // Create a new chat if one doesn't exist
            Messaging::initializeDirectChatTo($currentUser, $user);
            $chat = Messaging::getDirectChatTo($currentUser, $user);
        } else {
            $chat = $existingChat;
        }

        if ($chat) {
            // Automatically update ticket status to "in_progress" when chat is opened
            $ticket->update(['status' => 'in_progress']);

            // Show success message
            if (!$existingChat) {
                session()->flash('success', 'Chat created with ' . $user->name . ' regarding ticket #' . $ticket->id . '. Status updated to In Progress.');
            } else {
                session()->flash('success', 'Chat opened with ' . $user->name . '. You can discuss ticket #' . $ticket->id . '. Status updated to In Progress.');
            }

            // Trigger the chat to open
            $this->dispatch('openChat', $chat->id);

            // Force close the current modal with a delay to ensure proper state management
            $this->dispatch('forceCloseModal', ticketId: $ticket->id);

        } else {
            session()->flash('error', 'Unable to establish chat connection. Please try again later.');
        }
    }

    public function render()
    {
        $query = SupportTicket::with(['user.role'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('subject', 'like', '%' . $this->search . '%')
                        ->orWhere('user_name', 'like', '%' . $this->search . '%')
                        ->orWhere('message', 'like', '%' . $this->search . '%')
                        ->orWhereHas('user', function ($userQuery) {
                            $userQuery->where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('email', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->priorityFilter !== 'all', function ($query) {
                $query->where('priority', $this->priorityFilter);
            })
            ->when($this->categoryFilter !== 'all', function ($query) {
                $query->where('category', $this->categoryFilter);
            })
            ->orderByRaw("CASE 
                WHEN status = 'open' THEN 1
                WHEN status = 'in_progress' THEN 2
                WHEN status = 'resolved' THEN 3
                ELSE 4
            END")
            ->orderBy('created_at', 'asc');

        $tickets = $query->paginate(10);

        return view('livewire.admin.dashboard.help-requests', compact('tickets'));
    }
}
