<?php

namespace App\Http\Middleware;

use App\Exceptions\AppError;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $paramId = $request->route('userId');
        $paramUser = User::find($paramId);

        if (is_null($paramUser)) {
            throw new AppError('User ID does not exist or is not active on the system', 404);
        }

        if (! $request['user_isAdmin']) {
            throw new AppError('Only administrators can access this feature', 403);
        }

        $request->merge([
            'param_User_DB' => $paramUser,
        ]);

        return $next($request);
    }
}
