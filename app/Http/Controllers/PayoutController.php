<?php

namespace App\Http\Controllers;

use App\Models\Game; // Import model Game
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PayoutController extends Controller
{
    /**
     * Menampilkan halaman pembayaran berdasarkan slug game.
     */
    public function create(Game $game)
    {
        // Mengambil semua item top-up yang berelasi dengan game ini
        $topupItems = $game->topupItems;

        // Mengirim data game dan itemnya ke view
        return view('payout', [
            'game' => $game,
            'topupItems' => $topupItems
        ]);
    }

    /**
     * Menyimpan transaksi baru ke database (tanpa Midtrans).
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari form
        $validated = $request->validate([
            'nominal_amount' => 'required|string',
            'price' => 'required|integer',
            'payment_method' => 'required|string',
            'game_user_id' => 'required|string|max:255',
            'game_server' => 'nullable|string|max:255', // Server bisa opsional
            'whatsapp_number' => 'nullable|string|max:20',
            'game_id' => 'required|exists:games,id', // Validasi bahwa game-nya ada
        ]);

        // 2. Buat transaksi baru di database Anda
        try {
            $game = Game::find($validated['game_id']);

            Transaction::create([
                'user_id' => Auth::id(),
                'transaction_code' => 'TPN-' . strtoupper(Str::random(10)),
                'game_name' => $game->name,
                'game_user_id' => $validated['game_user_id'],
                'game_server' => $validated['game_server'],
                'nominal_amount' => $validated['nominal_amount'],
                'price' => $validated['price'],
                'payment_method' => $validated['payment_method'],
                'whatsapp_number' => $validated['whatsapp_number'],
                'status' => 'completed', // Langsung dianggap selesai untuk MVP
            ]);

            // 3. Redirect ke halaman home dengan pesan sukses
            return redirect()->route('home')->with('success', 'Pembelian berhasil!');

        } catch (\Exception $e) {
            // Jika terjadi error, kembali dengan pesan error
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
}
