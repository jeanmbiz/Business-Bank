<?php

namespace App\Services\User;

use App\Models\User;

class listActiveUsersService
{
    public function execute()
    {
        $users = User::all();

        return $users;
    }
}
