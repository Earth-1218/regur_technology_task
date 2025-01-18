<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login form
    public function loginForm()
    {
        return view('auth.login');
    }

    // Register form
    public function registerForm()
    {
        return view('auth.register');
    }

    // Login and redirect to home
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // Attempt to generate a token using the provided credentials
            if (!$token = JWTAuth::attempt($credentials)) {
                return redirect()->route('login')->withErrors(['error' => 'Invalid credentials']);
            }

            // Set the token in a cookie
            return redirect()->route('home')->withCookie(cookie('jwt_token', $token, 60 * 24)); // 24-hour expiration
        } catch (JWTException $e) {
            return redirect()->route('login')->withErrors(['error' => 'Could not create token.']);
        }
    }

    // Register and redirect to home
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        try {
            // Generate JWT token
            $token = JWTAuth::fromUser($user);

            // Set the token in a cookie
            return redirect()->route('home')->withCookie(cookie('jwt_token', $token, 60 * 24)); // 24-hour expiration
        } catch (JWTException $e) {
            return redirect()->route('register')->withErrors(['error' => 'Could not create token.']);
        }
    }

    // Logout and remove the cookie
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            // Forget the JWT cookie
            return redirect()->route('login')->withCookie(cookie('jwt_token', null, -1));
        } catch (JWTException $e) {
            return redirect()->route('home')->withErrors(['error' => 'Failed to log out.']);
        }
    }

    // Home 
    public function home()
    {
        // Get the total task count for the authenticated user
        $totalTaskCount = Task::where('user_id', auth()->id())->count();

        // Get the count of tasks by status
        $inProgressCount = Task::where('user_id', auth()->id())->where('status', 'in_progress')->count();
        $todoCount = Task::where('user_id', auth()->id())->where('status', 'todo')->count();
        $doneCount = Task::where('user_id', auth()->id())->where('status', 'done')->count();

        // Pass the counts to the view
        return view('home', compact('totalTaskCount', 'inProgressCount', 'todoCount', 'doneCount'));
    }
}
