<?php

namespace App\Policies;

use App\Models\FaqCategory;
use App\Models\User;

class FaqCategoryPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, FaqCategory $category): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    public function update(User $user, FaqCategory $category): bool
    {
        return $user->is_admin;
    }

    public function delete(User $user, FaqCategory $category): bool
    {
        return $user->is_admin;
    }
} 