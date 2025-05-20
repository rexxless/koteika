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
}
