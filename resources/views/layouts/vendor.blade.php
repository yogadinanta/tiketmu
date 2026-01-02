<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Dashboard Vendor - Tiketmu')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-100 flex h-screen">

    {{-- Sidebar --}}
    @include('partials.vendor.sidebar')

    {{-- Content --}}
  <div id="content"
     class="ml-64 flex-1 transition-all duration-300">


        {{-- Header --}}
        @include('partials.vendor.header')

        {{-- Main --}}
        <main class="mt-24 p-6 overflow-y-auto" id="mainContent">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>
</html>
