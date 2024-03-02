<?php

namespace App\Services\User;

use App\Exceptions\AppError;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteUserService
{
    public function delete(Request $request)
    {
        $paramId = $request->route('userId');

        $paramUser = User::find($paramId);

        if (is_null($paramUser)) {
            throw new AppError('User ID does not exist or is not active on the system', 404);
        }

        $paramUser->delete();

        return response()->noContent();
    }
}
