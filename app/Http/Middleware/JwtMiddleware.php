<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Attempt to retrieve the token from the cookie
            $token = Cookie::get('jwt_token');
            $user = null;

            if (!$token) {
                // If no token is found, throw an exception
                throw new JWTException('Token not provided');
            }

            // Set the token for validation
            JWTAuth::setToken($token);
            
            // Authenticate the user using the token
            $user = JWTAuth::authenticate();  // Authenticate using the provided token
            if (!$user) {
                return redirect()->route('login')->withErrors(['error' => 'User not found']);
            }
        } catch (TokenExpiredException $e) {
            // Token expired, regenerate new token
            try {
                // Refresh the token by parsing it again
                $token = JWTAuth::parseToken()->refresh();
                // Set the new token in the cookie
                Cookie::queue('jwt_token', $token, 60 * 24 * 7); // Set the cookie for 1 week
            } catch (JWTException $e) {
                return redirect()->route('login')->withErrors(['error' => 'Could not refresh token']);
            }

            return $next($request);  // Continue processing after setting new token
        } catch (TokenInvalidException $e) {
            return redirect()->route('login')->withErrors(['error' => 'Token is invalid']);
        } catch (JWTException $e) {
            return redirect()->route('login')->withErrors(['error' => $e->getMessage()]);
        }
        
        // Attach the authenticated user to the request
        $request->attributes->set('user', $user);

        // Allow the request to proceed if it does not expect a JSON response
        if (!$request->expectsJson()) {
            return $next($request);  // Allow the request to continue to the next middleware or controller
        }

        return $next($request);
    }
}
