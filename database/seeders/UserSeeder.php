<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Get roles
        $adminRole = Role::where('name', 'admin')->first();
        $hrRole = Role::where('name', 'hr manager')->first();
        $employeeRole = Role::where('name', 'employee')->first();

        // Create Admin (Only One)
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('123456'),
                'role_id' => $adminRole->id,
            ]
        );

        // Create HR Manager
        $hr = User::firstOrCreate(
            ['email' => 'hr@gmail.com'],
            [
                'name' => 'HR Manager',
                'password' => Hash::make('123456'),
                'role_id' => $hrRole->id,
            ]
        );

        Employee::create([
            'user_id' => $hr->id,
            'role_id' => $hr->role_id,
            'name' => $hr->name,
            'email' => $hr->email,
            'phone' => '01858xxxxxx',
        ]);

        // Create Employee
        $employee = User::firstOrCreate(
            ['email' => 'employee@gmail.com'],
            [
                'name' => 'Employee',
                'password' => Hash::make('123456'),
                'role_id' => $employeeRole->id,
            ]
        );

        Employee::create([
            'user_id' => $employee->id,
            'role_id' => $employee->role_id,
            'name' => $employee->name,
            'email' => $employee->email,
            'phone' => '01757xxxxxx',
        ]);

        // Create Demo Hr
        $demoHR = User::firstOrCreate(
            ['email' => 'demohr@gmail.com'],
            [
                'name' => 'Demo HR Manager',
                'password' => Hash::make('123456'),
                'role_id' => $hrRole->id,
            ]
        );

        Employee::create([
            'user_id' => $demoHR->id,
            'role_id' => $demoHR->role_id,
            'name' => $demoHR->name,
            'email' => $demoHR->email,
            'phone' => '01123xxxxxx',
        ]);

        // Create Demo Employee
        $demoEmployee = User::firstOrCreate(
            ['email' => 'demoemployee@gmail.com'],
            [
                'name' => 'Demo Employee',
                'password' => Hash::make('123456'),
                'role_id' => $employeeRole->id,
            ]
        );

        Employee::create([
            'user_id' => $demoEmployee->id,
            'role_id' => $demoEmployee->role_id,
            'name' => $demoEmployee->name,
            'email' => $demoEmployee->email,
            'phone' => '01353xxxxxx',
        ]);
    }
}
