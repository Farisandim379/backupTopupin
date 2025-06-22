@extends('layouts.app')

{{-- Menetapkan judul khusus untuk halaman ini --}}
@section('title', 'Game Populer')

{{-- Bagian konten utama halaman --}}
@section('content')

<div class="p-4 pt-8">
  {{-- Section GAME POPULER --}}
  <div class="py-8 px-4">
    <div class="flex py-8 justify-between items-center">
      <h2 class="text-2xl font-bold">Game Populer</h2>
    </div>

    {{--
      CATATAN PENGEMBANGAN:
      Idealnya, bagian ini akan menggunakan loop @foreach untuk menampilkan data game dari database.
      Contoh: @foreach ($popularGames as $game) ... @endforeach
    --}}
    <div class="md:px-16 lg:px-16 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">

      {{-- Game Card 1 --}}
      <div class="w-full flex flex-col">
        <img src="{{ asset('assets/imgPopuler/imgpopuler2.png') }}" class="rounded-t-lg object-cover w-full" alt="Minecraft Java & Bedrock Edition">
        <div class="bg-[#242424] rounded-b-lg px-4 py-2 flex-1 flex flex-col justify-between">
          <h3 class="text-sm md:text-base font-semibold break-words h-[60px] overflow-hidden">Minecraft Java & Bedrock Edition - Microsoft</h3>
          <div class="mt-2">
            <p class="text-sm md:text-md font-bold">Rp 285.500</p>
            <button class="w-full mt-2 py-1 md:text-lg bg-[#D7FD52] text-black font-bold rounded-lg hover:bg-lime-300 transition-colors">Beli</button>
          </div>
        </div>
      </div>

      {{-- Game Card 2 --}}
      <div class="w-full flex flex-col">
        <img src="{{ asset('assets/imgPopuler/imgpopuler1.png') }}" class="rounded-t-lg object-cover w-full" alt="Game Image">
        <div class="bg-[#242424] rounded-b-lg px-4 py-2 flex-1 flex flex-col justify-between">
            <h3 class="text-sm md:text-base font-semibold break-words h-[60px] overflow-hidden">Valorant</h3>
            <div class="mt-2">
                <p class="text-sm md:text-md font-bold">Mulai dari Rp 10.000</p>
                <button class="w-full mt-2 py-1 md:text-lg bg-[#D7FD52] text-black font-bold rounded-lg hover:bg-lime-300 transition-colors">Beli</button>
            </div>
        </div>
      </div>

      {{-- Game Card 3 --}}
      <div class="w-full flex flex-col">
        <img src="{{ asset('assets/imgPopuler/imgpopuler3.png') }}" class="rounded-t-lg object-cover w-full" alt="Resident Evil Village">
        <div class="bg-[#242424] rounded-b-lg px-4 py-2 flex-1 flex flex-col justify-between">
          <h3 class="text-sm md:text-base font-semibold break-words h-[60px] overflow-hidden">Resident Evil Village</h3>
          <div class="mt-2">
            <p class="text-sm md:text-md font-bold">Rp 285.500</p>
            <button class="w-full mt-2 py-1 md:text-lg bg-[#D7FD52] text-black font-bold rounded-lg hover:bg-lime-300 transition-colors">Beli</button>
          </div>
        </div>
      </div>

      {{-- Game Card 4 --}}
      <div class="w-full flex flex-col">
        <img src="{{ asset('assets/imgPopuler/imgpopuler6.png') }}" class="rounded-t-lg object-cover w-full" alt="Ghost of Tsushima">
        <div class="bg-[#242424] rounded-b-lg px-4 py-2 flex-1 flex flex-col justify-between">
          <h3 class="text-sm md:text-base font-semibold break-words h-[60px] overflow-hidden">Ghost of Tsushima</h3>
          <div class="mt-2">
            <p class="text-sm md:text-md font-bold">Rp 285.500</p>
            <button class="w-full mt-2 py-1 md:text-lg bg-[#D7FD52] text-black font-bold rounded-lg hover:bg-lime-300 transition-colors">Beli</button>
          </div>
        </div>
      </div>

      {{-- Game Card 5 --}}
      <div class="w-full flex flex-col">
        <img src="{{ asset('assets/imgPopuler/imgpopuler5.png') }}" class="rounded-t-lg object-cover w-full" alt="Mobile Legends">
        <div class="bg-[#242424] rounded-b-lg px-4 py-2 flex-1 flex flex-col justify-between">
            <h3 class="text-sm md:text-base font-semibold break-words h-[60px] overflow-hidden">Mobile Legends</h3>
            <div class="mt-2">
                <p class="text-sm md:text-md font-bold">Mulai dari Rp 1.500</p>
                <button class="w-full mt-2 py-1 md:text-lg bg-[#D7FD52] text-black font-bold rounded-lg hover:bg-lime-300 transition-colors">Beli</button>
            </div>
        </div>
      </div>

      {{-- Game Card 6 --}}
      <div class="w-full flex flex-col">
        <img src="{{ asset('assets/imgPopuler/imgpopuler6.png') }}" class="rounded-t-lg object-cover w-full" alt="PUBG Mobile">
        <div class="bg-[#242424] rounded-b-lg px-4 py-2 flex-1 flex flex-col justify-between">
            <h3 class="text-sm md:text-base font-semibold break-words h-[60px] overflow-hidden">PUBG Mobile</h3>
            <div class="mt-2">
                <p class="text-sm md:text-md font-bold">Mulai dari Rp 5.000</p>
                <button class="w-full mt-2 py-1 md:text-lg bg-[#D7FD52] text-black font-bold rounded-lg hover:bg-lime-300 transition-colors">Beli</button>
            </div>
        </div>
      </div>

      {{-- Anda dapat menambahkan lebih banyak card di sini atau menggunakan loop --}}

    </div>
  </div>
</div>
@endsection
