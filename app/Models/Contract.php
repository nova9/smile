<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    // Optional: specify table name if different
    // protected $table = 'contracts';

    // If your primary key is 'contract_id' instead of 'id'
    protected $primaryKey = 'contract_id';

    // If you're not using created_at and updated_at
    // public $timestamps = false;

    // Fields that can be mass-assigned
    protected $fillable = [
        'user_id',
        'requester_id',
        'opportunity_id',
        'status',        // e.g., pending, approved
        'document_path'  // if you're uploading a file
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }
}
