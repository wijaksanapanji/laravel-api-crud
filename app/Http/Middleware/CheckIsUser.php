<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(isset(Auth::user()->role) && Auth::user()->role == 2 ) {
            return $next($request);
        } else {
           return response()->json([
            "error" => "unauthorized"
           ], 401);
        }
    }
}
