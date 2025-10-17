<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Vendor - Tiketmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-blue-900">Tiketmu Vendor</h1>
        </div>
        <nav class="mt-6">
            <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-blue-100 hover:text-blue-900 transition rounded">Dashboard</a>
            <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-blue-100 hover:text-blue-900 transition rounded">Pesanan</a>
            <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-blue-100 hover:text-blue-900 transition rounded">Produk / Layanan</a>
            <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-blue-100 hover:text-blue-900 transition rounded">Profil</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-6 px-6">
                @csrf
                <button type="submit" class="w-full py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">Logout</button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Selamat Datang, Vendor!</h2>

        <div class="grid grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
                <h3 class="text-lg font-medium text-gray-700">Pesanan Hari Ini</h3>
                <p class="text-2xl font-bold mt-2 text-green-600">12</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
                <h3 class="text-lg font-medium text-gray-700">Produk Aktif</h3>
                <p class="text-2xl font-bold mt-2 text-blue-900">8</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
                <h3 class="text-lg font-medium text-gray-700">Pendapatan</h3>
                <p class="text-2xl font-bold mt-2 text-yellow-600">Rp 5.250.000</p>
            </div>
        </div>

        <!-- Ringkasan -->
        <div class="mt-8 bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Ringkasan Vendor</h3>
            <p class="text-gray-600">Di sini Anda dapat menampilkan grafik penjualan, laporan pesanan, atau update produk terbaru.</p>
        </div>
    </main>

</body>
</html>
