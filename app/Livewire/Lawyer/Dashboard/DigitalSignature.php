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
                'event' => 'Community Garden Project 2024',
                'start_date' => '2024-02-01',
                'end_date' => '2024-02-28',
                'duration' => '4 weeks',
                'contact' => '+1 (555) 123-4567',
                'volunteer_name' => 'John Doe',
                'volunteer_address' => '123 Main St, Springfield',
                'volunteer_email' => 'john.doe@example.com',
                'volunteer_nic' => '901234567V',
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
                'event' => 'City Food Bank Distribution 2024',
                'start_date' => '2024-03-01',
                'end_date' => '2024-03-31',
                'duration' => '4 weeks',
                'contact' => '+1 (555) 234-5678',
                'volunteer_name' => 'Mary Johnson',
                'volunteer_address' => '456 Elm St, Springfield',
                'volunteer_email' => 'mary.johnson@example.com',
                'volunteer_nic' => '812345678V',
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
                'event' => 'Community Clean-up Drive 2024',
                'start_date' => '2024-01-01',
                'end_date' => '2024-01-31',
                'duration' => '4 weeks',
                'contact' => '+1 (555) 456-7890',
                'volunteer_name' => 'Jane Smith',
                'volunteer_address' => '789 Oak Ave, Springfield',
                'volunteer_email' => 'jane.smith@example.com',
                'volunteer_nic' => '701234567V',
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
            ]
        ];

        return view('livewire.lawyer.dashboard.digital-signature', compact('contracts', 'signedContracts'));
    }
}
