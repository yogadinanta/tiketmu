<?php

use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorEventController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\VendorHistoryController;


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



Route::middleware(['auth'])->group(function () {
    Route::get('/dash-vendor', [VendorEventController::class, 'index'])->name('vendor.dashboard');
    Route::post('/vendor/events', [VendorEventController::class, 'store'])->name('vendor.events.store');
});


Route::get('/', function () {
    $events = Event::latest()->get(); // ambil semua event dari database
    return view('home', compact('events')); // kirim ke halaman utama
});


// DISPLAY DETAIL Event
Route::get('/event/{id}', [EventController::class, 'show'])->name('event.detail');

// ================ 
// SWITH ROLE 
Route::post('/admin/users/update-role/{id}', [UserController::class, 'updateRole'])->name('admin.users.updateRole');


// DESTROY
// EVENT BY VENDOR
Route::delete('/vendor/events/{event}', [EventController::class, 'destroy'])->name('vendor.events.destroy');

// UPDATE DAN EDIT USER
Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');


// HISTORY SALDO 
Route::get('/admin/layouts/history', [App\Http\Controllers\VendorHistoryController::class, 'index'])
    ->name('admin.layout.history')
    ->middleware('auth');

// EDIT USER BY ADMIN ROUTING
Route::get('/admin/user/edit/{id}', [EditUserController::class, 'edit'])->name('admin.user.edit');
Route::post('/admin/user/update/{id}', [EditUserController::class, 'update'])->name('admin.user.update');

