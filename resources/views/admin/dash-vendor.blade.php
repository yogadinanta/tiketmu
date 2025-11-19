<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Vendor - Tiketmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- Font Awesome 6.6.0 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">



          

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex h-screen">


<!-- Sidebar -->
<aside id="sidebar"
       class="w-64 bg-[#00345e] text-gray-200 shadow-xl flex flex-col h-screen justify-between fixed top-0 left-0 transition-all duration-300 overflow-hidden z-50">
<!-- Toggle Button di Paling Atas -->
<button id="toggleSidebar"
    class="absolute top-4 right-4 bg-gray-900 text-white p-3 rounded-full shadow-2xl 
           hover:bg-gray-800 transition-transform duration-300 z-50">
    <i id="toggleIcon" class="fa-solid fa-arrow-left text-lg"></i>
</button>


    <!-- Header -->
    <div>
        <div class="p-6 border-b border-gray-700">
            <h1 id="sidebarTitle" class="text-2xl font-bold text-white tracking-wide">
                Tiketmu Vendor
            </h1>
        </div>

        <!-- Navigation -->
        <nav class="mt-6 space-y-1">

            <!-- Dashboard -->
           <a href="{{ route('vendor.dashboard') }}"
   class="flex items-center py-3 px-6 hover:bg-gray-700/40 hover:text-white transition rounded-lg">
    <i class="fa-solid fa-gauge-high text-xl w-8 mr-3"></i>
    <span class="menu-text font-medium">Dashboard</span>
</a>


            <!-- Riwayat -->
            <a href="{{ route('admin.layout.history') }}"
               id="linkRiwayat"
               class="flex items-center py-3 px-6 hover:bg-gray-700/40 hover:text-white transition rounded-lg">
                <i class="fas fa-receipt text-xl w-8 mr-3"></i>
                <span class="menu-text font-medium">Riwayat</span>
            </a>

            <!-- Produk -->
            <a href="#"
               class="flex items-center py-3 px-6 hover:bg-gray-700/40 hover:text-white transition rounded-lg">
                <i class="fas fa-box-open text-xl w-8 mr-3"></i>
                <span class="menu-text font-medium">Produk / Layanan</span>
            </a>
<a href="javascript:void(0)" id="profileLink"
   class="flex items-center py-3 px-6 hover:bg-gray-700/40 hover:text-white transition rounded-lg">
    <i class="fas fa-user text-xl w-8 mr-3"></i>
    <span class="menu-text font-medium">Profil</span>
</a>

        </nav>
    </div>

    <!-- Logout Section -->
    <div class="p-6 border-t border-gray-700">
        <form id="logoutForm" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="button"
                id="logoutButton"
                class="w-full flex items-center justify-center gap-2 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                <i class="fas fa-sign-out-alt text-xl"></i>
                <span class="menu-text">Logout</span>
            </button>
        </form>
    </div>
</aside>

<!-- Main Content -->
<div id="content" class="ml-64 transition-all duration-300 p-6">
    <!-- isi halaman -->
</div>

<!-- JS for Sidebar Toggle -->
<script>
let isCollapsed = false;

document.getElementById('toggleSidebar').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const texts = document.querySelectorAll('.menu-text');
    const title = document.getElementById('sidebarTitle');
    const toggleIcon = document.getElementById('toggleIcon');

    if (!isCollapsed) {
        // Collapse sidebar
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-20');
        content.classList.remove('ml-64');
        content.classList.add('ml-20');

        // Hide text
        texts.forEach(t => t.classList.add('hidden'));
        title.classList.add('hidden');

        // Change toggle icon
        toggleIcon.classList.remove('fa-arrow-left');
        toggleIcon.classList.add('fa-arrow-right');

        isCollapsed = true;
    } else {
        // Expand sidebar
        sidebar.classList.remove('w-20');
        sidebar.classList.add('w-64');
        content.classList.remove('ml-20');
        content.classList.add('ml-64');

        // Show text
        texts.forEach(t => t.classList.remove('hidden'));
        title.classList.remove('hidden');

        // Change toggle icon
        toggleIcon.classList.remove('fa-arrow-right');
        toggleIcon.classList.add('fa-arrow-left');

        isCollapsed = false;
    }
});
</script>


<!-- SweetAlert2 untuk konfirmasi logout -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Header biru full layar, di belakang sidebar -->
<div class="bg-[#00345e] text-white p-6 pl-72 shadow-md fixed top-0 left-0 w-full z-10 flex items-center justify-between">
    <!-- Bagian kiri: teks -->
    <div>
        <h2 class="text-3xl font-semibold">
            Selamat Datang, {{ Auth::user()->name }}!
        </h2>
        <p class="text-sm mt-0">Dashboard Vendor Tiketmu</p>
    </div>

    <!-- Bagian kanan: icon profil -->
    <div class="flex items-center gap-4">
        <a href="{{ route('profile.edit') }}" id="headerProfileLink" class="hover:opacity-80 transition">
            <i class="fas fa-user-circle text-3xl"></i>
        </a>
    </div>
</div>



<!-- Main content -->
<main class="flex-1 mt-24 p-6 overflow-y-auto" id="mainContent">
    <div class="bg-gray-100 p-6">
        @include('admin.layouts.add_event')
    </div>
</main>

</body>

<script>
document.getElementById('linkRiwayat').addEventListener('click', function (e) {
    e.preventDefault(); // cegah reload
    const url = this.getAttribute('href');

    // tampilkan loading
    const mainContent = document.getElementById('mainContent');
    mainContent.innerHTML = '<p class="text-gray-600">Memuat riwayat transaksi...</p>';

    // ambil isi halaman via AJAX
    fetch(url)
        .then(response => response.text())
        .then(html => {
            mainContent.innerHTML = html;
        })
        .catch(error => {
            console.error(error);
            mainContent.innerHTML = '<p class="text-red-500">Gagal memuat riwayat.</p>';
        });
});


// ========== LOGOUT KONFIRMASI =========
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
// =========== END LOGOUT KONFIRMASI ==========


// ====== PENYESUAIAN TEKS DI HEADER ======
const sidebar = document.getElementById('sidebar');
const header = document.querySelector('div.bg-[#00345e]');
document.getElementById('toggleSidebar').addEventListener('click', () => {
    if (!isCollapsed) {
        header.classList.replace('pl-72','pl-24'); // lebih kecil saat sidebar collapse
        isCollapsed = true;
    } else {
        header.classList.replace('pl-24','pl-72'); // kembali saat sidebar expand
        isCollapsed = false;
    }
});

</script>


</html>
