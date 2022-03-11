<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApproval extends Model
{
    use HasFactory;

    public function leave_application()
    {
        return $this->belongsTo(LeaveApplication::class, 'leave_application_id');
    }
}
