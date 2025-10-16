<header class="bg-white shadow-sm" x-data="{ open: false }">
  <div class="max-w-7xl mx-auto flex justify-between items-center px-6 md:px-10 py-4">

    <!-- Left: Logo + Navigation -->
    <div class="flex items-center space-x-10">
      <!-- Logo -->
      <div class="flex items-center space-x-2">
        <img src="{{ asset('assets/icon/icon-tiketmu.svg') }}"
             alt="Logo Tiketmu"
             class="h-8 md:h-10 object-contain">
      </div>

      <!-- Navigation -->
      <nav class="hidden md:flex items-center space-x-8 text-[15px] font-semibold text-[#0E234B]">
        <a href="#" class="hover:text-blue-800 transition">Features</a>
        <a href="#" class="hover:text-blue-800 transition">Promos</a>
        <a href="#" class="hover:text-blue-800 transition">Updates</a>
        <a href="#" class="flex items-center hover:text-blue-800 transition">
          Loket.com
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M14 3h7m0 0v7m0-7L10 14m-4 7h7" />
          </svg>
        </a>
      </nav>
    </div>

    <!-- Right: Button -->
    <div class="flex items-center space-x-4">
      <!-- Hamburger Button (Mobile) -->
      <button @click="open = !open" class="md:hidden text-[#0E234B] focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Desktop Button -->
      <a href="#" class="hidden md:inline bg-[#3E89FF] text-[#ffffff] font-semibold px-5 py-2.5 rounded-full shadow-md hover:bg-yellow-400 transition">
        Login Tiketmu
      </a>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div x-show="open" x-transition class="md:hidden bg-white border-t border-gray-200 px-6 py-4 space-y-3 text-[#0E234B] text-[15px] font-semibold">
    <a href="#" class="block hover:text-blue-800 transition">Features</a>
    <a href="#" class="block hover:text-blue-800 transition">Promos</a>
    <a href="#" class="block hover:text-blue-800 transition">Updates</a>
    <a href="#" class="hover:text-blue-800 transition flex items-center">
      Loket.com
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M14 3h7m0 0v7m0-7L10 14m-4 7h7" />
      </svg>
    </a>
    <a href="#" class="block bg-[#FFC107] text-[#0E234B] text-center px-5 py-2.5 rounded-full shadow-md hover:bg-yellow-400 transition">
      Login Tiketmu
    </a>
  </div>
</header>
