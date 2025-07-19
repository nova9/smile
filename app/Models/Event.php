<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'maximum_participants',
        'description',
        'starts_at',
        'ends_at',
        'latitude',
        'longitude',
        'skills',
        'notes',
        'minimum_age',
        'address_id',
        'user_id',
        'chat_id',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('status');
    }

    protected $casts = [
        'ends_at' => 'datetime',
        'starts_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // In App\Models\Event.php



}
