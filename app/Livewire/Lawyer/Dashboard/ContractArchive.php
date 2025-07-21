<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class ContractArchive extends Component
{
    public function render()
    {
        $stats = [
            'total_archived' => 127,
            'this_month' => 18,
            'total_value' => '$2.3M',
            'avg_completion' => '14 days'
        ];

        $archivedContracts = [
            [
                'id' => 1,
                'title' => 'Community Garden Project - Volunteer Agreement',
                'organization' => 'Green Earth Foundation',
                'type' => 'Volunteer Service Agreement',
                'value' => 'Volunteer Service (No monetary compensation)',
                'contract_id' => 'VSA-2024-001',
                'duration' => '6 months',
                'signed_date' => '2024-01-15',
                'archived_date' => '2024-01-20',
                'completion_time' => '12 days',
                'final_status' => 'completed',
                'last_accessed' => '2024-01-18',
                'representative' => 'Maria Rodriguez'
            ],
            [
                'id' => 2,
                'title' => 'Beach Cleanup Initiative - Volunteer Agreement',
                'organization' => 'Ocean Conservation Society',
                'type' => 'Volunteer Service Agreement',
                'value' => 'Volunteer Service (No monetary compensation)',
                'contract_id' => 'VSA-2024-002',
                'duration' => '3 months',
                'signed_date' => '2024-01-10',
                'archived_date' => '2024-01-12',
                'completion_time' => '8 days',
                'final_status' => 'completed',
                'last_accessed' => '2024-01-15',
                'representative' => 'Lisa Park'
            ],
            [
                'id' => 3,
                'title' => 'Food Bank Distribution - Service Contract',
                'organization' => 'City Food Bank',
                'type' => 'Volunteer Service Agreement',
                'value' => 'Volunteer Service (No monetary compensation)',
                'contract_id' => 'VSA-2024-003',
                'duration' => '12 months',
                'signed_date' => '2024-01-05',
                'archived_date' => '2024-01-08',
                'completion_time' => '15 days',
                'final_status' => 'completed',
                'last_accessed' => '2024-01-10',
                'representative' => 'David Chen'
            ],
            [
                'id' => 4,
                'title' => 'Employment Contract - Senior Developer',
                'organization' => 'TechCorp Solutions',
                'type' => 'Employment Contract',
                'value' => '$85,000',
                'contract_id' => 'EC-2024-001',
                'duration' => '2 years',
                'signed_date' => '2023-12-28',
                'archived_date' => '2023-12-30',
                'completion_time' => '20 days',
                'final_status' => 'completed',
                'last_accessed' => '2024-01-05',
                'representative' => 'Sarah Johnson'
            ],
            [
                'id' => 5,
                'title' => 'Partnership Agreement - Legal Services',
                'organization' => 'Metro Legal Aid',
                'type' => 'Partnership Agreement',
                'value' => '$50,000',
                'contract_id' => 'PA-2024-001',
                'duration' => '1 year',
                'signed_date' => '2023-12-20',
                'archived_date' => '2023-12-22',
                'completion_time' => '18 days',
                'final_status' => 'completed',
                'last_accessed' => '2023-12-28',
                'representative' => 'Michael Brown'
            ],
            [
                'id' => 6,
                'title' => 'Non-Disclosure Agreement - Tech Startup',
                'organization' => 'InnovateNow Inc',
                'type' => 'NDA',
                'value' => '$5,000',
                'contract_id' => 'NDA-2024-001',
                'duration' => '5 years',
                'signed_date' => '2023-12-15',
                'archived_date' => '2023-12-16',
                'completion_time' => '5 days',
                'final_status' => 'completed',
                'last_accessed' => '2023-12-20',
                'representative' => 'Jennifer White'
            ]
        ];

        return view('livewire.lawyer.dashboard.contract-archive', compact('stats', 'archivedContracts'));
    }
}
