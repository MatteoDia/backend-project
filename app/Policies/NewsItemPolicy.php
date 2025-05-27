<?php

namespace App\Policies;

use App\Models\NewsItem;
use App\Models\User;

class NewsItemPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, NewsItem $newsItem): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    public function update(User $user, NewsItem $newsItem): bool
    {
        return $user->is_admin;
    }

    public function delete(User $user, NewsItem $newsItem): bool
    {
        return $user->is_admin;
    }
} 