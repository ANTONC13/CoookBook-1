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
        $segments = $request->segments();
        $object = $segments[1]; # /en/user/...
        $action = end($segments);

        if (
            ! Auth::user()->super
            &&
            (
                $object == 'user'
                ||
                $object == 'group' && in_array($action,['update','create','delete','edit'])
                ||
                $object == 'group' && $request->isMethod('POST')
            )
        ) {
            return redirect(route('welcome'));
        }

        return $next($request);
    }
}
