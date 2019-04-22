<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class HttpCors
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
        if ($request->isMethod('OPTIONS')) {
            $headers = [
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, Content-Type, Cookie, Accept',
                'Access-Control-Allow-Methods' => 'GET, POST, PATCH, PUT, OPTIONS',
                'Access-Control-Allow-Credentials' => true,
                // 'Access-Control-Max-Age' => 3600,
            ];

            return new Response('', 200, $headers);
        }

        return $next($request);
    }
}
