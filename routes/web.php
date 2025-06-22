<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TopupItemController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionController; // <-- Ditambahkan

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Rute Publik ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/order/{game:slug}', [PayoutController::class, 'create'])->name('payout.create');


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
});


// --- Rute Khusus Admin ---
// DIUBAH: Ditambahkan middleware 'auth' agar hanya yang sudah login bisa akses
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('games', GameController::class);
    Route::resource('topup-items', TopupItemController::class);
    Route::resource('accounts', AccountController::class);

    // DIUBAH: Menambahkan rute untuk halaman transaksi
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
});
