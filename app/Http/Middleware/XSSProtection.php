<?php

namespace app\Http\Middleware;

use Illuminate\Http\Request;


use Closure;

class XSSProtection
{
    /**
     * The following method loops through all request input and strips out all tags from
     * the request. This to ensure that users are unable to set ANY HTML within the form
     * submissions, but also cleans up input.
     *
     * @param Request $request
     * @param callable $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        if (!in_array(strtolower($request->method()), ['put', 'post'])) {
            return $next($request);
        }

        $input = $request->all();
        array_walk_recursive($input, function(&$input) {
            $input = htmlspecialchars($input);
        });

        $request->merge($input);

        return $next($request);
    }
}