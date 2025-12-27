<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $staff = Role::firstOrCreate(['name' => 'staff']);

        $allPermissions = Permission::all();

        // Admin gets all permissions
        $admin->permissions()->sync($allPermissions->pluck('id'));

        // Manager gets product + category permissions
        $managerPermissions = Permission::where('name', 'like', 'products.%')
            ->orWhere('name', 'like', 'category.%')
            ->get();

        $manager->permissions()->sync($managerPermissions->pluck('id'));

        // Staff gets no permissions
        $staff->permissions()->sync([]);
    }
}

