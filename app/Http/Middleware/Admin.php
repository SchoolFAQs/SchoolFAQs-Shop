<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if(auth()->user()->role < '3'){
            return $next($request);
        } else {
            return redirect('/')->with('error', 'You don\'t have Admin Access!');
        }
    }
}
