<?php

namespace App\Http\Middleware;

use Closure;

class UserAuthMiddleware
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
        if(!session()->has('userId'))
        {
            return redirect('/');
        }
        
        return $next($request);
    }
}
