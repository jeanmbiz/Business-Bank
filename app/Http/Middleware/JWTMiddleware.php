<?php

namespace App\Http\Middleware;

use App\Exceptions\AppError;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware{

    public function handle(Request $request, Closure $next){

        $token = $request->header('Authorization');

        if (!$token) {
            throw new AppError('Token é obrigatório para acessar este recurso.', 400);
        }

        try{
            JWTAuth::parseToken()->authenticade();
            return $next($request);
        } catch(JWTException $error ) {

            if($error instanceof TokenInvalidException){
                throw new AppError('Token Invalido', 498);
            }

            if($error instanceof TokenExpiredException){
                throw new AppError('Token expirado', 401);
            }

            throw new AppError($error->getMessage(), 500);

        }
    }
}
