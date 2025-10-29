<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Vendor - Tiketmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- Font Awesome 6.6.0 CDN -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-KuCw6qIIBpZ9KxOKL4j4zjQeHnEgbJvAzgO4IMUWRN9k7G+WXwl38WZ2r9Kgfj/5RmEoLqQpxTjX36Q0yRr9BA=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex h-screen">

 <!-- Sidebar -->
<aside class="w-64 bg-white shadow-lg flex flex-col h-screen justify-between">
    <!-- Header -->
    <div>
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold text-blue-900">Tiketmu Vendor</h1>
        </div>

        <!-- Navigation -->
        <nav class="mt-6 space-y-1">
            <a href="#"
               class="flex items-center py-3 px-6 text-gray-700 hover:bg-blue-100 hover:text-blue-900 transition rounded">
                <i class="fa-solid fa-tachometer-alt w-5 mr-3 text-blue-700"></i>
                Dashboard
            </a>
            <a href="#"
               class="flex items-center py-3 px-6 text-gray-700 hover:bg-blue-100 hover:text-blue-900 transition rounded">
                <i class="fas fa-receipt w-5 mr-3 text-blue-700"></i>
                Pesanan
            </a>
            <a href="#"
               class="flex items-center py-3 px-6 text-gray-700 hover:bg-blue-100 hover:text-blue-900 transition rounded">
                <i class="fas fa-box-open w-5 mr-3 text-blue-700"></i>
                Produk / Layanan
            </a>
            <a href="#"
               class="flex items-center py-3 px-6 text-gray-700 hover:bg-blue-100 hover:text-blue-900 transition rounded">
                <i class="fas fa-user w-5 mr-3 text-blue-700"></i>
                Profil
            </a>
        </nav>
    </div>

    <!-- Logout Section -->
    <div class="p-6 border-t">
        <form id="logoutForm" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="button"
                id="logoutButton"
                class="w-full flex items-center justify-center gap-2 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </form>
    </div>
</aside>

<!-- SweetAlert2 untuk konfirmasi logout -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('logoutButton').addEventListener('click', function (e) {
    Swal.fire({
        title: 'Yakin mau logout?',
        text: "Kamu akan keluar dari akun vendor.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2563EB',
        cancelButtonColor: '#EF4444',
        confirmButtonText: 'Ya, logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logoutForm').submit();
        }
    });
});
</script>


    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Selamat Datang, Vendor!</h2>

        <div class="grid grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
                <h3 class="text-lg font-medium text-gray-700">Saldo Akun</h3>
                <p class="text-2xl font-bold mt-2 text-green-600">Rp {{ number_format(Auth::user()->vendorBalance->balance ?? 0, 0, ',', '.') }}
</p>
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
<script>
document.getElementById('logoutButton').addEventListener('click', function (e) {
    Swal.fire({
        title: 'Yakin mau logout?',
        text: "Kamu akan keluar dari akun ini.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logoutForm').submit();
        }
    });
});
</script>

</html>
