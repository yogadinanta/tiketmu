@if(isset($vendors) && $vendors->count() > 0)
    <section class="px-6 py-12 bg-white">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-gray-800">Kreator Favorit</h2>

            <div class="flex gap-6 overflow-x-auto scrollbar-hide">
                @foreach ($vendors as $vendor)
                    <div class="flex flex-col items-center">
                        <img src="{{ $vendor->profile_photo ? asset('storage/' . $vendor->profile_photo) : asset('images/default.png') }}"
                             alt="{{ $vendor->name }}"
                             class="w-24 h-24 rounded-full object-cover shadow-md mb-2 border">
                        <p class="text-sm font-medium text-gray-800 text-center">{{ $vendor->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
