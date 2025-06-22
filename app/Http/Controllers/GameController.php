<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class GameController extends Controller
{
    /**
     * Menampilkan daftar semua game.
     */
    public function index()
    {
        // Kembalikan kode ini ke keadaan semula
        $games = Game::all();
        return view('admin.games.index', compact('games'));
    }

    /**
     * Menampilkan form untuk membuat game baru.
     */
    public function create()
    {
        return view('admin.games.create');
    }

    /**
     * Menyimpan game baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:games',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'needs_server_id' => 'required|boolean',
        ]);

        $game = new Game();
        $game->name = $request->name;
        $game->slug = $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->name, '-');

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . Str::slug($game->name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/logogame'), $filename);
            $game->thumbnail = $filename;
        }

        $game->needs_server_id = $request->needs_server_id;
        $game->save();

        return redirect()->route('admin.games.index')->with('success', 'Game berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit game.
     */
    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    /**
     * Memperbarui data game di database.
     */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:games,slug,' . $game->id,
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'needs_server_id' => 'required|boolean',
        ]);

        $game->name = $request->name;
        $game->slug = $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->name, '-');

        if ($request->hasFile('thumbnail')) {
            if ($game->thumbnail && File::exists(public_path('assets/logogame/' . $game->thumbnail))) {
                File::delete(public_path('assets/logogame/' . $game->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = time() . '_' . Str::slug($game->name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/logogame'), $filename);
            $game->thumbnail = $filename;
        }

        $game->needs_server_id = $request->needs_server_id;
        $game->save();

        return redirect()->route('admin.games.index')->with('success', 'Game berhasil diperbarui.');
    }

    /**
     * Menghapus game dari database.
     */
    public function destroy(Game $game)
    {
        if ($game->thumbnail && File::exists(public_path('assets/logogame/' . $game->thumbnail))) {
            File::delete(public_path('assets/logogame/' . $game->thumbnail));
        }

        $game->delete();

        return redirect()->route('admin.games.index')->with('success', 'Game berhasil dihapus.');
    }
}
