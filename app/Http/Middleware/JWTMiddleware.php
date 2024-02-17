<?php

namespace App\Http\Middleware;

use App\Exceptions\AppError;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        $authorizationHeader = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $authorizationHeader);

        if (! $token) {
            throw new AppError('Token is required to access this feature', 400);
        }

        try {
            $user = JWTAuth::parseToken()->authenticate();

            $request->merge([
                'user_id' => $user->id,
                'user_cpf' => $user->cpf,
                'user_isAdmin' => $user->isAdmin,
            ]);

            return $next($request);

        } catch (TokenInvalidException $error) {
            throw new AppError('Invalid token', 498);
        } catch (TokenExpiredException $error) {
            throw new AppError('Expired token', 401);
        } catch (\Exception $error) {
            throw new AppError($error->getMessage(), 500);
        }
    }
}
