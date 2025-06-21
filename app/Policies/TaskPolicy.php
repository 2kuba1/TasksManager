<?php

namespace App\Policies;

use App\Models\User;

class TaskPolicy
{
    public function getAll(User $user): bool
    {
        return $user->hasRole('user');
    }
}
