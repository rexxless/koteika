<?php

namespace App\Policies;

use App\Models\MainData;
use App\Models\User;

class MainDataPolicy
{
    public function update(User $user, MainData $mainData)
    {
        return $user->is_admin;
    }
}
