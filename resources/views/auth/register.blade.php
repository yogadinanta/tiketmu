<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tokopay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md">
        <div class="text-center mb-6">
            <img src="https://via.placeholder.com/120x60?text=Tokopay" alt="Tokopay Logo" class="mx-auto mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h1>
            <p class="text-gray-500 mt-1">Daftar untuk mulai menggunakan Tokopay</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" required
                    class="mt-2 block w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm"
                    value="{{ old('name') }}">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="mt-2 block w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm"
                    value="{{ old('email') }}">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="mt-2 block w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition shadow-sm">
            </div>

            <div class="flex items-center text-sm text-gray-600">
                <input type="checkbox" name="agree_terms" class="mr-2 rounded border-gray-300 focus:ring-blue-500" required>
                Saya setuju dengan <a href="#" class="text-blue-600 hover:underline">Syarat dan Ketentuan</a>
            </div>

            <button type="submit"
                class="w-full bg-blue-900 text-white py-3 rounded-xl font-semibold hover:bg-blue-800 transition shadow-md">
                Daftar
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600 text-sm">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Masuk Sekarang</a>
        </p>
    </div>

</body>
</html>
