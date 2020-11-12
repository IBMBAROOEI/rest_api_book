<?php

namespace App\Http\Middleware;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
//    protected $auth;

//    /**
//     * Create a new middleware instance.
//     *
//     * @param  \Illuminate\Contracts\Auth\Factory  $auth
//     * @return void
//     */
//    public function __construct(Auth $auth)
//    {
//        $this->auth = $auth;
//    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        // Get User From Token
//        $user = JWTAuth::user();
        $user = JWTAuth::parseToken()->authenticate();
        // Return Error If Token Return No User
        if ($user == null) {
            return response()->json(['message' => 'کاربر نامعتبر'], 401);
        }
        Config::set('user', $user);

        return $next($request);

//        if ($this->auth->guard($guard)->guest())
//        {
//            return response('Unauthorized', 401);
//        }
//
//        return $next($request);
    }
}
