<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder yang sudah kita buat
        $this->call([
            UserSeeder::class,
            GameSeeder::class,
            TopupItemSeeder::class,
            TransactionSeeder::class, // <-- TAMBAHKAN INI

        ]);
    }
}
