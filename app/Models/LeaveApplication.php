<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LeaveApplication extends Model
{
    use HasFactory;

    public $with = ['attachment'];

    protected $casts = [
        'start_date' => 'date',
    ];

    public function applier()
    {
        return $this->hasOne(User::class, 'id', 'applier_user_id');
    }

    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    public function attachment()
    {
        return $this->hasOne(Attachment::class, 'leave_id');
    }

    public function leave_approvals()
    {
        return $this->hasMany(LeaveApproval::class, 'leave_application_id');
    }

    public function getStartDateAttribute($value)
    {
        return (new Carbon($value))->toFormattedDateString();
    }
    public function getEndDateAttribute($value)
    {
        return ($value) ? (new Carbon($value))->toFormattedDateString() : $value;
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Carbon($value))->toFormattedDateString();
    }

    public function getDurationAttribute()
    {
        // return (new Carbon($this->end_date))->diffInDays(new Carbon($this->start_date)) + 1;

        $days = Carbon::parse($this->start_date)->diffInDaysFiltered(function (Carbon $date) {
            return !$date->isWeekend();
        }, Carbon::parse($this->end_date));

        return $days+1;
    }

    public function getDepartmentAttribute($value){
        if ($value == 1) {
           return 'Business development';
        } elseif ($value == 2) {
           return 'Operations';
        } elseif ($value == 3) {
           return 'Customer support';
        } elseif ($value == 4) {
           return 'Warehouse';
        } elseif ($value == 5) {
           return 'Finance';
        } elseif ($value == 6) {
           return 'IT';
        }
    }

    public function scopeMyApplications($query)
    {
        return $query->where('leave_applications.applier_user_id', Auth::id())
            ->latest('leave_applications.id')
            ->select(
                'leave_applications.id as id',
                'leave_applications.take_charge',
                'leave_applications.department',
                'leave_applications.information',
                'leave_applications.start_date',
                'leave_applications.end_date',
                'leave_applications.status',
                'leave_applications.remarks',
            );
    }

    public function scopeAddLeaveType($query)
    {
        return $query->join('leave_types', 'leave_types.id', '=', 'leave_applications.leave_type_id')
            ->addSelect('leave_types.type');
    }
}
