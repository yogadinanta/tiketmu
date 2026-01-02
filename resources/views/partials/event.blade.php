<!-- ////////////// SECTION LIST ////////////////// -->
<section class="px-6 py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold mb-8 text-gray-800">Event Terbaru</h2>

        @if ($events->count() > 0)
            <!-- WRAPPER SLIDER -->
            <div class="relative group"> 

                <!-- Tombol Navigasi -->
                <button id="prevBtn"
                    class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center 
                           bg-white/80 shadow-md rounded-full text-gray-700 opacity-0 
                           group-hover:opacity-100 group-hover:-translate-x-2 
                           transition-all duration-300 hover:scale-110 hover:bg-white z-10">
                    &#10094;
                </button>

                <button id="nextBtn"
                    class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center 
                           bg-white/80 shadow-md rounded-full text-gray-700 opacity-0 
                           group-hover:opacity-100 group-hover:translate-x-2 
                           transition-all duration-300 hover:scale-110 hover:bg-white z-10">
                    &#10095;
                </button>

                <!-- SLIDER -->
                <div id="eventSlider"
                    class="flex overflow-x-auto scroll-smooth space-x-6 px-2 py-6 hide-scrollbar">
                    @foreach ($events as $event)
                        <!-- CARD EVENT -->
                    

<a href="{{ route('event.detail', [
    'id' => $event->id,
    'slug' => Str::slug($event->title)
]) }}"
class="group flex-none w-72 bg-white rounded-xl shadow-md 
       hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 overflow-hidden">


                            @if ($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}"
                                     alt="{{ $event->title }}"
                                     class="w-full h-44 object-cover group-hover:brightness-90 transition">
                            @else
                                <div class="w-full h-44 bg-gray-200 flex items-center justify-center text-gray-400 italic">
                                    Tidak ada gambar
                                </div>
                            @endif

                            <div class="p-5 flex flex-col justify-between h-52">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 truncate hover:text-blue-600 transition">
                                        {{ $event->title }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d M Y') }}
                                        - {{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('d M Y') }}
                                    </p>
                                    <p class="text-gray-600 mt-2 line-clamp-2">{{ $event->location }}</p>
                                </div>

                                <div class="mt-4">
                                    <p class="text-lg font-bold text-blue-600">
                                        Rp{{ number_format($event->price, 0, ',', '.') }}
                                    </p>
                                    <p class="text-sm text-gray-400 mt-1">
                                        {{ $event->vendor->name ?? 'Vendor tidak diketahui' }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <p class="italic text-gray-500 text-center py-10">Belum ada event yang tersedia.</p>
        @endif
    </div>
</section>


<!-- SCRIPT SLIDER -->
<script>
    const slider = document.getElementById('eventSlider');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const cardWidth = 300; // lebar card + margin

    nextBtn.addEventListener('click', () => {
        slider.scrollBy({ left: cardWidth * 2, behavior: 'smooth' });
    });

    prevBtn.addEventListener('click', () => {
        slider.scrollBy({ left: -cardWidth * 2, behavior: 'smooth' });
    });
</script>

<!-- HIDE SCROLLBAR STYLE -->
<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
