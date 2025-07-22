<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public $stats;
    public $recentActivities;

    public function mount()
    {
        // Simplified dashboard data
        $this->stats = [
            'total_contracts' => 127,
            'pending_approval' => 8,
            'active_contracts' => 45,
            'completed_this_month' => 23
        ];

        // Only show 3 most recent activities
        $this->recentActivities = [
            [
                'type' => 'Contract Drafted',
                'title' => 'Service Agreement - TechCorp Ltd',
                'status' => 'completed',
                'time' => '2 hours ago'
            ],
            [
                'type' => 'Digital Signature',
                'title' => 'Employment Contract - Jane Smith',
                'status' => 'pending',
                'time' => '5 hours ago'
            ],
            [
                'type' => 'Contract Approved',
                'title' => 'Partnership Agreement - ABC Industries',
                'status' => 'completed',
                'time' => '1 day ago'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.index');
    }
}
