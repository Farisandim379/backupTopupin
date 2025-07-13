@extends('layouts.app')

@section('title', 'Riwayat Transaksi Saya')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-[#1a1a1a] p-6 sm:p-8 rounded-2xl shadow-md">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white">Riwayat Transaksi Saya</h1>
                <p class="text-gray-400 mt-1">Berikut adalah semua pembelian yang telah Anda lakukan.</p>
            </div>
            <a href="{{ route('home') }}" class="mt-4 sm:mt-0 text-sm bg-[#D7FD52] text-black font-semibold py-2 px-5 rounded-lg hover:bg-lime-300 transition-colors">
                Kembali ke Home
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-[#242424] text-gray-300">
                    <tr>
                        <th class="p-3 text-left">Kode Transaksi</th>
                        <th class="p-3 text-left">Detail Item</th>
                        <th class="p-3 text-left">Total Harga</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr class="border-b border-gray-800">
                            <td class="p-3 font-mono text-gray-400">{{ $transaction->transaction_code }}</td>
                            <td class="p-3">
                                <div class="font-semibold">{{ $transaction->game_name }}</div>
                                <div class="text-gray-400">{{ $transaction->nominal_amount }}</div>
                            </td>
                            <td class="p-3">Rp{{ number_format($transaction->price, 0, ',', '.') }}</td>
                            <td class="p-3 text-center">
                                @if($transaction->status == 'completed')
                                    <span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Berhasil</span>
                                @elseif($transaction->status == 'pending')
                                    <span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs">Tertunda</span>
                                @else
                                    <span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-full text-xs">Gagal</span>
                                @endif
                            </td>
                            <td class="p-3">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-400">Anda belum memiliki riwayat transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
