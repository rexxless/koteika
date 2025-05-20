<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return !$user->is_admin;
    }
}
