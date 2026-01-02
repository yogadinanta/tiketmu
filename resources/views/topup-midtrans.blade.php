@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow text-center">
    <h2 class="text-xl font-bold mb-4">Pembayaran Topup</h2>
    <button id="pay-button" class="bg-green-600 text-white py-2 px-4 rounded">Bayar Sekarang</button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert('Pembayaran berhasil!');
                window.location.href = '/'; // redirect setelah sukses
            },
            onPending: function(result){
                alert('Pembayaran pending!');
            },
            onError: function(result){
                alert('Pembayaran gagal!');
            }
        });
    });
</script>
@endsection
