<?php

namespace App\Http\Middleware;

use Awok\Authorization\Exceptions\UnauthorizedAccess;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory $auth
     *
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param          $request
     * @param \Closure $next
     * @param null     $guard
     *
     * @return mixed
     * @throws \Awok\Authorization\Exceptions\UnauthorizedAccess
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            throw new UnauthorizedAccess();
        }

        return $next($request);
    }
}
