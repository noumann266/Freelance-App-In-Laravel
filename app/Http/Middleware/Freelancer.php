<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Auth;
class freelancer
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
        if(Auth::check() && Auth::user()->role_id == User::freelancerRoleId){
            return $next($request);
        }
        return redirect('/login');
    }
}