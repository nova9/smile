<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\Notifications\CertificateIssued;

class Certificate extends Model
{
    protected $fillable = [
        'event_id',
        'issued_by',
        'issued_to',
        'issued_at',
        'remarks',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function issuer()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'issued_to');
    }

    public function issueCertificateNotify()
    {
        // Send notification to volunteer
        $volunteer = $this->recipient;
        if ($volunteer) {
            $volunteer->notify(new CertificateIssued($this));
        }

        return $this;
    }
}


