@extends('layouts.admin')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-[#242424] text-gray-300">
                <tr>
                    <th class="p-3 text-left">Kode Transaksi</th>
                    <th class="p-3 text-left">Pengguna</th>
                    <th class="p-3 text-left">Detail Item</th>
                    <th class="p-3 text-left">Total Harga</th>
                    <th class="p-3 text-center">Status</th>
                    <th class="p-3 text-left">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr class="border-b border-gray-800 hover:bg-[#2a2a2a]">
                        <td class="p-3 font-mono text-gray-400">{{ $transaction->transaction_code }}</td>
                        <td class="p-3">{{ $transaction->user->name ?? 'Pengguna Dihapus' }}</td>
                        <td class="p-3">
                            <div class="font-semibold">{{ $transaction->game_name }}</div>
                            <div class="text-gray-400">{{ $transaction->nominal_amount }}</div>
                        </td>
                        <td class="p-3">Rp{{ number_format($transaction->price, 0, ',', '.') }}</td>
                        <td class="p-3 text-center">
                            @if($transaction->status == 'completed')
                                <span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Completed</span>
                            @elseif($transaction->status == 'pending')
                                <span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs">Pending</span>
                            @else
                                <span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-full text-xs">Failed</span>
                            @endif
                        </td>
                        <td class="p-3">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-3 text-center text-gray-400">Belum ada data transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="md:hidden space-y-4">
        @forelse ($transactions as $transaction)
            <div class="bg-[#242424] p-4 rounded-lg shadow-md">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <div class="font-bold text-lg text-white">{{ $transaction->game_name }}</div>
                        <div class="text-sm text-gray-400">{{ $transaction->nominal_amount }}</div>
                        <div class="text-lg text-[#D7FD52] mt-1">Rp{{ number_format($transaction->price, 0, ',', '.') }}</div>
                    </div>
                    <div>
                        @if($transaction->status == 'completed')
                            <span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Completed</span>
                        @elseif($transaction->status == 'pending')
                            <span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs">Pending</span>
                        @else
                            <span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-full text-xs">Failed</span>
                        @endif
                    </div>
                </div>

                <hr class="border-gray-700">

                <div class="mt-3 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Pengguna</span>
                        <span class="text-white">{{ $transaction->user->name ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Kode Transaksi</span>
                        <span class="font-mono text-gray-300">{{ $transaction->transaction_code }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Tanggal</span>
                        <span class="text-gray-300">{{ $transaction->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-4 text-center text-gray-400">
                Belum ada data transaksi.
            </div>
        @endforelse
    </div>
@endsection
