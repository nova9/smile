<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class ContractCustomization extends Component
{
    public $templates;
    public $customFields;

    public function mount()
    {
        $this->templates = [
            [
                'id' => 1,
                'name' => 'Service Agreement Template',
                'category' => 'Business',
                'last_modified' => '3 days ago',
                'usage_count' => 45
            ],
            [
                'id' => 2,
                'name' => 'Employment Contract Template',
                'category' => 'HR',
                'last_modified' => '1 week ago',
                'usage_count' => 32
            ],
            [
                'id' => 3,
                'name' => 'NDA Template',
                'category' => 'Legal',
                'last_modified' => '2 days ago',
                'usage_count' => 28
            ]
        ];

        $this->customFields = [
            ['name' => 'Company Logo', 'type' => 'Image', 'required' => true],
            ['name' => 'Payment Terms', 'type' => 'Text', 'required' => true],
            ['name' => 'Termination Clause', 'type' => 'Text Area', 'required' => false],
            ['name' => 'Governing Law', 'type' => 'Dropdown', 'required' => true]
        ];
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.contract-customization');
    }
}
