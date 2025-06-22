<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\TopupItem;
use Illuminate\Http\Request;

class TopupItemController extends Controller
{
    /**
     * Menampilkan daftar semua item top-up.
     */
    public function index()
    {
        // Mengambil semua item beserta data game yang berelasi
        // untuk menghindari query N+1
        $topupItems = TopupItem::with('game')->get();
        return view('admin.topup-items.index', compact('topupItems'));
    }

    /**
     * Menampilkan form untuk membuat item baru.
     */
    public function create()
    {
        // Kita perlu mengambil semua data game untuk ditampilkan di dropdown
        $games = Game::all();
        return view('admin.topup-items.create', compact('games'));
    }

    /**
     * Menyimpan item baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ]);

        TopupItem::create($request->all());

        return redirect()->route('admin.topup-items.index')
                         ->with('success', 'Item top up berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit item.
     *
     * @param  \App\Models\TopupItem  $topupItem
     */
    public function edit(TopupItem $topupItem)
    {
        // Mengambil semua game untuk dropdown
        $games = Game::all();
        return view('admin.topup-items.edit', compact('topupItem', 'games'));
    }

    /**
     * Memperbarui data item di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TopupItem  $topupItem
     */
    public function update(Request $request, TopupItem $topupItem)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ]);

        $topupItem->update($request->all());

        return redirect()->route('admin.topup-items.index')
                         ->with('success', 'Item top up berhasil diperbarui.');
    }

    /**
     * Menghapus item dari database.
     *
     * @param  \App\Models\TopupItem  $topupItem
     */
    public function destroy(TopupItem $topupItem)
    {
        $topupItem->delete();

        return redirect()->route('admin.topup-items.index')
                         ->with('success', 'Item top up berhasil dihapus.');
    }
}
