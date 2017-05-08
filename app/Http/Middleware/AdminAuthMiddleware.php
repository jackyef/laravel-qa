<?php

namespace app\Http\Middleware;

use Closure;

class AdminAuthMiddleware
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
        if(!Session::get('is_admin') !== 1){
            Session::flash('notification', TRUE);
            Session::flash('notification_type', 'danger');
            Session::flash('notification_msg', 'You don\'t have the privileges to do that.');
            return redirect()->back();
        }
        return $next($request);
    }
}
