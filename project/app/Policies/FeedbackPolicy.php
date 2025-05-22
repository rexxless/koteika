<?php

namespace App\Policies;

use App\Models\Feedback;
use App\Models\User;

class FeedbackPolicy
{
    public function create(User $user, Feedback $feedback)
    {
        return !$user->is_admin;
    }

    public function update(User $user, Feedback $feedback)
    {
        return !$user->is_admin;
    }

    public function delete(User $user, Feedback $feedback)
    {
        return !$user->is_admin;
    }

    public function adminDelete(User $user, Feedback $feedback)
    {
        return $user->is_admin;
    }
}
