<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteUserService
{
    public function delete(Request $request)
    {
        $userId = $request->route('userId');

        $user = User::find($userId);

        if (is_null($user)) {
            throw new AppError('Usuário não existe', 404);
        }

        $user->delete();

        return response()->noContent();
    }
}
