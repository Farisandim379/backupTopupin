<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use App\Models\TopupItem;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil pengguna pertama sebagai contoh pembeli.
        // Pastikan Anda sudah memiliki setidaknya satu user di database.
        $user = User::first();

        // 2. Ambil beberapa item top-up dari Valorant sebagai contoh produk.
        $topupItems = TopupItem::whereHas('game', function ($query) {
            $query->where('slug', 'valorant');
        })->take(5)->get();

        // Jika tidak ada user atau item, hentikan seeder.
        if (!$user || $topupItems->isEmpty()) {
            $this->command->info('Tidak dapat membuat data transaksi karena data user atau item top up tidak ditemukan.');
            return;
        }

        // 3. Buat beberapa data transaksi palsu.
        $statuses = ['completed', 'pending', 'failed'];
        $paymentMethods = ['OVO', 'DANA', 'QRIS'];

        foreach ($topupItems as $item) {
            Transaction::create([
                'user_id' => $user->id,
                'transaction_code' => 'TPN-' . strtoupper(Str::random(10)),
                'game_name' => 'Valorant',
                'game_user_id' => 'Player' . rand(1000, 9999),
                'game_server' => null, // Valorant tidak butuh server
                'nominal_amount' => $item->name,
                'price' => $item->price,
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'whatsapp_number' => '08123456789' . rand(0, 9),
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
