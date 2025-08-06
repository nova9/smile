<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'event_id',
        'parent_id',
        'name',
        'description',
        'assigned_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function subTasks()
    {
        return $this->hasMany(Task::class,'parent_id');
        
    }
    
    public function assignedUser()
    {
        return $this->belongsTo(User::class,'assigned_id');
    }
    
}
