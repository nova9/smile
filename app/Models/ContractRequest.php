<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractRequest extends Model
{
    protected $fillable = [
        'event_id',
        'requester_id',
        'agreement_id',
        'lawyer_id',
        'status',
        'requester_details',
        'notes',
        'customized_terms',
        'customization_status',
        'signature_path',
        'signed_at',
    ];

    protected $casts = [
        'requester_details' => 'array',
        'signed_at' => 'datetime',
    ];

    /**
     * Get the event associated with this contract request
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the requester (organization/user) who made the request
     */
    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    /**
     * Get the agreement template being used
     */
    public function agreement(): BelongsTo
    {
        return $this->belongsTo(Agreement::class);
    }

    /**
     * Get the lawyer assigned to this contract request
     */
    public function lawyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lawyer_id');
    }
}
