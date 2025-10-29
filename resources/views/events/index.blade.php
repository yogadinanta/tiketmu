<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Featured Events - Tiketmu</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="font-[Poppins] bg-gray-100 p-8">
  <h2 class="text-3xl font-semibold text-gray-800 mb-6">Featured Events</h2>

  {{-- Tempel kode grid di sini --}}
  @if($events->isEmpty())
      <p class="text-gray-500">Belum ada event yang diposting.</p>
  @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          @foreach($events as $event)
              <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                  @if($event->image)
                      <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                  @endif
                  <div class="p-4">
                      <h3 class="text-lg font-semibold">{{ strtoupper($event->title) }}</h3>
                      <p class="text-gray-500 text-sm mt-1">
                          {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                      </p>
                      <p class="text-blue-900 font-bold mt-2">Rp{{ number_format($event->price, 0, ',', '.') }}</p>
                      <hr class="my-3">
                      <div class="flex items-center gap-2">
                          <i class="fas fa-user text-gray-600"></i>
                          <span class="text-gray-700 text-sm">{{ $event->organizer }}</span>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>
  @endif
</body>
</html>
