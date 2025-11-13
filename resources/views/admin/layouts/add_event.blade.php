<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="max-w-8xl mx-auto p-6">

    <!-- ===================== -->
    <!-- Form Tambah Event -->
    <!-- ===================== -->
    <div class="bg-white shadow-md rounded-xl p-6 mb-8">
      <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Tambah Event Baru</h2>

    <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg text-sm font-semibold">
        Saldo Anda: Rp{{ number_format(auth()->user()->saldo, 0, ',', '.') }}
    </div>
</div>

        <!-- Pesan Sukses -->
        @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

        <form action="{{ route('vendor.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold mb-1">Judul Event</label>
                <input type="text" name="title" class="border p-2 w-full rounded" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-1">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="border p-2 w-full rounded" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="border p-2 w-full rounded" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-1">Jam Mulai</label>
                    <input type="time" name="start_time" class="border p-2 w-full rounded" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Jam Selesai</label>
                    <input type="time" name="end_time" class="border p-2 w-full rounded" required>
                </div>
            </div>

            <div>
                <label class="block font-semibold mb-1">Lokasi</label>
                <input type="text" name="location" class="border p-2 w-full rounded" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Harga Tiket (Rp)</label>
                <input id="price" type="number" name="price" class="border p-2 w-full rounded" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="description" class="border p-2 w-full rounded" rows="3"></textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Gambar Event</label>
                <input type="file" name="image" accept="image/*" class="border p-2 w-full rounded">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Tambah Event
            </button>
        </form>
    </div>



    <!-- ===================== -->
    <!-- Daftar Event -->
    <!-- ===================== -->
    <div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Event Anda</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($events as $event)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                @if($event->image)
                <img src="{{ asset('storage/'.$event->image) }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                @endif

                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h4 class="font-semibold text-gray-800 text-lg mb-1">{{ $event->title }}</h4>
                        <p class="text-sm text-gray-600 mb-1">
                            {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }} {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} –
                            {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }} {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                        </p>
                        <p class="text-blue-600 font-semibold">Rp{{ number_format($event->price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mt-2">{{ $event->location }}</p>
                    </div>

                    <div class="mt-3 flex justify-between items-center text-sm">
                        <a href="#" class="text-yellow-600 hover:underline">Edit</a>
<form id="delete-form-{{ $event->id }}" action="{{ route('vendor.events.destroy', $event->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<button onclick="deleteEvent({{ $event->id }})" class="text-red-600 hover:underline">
    Delete
</button>


                    </div>
                </div>
            </div>
            @empty
            <p class="text-gray-500 col-span-3">Belum ada event yang ditambahkan.</p>
            @endforelse
        </div>
    </div>

</div>
<script>
function deleteEvent(eventId) {
    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Event ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + eventId).submit();
        }
    })
}
</script>

