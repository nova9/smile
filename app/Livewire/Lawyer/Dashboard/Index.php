<?php

namespace App\Livewire\Lawyer\Dashboard;

use App\Models\ContractRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $stats;
    public $recentActivities;
    public $processCounts;

    public function mount()
    {
        $lawyerId = Auth::id();

        // Fetch real statistics
        $totalContracts = ContractRequest::where('lawyer_id', $lawyerId)->count();
        $pendingApproval = ContractRequest::where('lawyer_id', $lawyerId)
            ->where('status', 'pending')
            ->count();
        $activeContracts = ContractRequest::where('lawyer_id', $lawyerId)
            ->where('status', 'approved')
            ->whereNotNull('signed_at')
            ->count();
        $completedThisMonth = ContractRequest::where('lawyer_id', $lawyerId)
            ->where('status', 'approved')
            ->whereNotNull('signed_at')
            ->whereMonth('signed_at', now()->month)
            ->whereYear('signed_at', now()->year)
            ->count();

        $this->stats = [
            'total_contracts' => $totalContracts,
            'pending_approval' => $pendingApproval,
            'active_contracts' => $activeContracts,
            'completed_this_month' => $completedThisMonth
        ];

        // Business process counts
        $awaitingSignature = ContractRequest::where('lawyer_id', $lawyerId)
            ->where('status', 'approved')
            ->whereNull('signed_at')
            ->count();

        $customizationRequests = ContractRequest::where('lawyer_id', $lawyerId)
            ->where('status', 'pending')
            ->whereNotNull('notes')
            ->count();

        $this->processCounts = [
            'pending_approval' => $pendingApproval,
            'awaiting_signature' => $awaitingSignature,
            'archived' => $activeContracts,
            'customization_requests' => $customizationRequests,
        ];

        // Fetch recent activities
        $recentContracts = ContractRequest::where('lawyer_id', $lawyerId)
            ->with(['event', 'agreement'])
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        $this->recentActivities = $recentContracts->map(function ($contract) {
            $type = 'Contract Request';
            if ($contract->status === 'approved' && $contract->signed_at) {
                $type = 'Contract Signed';
            } elseif ($contract->status === 'approved') {
                $type = 'Contract Approved';
            } elseif ($contract->status === 'rejected') {
                $type = 'Contract Rejected';
            }

            return [
                'type' => $type,
                'title' => ($contract->agreement->topic ?? 'Contract') . ' - ' . ($contract->event->name ?? 'Event'),
                'status' => $contract->status === 'approved' ? 'completed' : ($contract->status === 'pending' ? 'pending' : 'rejected'),
                'time' => $contract->updated_at->diffForHumans()
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.index');
    }
}
