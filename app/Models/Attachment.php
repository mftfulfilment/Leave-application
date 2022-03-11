<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    use HasFactory;

    /**
     * Get the leaveapplication that owns the Attachment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leaveapplication(): BelongsTo
    {
        return $this->belongsTo(LeaveApplication::class, 'leave_id');
    }
}
