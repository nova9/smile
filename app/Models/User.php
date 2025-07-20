<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        return $this->belongsToMany(Attribute::class, 'attribute_user', 'user_id', 'attribute_id')->withPivot('value');
    }

    public function organizingEvents(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function participatingEvents(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)
            ->withTimestamps()
        ;
    }

    public function events()
    {
        return $this->hasMany(\App\Models\Event::class);
    }
    
    public function isProfileCompletionPercentage(...$args)
    {
        $initialPercentage = 0.3;
        $points = [];
        if (count($args) === 7) {
            // Volunteer: 7 fields
            $points = [
                ['name' => $args[0], 'points' => 0.1], // contact_number
                ['name' => $args[1], 'points' => 0.1], // skills
                ['name' => $args[2], 'points' => 0.1], // latitude
                ['name' => $args[3], 'points' => 0.1], // longitude
                ['name' => $args[4], 'points' => 0.1], // gender
                ['name' => $args[5], 'points' => 0.1], // profile_picture
                ['name' => $args[6], 'points' => 0.1], // age
            ];
        } elseif (count($args) === 2) {
            // Requester: 2 fields
            $points = [
                ['name' => $args[0], 'points' => 0.35],//contact_number
                ['name' => $args[1], 'points' => 0.35],//logo
            ];
        }
        foreach ($points as $point) {
            if (!empty($point['name'])) {
                $initialPercentage += $point['points'];
            }
        }
        return $initialPercentage;
    }
}
