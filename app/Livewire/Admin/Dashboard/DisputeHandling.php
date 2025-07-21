<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;

class DisputeHandling extends Component
{
    public $showResolveModal = false;
    public $resolveReport = [];

    public function suspendAccount()
    {
        // Add suspend logic here
        $this->showResolveModal = false;
    }

    public function dismissReport()
    {
        // Add dismiss logic here
        $this->showResolveModal = false;
    }

    public function render()
    {
        return view('livewire.admin.dashboard.DisputeHandling', [
            'showResolveModal' => $this->showResolveModal,
            'resolveReport' => $this->resolveReport,
        ]);
    }
}
