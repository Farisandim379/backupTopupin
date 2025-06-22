@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <p class="text-gray-400 mb-6">Selamat datang kembali! Berikut adalah ringkasan aktivitas di toko Anda.</p>

    {{-- Grid untuk Kartu Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Kartu Total Pengguna -->
        <div class="bg-[#242424] p-6 rounded-2xl flex items-center gap-6 border border-gray-800">
            <div class="bg-[#D7FD52]/10 p-4 rounded-full">
                <i class="fas fa-users fa-2x text-[#D7FD52]"></i>
            </div>
            <div>
                <p class="text-sm text-gray-400">Total Pengguna</p>
                <p class="text-2xl font-bold">{{ number_format($totalUsers) }}</p>
            </div>
        </div>

        <!-- Kartu Total Game -->
        <div class="bg-[#242424] p-6 rounded-2xl flex items-center gap-6 border border-gray-800">
            <div class="bg-sky-500/10 p-4 rounded-full">
                <i class="fas fa-gamepad fa-2x text-sky-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-400">Total Game</p>
                <p class="text-2xl font-bold">{{ number_format($totalGames) }}</p>
            </div>
        </div>

        <!-- Kartu Total Transaksi -->
        <div class="bg-[#242424] p-6 rounded-2xl flex items-center gap-6 border border-gray-800">
            <div class="bg-orange-500/10 p-4 rounded-full">
                <i class="fas fa-history fa-2x text-orange-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-400">Total Transaksi</p>
                <p class="text-2xl font-bold">{{ number_format($totalTransactions) }}</p>
            </div>
        </div>

        <!-- Kartu Total Pendapatan -->
        <div class="bg-[#242424] p-6 rounded-2xl flex items-center gap-6 border border-gray-800">
            <div class="bg-green-500/10 p-4 rounded-full">
                <i class="fas fa-dollar-sign fa-2x text-green-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-400">Total Pendapatan</p>
                <p class="text-2xl font-bold">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>

    </div>

    {{-- Anda bisa menambahkan chart atau tabel ringkasan lainnya di sini --}}

@endsection
