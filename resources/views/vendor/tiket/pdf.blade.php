<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #f3f4f6;
        }
        .ticket {
            width: 100%;
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            border: 2px dashed #4f46e5;
        }
        h1 {
            text-align: center;
            color: #4f46e5;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .label {
            color: #6b7280;
        }
        .qr {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="ticket">
    <h1>E-TICKET</h1>

    <p style="text-align:center;color:green;font-weight:bold;">
        PEMBAYARAN BERHASIL
    </p>

    <div class="row">
        <span class="label">Event</span>
        <span>{{ $transaksi->event->title }}</span>
    </div>

    <div class="row">
        <span class="label">Order ID</span>
        <span>{{ $transaksi->order_id }}</span>
    </div>

    <div class="row">
        <span class="label">Jumlah Tiket</span>
        <span>{{ $transaksi->quantity }}</span>
    </div>

    <div class="row">
        <span class="label">Total</span>
        <span>
            Rp {{ number_format($transaksi->total_price, 0, ',', '.') }}
        </span>
    </div>

    <div class="qr">
        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(120)->generate($transaksi->order_id) !!}
        <p style="font-size:12px;color:#9ca3af">
            {{ $transaksi->order_id }}
        </p>
    </div>

</div>

</body>
</html>
