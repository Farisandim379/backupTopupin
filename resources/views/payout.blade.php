@extends('layouts.app')

@section('title', 'Pembayaran - ' . $game->name)

@section('content')
<div class="bg-black text-white p-6 rounded-lg container mx-auto my-6 px-4">
    <!-- Tombol Kembali -->
    <div class="mb-6">
        <a href="{{ route('home') }}" class="text-white hover:text-[#D7FD52] flex items-center gap-2 w-fit">
            <i class="fas fa-arrow-left"></i> <span class="font-bold">Kembali</span>
        </a>
    </div>
    <!-- Product Header -->
    <div class="bg-black text-white p-4 rounded flex flex-col sm:flex-row items-center mb-5">
        <div class="mr-0 sm:mr-4 mb-4 sm:mb-0">
            <img src="{{ asset('assets/logogame/' . $game->thumbnail) }}" alt="{{ $game->name }} Logo" class="w-20 h-20 rounded">
        </div>
        <div class="text-center sm:text-left">
            <h1 class="text-lg font-bold">{{ $game->name }}</h1>
            <p class="text-sm text-gray-400">Top Up {{ $game->name }} murah & proses instan di Topupin.</p>
        </div>
    </div>

    {{-- Form utama yang akan mengirim data ke controller --}}
    <form id="checkoutForm" method="POST" action="{{ route('payout.store') }}">
        @csrf
        {{-- Input tersembunyi untuk data penting --}}
        <input type="hidden" name="game_id" value="{{ $game->id }}">
        <input type="hidden" name="nominal_amount" id="hidden-nominal-amount">
        <input type="hidden" name="price" id="hidden-price">
        <input type="hidden" name="payment_method" id="hidden-payment-method">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Left Section - Nominal Selection -->
            <div class="md:col-span-2">
                <div class="bg-[#D7FD52] text-black p-3 rounded-t-[15px] font-bold">Pilih Nominal</div>
                <div class="bg-[#242424] p-4 rounded-b-lg">
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @forelse($topupItems as $item)
                            <div class="nominal-card border border-gray-600 bg-[#242424] rounded-lg cursor-pointer hover:border-[#D7FD52]" data-price="{{ $item->price }}" data-amount="{{ $item->name }}">
                                <div class="p-4 flex justify-center"><img src="{{ asset('assets/diamondgame/diamondcalo.png') }}" alt="Item" class="w-12 h-12"></div>
                                <div class="p-2 text-center text-sm">{{ $item->name }}</div>
                                <div class="bg-[#D7FD52] text-black text-center p-1 rounded-b-lg font-semibold">Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-400">Item top up untuk game ini belum tersedia.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Payment Method Section -->
                <div class="mt-6">
                    <div class="bg-[#D7FD52] text-black p-3 rounded-t-[15px] font-bold">Pilih Metode Pembayaran</div>
                    <div class="bg-[#242424] p-4 rounded-b-[15px]">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <div class="payment-method bg-white rounded-lg p-2 flex items-center justify-center cursor-pointer border-2 border-transparent hover:border-[#D7FD52]" data-method="OVO"><img src="{{ asset('assets/logopembayaran/ovo.png') }}" alt="OVO" class="h-8"></div>
                            <div class="payment-method bg-white rounded-lg p-2 flex items-center justify-center cursor-pointer border-2 border-transparent hover:border-[#D7FD52]" data-method="QRIS"><img src="{{ asset('assets/logopembayaran/qris.png') }}" alt="QRIS" class="h-8"></div>
                            <div class="payment-method bg-white rounded-lg p-2 flex items-center justify-center cursor-pointer border-2 border-transparent hover:border-[#D7FD52]" data-method="DANA"><img src="{{ asset('assets/logopembayaran/dana.png') }}" alt="DANA" class="h-8"></div>
                            <div class="payment-method bg-white rounded-lg p-2 flex items-center justify-center cursor-pointer border-2 border-transparent hover:border-[#D7FD52]" data-method="Blu"><img src="{{ asset('assets/logopembayaran/blu.png') }}" alt="Blu" class="h-8"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section - Checkout -->
            <div class="bg-[#242424] rounded-[16px] shadow-lg text-white font-sans self-start">
                <div class="text-center bg-[#D7FD52] text-black font-bold py-3 text-lg rounded-t-[16px]">Checkout</div>
                <div class="px-6 py-7 space-y-5 text-sm">

                    {{-- DITAMBAHKAN: Blok untuk menampilkan error validasi --}}
                    @if ($errors->any())
                        <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded-lg relative" role="alert">
                            <strong class="font-bold">Oops! Terjadi kesalahan:</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex flex-col gap-2">
                        <label class="font-semibold">No. WhatsApp <span class="text-[#D7FD52] font-normal">(opsional)</span></label>
                        <input type="tel" name="whatsapp_number" id="whatsapp" placeholder="Nomor WhatsApp" class="w-full bg-white text-black rounded-[8px] px-4 py-2 text-sm placeholder-gray-500 focus:outline-none">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-semibold">User ID <span class="text-red-500">*</span></label>
                        <input type="text" name="game_user_id" id="userId" placeholder="Masukkan User ID" class="w-full bg-white text-black rounded-[8px] px-4 py-2 text-sm focus:outline-none" required>
                    </div>
                    @if($game->needs_server_id)
                    <div class="flex flex-col gap-2">
                        <label class="font-semibold">Server <span class="text-red-500">*</span></label>
                        <input type="text" name="game_server" id="server" placeholder="Masukkan Server" class="w-full bg-white text-black rounded-[8px] px-4 py-2 text-sm focus:outline-none" required>
                    </div>
                    @endif
                    <p class="font-semibold mt-4 mb-2">Ringkasan Pesanan</p>
                    <div class="bg-[#1a1a1a] border border-[#D7FD52]/50 rounded-[18px] p-4 space-y-2 text-sm">
                        <div class="flex justify-between"><span>Item</span><span id="amount-display">-</span></div>
                        <div class="flex justify-between"><span>Metode</span><span id="payment-method-display">-</span></div>
                        <div class="flex justify-between font-semibold text-[#D7FD52] pt-2 border-t border-gray-600"><span>Total</span><span id="total-price-display">Rp0</span></div>
                    </div>
                    <button type="submit" class="w-full bg-[#D7FD52] text-black font-bold py-3 rounded-[10px] text-sm mt-4 hover:bg-lime-300 transition-colors">Beli Sekarang</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let selectedPrice = null;
    let selectedAmount = null;
    let selectedPayment = null;

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    }

    function updateSummary() {
        document.getElementById('hidden-price').value = selectedPrice;
        document.getElementById('hidden-nominal-amount').value = selectedAmount;
        document.getElementById('hidden-payment-method').value = selectedPayment;

        document.getElementById('amount-display').innerText = selectedAmount || '-';
        document.getElementById('payment-method-display').innerText = selectedPayment || '-';
        document.getElementById('total-price-display').innerText = selectedPrice ? formatRupiah(selectedPrice) : 'Rp0';
    }

    document.querySelectorAll('.nominal-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll('.nominal-card').forEach(c => c.classList.remove('ring-2', 'ring-[#D7FD52]'));
            this.classList.add('ring-2', 'ring-[#D7FD52]');
            selectedPrice = this.dataset.price;
            selectedAmount = this.dataset.amount;
            updateSummary();
        });
    });

    document.querySelectorAll('.payment-method').forEach(method => {
        method.addEventListener('click', function() {
            document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('ring-2', 'ring-[#D7FD52]'));
            this.classList.add('ring-2', 'ring-[#D7FD52]');
            selectedPayment = this.dataset.method;
            updateSummary();
        });
    });
});
</script>
@endsection
