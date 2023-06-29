<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HasJwtTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|JsonResponse
     */
    public function handle(Request $request, Closure $next, $key = "SI-CAFE")
    {
        if(isset($_COOKIE[$key])){
            $request->headers->set('Authorization', 'Bearer ' . $_COOKIE[$key]);
            return $next($request);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid'
        ], 403);
    }


}
