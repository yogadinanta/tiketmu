<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Tiket</title>

    {{-- MIDTRANS SNAP --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,.1);
            text-align: center;
            width: 400px;
        }
        button {
            background: #2563eb;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background: #1e40af;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Pembayaran Tiket</h2>
    <p>Klik tombol di bawah untuk melanjutkan pembayaran</p>

    <button id="pay-button">Bayar Sekarang</button>
</div>

<script>
document.getElementById('pay-button').addEventListener('click', function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            console.log(result);

            // PAKAI order_id DARI MIDTRANS
            window.location.href = '/tiket/sukses?order_id=' + result.order_id;
        },
        onPending: function(result){
            alert('Menunggu pembayaran');
        },
        onError: function(result){
            alert('Pembayaran gagal');
        },
        onClose: function(){
            alert('Popup pembayaran ditutup');
        }
    });
});
</script>


</body>
</html>
