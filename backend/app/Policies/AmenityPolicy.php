<?php

namespace App\Policies;

use App\Models\Amenity;
use App\Models\User;

class AmenityPolicy
{
    public function create(User $user, Amenity $amenity)
    {
        return $user->is_admin;
    }

    public function update(User $user, Amenity $amenity)
    {
        return $user->is_admin;
    }

    public function delete(User $user, Amenity $amenity)
    {
        return $user->is_admin;
    }
}
