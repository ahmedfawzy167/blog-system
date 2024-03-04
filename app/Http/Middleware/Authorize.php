<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Gate;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Gate::allows('access-dashboard')){
            return $next($request);
        }
        else{
            abort(403,'Access Forbidden');
        }
    }
}
