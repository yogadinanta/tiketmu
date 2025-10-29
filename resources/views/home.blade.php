<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tiketmu - Hero Section</title>
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


  
<section class="w-full py-10">
    <div class="max-w-7xl mx-auto px-4">

        <!-- Swiper container -->
        <div class="swiper promo-swiper rounded-xl overflow-hidden shadow-lg">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="https://assets.loket.com/images/ss/1759301963_iFpq0g.jpg" alt="Promo 1"
                        class="w-full h-auto object-cover rounded-xl">
                </div>

                <div class="swiper-slide">
                    <img src="https://assets.loket.com/images/ss/1758095817_zV3svk.png" alt="Promo 2"
                        class="w-full h-auto object-cover rounded-xl">
                </div>

                <div class="swiper-slide">
                    <img src="https://assets.loket.com/images/ss/1758095817_zV3svk.png" alt="Promo 2"
                        class="w-full h-auto object-cover rounded-xl">
                </div>

                                <div class="swiper-slide">
                    <img src="https://assets.loket.com/images/ss/1758095817_zV3svk.png" alt="Promo 2"
                        class="w-full h-auto object-cover rounded-xl">
                </div>

                                <div class="swiper-slide">
                    <img src="https://assets.loket.com/images/ss/1758095817_zV3svk.png" alt="Promo 2"
                        class="w-full h-auto object-cover rounded-xl">
                </div>

                <div class="swiper-slide">
                    <img src=" https://assets.loket.com/images/ss/1758513771_nHbUKp.png" alt="Promo 2"
                        class="w-full h-auto object-cover rounded-xl">
                </div>
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination mt-4"></div>
        </div>
    </div>
</section>

<!-- Swiper JS (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Inisialisasi Swiper -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.promo-swiper', {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            renderBullet: function (index, className) {
                // className = 'swiper-pagination-bullet'
                // tambahkan style inline untuk warna putih
                return '<span class="' + className + '" style="background-color: white;"></span>';
            },
        },
    });
});
</script>


<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />



</body>
</html>
