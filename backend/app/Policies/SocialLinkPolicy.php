<?php

namespace App\Policies;

use App\Models\SocialLink;
use App\Models\User;

class SocialLinkPolicy
{
    public function create(User $user, SocialLink $socialLink): bool
    {
        return $user->is_admin;
    }

    public function delete(User $user, SocialLink $socialLink): bool
    {
        return $user->is_admin;
    }
}
