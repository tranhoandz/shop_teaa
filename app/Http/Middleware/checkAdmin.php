<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class checkAdmin 
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            if (Auth::user()->role==1){
                return $next($request);
            }
            else{
                return redirect('backend');
            }
            return redirect(RouteServiceProvider::HOME);
        }
        else{
            return redirect('/login');
        }
        return $next($request);
    }
}
