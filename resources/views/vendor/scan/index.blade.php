@extends('layouts.vendor')

@section('title', 'Scan Tiket')

@push('styles')
<style>
    /* Kamera tidak mirror */
    #reader video {
        transform: scaleX(-1) !important;
    }
</style>
@endpush

@section('content')

<audio id="beep-success" src="https://actions.google.com/sounds/v1/cartoon/clang_and_wobble.ogg"></audio>
<audio id="beep-error" src="https://actions.google.com/sounds/v1/cartoon/boing.ogg"></audio>

<div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- ================= KIRI : SCAN ================= -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-bold text-center mb-4 flex items-center justify-center gap-2">
                <i class="fa-solid fa-qrcode"></i>
                Scan Tiket Masuk
            </h2>

            <!-- QR CAMERA -->
            <div id="reader" class="rounded overflow-hidden"></div>

            <!-- INPUT MANUAL -->
            <div class="mt-4">
                <label class="block text-sm font-medium mb-1">
                    <i class="fa-solid fa-keyboard mr-1"></i>
                    Input Order ID Manual
                </label>

                <div class="flex gap-2">
                    <input
                        type="text"
                        id="manualOrderId"
                        placeholder="Contoh: EVT-1767109791-8"
                        class="flex-1 border rounded px-3 py-2 text-sm"
                    >
                    <button
                        id="manualSubmit"
                        class="bg-[#f97316] text-white px-4 py-2 rounded text-sm flex items-center gap-1"
                    >
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Scan
                    </button>
                </div>
            </div>

            <!-- RESULT -->
            <div id="result" class="mt-4 text-center text-sm font-semibold"></div>
        </div>

        <!-- ================= KANAN : RIWAYAT ================= -->
        <div class="bg-white rounded-xl shadow p-4">
            <h3 class="font-semibold mb-2 flex items-center gap-2">
                <i class="fa-solid fa-clock-rotate-left text-gray-600"></i>
                Riwayat Scan
            </h3>

            <ul class="text-sm max-h-[420px] overflow-y-auto space-y-2">
                @forelse ($scans as $scan)
                    <li class="flex items-start gap-2 text-green-600 border-b pb-2">
                        <i class="fa-solid fa-circle-check mt-0.5"></i>

                        <div>
                            <div class="font-medium">
                                {{ $scan->order_id }}
                            </div>

                            <div class="text-xs text-gray-500 flex items-center gap-1">
                                {{ $scan->scanned_at->format('d M Y H:i') }}
                            </div>

                            <div class="text-xs text-gray-500 flex items-center gap-1">

                                {{ $scan->event->title }}
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="flex items-center gap-2 text-gray-400">
                        <i class="fa-regular fa-circle-xmark"></i>
                        Belum ada scan
                    </li>
                @endforelse
            </ul>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
document.addEventListener('DOMContentLoaded', async () => {

    const result   = document.getElementById('result');
    const beepOk   = document.getElementById('beep-success');
    const beepErr  = document.getElementById('beep-error');

    let isProcessing = false;
    const html5QrCode = new Html5Qrcode("reader");

    async function processScan(orderId) {
        if (!orderId) {
            alert('Order ID kosong');
            return;
        }

        result.innerHTML = `<span class="text-gray-500">Memproses...</span>`;

        try {
            const res = await fetch("{{ secure_url('/vendor/scan') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order_id: orderId })
            });

            const data = await res.json();

            if (data.status === 'success') {
                beepOk.play();
                result.innerHTML = `
                    <div class="bg-green-100 text-green-700 p-3 rounded">
                        ${data.message}<br>
                        <small>${data.data.event} | ${data.data.time}</small>
                    </div>
                `;
            } else {
                beepErr.play();
                result.innerHTML = `
                    <div class="bg-red-100 text-red-700 p-3 rounded">
                        ${data.message}
                    </div>
                `;
            }

        } catch (err) {
            result.innerHTML = `
                <div class="bg-red-100 text-red-700 p-3 rounded">
                    Server error / 500
                </div>
            `;
            console.error(err);
        }
    }

    // START QR
    try {
        await html5QrCode.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: 250, disableFlip: true },
            async (decodedText) => {
                if (isProcessing) return;
                isProcessing = true;

                await html5QrCode.pause();
                await processScan(decodedText);

                setTimeout(async () => {
                    isProcessing = false;
                    await html5QrCode.resume();
                }, 2000);
            }
        );
    } catch (err) {
        result.innerHTML = `<div class="text-red-600">Kamera tidak bisa diakses</div>`;
        console.error(err);
    }

    // MANUAL INPUT
    document.getElementById('manualSubmit').addEventListener('click', () => {
        processScan(document.getElementById('manualOrderId').value.trim());
    });

    document.getElementById('manualOrderId').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            processScan(e.target.value.trim());
        }
    });
});
</script>
@endpush
