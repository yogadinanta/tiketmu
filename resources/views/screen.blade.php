<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tiketmu - Hero Section</title>

  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <link rel="icon" href="{{ asset('assets/icon/icon.svg') }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<script src="//unpkg.com/alpinejs" defer></script>

<body x-data="{ open: false }" class="bg-white text-gray-800">
  @include('layouts.header')
  <section class="relative flex flex-col-reverse md:flex-row items-center justify-between px-6 md:px-16 py-24 md:py-32 max-w-7xl mx-auto">

    <!-- Text Section -->
    <div class="md:w-1/2 text-center md:text-left space-y-6">
    <p class="text-xl font-semibold text-[#ffc107] uppercase tracking-wide mt-4 md:mt-0 md:pt-2">
  #NowScreening
</p>

      <h1 class="text-5xl md:text-7xl font-bold text-[#0d1b4c] leading-tight">
        No More Antre, <br>
        Now More <span class="text-[#3E89FF]">Easy</span>
      </h1>
      <p class="text-gray-600 text-lg md:text-xl max-w-lg md:max-w-none">
        Tiketmu kini hadir di ponselmu! Temukan event terbaru, pesan tiket dengan mudah, dan nikmati promo eksklusif langsung dari aplikasi.
      </p>
      <div class="pt-6">
        <a href="#" class="bg-[#3E89FF] hover:bg-orange-600 text-white px-8 py-4 rounded-full font-semibold text-lg transition">
          Coba Sekarang
        </a>
      </div>
    </div>

<div class="md:w-1/2 flex justify-center relative overflow-visible ml-10">
  <img src="https://assets.loket.com/amber-assets/spot_hero/nema_home.webp" 
       alt="Hero Tiketmu"
       class="w-full md:w-[110%] scale-110 md:scale-125 drop-shadow-2xl z-10 transition-transform duration-500">
</div>


  </section>

  
@include('layouts.slider-bioskop')

  <script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="5KQVU2aUPb5Fi95vVkeJ6";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>


</body>
</html>
