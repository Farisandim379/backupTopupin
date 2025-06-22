@extends('layouts.admin')

@section('title', 'Manage Games')

@section('header-button')
    <a href="{{ route('admin.games.create') }}" class="bg-[#D7FD52] text-black font-semibold py-2 px-5 rounded-lg hover:bg-lime-300 transition-colors">
        + Tambah Game
    </a>
@endsection

@section('content')
    <div class="space-y-4 md:hidden"> {{-- Show on small screens only --}}
        @forelse ($games as $game)
            <div class="bg-[#242424] text-gray-300 p-4 rounded-lg shadow">
                <div class="flex items-center gap-4 mb-3">
                    <img src="{{ asset('assets/logogame/' . $game->thumbnail) }}" alt="{{ $game->name }}" class="w-16 h-16 rounded object-cover">
                    <div>
                        <p class="font-bold text-lg">{{ $game->name }}</p>
                        <p class="font-mono text-gray-400 text-sm">{{ $game->slug }}</p>
                    </div>
                </div>
                <div class="border-t border-gray-700 pt-3">
                    <p class="text-gray-400">Butuh Server ID:</p>
                    <p class="font-semibold mb-3">
                        @if($game->needs_server_id)
                            <span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Ya</span>
                        @else
                            <span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-full text-xs">Tidak</span>
                        @endif
                    </p>
                    <div class="flex justify-end items-center gap-3">
                        <a href="{{ route('admin.games.edit', $game->id) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                        <form action="{{ route('admin.games.destroy', $game->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus game ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-3 text-center text-gray-400 bg-[#242424] rounded-lg">
                Belum ada data game.
            </div>
        @endforelse
    </div>

    <div class="overflow-x-auto hidden md:block"> {{-- Hide on small screens, show on medium and larger --}}
        <table class="min-w-full text-sm">
            <thead class="bg-[#242424] text-gray-300">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Thumbnail</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Slug</th>
                    <th class="p-3 text-center">Butuh Server ID</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($games as $game)
                    <tr class="border-b border-gray-800">
                        <td class="p-3">{{ $game->id }}</td>
                        <td class="p-3">
                            <img src="{{ asset('assets/logogame/' . $game->thumbnail) }}" alt="{{ $game->name }}" class="w-12 h-12 rounded object-cover">
                        </td>
                        <td class="p-3 font-semibold">{{ $game->name }}</td>
                        <td class="p-3 font-mono text-gray-400">{{ $game->slug }}</td>
                        <td class="p-3 text-center">
                            @if($game->needs_server_id)
                                <span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Ya</span>
                            @else
                                <span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-full text-xs">Tidak</span>
                            @endif
                        </td>
                        <td class="p-3">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('admin.games.edit', $game->id) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                <form action="{{ route('admin.games.destroy', $game->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus game ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-3 text-center text-gray-400">Belum ada data game.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
