<?php

namespace app\Http\Middleware;

use Closure;

class TerminateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
      echo "Executing statements of handle method of TerminateMiddleware.";
      return $next($request);
   }
   
   // the terminate method will be called after all the response content is sent to the browser
   public function terminate($request, $response){
      echo "<br>Executing statements of terminate method of TerminateMiddleware.";
   }
}