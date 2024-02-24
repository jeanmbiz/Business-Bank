<?php

namespace App\Http\Middleware;

use App\Exceptions\AppError;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSameUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->id !== $request->route('userId')) {
            throw new AppError('Este recurso está disponivel apenas para o próprio usuário', 403);
        }

        return $next($request);
    }
}
