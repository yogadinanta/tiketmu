@extends('layouts.vendor')

@section('title','Pembayaran Deposit')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Pembayaran Deposit</h2>
    <p>Nominal deposit: <strong>Rp {{ number_format($deposit->nominal) }}</strong></p>
    <p>Order ID: <strong>{{ $deposit->order_id }}</strong></p>

    <button id="pay-button" class="bg-blue-600 text-white px-6 py-2 rounded mt-4">
        Bayar Sekarang
    </button>
</div>

<script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>


<script>
document.getElementById('pay-button').onclick = function() {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            console.log(result);
            window.location.href = "{{ route('vendor.deposit.success') }}?order_id={{ $deposit->order_id }}";
        },
        onPending: function(result){
            console.log(result);
            alert("Pembayaran sedang menunggu: " + result.status_message);
        },
        onError: function(result){
            console.log(result);
            alert("Terjadi kesalahan: " + result.status_message);
        },
        onClose: function(){
            alert('Anda menutup popup tanpa menyelesaikan pembayaran');
        }
    });
};
</script>
@endsection
