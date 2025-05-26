<?php

namespace App\Policies;

use App\Models\Photo;
use App\Models\User;

class PhotoPolicy
{
    public function create(User $user, Photo $photo)
    {
        return $user->is_admin;
    }

    public function delete(User $user, Photo $photo)
    {
        return $user->is_admin;
    }
}
