<?php

namespace App\Http\Middleware;

use App\Models\Society;
use Closure;
use Illuminate\Http\Request;

class CustomTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (is_null($request->token) ){
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }

        return $next($request);
    }
}
