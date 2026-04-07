<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createUser(array $data, User $authUser): User
    {
        return User::create($data);
    }
    public function updateUser(User $user, array $data): bool
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }
        return $user->update($data);
    }
    public function deleteUser(User $user, User $authUser): bool
    {
        if ($user->id === $authUser->id) {
            return false;
        }

        return (bool) $user->delete();
    }
}
