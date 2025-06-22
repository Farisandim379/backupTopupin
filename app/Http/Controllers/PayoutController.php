<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\TopupItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PayoutController extends Controller
{
    public function create(Game $game)
    {
        $topupItems = $game->topupItems()->get();
        return view('payout', compact('game', 'topupItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'topup_item_id' => 'required|exists:topup_items,id',
            'payment_method' => 'required|string',
            'game_user_id' => 'required|string|max:255',
            'game_server' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'game_id' => 'required|exists:games,id',
        ]);

        $item = TopupItem::findOrFail($validated['topup_item_id']);
        $game = Game::findOrFail($validated['game_id']);

        try {
            Transaction::create([
                'user_id' => Auth::id(),
                'transaction_code' => 'TPN-' . strtoupper(Str::random(10)),
                'game_name' => $game->name,
                'game_user_id' => $validated['game_user_id'],

                // DIUBAH: Menggunakan null coalescing operator untuk handle game tanpa server
                'game_server' => $validated['game_server'] ?? null,

                'nominal_amount' => $item->name,
                'price' => $item->price,
                'payment_method' => $validated['payment_method'],
                'whatsapp_number' => $validated['whatsapp_number'],
                'status' => 'completed',
            ]);

            return redirect()->route('home')->with('success', 'Pembelian berhasil! Terima kasih telah berbelanja.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
