<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(Auth::user()->role != $role){
            abort(401);
        }
        return $next($request);
    }
}
