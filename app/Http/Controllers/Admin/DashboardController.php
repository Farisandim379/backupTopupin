<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor admin dengan data ringkasan.
     */
    public function index()
    {
        // Data Statistik Utama
        $totalUsers = User::count();
        $totalGames = Game::count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::where('status', 'completed')->sum('price');

        // Data untuk Grafik Pendapatan Harian
        $dailyRevenue = Transaction::where('status', 'completed')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(price) as total')
            ])
            ->pluck('total', 'date');

        // Siapkan data untuk Chart.js
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = Carbon::parse($date)->format('D, d M'); // Format: Sun, 13 Jul
            $chartData[] = $dailyRevenue->get($date, 0); // Ambil data, jika tidak ada isi dengan 0
        }

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalGames',
            'totalTransactions',
            'totalRevenue',
            'chartLabels',
            'chartData'
        ));
    }
}
