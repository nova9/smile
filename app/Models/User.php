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
            ->withPivot('status', 'created_at');
    }

    public function events()
    {
        return $this->hasMany(\App\Models\Event::class);
    }

    public function isProfileCompletionPercentage()
    {
        $requiredskills = [
            'skills',
            'age',
            'latitude',
            'longitude',
            'contact_number',
            'gender',
            'profile_picture'
        ];

        $initialPercentage = 0.3;

        $user = auth()->user();
        $attributes = $user->attributes()->get()->pluck('pivot.value', 'name')->all();
        // dd($attributes);
        foreach ($requiredskills as $requiredskill) {
            // dd($attributes[$requiredskill]);
            if (!empty($attributes[$requiredskill])) {
                $initialPercentage += 0.1;
            }
        }
        return $initialPercentage;
    }
}
