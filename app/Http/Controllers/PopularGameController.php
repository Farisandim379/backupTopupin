<?php

namespace App\Http\Controllers;

use App\Models\Game; // Jangan lupa import model Game
use Illuminate\Http\Request;

class PopularGameController extends Controller
{
    /**
     * Menampilkan halaman daftar game populer.
     */
    public function index()
    {
        // 1. Ambil semua data game dari database
        $games = Game::all(); // Anda bisa tambahkan logika sorting/filter di sini nanti

        // 2. Kirim data games ke sebuah view baru
        return view('popular-games', [
            'games' => $games
        ]);
    }
}
