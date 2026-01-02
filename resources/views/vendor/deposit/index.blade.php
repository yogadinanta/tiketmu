@extends('layouts.vendor')

@section('title','Deposit Saldo')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-9xl mx-auto">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Deposit Saldo</h2>

    {{-- Form Deposit --}}
    <form id="topup-form" action="{{ url('/topup_saldo') }}" method="get">
        @csrf
        <label class="block text-sm font-medium text-gray-700 mb-2">Nominal Deposit</label>
        <input type="number"
                       name="amount"
                       min="1000"
                       required
                       placeholder="Minimal Rp 1.000"
               class="w-full border rounded-lg px-4 py-2 mb-2 focus:ring focus:ring-blue-200" required>
        <button type="submit"
                class="w-full bg-[#00345e] text-white py-2 rounded-lg font-semibold hover:opacity-90">
            Lanjutkan Pembayaran
        </button>
    </form>

            {{-- Tombol Bayar Sekarang, optional --}}
        @if(isset($snapToken))
            <hr class="my-6">
            <button id="pay-button"
                    class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                Bayar Sekarang
            </button>
        @endif

  @include('vendor.deposit.history')
  {{-- Midtrans Logic --}}
    <script>
        @if(isset($snapToken))

        // Jika snapToken tersedia, trigger pembayaran otomatis saat page load
        window.addEventListener('DOMContentLoaded', function() {
            
            // Optional: sembunyikan tombol Bayar karena otomatis
            const payButton = document.getElementById('pay-button');
            if(payButton) payButton.style.display = 'none';

            Swal.fire({
                title: 'Membuka Pembayaran',
                text: 'Mohon tunggu...',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading() }
            });

            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    Swal.fire({
                        icon: 'success',
                        title: 'Pembayaran Berhasil',
                        text: 'Saldo akan segera diproses.',
                        confirmButtonColor: '#16a34a'
                    });
                    console.log(result);
                },
                onPending: function(result){
                    Swal.fire({
                        icon: 'info',
                        title: 'Menunggu Pembayaran',
                        text: 'Silakan selesaikan pembayaran Anda.',
                        confirmButtonColor: '#2563eb'
                    });
                    console.log(result);
                },
                onError: function(result){
                    Swal.fire({
                        icon: 'error',
                        title: 'Pembayaran Gagal',
                        text: 'Terjadi kesalahan saat proses pembayaran.',
                        confirmButtonColor: '#dc2626'
                    });
                    console.log(result);
                },
                onClose: function(){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pembayaran Dibatalkan',
                        text: 'Anda menutup popup pembayaran.',
                        confirmButtonColor: '#f59e0b'
                    });
                }
            });
        });

        @endif
    </script>

@endsection
