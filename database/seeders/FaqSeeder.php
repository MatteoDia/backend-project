<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqCategory;
use App\Models\FaqItem;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        // General Questions Category
        $general = FaqCategory::create([
            'name' => 'General Questions',
            'description' => 'Frequently asked general questions about our platform.',
        ]);

        FaqItem::create([
            'category_id' => $general->id,
            'question' => 'What is TrainH Community?',
            'answer' => 'TrainH Community is a platform dedicated to connecting trainers and health enthusiasts, sharing knowledge and promoting healthy lifestyles.',
            'order' => 1,
        ]);

        FaqItem::create([
            'category_id' => $general->id,
            'question' => 'How do I create an account?',
            'answer' => 'You can create an account by clicking the "Register" button in the top right corner and filling out the registration form with your details.',
            'order' => 2,
        ]);

        // Account & Profile Category
        $account = FaqCategory::create([
            'name' => 'Account & Profile',
            'description' => 'Questions about account management and profile settings.',
        ]);

        FaqItem::create([
            'category_id' => $account->id,
            'question' => 'How can I update my profile information?',
            'answer' => 'You can update your profile by clicking on your name in the top right corner, selecting "Profile", and then clicking "Edit Profile".',
            'order' => 1,
        ]);

        FaqItem::create([
            'category_id' => $account->id,
            'question' => 'Can I change my username?',
            'answer' => 'Yes, you can change your username through your profile settings. Make sure to choose a unique username that hasn\'t been taken by another user.',
            'order' => 2,
        ]);
    }
} 