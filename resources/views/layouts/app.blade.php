<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topupin - @yield('title', 'Situs Top Up Terpercaya')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
        <div class="flex justify-between items-center max-w-screen-xl mx-auto px-4">
            <!-- Logo -->
            <div class="text-lg font-bold">
                <a href="{{ route('home') }}">Topup<span class="text-[#D7FD52]">in</span></a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-4">
                <div class="relative">
                    <input type="text" class="bg-gray-700 text-gray-300 rounded px-3 py-1 w-48 focus:outline-none" placeholder="Search..." />
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-search text-gray-400"></i>
                    </button>
                </div>
                <a href="#" class="hover:text-[#D7FD52] flex items-center gap-1">
                    <i class="fas fa-box"></i> Lacak Pesanan
                </a>
                @guest
                    <a href="{{ route('login') }}" class="hover:text-[#D7FD52]"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="{{ route('register') }}" class="hover:text-[#D7FD52]"><i class="fas fa-user-plus"></i> Daftar</a>
                @else
                    <a href="#" class="hover:text-[#D7FD52]">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-[#D7FD52]"><i class="fas fa-sign-out-alt"></i> Logout</button>
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
    <div id="dropdownMenu" class="fixed top-14 left-0 w-full bg-[#242424] text-white z-40 hidden animate-slide-down">
      <div class="flex flex-col px-6 py-4 space-y-4 border-t border-gray-700">
        <!-- Konten dropdown mobile sama seperti desktop -->
      </div>
    </div>

    <!-- Main Content -->
    <main class="mt-14">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#242424] mt-10 rounded-t-[15px] w-full">
      <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between mb-6">
            <!-- Left -->
            <div class="mb-4 md:mb-0">
                <div class="text-xl font-bold mb-1 text-white font-sans">Topup<span class="text-[#D7FD52]">in</span></div>
                <div class="text-sm text-gray-400 font-sans">Game Voucher</div>
            </div>

            <!-- Right -->
            <div class="text-right">
                <div class="text-sm font-semibold mb-2 text-white font-sans">Metode Pembayaran</div>
                <!-- Payment methods -->
            </div>
        </div>

        <!-- Footer bawah -->
        <div class="border-t border-gray-800 pt-4 flex flex-wrap gap-4 justify-center md:justify-start text-xs text-gray-500 font-sans">
            <span>©2024</span> <span>Privacy</span> <span>Terms</span> <span>Sitemap</span> <span>Blog</span>
        </div>
      </div>
    </footer>

    <script>
      function toggleDropdown() {
        const menu = document.getElementById("dropdownMenu");
        menu.classList.toggle("hidden");
      }
    </script>
</body>
</html>
