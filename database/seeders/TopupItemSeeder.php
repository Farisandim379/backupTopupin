<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\TopupItem;

class TopupItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat
        TopupItem::truncate();

        // --- Data untuk Valorant ---
        $valorantGame = Game::where('slug', 'valorant')->first();
        if ($valorantGame) {
            $items = [
                ['name' => '53 VP', 'price' => 14500, 'image' => 'valorant.jpg'],
                ['name' => '154 VP', 'price' => 28500, 'image' => 'valorant.jpg'],
                ['name' => '256 VP', 'price' => 45000, 'image' => 'valorant.jpg'],
                ['name' => '503 VP', 'price' => 70000, 'image' => 'valorant.jpg'],
                ['name' => '1010 VP', 'price' => 140000, 'image' => 'valorant.jpg'],
                ['name' => '2020 VP', 'price' => 280000, 'image' => 'valorant.jpg'],
            ];
            foreach ($items as $item) {
                TopupItem::create([
                    'game_id' => $valorantGame->id,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'image' => $item['image'],
                ]);
            }
        }

        // --- Data untuk Mobile Legends ---
        $mlGame = Game::where('slug', 'mobile-legends')->first();
        if ($mlGame) {
            $items = [
                ['name' => '86 Diamonds', 'price' => 25000, 'image' => 'diamondml.jpg'],
                ['name' => '172 Diamonds', 'price' => 50000, 'image' => 'diamondml.jpg'],
                ['name' => '257 Diamonds', 'price' => 75000, 'image' => 'diamondml.jpg'],
            ];
            foreach ($items as $item) {
                TopupItem::create([
                    'game_id' => $mlGame->id,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'image' => $item['image'],
                ]);
            }
        }

        // --- Data untuk Clash of Clans ---
        $cocGame = Game::where('slug', 'clash-of-clans')->first();
        if ($cocGame) {
            $items = [
                ['name' => '80 Gems', 'price' => 15000, 'image' => 'diamondcoc.png'],
                ['name' => '500 Gems', 'price' => 79000, 'image' => 'diamondcoc.png'],
                ['name' => '1200 Gems', 'price' => 159000, 'image' => 'diamondcoc.png'],
            ];
            foreach ($items as $item) {
                TopupItem::create([
                    'game_id' => $cocGame->id,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'image' => $item['image'],
                ]);
            }
        }
    }
}
