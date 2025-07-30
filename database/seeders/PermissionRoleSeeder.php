<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::where('name', 'admin')->first();
        $hr = Role::where('name', 'hr manager')->first();
        $employee = Role::where('name', 'employee')->first();

        $viewProfile = Permission::where('name', 'view_profile')->first();
        $createEmployee = Permission::where('name', 'create_employee')->first();
        $viewEmployee = Permission::where('name', 'view_employee')->first();
        $editEmployee = Permission::where('name', 'edit_employee')->first();
        $deleteEmployee = Permission::where('name', 'delete_employee')->first();
        $createTask = Permission::where('name', 'create_task')->first();
        $viewTask = Permission::where('name', 'view_task')->first();
        $editTask = Permission::where('name', 'edit_task')->first();
        $deleteTask = Permission::where('name', 'delete_task')->first();

        // Admin gets all permissions
        $allPermissions = Permission::all();
        $admin->permissions()->sync($allPermissions->pluck('id')->toArray());

        // HR Manager permissions
        $hr->permissions()->sync([
            $viewProfile->id,
            $viewEmployee->id,
            $editEmployee->id,
            $createTask->id,
            $editTask->id,
        ]);

        // Employee permissions (limited)
        $employee->permissions()->sync([
            $viewProfile->id,
        ]);
    }
}
