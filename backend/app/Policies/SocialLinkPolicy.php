<?php

namespace App\Policies;

use App\Models\User;

class SocialLinkPolicy
{
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    public function delete(User $user): bool
    {
        return $user->is_admin;
    }
}
