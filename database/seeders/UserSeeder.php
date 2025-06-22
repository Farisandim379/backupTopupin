<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Akun Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@topup.in',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Membuat Akun Customer Biasa
        User::create([
            'name' => 'Hafid',
            'email' => 'hafid@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user', // Defaultnya sudah user, tapi lebih baik eksplisit
        ]);
    }
}
