<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeaveType::create([
            'type' => 'Annual Leave',
            'days' => 21,
        ]);
        LeaveType::create([
            'type' => 'Sick Leave',
            'days' => 7,
        ]);
        LeaveType::create([
            'type' => 'Maternity Leave',
            'days' => 90,
        ]);
        LeaveType::create([
            'type' => 'Paternity Leave',
            'days' => 14,
        ]);
        LeaveType::create([
            'type' => 'Compassionate Leave',
            'days' => 14,
        ]);
        LeaveType::create([
            'type' => 'Pre-adoption Leave',
            'days' => 30,
        ]);
    }
}
