<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor admin dengan data ringkasan.
     */
    public function index()
    {
        // Menghitung total data dari masing-masing model
        $totalUsers = User::count();
        $totalGames = Game::count();
        $totalTransactions = Transaction::count();

        // Menghitung total pendapatan dari transaksi yang sudah selesai
        $totalRevenue = Transaction::where('status', 'completed')->sum('price');

        // Mengirim semua data ke view
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalGames',
            'totalTransactions',
            'totalRevenue'
        ));
    }
}
