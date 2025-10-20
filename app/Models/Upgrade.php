<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Upgrade extends Model
{
    protected $fillable = [
        'logo_file_id',
        'user_id',
        'organization_name',
        'organization_website',
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
