<?php

namespace ApiVue\Http\Middleware;

use Closure;
use Illuminate\Pagination\Paginator;

class ConfigurePagination
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
        Paginator::currentPageResolver(function() use($request) {
            return $request->query('limit') ?? $request->query('offset') ?? $request->query('page') ?? 0;
        });

        return $next($request);
    }
}
