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
            'logo' => 'valorant.jpg',
            'needs_server_id' => false,
        ]);

        Game::create([
            'name' => 'Clash of Clans',
            'slug' => 'clash-of-clans',
            'thumbnail' => 'logococ.png', // Menggunakan logo kecil
            'logo' => 'clashofclans.jpg',
            'needs_server_id' => false,
        ]);

        Game::create([
            'name' => 'Mobile Legends',
            'slug' => 'mobile-legends',
            'thumbnail' => 'logomobile.png', // Menggunakan logo kecil
            'logo' => 'mobilelegends.jpg',
            'needs_server_id' => true,
        ]);

        Game::create([
            'name' => 'Genshin Impact',
            'slug' => 'genshin-impact',
            'thumbnail' => 'genshinimpact.jpg', // Disesuaikan dengan file Anda
            'logo' => 'genshintopup.jpeg',
            'needs_server_id' => true,
        ]);

        Game::create([
            'name' => 'Free Fire',
            'slug' => 'free-fire',
            'thumbnail' => 'freefire.jpg', // Disesuaikan dengan file Anda
            'logo' => 'logoepep.png',
            'needs_server_id' => false,
        ]);

        Game::create([
            'name' => 'Roblox',
            'slug' => 'roblox',
            'thumbnail' => 'roblox.jpg', // Disesuaikan dengan file Anda
            'logo' => 'logoroblox.png',
            'needs_server_id' => false,
        ]);

        Game::create([
            'name' => 'PUBG Mobile',
            'slug' => 'pubg',
            'thumbnail' => 'logopubg.png', // Ini bisa jadi berbeda folder
            'logo' => 'pubgmobile.jpg',
            'needs_server_id' => true,
        ]);
    }
}
