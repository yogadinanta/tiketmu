<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sidebar Tiketmu</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100">

<aside
    class="fixed top-0 left-0 z-50 w-64 h-screen
           bg-[#00345e] text-gray-200 flex flex-col" id="sidebar">

    <!-- LOGO -->
    <div class="px-6 py-5 border-b border-white/10">
        <h1 class="text-2xl font-semibold text-white tracking-wide">
            tiketmu
        </h1>
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-3 py-4 space-y-1 text-sm">

        <!-- DASHBOARD -->
        <a href="{{ route('vendor.dashboard') }}"
           class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium transition
           {{ request()->routeIs('vendor.dashboard')
                ? 'bg-white text-[#00345e]'
                : 'text-gray-200 hover:bg-white/10' }}">
            <i class="fa-solid fa-house w-5 text-center"></i>
            <span>Dashboard</span>
        </a>

  <a href="{{ route('vendor.deposit.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium transition
           {{ request()->routeIs('vendor.deposit.index')
                ? 'bg-white text-[#00345e]'
                : 'text-gray-200 hover:bg-white/10' }}">
            <div class="flex items-center gap-4">
                <i class="fa-solid fa-toolbox w-5 text-center"></i>
                <span>Deposit Saldo</span>
            </div>
            <span
                class="text-[10px] bg-orange-500 text-white
                       px-2 py-0.5 rounded-full">
                NEW
            </span>
        </a>


<a href="{{ route('vendor.scan.index') }}"
   class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium transition
          hover:bg-white/10">
    <i class="fa-solid fa-qrcode w-5 text-center"></i>
    <span>Scan Tiket</span>
</a>

        <!-- TRANSAKSI -->
  <a href="{{ route('vendor.orders.index') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium transition
           {{ request()->routeIs('vendor.orders.index')
                ? 'bg-white text-[#00345e]'
                : 'text-gray-200 hover:bg-white/10' }}">
            <i class="fa-solid fa-chart-column w-5 text-center"></i>
            <span>Transaksi</span>
        </a>

        <!-- REFERRAL -->
        <a href="#"
           class="flex items-center justify-between px-4 py-3 rounded-xl font-medium transition
                  hover:bg-white/10">
            <div class="flex items-center gap-4">
                <i class="fa-solid fa-link w-5 text-center"></i>
                <span>Referral</span>
            </div>
            <i class="fa-solid fa-chevron-right text-xs"></i>
        </a>

        <!-- KLIRING -->
        <a href="#"
           class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium transition
                  hover:bg-white/10">
            <i class="fa-solid fa-right-left w-5 text-center"></i>
            <span>Kliring</span>
        </a>

        <!-- PENARIKAN -->
        <a href="{{ route('vendor.penarikan.index') }}"
           class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium transition
                 {{ request()->routeIs('vendor.penarikan.index')
                ? 'bg-white text-[#00345e]'
                : 'text-gray-200 hover:bg-white/10' }}">
            <i class="fa-solid fa-download w-5 text-center"></i>
            <span>Penarikan</span>
        </a>

        <!-- MUTASI SALDO -->
        <a href="{{ route('vendor.history') }}"
           class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium transition
           {{ request()->routeIs('vendor.history')
                ? 'bg-white text-[#00345e]'
                : 'text-gray-200 hover:bg-white/10' }}">
            <i class="fa-solid fa-clock-rotate-left w-5 text-center"></i>
            <span>Mutasi Saldo</span>
        </a>

        <!-- TOOLS -->
        <a href="#"
           class="flex items-center justify-between px-4 py-3 rounded-xl font-medium transition
                  hover:bg-white/10">
            <div class="flex items-center gap-4">
                <i class="fa-solid fa-toolbox w-5 text-center"></i>
                <span>Tools</span>
            </div>
            <span
                class="text-[10px] bg-orange-500 text-white
                       px-2 py-0.5 rounded-full">
                NEW
            </span>
        </a>

        <!-- PENGATURAN -->
        <a href="#"
           class="flex items-center justify-between px-4 py-3 rounded-xl font-medium transition
                  hover:bg-white/10">
            <div class="flex items-center gap-4">
                <i class="fa-solid fa-gear w-5 text-center"></i>
                <span>Pengaturan</span>
            </div>
            <i class="fa-solid fa-chevron-right text-xs"></i>
        </a>
    </nav>

</aside>

</body>
</html>
