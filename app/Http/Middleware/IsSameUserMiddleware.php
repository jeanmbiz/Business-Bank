<?php

namespace App\Http\Middleware;

use App\Exceptions\AppError;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsSameUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $paramId = $request->route('userId');

        $paramUser = User::find($paramId);

        if (is_null($paramUser)) {
            throw new AppError('ID de usuário inexistente ou inativo do sistema', 404);
        }

        if ($request['user_id'] !== $paramId) {
            throw new AppError('Este recurso está disponivel apenas para o próprio usuário autenticado', 403);
        }

        $request->merge([
            'param_User_DB' => $paramUser,
        ]);

        return $next($request);
    }
}
