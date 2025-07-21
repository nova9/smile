<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class ContractDrafting extends Component
{
    public $contracts;
    public $templates;

    public function mount()
    {
        $this->contracts = [
            [
                'id' => 1,
                'title' => 'Service Agreement - TechCorp Ltd',
                'type' => 'Service Agreement',
                'status' => 'in_progress',
                'progress' => 75,
                'created_at' => '2 days ago'
            ],
            [
                'id' => 2,
                'title' => 'Employment Contract - Jane Smith',
                'type' => 'Employment Contract',
                'status' => 'draft',
                'progress' => 40,
                'created_at' => '1 week ago'
            ],
            [
                'id' => 3,
                'title' => 'Partnership Agreement - ABC Corp',
                'type' => 'Partnership Agreement',
                'status' => 'review',
                'progress' => 90,
                'created_at' => '3 days ago'
            ]
        ];

        $this->templates = [
            ['name' => 'Service Agreement Template', 'category' => 'Business'],
            ['name' => 'Employment Contract Template', 'category' => 'HR'],
            ['name' => 'NDA Template', 'category' => 'Legal'],
            ['name' => 'Partnership Agreement Template', 'category' => 'Business']
        ];
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.contract-drafting');
    }
}
