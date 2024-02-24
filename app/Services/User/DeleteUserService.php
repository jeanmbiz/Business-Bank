<?php

namespace App\Services\User;

use Illuminate\Http\Request;

class DeleteUserService
{
    public function delete(Request $request)
    {
        $request['user_DB']->delete();

        return response()->noContent();
    }
}
