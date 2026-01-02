<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Topup Saldo</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Midtrans Snap --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
             Topup Saldo
        </h2>

        {{-- Form Topup --}}
        <form id="topup-form" action="{{ url('/topup_saldo') }}" method="get" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nominal Topup (Rp)
                </label>
                <input type="number"
                       name="amount"
                       min="1000"
                       required
                       placeholder="Minimal Rp 1.000"
                       class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                Buat Pembayaran
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
    </div>

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

</body>
</html>
