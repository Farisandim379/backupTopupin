<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTransactionController extends Controller
{
    /**
     * Menampilkan riwayat transaksi milik pengguna yang sedang login.
     */
    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Ambil semua transaksi milik pengguna tersebut, diurutkan dari yang terbaru.
        $transactions = $user->transactions()->latest()->get();

        // Kirim data transaksi ke view 'user.transactions'
        // Ini akan mencari file di: resources/views/user/transactions.blade.php
        return view('user.transactions', compact('transactions'));
    }
}
