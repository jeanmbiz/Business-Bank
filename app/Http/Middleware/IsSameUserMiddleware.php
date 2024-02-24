<?php

namespace App\Http\Middleware;

use App\Exceptions\AppError;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSameUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->route('userId');

        $paramUser = User::find($userId);

        if (is_null($paramUser)) {
            throw new AppError('Usuário não existe', 404);
        }

        if ($request['user_id'] !== $userId) {
            throw new AppError('Este recurso está disponivel apenas para o próprio usuário', 403);
        }

        $request->merge([
            'user_DB' => $paramUser
        ]);

        return $next($request);
    }
}
