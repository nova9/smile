<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class ContractArchive extends Component
{
    public function render()
    {
        // Provide signed contracts as expected by the updated blade
        $signedContracts = [
            [
                'id' => 901,
                'title' => 'Community Cleanup Volunteer Agreement',
                'organization' => 'Acme Goodwill Foundation',
                'type' => 'Volunteer Service Agreement',
                'value' => '$0.00',
                'status' => 'signed',
                'signed_at' => date('Y-m-d'),
                'contract_number' => 'VSA-2025-001',
                'event' => 'Community Clean-up Drive 2025',
                'start_date' => date('Y-m-01'),
                'end_date' => date('Y-m-t'),
                'duration' => '4 weeks',
                'contact' => '+1 (555) 012-3456',
                'volunteer_name' => 'John Doe',
                'volunteer_address' => '123 Main St, Springfield',
                'volunteer_email' => 'john.doe@example.com',
                'volunteer_nic' => '901234567V',
            ],
            [
                'id' => 902,
                'title' => 'Riverbank Restoration Volunteer Agreement',
                'organization' => 'EcoCare Trust',
                'type' => 'Volunteer Service Agreement',
                'value' => '$0.00',
                'status' => 'signed',
                'signed_at' => date('Y-m-d', strtotime('-7 days')),
                'contract_number' => 'VSA-2025-002',
                'event' => 'Riverbank Restoration Week',
                'start_date' => date('Y-m-01', strtotime('-1 month')),
                'end_date' => date('Y-m-t', strtotime('-1 month')),
                'duration' => '4 weeks',
                'contact' => '+1 (555) 111-2222',
                'volunteer_name' => 'Alice Brown',
                'volunteer_address' => '22 River Rd, Lakeside',
                'volunteer_email' => 'alice.brown@example.com',
                'volunteer_nic' => '781234567V',
            ],
        ];

        return view('livewire.lawyer.dashboard.contract-archive', compact('signedContracts'));
    }
}
