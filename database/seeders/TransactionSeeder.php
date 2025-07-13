<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Game;
use App\Models\TopupItem;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user pertama dan semua item top-up sebagai sampel
        $user = User::first();
        $topupItems = TopupItem::all();

        if (!$user || $topupItems->isEmpty()) {
            $this->command->info('Tidak dapat membuat data transaksi karena data user atau item top up tidak ditemukan.');
            return;
        }

        // Hapus transaksi lama agar tidak duplikat setiap kali seeder dijalankan
        Transaction::truncate();

        // Buat data transaksi untuk 7 hari terakhir
        for ($i = 0; $i < 7; $i++) {
            // Tentukan tanggal untuk iterasi saat ini
            $date = Carbon::now()->subDays($i);

            // Buat 2 sampai 5 transaksi acak untuk setiap hari
            for ($j = 0; $j < rand(2, 5); $j++) {

                // Pilih item secara acak
                $item = $topupItems->random();

                Transaction::create([
                    'user_id' => $user->id,
                    'transaction_code' => 'TPN-' . strtoupper(Str::random(10)),
                    'game_name' => $item->game->name,
                    'game_user_id' => 'Player' . rand(1000, 9999),
                    'game_server' => $item->game->needs_server_id ? rand(1000, 9999) : null,
                    'nominal_amount' => $item->name,
                    'price' => $item->price,
                    'payment_method' => ['OVO', 'DANA', 'QRIS'][array_rand(['OVO', 'DANA', 'QRIS'])],
                    'whatsapp_number' => '08123456789' . rand(0, 9),
                    'status' => 'completed', // Kita hanya hitung yang completed untuk pendapatan
                    'created_at' => $date, // Set tanggal transaksi sesuai iterasi
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
