<?php

namespace App\Http\Middleware;

use Closure;

class userCheck
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
        if(auth()->user()->is_admin){
            return redirect()->route('admin.index');
        }else if(auth()->user()->is_seller){
            if(auth()->user()->is_active){
                return redirect()->route('seller.index');
            }else{
                return redirect()->route('seller.inactive');
            }
        }else{
            return $next($request);
        }
    }
}
