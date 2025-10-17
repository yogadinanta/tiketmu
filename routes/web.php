<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('home');
});

// Halaman screen (umum)
Route::get('/screen', function () {
    return view('screen');
})->name('screen');

// -----------------------------
// AUTH ROUTES
// -----------------------------

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// -----------------------------
// DASHBOARD / HOME ROUTES
// -----------------------------

// User dashboard / homepage
Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

// Vendor dashboard
Route::get('/dash-vendor', function () {
    return view('admin.dash-vendor');
})->name('admin.dash-vendor')->middleware('auth');

// Admin dashboard
Route::get('/dash-admin', function () {
    return view('admin.dash-admin');
})->name('admin.dash-admin')->middleware('auth');


// ADMIN
Route::middleware(['role:admin'])->group(function () {
    Route::get('/dash-admin', function () {
        return view('dash-admin');
    })->name('admin.dashboard');
});

// VENDOR
Route::middleware(['role:vendor'])->group(function () {
    Route::get('/dash-vendor', function () {
        return view('admin.dash-vendor');
    })->name('admin.dash-vendor');
});

// USER
Route::middleware(['role:user'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('user.home');
});