<section class="w-full py-16 bg-[#ffffff] overflow-hidden">

  
  <div class="w-full px-6 text-center relative">


    <div class="swiper mySwiper">
      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <img src="https://assets.loket.com/screen/inventory/movie/cover/cgv_kang-solah-from-kang-mak-x-nenek-gayung.jpg"
               alt="Kang Solah"
               class="rounded-2xl shadow-xl w-[250px] md:w-[300px] lg:w-[350px] transition-transform duration-500 hover:scale-105" />
        </div>

        <div class="swiper-slide">
          <img src="https://assets.loket.com/screen/inventory/movie/cover/cgv_jangan-panggil-mama-kafir.jpg"
               alt="Mama Kafir"
               class="rounded-2xl shadow-xl w-[250px] md:w-[300px] lg:w-[350px] transition-transform duration-500 hover:scale-105" />
        </div>

        <div class="swiper-slide">
          <img src="https://assets.loket.com/screen/inventory/movie/cover/cgv_getih-ireng.jpg"
               alt="Getih Ireng"
               class="rounded-2xl shadow-xl w-[250px] md:w-[300px] lg:w-[350px] transition-transform duration-500 hover:scale-105" />
        </div>

        <div class="swiper-slide">
          <img src="https://assets.loket.com/screen/inventory/movie/cover/cgv_demon-slayer-kimetsu-no-yaiba-the-movie-infinity-castle.jpg"
               alt="Demon Slayer"
               class="rounded-2xl shadow-xl w-[250px] md:w-[300px] lg:w-[350px] transition-transform duration-500 hover:scale-105" />
        </div>

        <div class="swiper-slide">
          <img src="https://assets.loket.com/screen/inventory/movie/cover/cgv_rangga-cinta.jpg"
               alt="Rangga & Cinta"
               class="rounded-2xl shadow-xl w-[250px] md:w-[300px] lg:w-[350px] transition-transform duration-500 hover:scale-105" />
        </div>

        <div class="swiper-slide">
          <img src="https://assets.loket.com/screen/inventory/movie/cover/cgv_jembatan-shiratal-mustaqim.jpg"
               alt="Jembatan Shiratal Mustaqim"
               class="rounded-2xl shadow-xl w-[250px] md:w-[300px] lg:w-[350px] transition-transform duration-500 hover:scale-105" />
        </div>
      </div>

      <div class="flex justify-center mt-16 space-x-4 relative z-20"> 
        <button class="swiper-button-prev-custom !static !translate-x-0 bg-[#FFC107] text-[#0E234B] p-2 rounded-full shadow-md hover:bg-yellow-400 transition flex items-center justify-center w-9 h-9">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

        <button class="swiper-button-next-custom !static !translate-x-0 bg-[#FFC107] text-[#0E234B] p-2 rounded-full shadow-md hover:bg-yellow-400 transition flex items-center justify-center w-9 h-9">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
  .mySwiper {
    padding: 0;
    overflow: visible; 
  }

  .mySwiper .swiper-slide {
    width: auto; 
  }

  .mySwiper .swiper-slide img {
    width: 250px; 
  }

  @media (min-width: 768px) {
    .mySwiper .swiper-slide img {
      width: 300px; 
    }
  }

  @media (min-width: 1024px) {
    .mySwiper .swiper-slide img {
      width: 350px; 
    }
  }

  .mySwiper .swiper-slide-active img {
    transform: scale(1.2); 
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5); 
    z-index: 10;
  }

  .mySwiper .swiper-slide img {
    transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.5s ease; 
  }
</style>

<script>
  const nextEl = ".swiper-button-next-custom";
  const prevEl = ".swiper-button-prev-custom";

  const swiper = new Swiper(".mySwiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    loop: true,
    speed: 900,
    slidesPerView: 'auto', 
    
    coverflowEffect: {
      rotate: 0, 
      stretch: 0,
      depth: 250, 
      modifier: 2.5,
      slideShadows: false,
    },
    
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    
    navigation: {
      nextEl: nextEl,
      prevEl: prevEl,
    },
    
    // KUNCI PERUBAHAN: spaceBetween dibuat kurang negatif (lebih mendekati 0)
    breakpoints: {
      // Mobile: Renggang
      0: { 
        spaceBetween: -50 // Sebelumnya -100
      }, 
      // Tablet: Renggang
      640: { 
        spaceBetween: -80 // Sebelumnya -150
      },
      // Desktop: Renggang
      1024: { 
        spaceBetween: 150 // Sebelumnya -200
      }, 
    },
    
    loopedSlides: 6,
    watchSlidesProgress: true,
  });
</script>
