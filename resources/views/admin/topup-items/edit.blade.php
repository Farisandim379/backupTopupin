<!-- File: resources/views/admin/topup-items/create.blade.php -->

@extends('layouts.admin')

@section('title', 'Tambah Item Baru')

@section('content')
    {{-- DIUBAH: Menambahkan enctype="multipart/form-data" --}}
    <form action="{{ route('admin.topup-items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded-lg">
                <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div>
        @endif

        <div>
            <label for="game_id" class="block mb-2 text-sm font-medium text-gray-300">Pilih Game</label>
            <select id="game_id" name="game_id" class="bg-[#242424] border border-gray-600 text-white text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full p-2.5" required>
                <option selected disabled>-- Pilih Game --</option>
                @foreach($games as $game)
                    <option value="{{ $game->id }}">{{ $game->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Nama Item (cth: 1050 Diamonds)</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-[#242424] border border-gray-600 text-white text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full p-2.5" required>
        </div>

        <div>
            <label for="price" class="block mb-2 text-sm font-medium text-gray-300">Harga (cth: 100000)</label>
            <input type="number" id="price" name="price" value="{{ old('price') }}" class="bg-[#242424] border border-gray-600 text-white text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full p-2.5" required>
        </div>

        <div>
            <label for="image" class="block mb-2 text-sm font-medium text-gray-300">Gambar Item (Opsional)</label>
            <input type="file" id="image" name="image" class="bg-[#242424] border border-gray-600 text-white text-sm rounded-lg block w-full">
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.topup-items.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white">Batal</a>
            <button type="submit" class="bg-[#D7FD52] text-black font-semibold py-2.5 px-6 rounded-lg hover:bg-lime-300 transition-colors">Simpan Item</button>
        </div>
    </form>
@endsection

---
<!-- File: resources/views/admin/topup-items/edit.blade.php -->

@extends('layouts.admin')

@section('title', 'Edit Item: ' . $topupItem->name)

@section('content')
    {{-- DIUBAH: Menambahkan enctype="multipart/form-data" --}}
    <form action="{{ route('admin.topup-items.update', $topupItem->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded-lg">
                <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div>
        @endif

        <div>
            <label for="game_id" class="block mb-2 text-sm font-medium text-gray-300">Pilih Game</label>
            <select id="game_id" name="game_id" class="bg-[#242424] border border-gray-600 text-white text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full p-2.5" required>
                @foreach($games as $game)
                    <option value="{{ $game->id }}" {{ $topupItem->game_id == $game->id ? 'selected' : '' }}>
                        {{ $game->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Nama Item</label>
            <input type="text" id="name" name="name" value="{{ old('name', $topupItem->name) }}" class="bg-[#242424] border border-gray-600 text-white text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full p-2.5" required>
        </div>

        <div>
            <label for="price" class="block mb-2 text-sm font-medium text-gray-300">Harga</label>
            <input type="number" id="price" name="price" value="{{ old('price', $topupItem->price) }}" class="bg-[#242424] border border-gray-600 text-white text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full p-2.5" required>
        </div>

        <div>
            <label for="image" class="block mb-2 text-sm font-medium text-gray-300">Ganti Gambar Item (Opsional)</label>
            <input type="file" id="image" name="image" class="bg-[#242424] border border-gray-600 text-white text-sm rounded-lg block w-full">
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.topup-items.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-white">Batal</a>
            <button type="submit" class="bg-[#D7FD52] text-black font-semibold py-2.5 px-6 rounded-lg hover:bg-lime-300 transition-colors">Update Item</button>
        </div>
    </form>
@endsection
