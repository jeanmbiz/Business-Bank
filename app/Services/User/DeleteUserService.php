<?php

namespace App\Services\User;

use Illuminate\Http\Request;

class DeleteUserService
{
    public function delete(Request $request)
    {
        $request['param_User_DB']->delete();

        return response()->noContent();
    }
}
