<?php

namespace App\YouApp\Http\Middleware;

use Closure;

class VerifyToken
{
    /**
     * Проверка YOU_APP_TOKEN
     *
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Routing\ResponseFactory|mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        $token = $request->get('token');

        if (!is_null($token) && $token === env('YOU_APP_TOKEN')) {
            return $next($request);
        }

        return response('Unauthorized.', 401);
    }
}