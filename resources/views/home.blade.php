@extends('layouts.app')

@section('title', 'Home - Top Up Game Murah dan Cepat')

@push('styles')
<style>
    .developer-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .developer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(215, 253, 82, 0.15);
    }
</style>
@endpush

@section('content')

{{-- Wrapper untuk memberi jarak dari navbar --}}
<div class="pt-8">
    <!-- Carousel -->
    <div class="relative overflow-hidden bg-black w-full aspect-[17/5] max-w-screen-xl mx-auto rounded-2xl" id="carousel">
        <div class="absolute inset-0 w-full h-full">
            <img src="{{ asset('assets/promo/promosi1.png') }}" alt="Banner 1" class="carousel-image absolute inset-0 w-full h-full object-cover transition-opacity duration-700 opacity-100 rounded-2xl" />
            <img src="{{ asset('assets/promo/promosi2.png') }}" alt="Banner 2" class="carousel-image absolute inset-0 w-full h-full object-cover transition-opacity duration-700 opacity-0 rounded-2xl" />
        </div>
        <button id="prev" class="absolute left-2 top-1/2 -translate-y-1/2 z-10 bg-white/20 hover:bg-white/40 text-white rounded-full p-2">&#10094;</button>
        <button id="next" class="absolute right-2 top-1/2 -translate-y-1/2 z-10 bg-white/20 hover:bg-white/40 text-white rounded-full p-2">&#10095;</button>
        <div class="absolute bottom-2 w-full flex justify-center space-x-2 z-10">
            <button class="carousel-indicator w-3 h-3 rounded-full bg-white" data-index="0"></button>
            <button class="carousel-indicator w-3 h-3 rounded-full bg-gray-500" data-index="1"></button>
        </div>
    </div>
</div>

<!-- Kategori -->
<div class="container mx-auto px-4 py-6">
    <div class="px-4 sm:px-6 mt-1">
        <div class="flex justify-start gap-1 sm:gap-2">
            <a href="#" data-category="semua" class="kategori-btn flex-1 sm:flex-none sm:w-28 bg-lime-400 text-black px-1 sm:px-4 py-2 rounded-md text-xs sm:text-sm text-center font-medium truncate">SEMUA</a>
            <a href="#" data-category="topup" class="kategori-btn flex-1 sm:flex-none sm:w-28 bg-zinc-800 text-white px-1 sm:px-4 py-2 rounded-md text-xs sm:text-sm text-center font-medium truncate transition">TOP UP</a>
            <a href="#" data-category="akun" class="kategori-btn flex-1 sm:flex-none sm:w-28 bg-zinc-800 text-white px-1 sm:px-4 py-2 rounded-md text-xs sm:text-sm text-center font-medium truncate transition">AKUN</a>
            <a href="#" data-category="tim" class="kategori-btn flex-1 sm:flex-none sm:w-28 bg-zinc-800 text-white px-1 sm:px-4 py-2 rounded-md text-xs sm:text-sm text-center font-medium truncate transition">TIM</a>
        </div>
    </div>
</div>

