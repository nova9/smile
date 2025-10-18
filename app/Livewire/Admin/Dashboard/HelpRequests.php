<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SupportTicket;

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

    public function updateStatus($ticketId, $status)
    {
        $ticket = SupportTicket::findOrFail($ticketId);
        $ticket->update(['status' => $status]);

        session()->flash('success', 'Ticket status updated successfully.');
    }

    public function resolveTicket($ticketId)
    {
        $ticket = SupportTicket::findOrFail($ticketId);
        $ticket->update(['status' => 'resolved']);

        session()->flash('success', 'Ticket marked as resolved successfully.');
    }

    public function render()
    {
        $query = SupportTicket::with('user')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('subject', 'like', '%' . $this->search . '%')
                        ->orWhere('user_name', 'like', '%' . $this->search . '%')
                        ->orWhere('message', 'like', '%' . $this->search . '%');
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
            ->orderBy('created_at', 'desc');

        $tickets = $query->paginate(10);

        return view('livewire.admin.dashboard.help-requests', compact('tickets'));
    }
}
