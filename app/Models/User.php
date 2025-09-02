<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'embedding',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class);
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class)->withPivot('value');
    }

    public function organizingEvents(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function participatingEvents(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)
            ->withTimestamps()
            ->withPivot('status', 'created_at', 'ends_at');
    }
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class, 'issued_to');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function tasks(): HasManyThrough
    {
        return $this->hasManyThrough(Task::class, Event::class);
    }

    public function chats(): BelongsToMany
    {
        return $this->belongsToMany(Chat::class);
    }

    public function profileCompletionPercentage()
    {
        $initialPercentage = 0.4;

        $requiredSkills = [
            'latitude' => 0.1,
            'longitude' => 0.1,
            'contact_number' => 0.2,
            'gender' => 0.2,
        ];

        $user = auth()->user();
        $attributes = $user->attributes()->get()->pluck('pivot.value', 'name')->all();
//         dd($attributes);
        foreach ($requiredSkills as $key => $value) {
            if (!empty($attributes[$key])) {
                $initialPercentage += $value;
            }
        }
        return $initialPercentage;
    }

    public function deleteCustomAttributes($attributeName): void
    {
        $attribute = Attribute::where('name', $attributeName)->firstOrFail();
        $this->attributes()->detach($attribute);
    }

    public function setCustomAttribute($attributeName, $value): void
    {
        if (!$value) {
            $this->deleteCustomAttributes($attributeName);
            return;
        }
        $attribute = Attribute::where('name', $attributeName)->firstOrFail();
        $this->attributes()->syncWithoutDetaching([$attribute->id => ['value' => $value]]);
    }

    public function getCustomAttribute($attributeName)
    {
        $attribute = $this->attributes()->where('name', $attributeName)->first();
        return $attribute ? $attribute->pivot->value : null;
    }

    public function getAllAttributes()
    {
        return $this->attributes()->get()->pluck('pivot.value', 'name')->all();
    }

    public function assignBadgesForTasks($completedTasksCount)
    {
        if ($completedTasksCount === 1) {
            // Assign badge (first task completed)
            $firstBadge = \App\Models\Badge::find(1);
            if ($firstBadge) {
                $this->badges()->attach($firstBadge->id);
            }
        }
        if ($completedTasksCount === 100) {
            // Assign badge (100 tasks completed)
            $hundredBadge = \App\Models\Badge::find(2);
            if ($hundredBadge) {
                $this->badges()->attach($hundredBadge->id);
            }
        }
    }

    public function assignBadgesForEvents($participatedEventsCount)
    {
        if ($participatedEventsCount === 1) {
            // Assign badge (first event participated)
            $firstBadge = \App\Models\Badge::find(3);
            if ($firstBadge) {
                $this->badges()->attach($firstBadge->id);
            }
        }
        if ($participatedEventsCount === 10) {
            // Assign badge (10 events participated)
            $tenBadge = \App\Models\Badge::find(4);
            if ($tenBadge) {
                $this->badges()->attach($tenBadge->id);
            }
        }
    }

    public function setVolunteerLevel($points, $events, $tasks)
    {
        if ($points <= 10 && ($events <= 10 || $tasks <= 10)) {
            $this->setCustomAttribute('level', 'beginner');
        } elseif ($points <= 30 && ($events <= 30 || $tasks <= 30)) {
            $this->setCustomAttribute('level', 'intermediate');
        } else {
            $this->setCustomAttribute('level', 'advanced');
        }
    }
}
