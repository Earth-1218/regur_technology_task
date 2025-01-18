<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider within a group
| assigned to the "web" middleware group. Make something great!
|
*/

// Guest Routes (Accessible only if not authenticated)
Route::middleware('guest')->group(function () {
    // Login page and action
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    // Registration page and action
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

// Protected Routes (Accessible only after authentication)
Route::middleware('auth.jwt')->group(function () {
    // Home page
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/home', [AuthController::class, 'home'])->name('home');

    //Tasks
    Route::prefix('tasks')->group(function () {
        Route::get('/data', [TaskController::class, 'getData'])->name('tasks.data');
        Route::get('/add', [TaskController::class, 'add'])->name('tasks.add');
        Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::put('/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    });
});

// Default route
Route::get('/', [AuthController::class, 'loginForm'])->name('login');
