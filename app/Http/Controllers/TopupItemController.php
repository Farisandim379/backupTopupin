<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\TopupItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TopupItemController extends Controller
{
    /**
     * Menampilkan daftar semua item top-up.
     */
    public function index()
    {
        $topupItems = TopupItem::with('game')->get();
        return view('admin.topup-items.index', compact('topupItems'));
    }

    /**
     * Menampilkan form untuk membuat item baru.
     */
    public function create()
    {
        $games = Game::all();
        return view('admin.topup-items.create', compact('games'));
    }

    /**
     * Menyimpan item baru ke database.
     */
    public function store(Request $request)
    {
        // DIUBAH: Aturan validasi untuk 'image' dibuat lebih spesifik
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            // Aturan ini berarti 'image' boleh kosong (nullable),
            // tapi JIKA ADA, ia harus berupa gambar dengan format yang diizinkan.
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'item_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('assets/diamondgame'), $filename);
            $data['image'] = $filename;
        }

        TopupItem::create($data);

        return redirect()->route('admin.topup-items.index')
                         ->with('success', 'Item top up berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit item.
     */
    public function edit(TopupItem $topupItem)
    {
        $games = Game::all();
        return view('admin.topup-items.edit', compact('topupItem', 'games'));
    }

    /**
     * Memperbarui data item di database.
     */
    public function update(Request $request, TopupItem $topupItem)
    {
        // DIUBAH: Aturan validasi untuk 'image' disesuaikan
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($topupItem->image && File::exists(public_path('assets/diamondgame/' . $topupItem->image))) {
                File::delete(public_path('assets/diamondgame/' . $topupItem->image));
            }

            $file = $request->file('image');
            $filename = 'item_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('assets/diamondgame'), $filename);
            $data['image'] = $filename;
        }

        $topupItem->update($data);

        return redirect()->route('admin.topup-items.index')
                         ->with('success', 'Item top up berhasil diperbarui.');
    }

    /**
     * Menghapus item dari database.
     */
    public function destroy(TopupItem $topupItem)
    {
        if ($topupItem->image && File::exists(public_path('assets/diamondgame/' . $topupItem->image))) {
            File::delete(public_path('assets/diamondgame/' . $topupItem->image));
        }

        $topupItem->delete();

        return redirect()->route('admin.topup-items.index')
                         ->with('success', 'Item top up berhasil dihapus.');
    }
}
