<?php

namespace App\Livewire\Requester\Dashboard\Certificates;

use Livewire\Component;


class IssuedCertificates extends Component
{
    public $issuedCertificates = [];
    public $eligibleCertificates = [];
    public function mount()
    {
    
        //issued
        $this->issuedCertificates = \App\Models\Certificate::where('issued_by', auth()->user()->id)
            ->with('event')
            ->get();
        // dd($this->issuedCertificates);
    }
     



    public function render()
    {
        return view('livewire.requester.dashboard.certificates.issued-certificates');
    }
}
