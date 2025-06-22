<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-200 font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#1a1a1a] text-white p-6 shadow-lg">
            <div class="mb-10">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-white">Topup<span class="text-[#D7FD52]">in</span></a>
                <p class="text-sm text-gray-400">Admin Panel</p>
            </div>
            <nav class="space-y-3">
                {{-- Menu Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                          {{ request()->routeIs('admin.dashboard') ? 'bg-[#242424] text-white' : 'text-gray-300 hover:bg-[#242424] hover:text-white' }}">
                    <i class="fas fa-tachometer-alt fa-fw"></i>
                    <span>Dashboard</span>
                </a>

                {{-- Menu Manage Games --}}
                <a href="{{ route('admin.games.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                          {{ request()->routeIs('admin.games.*') ? 'bg-[#242424] text-white' : 'text-gray-300 hover:bg-[#242424] hover:text-white' }}">
                    <i class="fas fa-gamepad fa-fw"></i>
                    <span>Manage Games</span>
                </a>

                {{-- Menu Topup Items --}}
                <a href="{{ route('admin.topup-items.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                          {{ request()->routeIs('admin.topup-items.*') ? 'bg-[#242424] text-white' : 'text-gray-300 hover:bg-[#242424] hover:text-white' }}">
                    <i class="fas fa-gem fa-fw"></i>
                    <span>Topup Items</span>
                </a>

                {{-- Menu Manage Accounts --}}
                <a href="{{ route('admin.accounts.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                          {{ request()->routeIs('admin.accounts.*') ? 'bg-[#242424] text-white' : 'text-gray-300 hover:bg-[#242424] hover:text-white' }}">
                    <i class="fas fa-user-shield fa-fw"></i>
                    <span>Manage Accounts</span>
                </a>

                {{-- Menu Transaksi --}}
                <a href="{{ route('admin.transactions.index') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                          {{ request()->routeIs('admin.transactions.*') ? 'bg-[#242424] text-white' : 'text-gray-300 hover:bg-[#242424] hover:text-white' }}">
                    <i class="fas fa-history fa-fw"></i>
                    <span>Transactions</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-white">@yield('title')</h1>
                @yield('header-button')
            </div>

            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500 text-green-300 px-4 py-3 rounded-lg mb-6" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-[#1a1a1a] p-6 rounded-2xl shadow-md">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>
