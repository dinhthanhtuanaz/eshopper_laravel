<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogged
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
        if(session()->has('customer_id')){
            return $next($request);
        }
        return redirect()->route('home');

    }
}
