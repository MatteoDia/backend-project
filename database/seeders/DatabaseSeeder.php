<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create default admin user
        User::firstOrCreate(
            ['email' => 'admin@ehb.be'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('Password!321'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create some example FAQ categories and items
        $this->call([
            FaqSeeder::class,
        ]);
    }
}

