<?php

namespace App\Http\Controllers;

use App\Models\Game; // Pastikan Anda mengimpor model Game
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama (homepage) dengan data yang diperlukan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Mengambil semua data game dari database.
        // Di masa depan, Anda bisa menambahkan logika sorting atau filter di sini.
        // Contoh: Game::where('is_popular', true)->get();
        $games = Game::all();

        // 2. Mengirim data games ke view 'home.blade.php'.
        // Variabel $games sekarang akan tersedia di dalam file view tersebut.
        return view('home', [
            'games' => $games,
        ]);
    }
}
