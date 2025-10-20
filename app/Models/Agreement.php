<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agreement extends Model
{
    protected $fillable = ['topic', 'terms'];

    /**
     * Get all contract requests using this agreement template
     */
    public function contractRequests(): HasMany
    {
        return $this->hasMany(ContractRequest::class);
    }
}
