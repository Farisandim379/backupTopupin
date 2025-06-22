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
        // 1. Cari ID untuk game Valorant
        $valorantGame = Game::where('slug', 'valorant')->first();

        // 2. Jika Valorant ditemukan, tambahkan item top-up-nya
        if ($valorantGame) {
            $items = [
                ['name' => '53 VP', 'price' => 14500],
                ['name' => '154 VP', 'price' => 28500],
                ['name' => '256 VP', 'price' => 45000],
                ['name' => '503 VP', 'price' => 70000],
                ['name' => '1010 VP', 'price' => 140000],
                ['name' => '2020 VP', 'price' => 280000],
                ['name' => '3330 VP', 'price' => 350000],
                ['name' => '4440 VP', 'price' => 450000],
                ['name' => '8880 VP', 'price' => 725000],
            ];

            foreach ($items as $item) {
                TopupItem::create([
                    'game_id' => $valorantGame->id,
                    'name' => $item['name'],
                    'price' => $item['price'],
                ]);
            }
        }

        // Anda bisa menambahkan item untuk game lain di sini dengan logika yang sama
    }
}
