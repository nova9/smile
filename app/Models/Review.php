<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable =[
        'user_id',
        'event_id',
        'review',
        'rating'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function event(){
        return $this->belongsTo(Event::class);
    }
}
