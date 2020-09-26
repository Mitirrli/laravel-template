<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiMiddleware
{
    const DEFAULT_DATA = [];

    const DEFAULT_CODE = 1000;

    const DEFAULT_MESSAGE = 'success';

    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $next($request);

        $result = rt()->getResult();

        //常规返回 赋予默认值
        if (!array_key_exists('error', $result)) {
            $result['code'] ??= self::DEFAULT_CODE;
            $result['data'] ??= self::DEFAULT_DATA;
            $result['message'] ??= self::DEFAULT_MESSAGE;
        }

        ksort($result);

        return response()->json($result);
    }
}
