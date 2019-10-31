<?php

namespace App\Http\Middleware;

use Closure;

class sellerActive
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
        if(auth()->user()->is_active){
            return $next($request);
        }else{
            
            return redirect()->route('seller.inactive');
        }
    }
}
