<div class="bg-white shadow-md rounded-xl p-6 mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Event Anda</h2>

    @if ($events->isEmpty())
        <p class="text-gray-500">Belum ada event.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($events as $event)
                <div class="bg-white border rounded-xl shadow hover:shadow-lg transition p-4 flex flex-col">
                    @if ($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-40 object-cover rounded-lg mb-4">
                    @endif
                    <h3 class="font-semibold text-lg mb-1">{{ $event->title }}</h3>
                    <p class="text-gray-600 text-sm mb-1">
                        {{ $event->start_date }} {{ $event->start_time }} s/d {{ $event->end_date }} {{ $event->end_time }}
                    </p>
                    <p class="text-gray-600 text-sm mb-1">{{ $event->location }}</p>
                    <p class="text-gray-600 text-sm mb-2">Rp{{ number_format($event->price,0,',','.') }}</p>

                    <div class="mt-auto flex gap-2">
                        <a href="{{ route('vendor.events.edit', $event->id) }}" 
                           class="flex-1 bg-[#00345e] text-white py-1 rounded hover:bg-gray-500 text-center">
                            Edit
                        </a>
                        <form action="{{ route('vendor.events.destroy', $event->id) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-1 rounded w-full hover:bg-red-600"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
