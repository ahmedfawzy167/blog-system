<?php

namespace App\Http\Middleware;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        if(!$token){
            return response()->json([
             'status' => 'Error',
             'message'=> 'Token Not Found'],401);
        }

        if(!Auth::guard('sanctum')->check()) {
            return response()->json([
            'status' => 'Error',
            'error' => 'Invalid Token'], 401);
        }

        return $next($request);
    }
}
