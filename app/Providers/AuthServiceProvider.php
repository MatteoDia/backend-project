<?php

namespace App\Providers;

use App\Models\User;
use App\Models\NewsItem;
use App\Models\FaqCategory;
use App\Models\FaqItem;
use App\Models\ContactMessage;
use App\Policies\UserPolicy;
use App\Policies\NewsItemPolicy;
use App\Policies\FaqCategoryPolicy;
use App\Policies\FaqItemPolicy;
use App\Policies\ContactMessagePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        NewsItem::class => NewsItemPolicy::class,
        FaqCategory::class => FaqCategoryPolicy::class,
        FaqItem::class => FaqItemPolicy::class,
        ContactMessage::class => ContactMessagePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
} 