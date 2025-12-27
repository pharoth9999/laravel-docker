<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $managerRole = Role::where('name', 'manager')->first();
        $staffRole = Role::where('name', 'staff')->first();

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        $manager = User::firstOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Manager User',
                'password' => Hash::make('password'),
            ]
        );

        $staff1 = User::firstOrCreate(
            ['email' => 'staff1@example.com'],
            [
                'name' => 'Staff User 1',
                'password' => Hash::make('password'),
            ]
        );

        $staff2 = User::firstOrCreate(
            ['email' => 'staff2@example.com'],
            [
                'name' => 'Staff User 2',
                'password' => Hash::make('password'),
            ]
        );

        $admin->roles()->sync([$adminRole->id]);
        $manager->roles()->sync([$managerRole->id]);
        $staff1->roles()->sync([$staffRole->id]);
        $staff2->roles()->sync([$staffRole->id]);
    }
}
