<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'support@mftfulfillmentcentre.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');
        $payroll = User::create([
            'name'     => 'Hr',
            'email'    => 'hrm@mftfulfillmentcentre.com',
            'password' => Hash::make('password'),
        ]);
        $payroll->assignRole('hr');

        $operation = User::create([
            'name'     => 'department head',
            'email'    => 'operationske@mftfulfillmentcentre.com',
            'password' => Hash::make('password'),
        ]);
        $operation->assignRole('department head');


        $call_centre = User::create([
            'name'     => 'department head',
            'email'    => 'customersupport@mftfulfillmentcentre.com',
            'password' => Hash::make('password'),
        ]);
        $call_centre->assignRole('department head');

        $warehouse = User::create([
            'name'     => 'department head',
            'email'    => 'warehouseke@mftfulfillmentcentre.com',
            'password' => Hash::make('password'),
        ]);
        $warehouse->assignRole('department head');


        $business = User::create([
            'name'     => 'department head',
            'email'    => 'business@mftfulfillmentcentre.com',
            'password' => Hash::make('password'),
        ]);
        $business->assignRole('department head');

        $finance = User::create([
            'name'     => 'department head',
            'email'    => 'financeoffice@mftfulfillmentcentre.com',
            'password' => Hash::make('password'),
        ]);
        $finance->assignRole('department head');


        $user = User::create([
            'name'     => 'Staff',
            'email'    => 'user@mail.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('staff');
    }
}
