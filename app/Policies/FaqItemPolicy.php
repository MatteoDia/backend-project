<?php

namespace App\Policies;

use App\Models\FaqItem;
use App\Models\User;

class FaqItemPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, FaqItem $item): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    public function update(User $user, FaqItem $item): bool
    {
        return $user->is_admin;
    }

    public function delete(User $user, FaqItem $item): bool
    {
        return $user->is_admin;
    }
} 