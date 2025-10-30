<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;

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
    Route::get('/dash-admin', [UserController::class, 'index'])->name('admin.dashboard');
     Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
       Route::get('/admin/users/{id}/delete', [UserController::class, 'destroy'])->name('admin.users.delete');
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
