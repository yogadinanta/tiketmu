<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Event Detail')</title>

    {{-- Tailwind & Font --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Alpine.js --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>

    @vite('resources/css/app.css')
    @stack('styles')
</head>

<body class="bg-white text-gray-800">

    {{-- ===== HEADER NAVBAR ===== --}}
    <header class="bg-white fixed top-0 left-0 w-full z-50 shadow-sm" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 md:px-10 py-4">

            {{-- LEFT: LOGO + NAV --}}
            <div class="flex items-center space-x-10">
                {{-- Logo --}}
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('assets/icon/icon-tiketmu.svg') }}"
                         alt="Logo Tiketmu"
                         class="h-8 md:h-10 object-contain">
                </div>

                {{-- Navigation --}}
                <nav class="hidden md:flex items-center space-x-8 text-[15px] font-semibold text-[#0E234B]">
                    <a href="#" class="hover:text-blue-800 transition">Features</a>
                    <a href="#" class="hover:text-blue-800 transition">Promos</a>
                    <a href="#" class="hover:text-blue-800 transition">Updates</a>
                    <a href="/screen" class="flex items-center hover:text-blue-800 transition">
                        Screen.tiket
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M14 3h7m0 0v7m0-7L10 14m-4 7h7" />
                        </svg>
                    </a>
                </nav>
            </div>

            {{-- RIGHT: USER / LOGIN / TOGGLE --}}
            <div class="flex items-center space-x-4">
                {{-- Hamburger Button (Mobile) --}}
                <button @click="open = !open" class="md:hidden text-[#0E234B] focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                {{-- User / Login --}}
                @guest
                    {{-- Jika belum login --}}
                    <a href="/login"
                       class="hidden md:inline bg-[#3E89FF] text-white font-semibold px-5 py-2.5 rounded-full shadow-md hover:bg-yellow-400 transition">
                        Login Tiketmu
                    </a>
                @endguest

                @auth
                    {{-- Jika sudah login --}}
                    <div class="hidden md:flex items-center space-x-3">
                        {{-- Nama User --}}
                        <button disabled
                            class="bg-gray-200 text-gray-700 font-semibold px-5 py-2.5 rounded-full shadow-md cursor-not-allowed">
                            {{ Auth::user()->name }}
                        </button>

                        {{-- Tombol Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-red-500 text-white font-semibold px-4 py-2.5 rounded-full shadow-md hover:bg-red-600 transition">
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>

        {{-- MOBILE MENU --}}
        <div x-show="open" x-transition
             class="md:hidden bg-white border-t border-gray-200 px-6 py-4 space-y-3 text-[#0E234B] text-[15px] font-semibold">
            <a href="#" class="block hover:text-blue-800 transition">Features</a>
            <a href="#" class="block hover:text-blue-800 transition">Promos</a>
            <a href="#" class="block hover:text-blue-800 transition">Updates</a>
            <a href="#" class="flex items-center hover:text-blue-800 transition">
                Loket.com
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M14 3h7m0 0v7m0-7L10 14m-4 7h7" />
                </svg>
            </a>

            @guest
                <a href="/login"
                   class="block bg-[#FFC107] text-[#0E234B] text-center px-5 py-2.5 rounded-full shadow-md hover:bg-yellow-400 transition">
                    Login Tiketmu
                </a>
            @endguest

            @auth
                <div class="space-y-2">
                    <p class="bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-full shadow-md text-center">
                        {{ Auth::user()->name }}
                    </p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full bg-red-500 text-white font-semibold px-4 py-2.5 rounded-full shadow-md hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </header>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="max-w-7xl mx-auto mt-8 px-6 md:px-10">
        @yield('content')
    </main>

    {{-- ===== FOOTER (opsional) ===== --}}

    

<br>
<br>
<footer class="bg-[#103552] text-white py-24">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">

        <!-- Logo & Deskripsi -->
        <div>
            <h2 class="text-2xl font-bold mb-2">Tiketmu</h2>
            <p class="text-sm opacity-80">Your Professional Ticketing Partner</p>
        </div>

        <!-- Tentang Kami -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Tentang Kami</h3>
            <ul class="space-y-2 text-sm opacity-90">
                <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                <li><a href="#" class="hover:underline">Panduan Penyelenggara</a></li>
                <li><a href="#" class="hover:underline">Hubungi Kami</a></li>
                <li><a href="#" class="hover:underline">Biaya</a></li>
            </ul>
        </div>

        <!-- Informasi -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Informasi</h3>
            <ul class="space-y-2 text-sm opacity-90">
                <li><a href="#" class="hover:underline">Syarat & Ketentuan</a></li>
                <li><a href="#" class="hover:underline">Kebijakan Privasi & Pemrosesan Data</a></li>
                <li><a href="#" class="hover:underline">FAQ</a></li>
                <li><a href="#" class="hover:underline">Tiket Gelang</a></li>
            </ul>
        </div>

        <!-- Kategori Event -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Kategori Event</h3>
            <ul class="space-y-2 text-sm opacity-90">
                <li><a href="#" class="hover:underline">Musik</a></li>
                <li><a href="#" class="hover:underline">Pameran</a></li>
                <li><a href="#" class="hover:underline">Wahana</a></li>
                <li><a href="#" class="hover:underline">Olahraga</a></li>
                <li><a href="#" class="hover:underline">Semua Kategori</a></li>
            </ul>
        </div>
    </div>

    <!-- Garis Pemisah -->
    <div class="border-t border-white/20 my-8"></div>

    <!-- Copyright & Sosial Media -->
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-sm">
        <p class="mb-4 md:mb-0 opacity-80"> &copy; {{ date('Y') }} Tiketmu. Hak Cipta Dilindungi.</p>
        <div class="flex space-x-5 text-lg">
            <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-whatsapp"></i></a>
            <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-tiktok"></i></a>
            <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-linkedin"></i></a>
            <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-youtube"></i></a>
            <a href="#" class="hover:text-gray-300"><i class="fa-brands fa-facebook"></i></a>
        </div>
    </div>
</footer>

    @stack('scripts')
</body>
</html>
