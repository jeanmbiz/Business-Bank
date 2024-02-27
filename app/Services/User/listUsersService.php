<?php

namespace App\Services\User;

use App\Models\User;

class listUsersService
{
    public function execute()
    {
        $users = User::withTrashed()->paginate(10);

        return response()->json($users);
    }
}
