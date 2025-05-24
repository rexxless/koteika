<?php

namespace App\Policies;

use App\Models\User;

class MainDataPolicy
{
    public function update(User $user)
    {
        return $user->is_admin;
    }
}
