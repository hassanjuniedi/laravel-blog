<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;

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
        if (!Auth::user()->hasRole('مدير')) {
            Session::flash('error', 'You don\'t have the permissions to perform this action');
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
