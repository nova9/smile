<?php

namespace App\Livewire\Lawyer\Dashboard;

use Livewire\Component;

class ContractArchive extends Component
{
    public $archivedContracts;

    public function mount()
    {
        $this->archivedContracts = [
            [
                'id' => 1,
                'title' => 'Service Agreement - TechCorp Ltd',
                'type' => 'Service Agreement',
                'client' => 'TechCorp Ltd',
                'archived_date' => '2 weeks ago',
                'file_size' => '2.3 MB'
            ],
            [
                'id' => 2,
                'title' => 'Employment Contract - Jane Smith',
                'type' => 'Employment Contract',
                'client' => 'Jane Smith',
                'archived_date' => '1 month ago',
                'file_size' => '1.8 MB'
            ],
            [
                'id' => 3,
                'title' => 'Partnership Agreement - ABC Corp',
                'type' => 'Partnership Agreement',
                'client' => 'ABC Corp',
                'archived_date' => '3 weeks ago',
                'file_size' => '3.1 MB'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.lawyer.dashboard.contract-archive');
    }
}
