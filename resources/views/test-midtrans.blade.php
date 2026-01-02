<!DOCTYPE html>
<html>
<head>
    <title>Test Midtrans Sandbox</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
</head>
<body>

<h2>Topup Saldo</h2>

<form id="topup-form" action="{{ url('/test-midtrans') }}" method="get">
    <label>Nominal Topup (Rp):</label>
    <input type="number" name="amount" min="1000" required>
    <button type="submit">Buat Pembayaran</button>
</form>

@if(isset($snapToken))
    <button id="pay-button">Bayar Sekarang</button>
@endif

<script>
@if(isset($snapToken))
document.getElementById('pay-button').addEventListener('click', function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            alert("Pembayaran berhasil");
            console.log(result);
        },
        onPending: function(result){
            alert("Menunggu pembayaran");
            console.log(result);
        },
        onError: function(result){
            alert("Pembayaran gagal");
            console.log(result);
        },
        onClose: function(){
            alert("Popup ditutup");
        }
    });
});
@endif
</script>

</body>
</html>
