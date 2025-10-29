<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tiketmu</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('assets/icon/icon-tiketmu.svg') }}" alt="Tiketmu Logo" class="w-36 mx-auto mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Selamat Datang</h1>
            <p class="text-gray-500 mt-1">Masuk ke akun Tiketmu Anda</p>
        </div>

<form action="{{ route('login.post') }}" method="POST" class="space-y-5">
    @csrf
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

    <div class="flex items-center justify-between text-sm text-gray-600">
        <label class="flex items-center">
            <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 focus:ring-blue-500">
            Ingat saya
        </label>
        <a href="#" class="text-blue-600 hover:underline">Lupa Password?</a>
    </div>

    <button type="submit"
        class="w-full bg-[#3e89ff] text-white py-3 rounded-xl font-semibold hover:bg-blue-800 transition shadow-md">
        Masuk
    </button>
</form>


        <p class="mt-6 text-center text-gray-600 text-sm">
            Belum punya akun? <a href="/register" class="text-blue-600 font-medium hover:underline">Daftar Sekarang</a>
        </p>
    </div>

</body>
</html>
