<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================
// HALAMAN UMUM
// ============================
Route::get('/', fn() => view('home'));
Route::get('/screen', fn() => view('screen'))->name('screen');

// ============================
// AUTH ROUTES
// ============================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// ============================
// DASHBOARD ROUTES (Role Based)
// ============================

// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dash-admin', function () {
        return view('admin.dash-admin');
    })->name('admin.dashboard');
});

// VENDOR
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/dash-vendor', function () {
        return view('admin.dash-vendor');
    })->name('vendor.dashboard');
});

// USER
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('user.home');
});
