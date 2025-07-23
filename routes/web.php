<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TopupItemController;
use App\Http\Controllers\UserTransactionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Api\SearchController; // <-- Pastikan ini di-import

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Rute Publik ---
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', function () { return redirect()->route('home'); });
Route::get('/order/{game:slug}', [PayoutController::class, 'create'])->name('payout.create');

// DIUBAH: Rute API untuk search dipindahkan ke sini agar bisa diakses oleh semua
Route::get('/search', [SearchController::class, 'search'])->name('search');


// --- Rute Khusus Tamu (Guest) ---
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});


// --- Rute Khusus Pengguna Terotentikasi ---
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::post('/order', [PayoutController::class, 'store'])->name('payout.store');
    Route::get('/my-transactions', [UserTransactionController::class, 'index'])->name('user.transactions');
});


// --- Rute Khusus Admin ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('games', GameController::class);
    Route::resource('topup-items', TopupItemController::class);
    Route::resource('accounts', AccountController::class);
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
});
