<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;

class UserPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Room $room): bool
    {
        return !$user->is_admin;
    }
}
