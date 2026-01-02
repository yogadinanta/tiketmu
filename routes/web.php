<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Deposit;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

// AUTH
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginOtpController;

// GENERAL
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;

// ADMIN
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;


// VENDOR
use App\Http\Controllers\Vendor\VendorEventController;
use App\Http\Controllers\Vendor\VendorHistoryController;
use App\Http\Controllers\Vendor\PenarikanController;
use App\Http\Controllers\Vendor\DepositController;
use App\Http\Controllers\Vendor\VendorOrderController;
use App\Http\Controllers\Vendor\TiketController;
use App\Http\Controllers\Vendor\ScanTiketController;

// MIDTRANS
use Midtrans\Config;
use Midtrans\Snap;


use App\Http\Controllers\EventOrderController;

/*
|--------------------------------------------------------------------------
| HALAMAN UMUM
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $events = Event::latest()->get();
    return view('home', compact('events'));
})->name('home');

Route::get('/screen', fn () => view('screen'))->name('screen');

/*
|--------------------------------------------------------------------------
| AUTH (GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'loginPost'])->name('login.post');

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

    Route::post('/register/verify-otp', [RegisterController::class, 'verifyRegisterOtp'])
        ->name('register.verifyOtp');

    Route::get('/verify-otp', fn () => view('auth.verify-otp'))->name('otp.verify.page');
    Route::post('/verify-otp', [LoginOtpController::class, 'verifyOtp'])->name('otp.verify');
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (BERSIH & BENAR)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // USERS
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{id}', [AdminUserController::class, 'update'])
            ->name('users.update');

        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])
            ->name('users.destroy'); 
    });

/*
|--------------------------------------------------------------------------
| VENDOR ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:vendor'])
    ->prefix('vendor')
    ->name('vendor.')
    ->group(function () {

        Route::get('/dashboard', [VendorEventController::class, 'index'])
            ->name('dashboard');

        Route::resource('events', VendorEventController::class)
            ->except(['show']);

        Route::get('/history', [VendorHistoryController::class, 'index'])
            ->name('history');

        Route::get('/penarikan', [PenarikanController::class, 'index'])
            ->name('penarikan.index');

        Route::post('/penarikan', [PenarikanController::class, 'store'])
            ->name('penarikan.store');
        Route::get('/orders', [VendorOrderController::class, 'index'])
            ->name('orders.index');
    });



/*
|--------------------------------------------------------------------------
| VENDOR DEPOSIT
|--------------------------------------------------------------------------
*/
Route::prefix('vendor')
    ->middleware('auth')
    ->name('vendor.deposit.')
    ->group(function () {

        Route::get('deposit', [DepositController::class, 'index'])->name('index');
        Route::post('deposit/store', [DepositController::class, 'store'])->name('store');
        Route::post('deposit/callback', [DepositController::class, 'callback'])->name('callback');
        Route::get('deposit/success', [DepositController::class, 'success'])->name('success');
    });

/*
|--------------------------------------------------------------------------
| TOPUP SALDO
|--------------------------------------------------------------------------
*/
Route::get('/topup_saldo', function (Request $request) {

    $user = auth()->user();
    $amount = (int) $request->query('amount', 10000);

    Config::$serverKey = config('services.midtrans.server_key');
    Config::$isProduction = false;
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $orderId = 'TOPUP-' . time() . '-' . $user->id;

    Deposit::create([
        'user_id' => $user->id,
        'order_id' => $orderId,
        'amount' => $amount,
        'status' => 'pending'
    ]);

    $snapToken = Snap::getSnapToken([
        'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => $amount,
        ],
        'item_details' => [[
            'id' => 'TOPUP',
            'price' => $amount,
            'quantity' => 1,
            'name' => 'Topup Saldo'
        ]],
        'customer_details' => [
            'first_name' => $user->name,
            'email' => $user->email,
        ]
    ]);

    return view('topup_saldo', compact('snapToken', 'amount'));
})->middleware('auth');

// TIKET ROUTING
Route::prefix('tiket')->group(function () {
    Route::get('/sukses', [TiketController::class, 'index'])
        ->name('vendor.tiket.sukses');
});
Route::get('/tiket/download', [\App\Http\Controllers\Vendor\TiketController::class, 'download'])
    ->name('tiket.download');
// SCAN Tiket


Route::middleware('auth')
    ->prefix('vendor')
    ->name('vendor.')
    ->group(function () {

        Route::get('/scan', [ScanTiketController::class, 'index'])
            ->name('scan.index');

        Route::post('/scan', [ScanTiketController::class, 'scan'])
            ->name('scan.process');
    });



/*
|--------------------------------------------------------------------------
| USER PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile/edit', [UserController::class, 'editProfile'])
        ->name('profile.edit');

    Route::put('/profile/update', [UserController::class, 'updateProfile'])
        ->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| EVENT DETAIL
|--------------------------------------------------------------------------
*/
Route::get('event/{id}/{slug}', [EventController::class, 'show'])
    ->name('event.detail');

    Route::post('/events/{event}/buy', [EventOrderController::class, 'buy'])
    ->name('events.buy');
