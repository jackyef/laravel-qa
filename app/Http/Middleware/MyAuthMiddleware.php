<?php

namespace app\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class MyAuthMiddleware
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
        if(!Session::has('username')){
            Session::flash('notification', TRUE);
            Session::flash('notification_type', 'danger');
            Session::flash('notification_msg', 'You need to log in to do that.');
            return redirect()->back();
        }
        return $next($request);
    }
}
