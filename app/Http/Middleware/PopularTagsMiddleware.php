<?php

namespace app\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PopularTagsMiddleware
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
        if(!Session::has('popular_tags')) {
            // get 10 most popular tags, only if there are currently none in session
            $tags = DB::select("
                SELECT qht.tag_id as 'tag_id', t.tag as 'tag', COUNT(qht.tag_id) as 'count'
                FROM question_has_tags qht, tags t
                WHERE 
                  qht.tag_id = t.id
                GROUP BY 
                  qht.tag_id, t.tag
                ORDER BY
                  count DESC
                LIMIT 10
            ");
            Session::put('popular_tags', $tags);
        }
        return $next($request);
    }
}
