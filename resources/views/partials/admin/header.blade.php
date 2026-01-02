<header
    class="fixed top-0 left-0 w-full h-16 bg-white border-b border-gray-200
           z-40 flex items-center justify-between pl-72 pr-6" id="header">

    <!-- LEFT -->
    <div class="flex items-center gap-4">
        <button id="toggleSidebar"
                class="text-gray-600 hover:text-gray-900 transition">
            <i id="toggleIcon" class="fa-solid fa-bars text-xl"></i>
        </button>
    </div>

    <!-- RIGHT -->
    <div class="relative">
        <!-- TRIGGER -->
        <button id="profileButton"
            class="flex items-center gap-3 focus:outline-none">

            <div class="text-right leading-tight hidden sm:block">
                <p class="text-sm font-semibold text-gray-800">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-xs text-gray-500">
                    {{ Auth::user()->email }}
                </p>
            </div>

            <div
                class="w-10 h-10 rounded-full bg-gray-300
                       flex items-center justify-center
                       font-semibold text-gray-700">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </button>

        <!-- DROPDOWN -->
        <div id="profileDropdown"
            class="hidden absolute right-0 mt-3 w-48 bg-white rounded-xl
                   shadow-lg border border-gray-100 overflow-hidden">

            <!-- Ubah Password -->
            <a href="#"
               class="flex items-center gap-3 px-4 py-3
                      text-sm text-gray-700 hover:bg-gray-100 transition">
                <i class="fa-solid fa-key text-gray-500"></i>
                Ubah Password
            </a>

            <div class="border-t border-gray-100"></div>

            <!-- Logout -->
            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="button" id="logoutButton"
                    class="w-full flex items-center gap-3 px-4 py-3
                           text-sm text-red-600 hover:bg-red-50 transition">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>
<script>
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const header = document.getElementById('header');
    const toggleBtn = document.getElementById('toggleSidebar');
    const toggleIcon = document.getElementById('toggleIcon');

    let isOpen = true;

    toggleBtn.addEventListener('click', () => {
        isOpen = !isOpen;

        if (!isOpen) {
            // Sidebar tutup
            sidebar.classList.add('-translate-x-full');

            content.classList.remove('ml-64');
            content.classList.add('ml-0');

            header.classList.remove('pl-72');
            header.classList.add('pl-6');

            toggleIcon.classList.replace('fa-bars', 'fa-xmark');
        } else {
            // Sidebar buka
            sidebar.classList.remove('-translate-x-full');

            content.classList.add('ml-64');
            content.classList.remove('ml-0');

            header.classList.add('pl-72');
            header.classList.remove('pl-6');

            toggleIcon.classList.replace('fa-xmark', 'fa-bars');
        }
    });
</script>


<script>
    const profileBtn = document.getElementById('profileButton');
    const dropdown = document.getElementById('profileDropdown');
    const logoutBtn = document.getElementById('logoutButton');

    // Toggle dropdown
    profileBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    // Klik di luar → tutup
    document.addEventListener('click', () => {
        dropdown.classList.add('hidden');
    });

    // Logout confirm
    logoutBtn.addEventListener('click', () => {
        Swal.fire({
            title: 'Yakin logout?',
            text: 'Anda akan keluar dari akun ini',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, logout'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>
