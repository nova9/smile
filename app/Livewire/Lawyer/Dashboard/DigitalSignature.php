<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class DigitalSignature extends Component
{
    public function render()
    {
        $contracts = [
            [
                'id' => 1,
                'title' => 'Community Garden Project - Volunteer Agreement',
                'organization' => 'Green Earth Foundation',
                'type' => 'Volunteer Service Agreement',
                'status' => 'ready_to_sign',
                'value' => 'Volunteer Service (No monetary compensation)',
                'created_at' => '2024-01-15',
                'contract_number' => 'VSA-2024-001',
                'representative' => 'Maria Rodriguez',
                'email' => 'maria@greenearth.org',
                'phone' => '+1 (555) 123-4567'
            ],
            [
                'id' => 2,
                'title' => 'Food Bank Distribution - Service Contract',
                'organization' => 'City Food Bank',
                'type' => 'Volunteer Service Agreement',
                'status' => 'ready_to_sign',
                'value' => 'Volunteer Service (No monetary compensation)',
                'created_at' => '2024-01-20',
                'contract_number' => 'VSA-2024-002',
                'representative' => 'David Chen',
                'email' => 'david@cityfoodbank.org',
                'phone' => '+1 (555) 234-5678'
            ],
            [
                'id' => 3,
                'title' => 'Employment Contract - Senior Developer',
                'organization' => 'TechCorp Solutions',
                'type' => 'Employment Contract',
                'status' => 'ready_to_sign',
                'value' => '$85,000',
                'created_at' => '2024-01-18',
                'contract_number' => 'EC-2024-001',
                'representative' => 'Sarah Johnson',
                'email' => 'hr@techcorp.com',
                'phone' => '+1 (555) 345-6789'
            ]
        ];

        $signedContracts = [
            [
                'id' => 4,
                'title' => 'Beach Cleanup Initiative - Volunteer Agreement',
                'organization' => 'Ocean Conservation Society',
                'type' => 'Volunteer Service Agreement',
                'status' => 'signed',
                'value' => 'Volunteer Service (No monetary compensation)',
                'created_at' => '2024-01-10',
                'signed_at' => '2024-01-12',
                'contract_number' => 'VSA-2024-003',
                'representative' => 'Lisa Park',
                'email' => 'lisa@oceanconservation.org',
                'phone' => '+1 (555) 456-7890'
            ],
            [
                'id' => 5,
                'title' => 'Partnership Agreement - Legal Services',
                'organization' => 'Metro Legal Aid',
                'type' => 'Partnership Agreement',
                'status' => 'signed',
                'value' => '$50,000',
                'created_at' => '2024-01-05',
                'signed_at' => '2024-01-08',
                'contract_number' => 'PA-2024-001',
                'representative' => 'Michael Brown',
                'email' => 'michael@metrolegalaid.org',
                'phone' => '+1 (555) 567-8901'
            ]
        ];

        return view('livewire.lawyer.dashboard.digital-signature', compact('contracts', 'signedContracts'));
    }
}
