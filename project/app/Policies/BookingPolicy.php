<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    public function view(User $user, Booking $room): bool
    {
        return !$user->is_admin;
    }

    public function viewAll(User $user, Booking $room): bool
    {
        return $user->is_admin;
    }

    public function create(User $user): bool
    {
        return !$user->is_admin;
    }

    public function destroy(User $user, Booking $room): bool
    {
        return !$user->is_admin;
    }

    public function adminDestroy(User $user, Booking $room): bool
    {
        return $user->is_admin;
    }
}
