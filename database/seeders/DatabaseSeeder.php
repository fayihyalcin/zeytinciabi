<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('SUPER_ADMIN_EMAIL', 'superadmin@zeytinciabi.test')],
            [
                'name' => env('SUPER_ADMIN_NAME', 'Süper Admin'),
                'phone' => env('SUPER_ADMIN_PHONE'),
                'password' => env('SUPER_ADMIN_PASSWORD', 'ChangeMe123!'),
                'role' => UserRole::SuperAdmin,
                'status' => UserStatus::Active,
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test Bayi',
                'password' => 'password',
                'role' => UserRole::Dealer,
                'status' => UserStatus::Active,
                'email_verified_at' => now(),
            ]
        );
    }
}
