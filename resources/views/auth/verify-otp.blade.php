<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 flex justify-center items-center min-h-screen">

<div class="bg-white p-8 rounded-3xl shadow-xl w-full max-w-md">
    <h2 class="text-xl font-bold mb-3">Verifikasi OTP</h2>
    <p class="text-gray-600 mb-3">Masukkan kode OTP yang dikirim ke email Anda.</p>

    @if(session('error'))
        <div class="text-red-600 mb-3">{{ session('error') }}</div>
    @endif

    <form action="{{ route('otp.verify') }}" method="POST">
        @csrf
        <input type="text" name="otp" maxlength="6"
               class="w-full border rounded-xl p-3 mb-4"
               placeholder="Masukkan OTP" required>

        <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold">
            Verifikasi
        </button>
    </form>
</div>

</body>
</html>
