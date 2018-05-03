<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AuthRoot
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
        if (! Auth::user()->super) {
            return redirect(route('welcome'));
        }


        return $next($request);
    }
}
