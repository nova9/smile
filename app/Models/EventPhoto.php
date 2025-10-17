<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPhoto extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'file_id',
    ];
    
   
}
