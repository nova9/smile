<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class DigitalSignature extends Component
{
    public $pendingSignatures;
    public $completedSignatures;

    public function mount()
    {
        $this->pendingSignatures = [
            [
                'id' => 1,
                'contract_title' => 'Service Agreement - TechCorp Ltd',
                'client_name' => 'TechCorp Ltd',
                'sent_date' => '1 day ago',
                'status' => 'awaiting_signature'
            ],
            [
                'id' => 2,
                'contract_title' => 'Employment Contract - Jane Smith',
                'client_name' => 'Jane Smith',
                'sent_date' => '3 hours ago',
                'status' => 'viewed'
            ]
        ];

        $this->completedSignatures = [
            [
                'contract_title' => 'Partnership Agreement - ABC Corp',
                'client_name' => 'ABC Corp',
                'signed_date' => '2 days ago'
            ],
            [
                'contract_title' => 'NDA - Startup XYZ',
                'client_name' => 'Startup XYZ',
                'signed_date' => '1 week ago'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.digital-signature');
    }
}
