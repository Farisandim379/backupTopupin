@extends('layouts.admin')

@section('title', 'Edit Game: ' . $game->name)

@section('content')
    <form action="{{ route('admin.games.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Menampilkan error validasi --}}
        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Nama Game</label>
            <input type="text" id="name" name="name" value="{{ old('name', $game->name) }}" class="bg-[#242424] border border-gray-600 text-white text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full p-2.5" required>
        </div>

        <div>
            <label for="slug" class="block mb-2 text-sm font-medium text-gray-300">Slug</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug', $game->slug) }}" class="bg-[#242424] border border-gray-600 text-white text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full p-2.5">
        </div>

         <div>
            <label for="logo" class="block mb-2 text-sm font-medium text-gray-300">Logo (untuk Halaman Pembayaran)</label>
            <input type="file" id="logo" name="logo" class="bg-[#242424] border border-gray-600 ...">
        </div>

        <div>
            <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-300">Thumbnail (Logo Game)</label>
            <div class="flex items-center gap-4">
                <img src="{{ asset('assets/logogame/' . $game->thumbnail) }}" alt="{{ $game->name }}" class="w-16 h-16 rounded object-cover">
                <input type="file" id="thumbnail" name="thumbnail" class="bg-[#242424] border border-gray-600 text-white text-sm rounded-lg block w-full">
            </div>
            <p class="mt-1 text-xs text-gray-400">Kosongkan jika tidak ingin mengubah thumbnail.</p>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-300">Membutuhkan Server/Zone ID?</label>
            <div class="flex items-center gap-4">
                <label><input type="radio" name="needs_server_id" value="1" {{ $game->needs_server_id ? 'checked' : '' }} class="accent-lime-400"> Ya</label>
                <label><input type="radio" name="needs_server_id" value="0" {{ !$game->needs_server_id ? 'checked' : '' }} class="accent-lime-400"> Tidak</label>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.games.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white">Batal</a>
            <button type="submit" class="bg-[#D7FD52] text-black font-semibold py-2.5 px-6 rounded-lg hover:bg-lime-300 transition-colors">Update Game</button>
        </div>
    </form>
@endsection
