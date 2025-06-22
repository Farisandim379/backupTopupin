<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data ini akan digunakan untuk menampilkan LOGO di halaman Payout
        // Pastikan semua file ini ada di dalam folder `public/assets/logogame/`

        Game::create([
            'name' => 'Valorant',
            'slug' => 'valorant',
            'thumbnail' => 'logovalo.png', // Menggunakan logo kecil
            'needs_server_id' => false,
        ]);

        Game::create([
            'name' => 'Clash of Clans',
            'slug' => 'clash-of-clans',
            'thumbnail' => 'logococ.png', // Menggunakan logo kecil
            'needs_server_id' => false,
        ]);

        Game::create([
            'name' => 'Mobile Legends',
            'slug' => 'mobile-legends',
            'thumbnail' => 'logomobile.png', // Menggunakan logo kecil
            'needs_server_id' => true,
        ]);

        Game::create([
            'name' => 'Genshin Impact',
            'slug' => 'genshin-impact',
            'thumbnail' => 'genshinimpact.jpg', // Disesuaikan dengan file Anda
            'needs_server_id' => true,
        ]);

        Game::create([
            'name' => 'Free Fire',
            'slug' => 'free-fire',
            'thumbnail' => 'logoepep.png', // Disesuaikan dengan file Anda
            'needs_server_id' => false,
        ]);

        Game::create([
            'name' => 'Roblox',
            'slug' => 'roblox',
            'thumbnail' => 'logoroblox.png', // Disesuaikan dengan file Anda
            'needs_server_id' => false,
        ]);

        Game::create([
            'name' => 'Minecraft',
            'slug' => 'minecraft',
            'thumbnail' => 'imgpopuler2.png', // Ini bisa jadi berbeda folder
            'needs_server_id' => false,
        ]);
    }
}
