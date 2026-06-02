<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root route
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login');
});

// Guest routes (only for NOT logged in users)
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.store');
    
    Route::get('/admin/register', [AuthController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/admin/register', [AuthController::class, 'register'])->name('admin.register.store');
    
    Route::get('/admin/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('admin.forgot-password');
    Route::post('/admin/forgot-password', [AuthController::class, 'forgotPassword'])->name('admin.forgot-password.store');
});

// Admin routes (only for logged in users)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});