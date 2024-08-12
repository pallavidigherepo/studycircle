<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'leave_type_id',
        'from',
        'to',
        'description',
        'status_type_id',
    ];

    // Define the relationship with the LeaveType model
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }

    public function leaveStatus()
    {
        return $this->belongsTo(leaveStatus::class);
    }

    // Define the relationship with the User model (assuming a User model exists)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
