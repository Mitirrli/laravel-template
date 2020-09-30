<?php

namespace App\Http\Middleware;

use App\Exceptions\BusinessException;
use App\Modules\User\Contracts\UserContract;
use App\Traits\TokenTrait;

class TokenMiddleware
{
    use TokenTrait;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param null|string $guard
     * @return mixed
     * @throws BusinessException|\Exception
     */
    public function handle($request, \Closure $next, UserContract $user)
    {
        $payload = $this->validate();

        return $next($request);
    }
}
