<?php 

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cookie;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Retrieve the JWT token from the cookie
            $token = Cookie::get('jwt_token');

            try {
                // If a token exists and it's valid, authenticate the user
                if ($token && JWTAuth::setToken($token)->authenticate()) {
                    // Token is valid, proceed with request
                    return $next($request);
                }
            } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                // Token has expired, refresh the token and set the new one in the cookie
                try {
                    // Refresh the expired token
                    $newToken = JWTAuth::refresh($token);

                    // Set the new token in the cookie
                    Cookie::queue('jwt_token', $newToken, 60 * 24); // 24 hours expiry

                    // Authenticate the user with the new token
                    JWTAuth::setToken($newToken)->authenticate();

                    // Redirect to the home page with the new token
                    return redirect(RouteServiceProvider::HOME);
                } catch (\Exception $e) {
                    // Handle any errors that occur while refreshing the token
                    return redirect()->route('login')->with('error', 'Could not refresh the token. Please log in again.');
                }
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                // Handle invalid token case
                return redirect()->route('login')->with('error', 'Invalid token. Please log in again.');
            } catch (\Exception $e) {
                // Handle any other exceptions
                return redirect()->route('login')->with('error', 'Authentication failed. Please log in again.');
            }
        }

        // Proceed to the next middleware if the user is not authenticated
        return $next($request);
    }
}
