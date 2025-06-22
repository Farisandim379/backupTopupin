@extends('layouts.admin')

@section('title', 'Manage Topup Items')

@section('header-button')
    <a href="{{ route('admin.topup-items.create') }}" class="bg-[#D7FD52] text-black font-semibold py-2 px-5 rounded-lg hover:bg-lime-300 transition-colors">
        + Tambah Item
    </a>
@endsection

@section('content')
    <div class="space-y-4 md:hidden"> {{-- Show on small screens only --}}
        @forelse ($topupItems as $item)
            <div class="bg-[#242424] text-gray-300 p-4 rounded-lg shadow">
                <div class="flex items-center gap-3 mb-3">
                    <img src="{{ asset('assets/logogame/' . $item->game->thumbnail) }}" alt="{{ $item->game->name }}" class="w-12 h-12 rounded object-cover">
                    <span class="font-bold text-lg">{{ $item->game->name }}</span>
                </div>
                <div class="border-t border-gray-700 pt-3">
                    <p class="text-gray-400">Nama Item:</p>
                    <p class="font-semibold mb-2">{{ $item->name }}</p>
                    <p class="text-gray-400">Harga:</p>
                    <p class="font-semibold mb-3">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                    <div class="flex justify-end items-center gap-3">
                        <a href="{{ route('admin.topup-items.edit', $item->id) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                        <form action="{{ route('admin.topup-items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-3 text-center text-gray-400 bg-[#242424] rounded-lg">
                Belum ada data item top up.
            </div>
        @endforelse
    </div>

    <div class="overflow-x-auto hidden md:block"> {{-- Hide on small screens, show on medium and larger --}}
        <table class="min-w-full text-sm">
            <thead class="bg-[#242424] text-gray-300">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Game</th>
                    <th class="p-3 text-left">Nama Item</th>
                    <th class="p-3 text-left">Harga</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($topupItems as $item)
                    <tr class="border-b border-gray-800">
                        <td class="p-3">{{ $item->id }}</td>
                        <td class="p-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('assets/logogame/' . $item->game->thumbnail) }}" alt="{{ $item->game->name }}" class="w-10 h-10 rounded object-cover">
                                <span class="font-semibold">{{ $item->game->name }}</span>
                            </div>
                        </td>
                        <td class="p-3">{{ $item->name }}</td>
                        <td class="p-3">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="p-3">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('admin.topup-items.edit', $item->id) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                <form action="{{ route('admin.topup-items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-400">Belum ada data item top up.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
