@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <p class="text-gray-400 mb-6">Selamat datang kembali! Berikut adalah ringkasan aktivitas di toko Anda.</p>

    {{-- Grid untuk Kartu Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Kartu Total Pengguna -->
        <div class="bg-[#242424] p-6 rounded-2xl flex items-center gap-6 border border-gray-800">
            <div class="bg-[#D7FD52]/10 p-4 rounded-full">
                <i class="fas fa-users fa-2x text-[#D7FD52]"></i>
            </div>
            <div>
                <p class="text-sm text-gray-400">Total Pengguna</p>
                <p class="text-2xl font-bold">{{ number_format($totalUsers) }}</p>
            </div>
        </div>

        <!-- Kartu Total Game -->
        <div class="bg-[#242424] p-6 rounded-2xl flex items-center gap-6 border border-gray-800">
            <div class="bg-sky-500/10 p-4 rounded-full">
                <i class="fas fa-gamepad fa-2x text-sky-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-400">Total Game</p>
                <p class="text-2xl font-bold">{{ number_format($totalGames) }}</p>
            </div>
        </div>

        <!-- Kartu Total Transaksi -->
        <div class="bg-[#242424] p-6 rounded-2xl flex items-center gap-6 border border-gray-800">
            <div class="bg-orange-500/10 p-4 rounded-full">
                <i class="fas fa-history fa-2x text-orange-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-400">Total Transaksi</p>
                <p class="text-2xl font-bold">{{ number_format($totalTransactions) }}</p>
            </div>
        </div>

        <!-- Kartu Total Pendapatan -->
        <div class="bg-[#242424] p-6 rounded-2xl flex items-center gap-6 border border-gray-800">
            <div class="bg-green-500/10 p-4 rounded-full">
                <i class="fas fa-dollar-sign fa-2x text-green-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-400">Total Pendapatan</p>
                <p class="text-2xl font-bold">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    {{-- Kontainer untuk Grafik --}}
    <div class="mt-8 bg-[#242424] p-6 rounded-2xl border border-gray-800">
        <h2 class="text-xl font-bold text-white mb-4">Pendapatan 7 Hari Terakhir</h2>
        <div>
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    {{-- Script untuk Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('revenueChart').getContext('2d');

            // Membuat gradasi warna untuk grafik
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(215, 253, 82, 0.6)');
            gradient.addColorStop(1, 'rgba(215, 253, 82, 0.05)');

            const revenueChart = new Chart(ctx, {
                type: 'line', // Tipe grafik
                data: {
                    labels: @json($chartLabels), // Label dari controller
                    datasets: [{
                        label: 'Pendapatan',
                        data: @json($chartData), // Data dari controller
                        backgroundColor: gradient, // Warna area di bawah garis
                        borderColor: '#D7FD52', // Warna garis
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4 // Membuat garis lebih melengkung
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#9ca3af', // Warna teks sumbu Y
                                callback: function(value, index, values) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)' // Warna garis grid
                            }
                        },
                        x: {
                            ticks: {
                                color: '#9ca3af' // Warna teks sumbu X
                            },
                            grid: {
                                display: false // Sembunyikan garis grid vertikal
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Sembunyikan legenda
                        }
                    }
                }
            });
        });
    </script>
@endsection
