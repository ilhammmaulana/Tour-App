<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function countUsers();
}

class UserRepository
{
    public function countUsers()
    {
        return User::role('user')->count();
    }
}
