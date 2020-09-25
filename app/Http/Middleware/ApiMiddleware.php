<?php

namespace App\Http\Middleware;

use App\Tools\RT;
use Closure;
use Illuminate\Http\Request;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $next($request);

        return response()->json(rt()->getResult());
    }
}
