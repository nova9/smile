<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventReport extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'reason',
        'details',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
