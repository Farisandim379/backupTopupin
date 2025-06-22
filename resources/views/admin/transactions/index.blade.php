@extends('layouts.admin')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="overflow-x-auto">
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
                    <tr class="border-b border-gray-800">
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
@endsection
