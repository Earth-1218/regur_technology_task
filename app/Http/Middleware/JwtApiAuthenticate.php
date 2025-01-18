<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class JwtApiAuthenticate
{
    public function handle($request, Closure $next)
    {
        try {
            $user = auth()->user(); // Will throw an exception if the token is invalid
        } catch (\Exception $e) {
            Log::error('JWT Authentication failed: ' . $e->getMessage());
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
