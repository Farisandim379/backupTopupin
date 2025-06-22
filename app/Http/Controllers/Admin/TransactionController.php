<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan halaman riwayat transaksi.
     */
    public function index()
    {
        // Mengambil semua transaksi, diurutkan dari yang paling baru.
        // `with('user')` digunakan untuk mengambil data pengguna terkait
        // agar lebih efisien (menghindari N+1 query problem).
        $transactions = Transaction::with('user')->latest()->get();

        return view('admin.transactions.index', compact('transactions'));
    }
}
