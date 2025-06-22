<?php

namespace App\Policies;

use App\Models\User;

class TaskPolicy
{
    public function getAll(User $user): bool
    {
        return $user->hasRole('user');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('user');
    }

    public function delete(User $user): bool
    {
        return $user->hasRole('user');
    }

    public function update(User $user): bool
    {
        return $user->hasRole('user');
    }
}
