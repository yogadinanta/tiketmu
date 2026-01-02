<div class="bg-white shadow-md rounded-xl p-6 mb-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Event Baru</h2>

        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg text-sm font-semibold">
            Saldo Anda: Rp{{ number_format(auth()->user()->saldo, 0, ',', '.') }}
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif


    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('vendor.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <input type="text" name="title" placeholder="Judul Event" class="border p-2 w-full rounded" required>

        <div class="grid grid-cols-2 gap-4">
            <input type="date" name="start_date" class="border p-2 rounded" required>
            <input type="date" name="end_date" class="border p-2 rounded" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <input type="time" name="start_time" class="border p-2 rounded" required>
            <input type="time" name="end_time" class="border p-2 rounded" required>
        </div>

        <input type="text" name="location" placeholder="Lokasi" class="border p-2 w-full rounded" required>
        <input type="number" name="price" placeholder="Harga Tiket" class="border p-2 w-full rounded" required>

        <textarea name="description" class="border p-2 w-full rounded" rows="3" placeholder="Deskripsi"></textarea>

        <input type="file" name="image" class="border p-2 w-full rounded">

        <button class="bg-[#00345e] text-white px-6 py-2 rounded hover:bg-[#004b84]">
            Tambah Event
        </button>
    </form>
</div>

