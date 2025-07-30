<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view_profile',
            'create_employee',
            'view_employee',
            'edit_employee',
            'delete_employee',
            'create_task',
            'view_task',
            'edit_task',
            'delete_task'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