<!-- Container untuk semua konten yang bisa difilter -->
<div id="filtered-content">

    <!-- Meet Our Team Section (Awalnya tersembunyi) -->
    <div id="team-section" class="kategori-content container mx-auto px-4 py-12 hidden" data-kategori="tim">
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold text-white mb-4">Meet our <span class="text-[#D7FD52]">Team</span></h1>
            <p class="text-gray-400">Tim kreatif di balik Topupin</p>
        </div>

        <div class="flex flex-col items-center gap-8">
            <!-- Baris pertama: 4 kartu -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="group developer-card bg-[#242424] rounded-2xl overflow-hidden border border-gray-700/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#D7FD52]/10 hover:border-[#D7FD52]/50 hover:-translate-y-2">
                    <div class="relative">
                        <img src="{{ asset('assets/teammember/faris.jpeg') }}" alt="Faris Andi Muhammad" class="w-full h-[220px] object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-white text-xl font-semibold mb-1 transition-colors duration-300 group-hover:text-[#D7FD52]">Faris Andi Muhammad</h3>
                        <p class="text-gray-400 text-sm">Full-Stack Developer</p>
                    </div>
                </div>
                 <!-- Team Member 2 -->
                 <div class="group developer-card bg-[#242424] rounded-2xl overflow-hidden border border-gray-700/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#D7FD52]/10 hover:border-[#D7FD52]/50 hover:-translate-y-2">
                    <div class="relative">
                        <img src="{{ asset('assets/teammember/awan.jpeg') }}" alt="Anugrah Awan Cahya P" class="w-full h-[220px] object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-white text-xl font-semibold mb-1 transition-colors duration-300 group-hover:text-[#D7FD52]">Anugrah Awan Cahya P</h3>
                        <p class="text-gray-400 text-sm">Frontend Developer</p>
                    </div>
                </div>
                <!-- Team Member 3 -->
                <div class="group developer-card bg-[#242424] rounded-2xl overflow-hidden border border-gray-700/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#D7FD52]/10 hover:border-[#D7FD52]/50 hover:-translate-y-2">
                    <div class="relative">
                        <img src="{{ asset('assets/teammember/lauza.jpg') }}" alt="Nafal Lauza Hafidz A" class="w-full h-[220px] object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-white text-xl font-semibold mb-1 transition-colors duration-300 group-hover:text-[#D7FD52]">Nafal Lauza Hafidz A</h3>
                        <p class="text-gray-400 text-sm">Frontend Developer</p>
                    </div>
                </div>
                <!-- Team Member 4 -->
                <div class="group developer-card bg-[#242424] rounded-2xl overflow-hidden border border-gray-700/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#D7FD52]/10 hover:border-[#D7FD52]/50 hover:-translate-y-2">
                    <div class="relative">
                        <img src="{{ asset('assets/teammember/lina.JPG') }}" alt="Lina Rahmati" class="w-full h-[220px] object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-white text-xl font-semibold mb-1 transition-colors duration-300 group-hover:text-[#D7FD52]">Lina Rahmati</h3>
                        <p class="text-gray-400 text-sm">Frontend Developer</p>
                    </div>
                </div>
            </div>
            <!-- Baris kedua: 2 kartu -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <!-- Team Member 5 -->
                <div class="group developer-card bg-[#242424] rounded-2xl overflow-hidden border border-gray-700/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#D7FD52]/10 hover:border-[#D7FD52]/50 hover:-translate-y-2">
                    <div class="relative">
                        <img src="{{ asset('assets/teammember/hafidz.jpeg') }}" alt="Hafidz Ar Rofi" class="w-full h-[220px] object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-white text-xl font-semibold mb-1 transition-colors duration-300 group-hover:text-[#D7FD52]">Hafidz Ar Rofi</h3>
                        <p class="text-gray-400 text-sm">Frontend Developer</p>
                    </div>
                </div>
                <!-- Team Member 6 -->
                <div class="group developer-card bg-[#242424] rounded-2xl overflow-hidden border border-gray-700/50 transition-all duration-300 hover:shadow-xl hover:shadow-[#D7FD52]/10 hover:border-[#D7FD52]/50 hover:-translate-y-2">
                    <div class="relative">
                        <img src="{{ asset('assets/teammember/nopal.jpg') }}" alt="Ekananda Naufal Arif W" class="w-full h-[220px] object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="text-white text-xl font-semibold mb-1 transition-colors duration-300 group-hover:text-[#D7FD52]">Ekananda Naufal Arif W</h3>
                        <p class="text-gray-400 text-sm">Frontend Developer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Game Section (Awalnya terlihat) -->
    <div id="game-section" class="kategori-content" data-kategori="semua">
        <!-- Flash Sale -->
        <div class="kategori-content px-4 sm:px-6 mt-6" data-kategori="topup" style="display: none;">
             {{-- Konten Flash Sale Anda --}}
        </div>
        <!-- Game Populer -->
        <div class="py-8 px-6">
            <div class="flex justify-between items-center py-8">
                <h2 class="text-xl font-bold">GAME POPULER</h2>
                <a href="#" class="text-lime-400 font-bold">Lihat semua</a>
            </div>
            <div id="game-grid" class="md:px-16 lg:px-16 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 sm:gap-4">
                @if(isset($games) && $games->count() > 0)
                    @foreach ($games as $game)
                        <div class="game-card w-full flex flex-col">
                            <a href="{{ route('payout.create', ['game' => $game->slug]) }}">
                                <img src="{{ asset('assets/logogame/' . $game->thumbnail) }}" class="rounded-t-lg object-cover w-full aspect-video" alt="{{ $game->name }}">
                            </a>
                            <div class="bg-[#242424] rounded-b-lg px-4 py-2 flex-1 flex flex-col justify-between">
                                <div><h1 class="text-sm font-semibold break-words h-[40px] overflow-hidden">{{ $game->name }}</h1><p class="text-sm min-h-[20px] mt-1"></p></div>
                                <div class="pt-2">
                                    <a href="{{ route('payout.create', ['game' => $game->slug]) }}" class="block text-center mt-auto w-full py-1 bg-lime-400 rounded-lg text-black font-semibold hover:bg-lime-300 transition-colors">Beli</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="col-span-full text-center text-gray-400">Belum ada game yang tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- DITAMBAHKAN KEMBALI: Popup Notifikasi Promo --}}
<div id="promo-popup" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 transition-opacity duration-300">
    <div class="relative max-w-md mx-4">
        <img src="{{ asset('assets/promo/promo.png') }}" class="rounded-lg shadow-lg" alt="Iklan Promo">
        <button onclick="document.getElementById('promo-popup').style.display='none'"
                class="absolute -top-2 -right-2 bg-white text-black rounded-full w-8 h-8 flex items-center justify-center font-bold text-lg hover:bg-gray-200 transition-transform hover:scale-110">
            ✕
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ... (Logika Carousel Anda di sini) ...

    const categoryButtons = document.querySelectorAll('.kategori-btn');
    const teamSection = document.getElementById('team-section');
    const gameSection = document.getElementById('game-section');

    categoryButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const category = button.dataset.category;

            // Atur tombol aktif
            categoryButtons.forEach(btn => {
                btn.classList.remove('bg-lime-400', 'text-black');
                btn.classList.add('bg-zinc-800', 'text-white');
            });
            button.classList.add('bg-lime-400', 'text-black');
            button.classList.remove('bg-zinc-800', 'text-white');

            // Logika untuk menampilkan/menyembunyikan seksi
            if (category === 'tim') {
                teamSection.classList.remove('hidden');
                gameSection.classList.add('hidden');
            } else {
                teamSection.classList.add('hidden');
                gameSection.classList.remove('hidden');
            }
        });
    });

    document.querySelector('.kategori-btn[data-category="semua"]').click();

    // DITAMBAHKAN KEMBALI: Logika untuk menyembunyikan popup promo
    const promoPopup = document.getElementById('promo-popup');
    if(promoPopup) {
        // Sembunyikan popup setelah 5 detik
        setTimeout(() => {
            promoPopup.style.opacity = '0';
            // Tunggu transisi selesai sebelum menambahkan kelas hidden
            setTimeout(() => {
                promoPopup.style.display = 'none';
            }, 300); // 300ms sesuai dengan durasi transisi
        }, 5000);
    }

});
</script>
@endsection
