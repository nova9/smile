<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attribute extends Model
{

    public function users() :BelongsToMany
    {
        return $this->belongsToMany(User::class, 'attribute_user', 'attribute_id', 'user_id')->withPivot('value');
    }
}
