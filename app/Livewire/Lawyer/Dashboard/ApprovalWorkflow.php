<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class ApprovalWorkflow extends Component
{
    public $pendingApprovals;
    public $approvalHistory;

    public function mount()
    {
        $this->pendingApprovals = [
            [
                'id' => 1,
                'contract_title' => 'Service Agreement - TechCorp Ltd',
                'submitted_by' => 'John Doe',
                'submitted_at' => '2 hours ago',
                'priority' => 'high',
                'status' => 'pending'
            ],
            [
                'id' => 2,
                'contract_title' => 'Employment Contract - Jane Smith',
                'submitted_by' => 'HR Department',
                'submitted_at' => '1 day ago',
                'priority' => 'medium',
                'status' => 'under_review'
            ]
        ];

        $this->approvalHistory = [
            [
                'contract_title' => 'Partnership Agreement - ABC Corp',
                'approved_at' => '3 days ago',
                'status' => 'approved'
            ],
            [
                'contract_title' => 'NDA - Startup XYZ',
                'approved_at' => '1 week ago',
                'status' => 'rejected'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.approval-workflow');
    }
}
