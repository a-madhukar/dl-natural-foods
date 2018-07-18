<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfUserIsActive
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
        if(!auth()->user()->isActive()) 
            return redirect('/account/send-activation-email'); 
        
        return $next($request);
    }
}
