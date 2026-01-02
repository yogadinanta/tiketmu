<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Ticket</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous"
    />
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen py-12">

<div class="max-w-lg mx-auto bg-white rounded-3xl shadow-xl overflow-hidden">

    <!-- TOP BAR -->
    <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white p-6 text-center">
        <i class="fa-solid fa-ticket text-3xl mb-2"></i>
        <h1 class="text-2xl font-bold tracking-widest">E-TICKET</h1>
        <p class="text-sm opacity-90 mt-1">
            Tiket Resmi Event
        </p>
    </div>

    <!-- CONTENT -->
    <div class="p-8">

        <!-- STATUS -->
        <div class="flex items-center justify-center mb-6">
            <span class="inline-flex items-center gap-2 bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                <i class="fa-solid fa-circle-check"></i>
                PEMBAYARAN BERHASIL
            </span>
        </div>

        <!-- EVENT INFO -->
        <div class="text-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">
                {{ $transaksi->event->title ?? 'Nama Event' }}
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Diselenggarakan oleh
            </p>

            <p class="font-semibold text-indigo-700">
                {{ $transaksi->event->vendor->name 
                    ?? $transaksi->event->organizer_name 
                    ?? 'Vendor Penyelenggara' }}
            </p>
        </div>

        <!-- DIVIDER -->
        <div class="border-t border-dashed my-6"></div>

        <!-- DETAIL -->
        <div class="space-y-4 text-sm">

            <div class="flex justify-between">
                <span class="text-gray-500">Order ID</span>
                <span class="font-medium text-gray-800">
                    {{ $transaksi->order_id }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Jumlah Tiket</span>
                <span class="font-medium">
                    {{ $transaksi->quantity }} Tiket
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Total Pembayaran</span>
                <span class="font-semibold text-indigo-600">
                    Rp {{ number_format($transaksi->total_price, 0, ',', '.') }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Status</span>
                <span class="font-semibold text-green-600 uppercase">
                    {{ $transaksi->status }}
                </span>
            </div>

        </div>

        <!-- QR CODE -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500 mb-3">
                Scan QR Code saat check-in
            </p>

            <div class="inline-block bg-gray-50 p-4 rounded-xl border shadow-sm">
                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(180)->generate($transaksi->order_id) !!}
            </div>

            <p class="mt-3 text-xs tracking-widest text-gray-400">
                {{ $transaksi->order_id }}
            </p>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="bg-gray-50 text-center text-xs text-gray-500 py-4">
        <i class="fa-solid fa-circle-info mr-1"></i>
        Tunjukkan e-ticket ini kepada panitia saat masuk event
    </div>
<a
    href="{{ route('tiket.download', ['order_id' => $transaksi->order_id]) }}"
    class="mt-6 inline-flex items-center justify-center w-full gap-2 bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold"
>
    <i class="fa-solid fa-download"></i>
    Download E-Ticket (PDF)
</a>

</div>

</body>
</html>
