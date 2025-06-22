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
    </style>
</head>
<body class="bg-black text-white font-sans">

    <!-- Navbar -->
    <nav class="bg-[#242424] p-3 border-b border-gray-800 text-white fixed top-0 w-full z-50">
        <div class="flex justify-between items-center px-4 sm:px-6 lg:px-8">
            <!-- Logo -->
            <div class="text-lg font-bold">
                <a href="{{ route('home') }}">Topup<span class="text-[#D7FD52]">in</span></a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-2">
                <div class="relative">
                    <input type="text" class="bg-gray-700 text-gray-300 rounded-md px-3 py-2 w-48 focus:outline-none" placeholder="Search..." />
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-search text-gray-400"></i>
                    </button>
                </div>
                <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300">
                    <i class="fas fa-box"></i> Lacak Pesanan
                </a>
                @guest
                    <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="{{ route('register') }}" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300"><i class="fas fa-user-plus"></i> Daftar</a>
                @else
                    <a href="#" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300"><i class="fas fa-user"></i> {{ Auth::user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-md hover:bg-gray-700/50 hover:text-[#D7FD52] transition-colors duration-300"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                @endguest
            </div>

            <!-- Burger Button (Mobile) -->
            <button class="md:hidden block focus:outline-none" aria-label="Open main menu" onclick="toggleDropdown()">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Dropdown Menu -->
    <div id="dropdownMenu" class="fixed top-16 left-0 w-full bg-[#242424] text-white z-40 hidden animate-slide-down">
      <div class="flex flex-col px-6 py-4 space-y-4 border-t border-gray-700">
        {{-- Konten dropdown mobile --}}
      </div>
    </div>

    <!-- Main Content -->
    <main class="mt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#242424] mt-10 w-full">
      {{-- ... Konten Footer ... --}}
    </footer>

    {{-- SweetAlert2 Library --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      function toggleDropdown() {
        const menu = document.getElementById("dropdownMenu");
        menu.classList.toggle("hidden");
      }

      // DIUBAH: Menambahkan script untuk menampilkan notifikasi sukses
      @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#84cc16',
            background: '#1f2937',
            color: '#ffffff'
        });
      @endif

      // Menampilkan notifikasi error jika ada
      @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#ef4444',
            background: '#1f2937',
            color: '#ffffff'
        });
      @endif
    </script>
</body>
</html>
