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
            ->withPivot('status', 'created_at','ends_at');
    }

    public function events()
    {
        return $this->hasMany(\App\Models\Event::class);
    }

    public function profileCompletionPercentage()
    {
        $requiredskills = [
//            'skills'=> 0.1,
            'age' => 0.2,
            'latitude' => 0.1,
            'longitude' => 0.1,
            'contact_number' => 0.1,
            'gender' => 0.1,
            'profile_picture' => 0.1
        ];

        $initialPercentage = 0.3;

        $user = auth()->user();
        $attributes = $user->attributes()->get()->pluck('pivot.value', 'name')->all();
        // dd($attributes);
        foreach ($requiredskills as $key => $value) {
            // dd($attributes[$requiredskill]);
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

    public function setCustomAttribute($attributeName, $value)
    {
        if (!$value) {
            $this->deleteCustomAttributes($attributeName);
            return;
        }
        $attribute = Attribute::where('name', $attributeName)->firstOrFail();
        $this->attributes()->syncWithoutDetaching([$attribute->id => ['value' => $value]]);
    }

    public function getCustomAttribute($attributeName) {
        $attribute = $this->attributes()->where('name', $attributeName)->first();
        return $attribute ? $attribute->pivot->value : null;
    }

    public function getAllAttributes() {
        return $this->attributes()->get()->pluck('pivot.value', 'name')->all();
    }


}
