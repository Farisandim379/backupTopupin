<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topupin - @yield('title', 'Situs Top Up Terpercaya')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @stack('styles')
    <style>
      .scrollbar-hidden::-webkit-scrollbar { display: none; }
      .animate-slide-down { animation: slideDown 0.3s ease-out; }
      @keyframes slideDown {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
      }
      /* PERBAIKAN: Menambahkan style untuk layout sticky footer */
      html, body {
        height: 100%;
      }
      body {
        display: flex;
        flex-direction: column;
      }
      main {
        flex-grow: 1;
      }
    </style>
</head>
<body class="bg-black text-white font-sans">

    <!-- Navbar -->
    <nav class="bg-[#242424] p-3 border-b border-gray-800 text-white fixed top-0 w-full z-50">
        <div class="flex justify-between items-center px-4 sm:px-6 lg:px-8">
            {{-- Logo di Kiri --}}
            <div class="text-lg font-bold flex-shrink-0">
                <a href="{{ route('home') }}">Topup<span class="text-[#D7FD52]">in</span></a>
            </div>

            {{-- Grup item di Kanan --}}
            <div class="hidden md:flex items-center space-x-4">
                {{-- Search Bar --}}
                <div class="w-64">
                    <x-search-bar />
                </div>

                {{-- Tombol Otentikasi --}}
                @auth
                <a href="{{ route('user.transactions') }}" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300">
                    <i class="fas fa-box"></i> Riwayat
                </a>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-md bg-[#D7FD52] text-black font-semibold hover:bg-yellow-300 transition-colors duration-300">Daftar</a>
                @else
                    <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300"><i class="fas fa-user"></i> {{ Auth::user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300"><i class="fas fa-sign-out-alt"></i></button>
                    </form>
                @endguest
            </div>

            {{-- Tombol Burger untuk Mobile --}}
            <button id="burgerBtn" class="md:hidden block focus:outline-none" aria-label="Open main menu">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Dropdown Menu -->
    <div id="dropdownMenu" class="fixed top-[60px] left-0 w-full bg-[#242424] text-white z-40 hidden animate-slide-down">
      <div class="flex flex-col px-4 py-4 space-y-2 border-t border-gray-700">
          <div class="relative w-full mb-2">
              <x-search-bar />
          </div>
          @auth
          <a href="{{ route('user.transactions') }}" class="flex items-center gap-3 px-3 py-3 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300">
              <i class="fas fa-box w-5"></i>
              <span>Riwayat Transaksi</span>
          </a>
          @endauth
          @guest
              <a href="{{ route('login') }}" class="flex items-center gap-3 px-3 py-3 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300">
                  <i class="fas fa-sign-in-alt w-5"></i>
                  <span>Login</span>
              </a>
              <a href="{{ route('register') }}" class="flex items-center gap-3 px-3 py-3 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300">
                  <i class="fas fa-user-plus w-5"></i>
                  <span>Daftar</span>
              </a>
          @else
              <a href="#" class="flex items-center gap-3 px-3 py-3 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300">
                  <i class="fas fa-user w-5"></i>
                  <span>{{ Auth::user()->name }}</span>
              </a>
              <form method="POST" action="{{ route('logout') }}" class="w-full">
                  @csrf
                  <button type="submit" class="w-full flex items-center gap-3 px-3 py-3 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300 text-left">
                      <i class="fas fa-sign-out-alt w-5"></i>
                      <span>Logout</span>
                  </button>
              </form>
          @endguest
      </div>
    </div>

    {{-- PERBAIKAN: Tag <main> sekarang akan mengisi ruang yang tersedia --}}
    <main class="pt-20 px-4">
        @yield('content')
    </main>

    <footer class="bg-[#242424] mt-auto w-full">
      <div class="text-center p-4">
        &copy; {{ date('Y') }} Topupin. All Rights Reserved.
      </div>
    </footer>

    {{-- SweetAlert2 Library --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- SCRIPT TERPUSAT UNTUK SEMUA LOGIKA HALAMAN --}}
    <script>
      document.addEventListener('DOMContentLoaded', () => {

        const burgerBtn = document.getElementById('burgerBtn');
        const menu = document.getElementById('dropdownMenu');
        if(burgerBtn && menu) {
            burgerBtn.addEventListener('click', (event) => {
                event.stopPropagation();
                menu.classList.toggle('hidden');
            });
        }

        // --- LOGIKA UNTUK LIVE SEARCH BAR ---
        const handleSearch = (event) => {
            const inputElement = event.target;
            const query = inputElement.value;
            const parentContainer = inputElement.closest('.search-container');
            if (!parentContainer) return;
            const resultsContainer = parentContainer.querySelector('.search-results-container');
            if (!resultsContainer) return;

            if (query.length < 1) {
                resultsContainer.innerHTML = '';
                resultsContainer.style.display = 'none';
                return;
            }

            fetch(`{{ route('search') }}?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    resultsContainer.innerHTML = '';

                    if (data.length > 0) {
                        resultsContainer.style.display = 'block';
                        data.forEach(game => {
                            const resultLink = document.createElement('a');
                            resultLink.href = `/game/${game.slug}`;
                            resultLink.className = 'flex items-center p-3 hover:bg-gray-700/50 transition-colors duration-200 cursor-pointer';

                            const image = document.createElement('img');
                            image.src = game.thumbnail ? `/assets/logogame/${game.thumbnail}` : 'https://placehold.co/48x48/2a2a2e/FFF?text=?';
                            image.alt = game.name;
                            image.className = 'w-16 h-10 object-cover rounded-md flex-shrink-0';

                            const textContainer = document.createElement('div');
                            textContainer.className = 'ml-4';

                            const title = document.createElement('div');
                            title.className = 'font-semibold text-white';
                            title.textContent = game.name;

                            textContainer.appendChild(title);
                            resultLink.appendChild(image);
                            resultLink.appendChild(textContainer);
                            resultsContainer.appendChild(resultLink);
                        });
                    } else {
                        resultsContainer.style.display = 'block';
                        resultsContainer.innerHTML = `<div class="px-4 py-3 text-sm text-gray-400">Tidak ada hasil ditemukan.</div>`;
                    }
                })
                .catch(error => console.error('Error fetching search results:', error));
        };

        const allSearchInputs = document.querySelectorAll('.live-search-input');
        allSearchInputs.forEach(input => {
            input.addEventListener('keyup', handleSearch);
        });

        window.addEventListener('click', (e) => {
            document.querySelectorAll('.search-container').forEach(container => {
                if (!container.contains(e.target)) {
                    const results = container.querySelector('.search-results-container');
                    if(results) results.style.display = 'none';
                }
            });
            if (menu && !menu.classList.contains('hidden') && !menu.contains(e.target) && e.target !== burgerBtn) {
                menu.classList.add('hidden');
            }
        });

        // --- LOGIKA UNTUK SWEETALERT ---
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: @json(session('success')), confirmButtonColor: '#84cc16', background: '#1f2937', color: '#ffffff' });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: @json(session('error')), confirmButtonColor: '#ef4444', background: '#1f2937', color: '#ffffff' });
        @endif
      });
    </script>
</body>
</html>

