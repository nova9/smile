<?php

namespace App\Livewire\Requester\Dashboard\Certificates;

use App\Models\Certificate as ModelsCertificate;
use Livewire\Component;
use App\Models\Event;
use App\Models\User;

class Certificate extends Component
{
    public $certificate;
    public $requester;
    public $id;
    public $volunteerid;
    public $volunteer_name;
    public $isIssued;

    public function mount($id, $volunteerid)
    {
        $this->id = $id;
        $this->volunteerid = $volunteerid;
        $this->volunteer_name = User::find($volunteerid)->name;
        $event = Event::where('id', $id)->first();

        if ($event) {
            $this->certificate = [
                'id' => $id,
                'name' => $event->name,
                'description' => $event->description,
                'starts_at' => $event->starts_at,
                'ends_at' => $event->ends_at,
            ];

            $this->requester = $event->user ? [
                'name' => $event->user->name,
            ] : null;
        } else {
            $this->certificate = null;
            $this->requester = null;
        }

        $this->isIssued = ModelsCertificate::where('event_id', $this->id)
            ->where('issued_to', $this->volunteerid)
            ->exists();
    }

    public function issueCertificate($volunteerId)
    {
        $certificate = \App\Models\Certificate::where('event_id', $this->id)
            ->where('issued_to', $volunteerId)
            ->first();

        if ($certificate) {
            $certificate->update([
                'issued_by' => auth()->user()->id,
                'issued_at' => now(),
                'remarks'   => null,
            ]);
            $certificate->issueCertificateNotify();
        } else {
            $certificate = \App\Models\Certificate::create([
                'event_id'    => $this->id,
                'issued_by'   => auth()->user()->id,
                'issued_to'   => $volunteerId,
                'issued_at'   => now(),
                'remarks'     => null,
            ]);
            $certificate->issueCertificateNotify();
        }
    }

    public function render()
    {
        return view('livewire.requester.dashboard.certificates.certificate');
    }
}
