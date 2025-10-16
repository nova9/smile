<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
    ];

    public function issueFavoriteNotify()
    {
        
    }
}
