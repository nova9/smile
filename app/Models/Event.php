<?php

namespace App\Models;

use App\Services\Notifications\ApprovalNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Services\Notifications\EventJoinNotification;

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
        'city',
        'embedding',
        'participant_requirements',
        'recruiting_method'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('status');
    }

    protected $casts = [
        'ends_at' => 'datetime',
        'starts_at' => 'datetime',
        'embedding' => 'json',
        'skills' => 'array',
        'participant_requirements' => 'array'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function eventCreator()
    {
        // Return the user who created the event
        return $this->user;
    }
    
    public function isFavourite()
    {
        return Favourites::where('event_id', $this->id)->exists();
    }

    public function userJoinsNotify()
    {
        // Send notification to event creator
        $eventCreator = $this->eventCreator();
        // dd($eventCreator);
        if ($eventCreator) {
            $eventCreator->notify(new EventJoinNotification($this));
            // dd("Notification sent to event creator: " . $eventCreator->name);
        }

        return $this;
    }
    public function approveUserNotify($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->notify(new ApprovalNotification($this));
        }
    }

    // In App\Models\Event.php



}
