<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@ehb.be',
            'password' => bcrypt('Password!321'),
            'is_admin' => true,
        ]);

        // Create regular users
        \App\Models\User::factory(10)->create();

        // Create news items
        \App\Models\NewsItem::factory(15)->create();

        // Create FAQ categories and items
        \App\Models\FaqCategory::factory(5)
            ->has(\App\Models\FaqItem::factory()->count(4))
            ->create();

        // Create some example contact messages
        \App\Models\ContactMessage::factory(8)->create();
    }
}

