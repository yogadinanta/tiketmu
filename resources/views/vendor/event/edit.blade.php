@extends('layouts.vendor')

@section('content')
<div class="flex-1 p-2 bg-gray-100 min-h-screen">
    <div class="max-w-9xl mx-auto bg-white shadow-xl rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Edit Event</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vendor.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul Event -->
            <div>
                <label for="title" class="block text-gray-700 font-medium mb-2">Judul Event</label>
                <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}"
                    class="border border-gray-300 p-4 w-full rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan judul event" required>
            </div>

            <!-- Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block text-gray-700 font-medium mb-2">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $event->start_date) }}"
                        class="border border-gray-300 p-4 w-full rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="end_date" class="block text-gray-700 font-medium mb-2">Tanggal Selesai</label>
                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $event->end_date) }}"
                        class="border border-gray-300 p-4 w-full rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <!-- Waktu -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_time" class="block text-gray-700 font-medium mb-2">Waktu Mulai</label>
                    <input type="time" id="start_time" name="start_time" value="{{ old('start_time', $event->start_time) }}"
                        class="border border-gray-300 p-4 w-full rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="end_time" class="block text-gray-700 font-medium mb-2">Waktu Selesai</label>
                    <input type="time" id="end_time" name="end_time" value="{{ old('end_time', $event->end_time) }}"
                        class="border border-gray-300 p-4 w-full rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <!-- Lokasi -->
            <div>
                <label for="location" class="block text-gray-700 font-medium mb-2">Lokasi</label>
                <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}"
                    class="border border-gray-300 p-4 w-full rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan lokasi event" required>
            </div>

            <!-- Harga -->
            <div>
                <label for="price" class="block text-gray-700 font-medium mb-2">Harga Tiket (Rp)</label>
                <input type="number" id="price" name="price" value="{{ old('price', $event->price) }}"
                    class="border border-gray-300 p-4 w-full rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan harga tiket" required>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <textarea id="description" name="description" rows="5"
                    class="border border-gray-300 p-4 w-full rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan deskripsi event">{{ old('description', $event->description) }}</textarea>
            </div>

            <!-- Gambar -->
            <div>
                <label for="image" class="block text-gray-700 font-medium mb-2">Gambar Event</label>
                <input type="file" id="image" name="image" class="border border-gray-300 p-4 w-full rounded-xl">
                @if ($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-48 h-48 object-cover rounded-xl mt-4">
                @endif
            </div>

            <!-- Tombol Submit -->
            <div class="text-center mt-6">
                <button type="submit"
                    class="bg-[#00345e] text-white px-10 py-4 rounded-xl font-semibold hover:bg-[#004b84] transition-colors">
                    Update Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
