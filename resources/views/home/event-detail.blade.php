@extends('layouts.app')

@section('title', $event->title)

@section('content')
<br>

<div class="max-w-7xl rounded-2xl shadow-2xl mx-auto p-12 md:p-20 bg-[#f8fafc] min-h-screen my-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- ================= KOLOM KIRI ================= --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- GAMBAR EVENT --}}
            <div class="relative">
                <img src="{{ asset('storage/' . $event->image) }}"
                     alt="{{ $event->title }}"
                     class="rounded-xl shadow-lg w-full object-cover">

                <div class="absolute top-4 left-4 bg-blue-600 text-white px-4 py-1 rounded-full text-sm shadow-md">
                    <i class="fa-solid fa-calendar-days mr-1"></i>
                    {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d M') }}
                </div>
            </div>

            {{-- JUDUL --}}
            <div>
                <h1 class="text-3xl font-bold mb-3 text-gray-900">
                    {{ $event->title }}
                </h1>

                <div class="space-y-2 text-sm text-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-calendar text-blue-600"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') }}
                            –
                            {{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('d F Y') }}
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-clock text-blue-600"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                            –
                            {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-location-dot text-blue-600"></i>
                        <span>{{ $event->location }}</span>
                    </div>
                </div>
            </div>

            {{-- DESKRIPSI --}}
            <div>
                <h2 class="text-2xl font-semibold mb-3 text-gray-800">Deskripsi</h2>
                <div class="text-gray-700 leading-relaxed">
                    {!! nl2br(e($event->description ?? 'Tidak ada deskripsi')) !!}
                </div>
            </div>
        </div>

        {{-- ================= KOLOM KANAN ================= --}}
        <div class="space-y-5">

            {{-- INFORMASI EVENT --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Informasi Event</h3>

                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500 mb-1">Kategori</p>
                        <span class="inline-flex bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $event->category ?? 'Umum' }}
                        </span>
                    </div>

                    <div>
                        <p class="text-gray-500 mb-1">Penyelenggara</p>
                        <span class="font-medium">
                            {{ $event->vendor->name ?? 'Vendor tidak diketahui' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- ================= HARGA & TIKET ================= --}}
            <div class="bg-white rounded-xl shadow-md p-6 space-y-4">

                {{-- TOTAL HARGA --}}
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 text-sm">Total Harga</span>
                    <span id="totalPrice"
                          data-price="{{ $event->price }}"
                          class="text-xl font-bold text-gray-900">
                        Rp{{ number_format($event->price, 0, ',', '.') }}
                    </span>
                </div>

                {{-- JUMLAH TIKET --}}
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Jumlah Tiket
                    </label>

                    <div class="flex items-center border rounded-lg overflow-hidden w-fit">
                        <button type="button"
                                onclick="decreaseQty()"
                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200">
                            −
                        </button>

                        <input type="number"
                               id="qty"
                               name="quantity"
                               value="1"
                               min="1"
                               onchange="updatePrice()"
                               class="w-14 text-center border-x focus:outline-none">

                        <button type="button"
                                onclick="increaseQty()"
                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200">
                            +
                        </button>
                    </div>
                </div>

                {{-- BUTTON BELI --}}
<form action="{{ route('events.buy', $event->id) }}" method="POST" id="buyForm">
    @csrf

    <input type="hidden" name="quantity" id="qtyHidden">

    <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold">
        <i class="fa-solid fa-ticket"></i>
        Beli Tiket
    </button>
</form>


            </div>

        </div>
    </div>
</div>

<br>
<script>
document.getElementById('buyForm').addEventListener('submit', function () {
    document.getElementById('qtyHidden').value =
        document.getElementById('qty').value;
});
</script>


{{-- ================= SCRIPT HITUNG HARGA ================= --}}
<script>
    const priceElement = document.getElementById('totalPrice');
    const qtyInput = document.getElementById('qty');
    const basePrice = parseInt(priceElement.dataset.price);

    function formatRupiah(number) {
        return 'Rp' + number.toLocaleString('id-ID');
    }

    function updatePrice() {
        let qty = parseInt(qtyInput.value);
        if (qty < 1 || isNaN(qty)) qty = 1;
        qtyInput.value = qty;

        const total = basePrice * qty;
        priceElement.innerText = formatRupiah(total);
    }

    function increaseQty() {
        qtyInput.value = parseInt(qtyInput.value) + 1;
        updatePrice();
    }

    function decreaseQty() {
        qtyInput.value = Math.max(1, qtyInput.value - 1);
        updatePrice();
    }
</script>

@endsection
