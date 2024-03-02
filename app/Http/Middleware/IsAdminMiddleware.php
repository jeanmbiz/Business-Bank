<?php

namespace App\Http\Middleware;

use App\Exceptions\AppError;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (! $user->isAdmin) {
            throw new AppError('Somente administradores podem acessar este recurso', 403);
        }

        return $next($request);
    }
}
