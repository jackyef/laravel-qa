<?php

namespace app\Http\Middleware;

use Closure;

class SecondMiddleware
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
		echo "<br> Second Middleware.";
        return $next($request);
    }
}
