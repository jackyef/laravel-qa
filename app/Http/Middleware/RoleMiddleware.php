<?php

namespace app\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $role2)
    {
		echo "Role: ". $role;
		echo "Role2: ". $role2;
		echo "<br />";
        return $next($request);
    }
}
