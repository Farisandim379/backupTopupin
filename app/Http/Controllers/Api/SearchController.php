<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Import DB facade

class SearchController extends Controller
{
    /**
     * Menangani permintaan pencarian game.
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
        ]);

        $query = $request->input('query');

        // DIUBAH: Query sekarang secara eksplisit membandingkan dalam huruf kecil
        // Ini memastikan pencarian tidak terpengaruh oleh besar kecilnya huruf.
        $games = Game::where(DB::raw('LOWER(name)'), 'LIKE', '%' . strtolower($query) . '%')
                     ->limit(5)
                     ->get();

        return response()->json($games);
    }
}
