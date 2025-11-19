@extends('layouts.app')

@section('title', $event->title)

@section('content')
<br>
<div class="max-w-7xl rounded-2xl shadow-2xl mx-auto p-12 md:p-20 bg-[#f8fafc] min-h-screen my-4">
    {{-- GRID 2 KOLOM --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- === KOLOM KIRI (GAMBAR + DETAIL) === --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- GAMBAR EVENT --}}
            <div class="relative">
                <img src="{{ asset('storage/' . $event->image) }}" 
                     alt="{{ $event->title }}" 
                     class="rounded-xl shadow-lg w-full object-cover">
                <div class="absolute top-4 left-4 bg-blue-600 text-white px-4 py-1 rounded-full text-sm shadow-md">
                    <i class="fa-solid fa-calendar-days mr-1"></i>
                    {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d M') }}
                </div>
            </div>

            {{-- JUDUL + INFO DASAR --}}
            <div>
                <h1 class="text-3xl font-bold mb-3 text-gray-900">{{ $event->title }}</h1>

                {{-- ICON INFO --}}
                <div class="space-y-2 text-[15px] text-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-calendar text-blue-600"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') }} – 
                            {{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('d F Y') }}
                        </span>
                    </div>

                  <div class="flex items-center gap-3">
    <i class="fa-regular fa-clock text-blue-600"></i>
    <span>
        {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} – 
        {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
    </span>
</div>


                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-location-dot text-blue-600"></i>
                        <span>{{ $event->location }}</span>
                    </div>
                </div>
            </div>

            {{-- TOMBOL DESKRIPSI --}}
            <div>
                <button class="bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition">
                    <i class="fa-solid fa-align-left mr-1"></i> Deskripsi
                </button>
            </div>

            {{-- DESKRIPSI EVENT --}}
            <div>
                <h2 class="text-2xl font-semibold mb-3 text-gray-800">Deskripsi</h2>
                <div class="text-gray-700 leading-relaxed space-y-2">
                    {!! nl2br(e($event->description ?? 'Tidak ada deskripsi untuk event ini.')) !!}
                </div>
            </div>
        </div>

        {{-- === KOLOM KANAN (KARTU INFORMASI EVENT) === --}}
        <div class="space-y-5">
            {{-- Informasi Event --}}
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Event</h3>

                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500 mb-1">Kategori</p>
                        <span class="inline-flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                            <i class="fa-solid fa-music mr-1"></i>
                            {{ $event->category ?? 'Umum' }}
                        </span>
                    </div>

                    <div>
                        <p class="text-gray-500 mb-1">Penyelenggara</p>
                        <div class="flex items-center gap-2">
                            @if(!empty($event->vendor->logo))
                                <img src="{{ asset('storage/' . $event->vendor->logo) }}" alt="Logo Vendor" class="h-6">
                            @endif
                            <span class="font-medium">{{ $event->vendor->name ?? 'Vendor tidak diketahui' }}</span>
                        </div>
                    </div>

                    @if(!empty($event->vendor->instagram))
                        <div>
                            <p class="text-gray-500 mb-1">Instagram</p>
                            <a href="https://instagram.com/{{ $event->vendor->instagram }}" target="_blank"
                               class="inline-flex items-center text-blue-600 hover:underline">
                                <i class="fa-brands fa-instagram mr-1"></i>
                                {{ '@' . $event->vendor->instagram }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Harga & Tombol --}}
            <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-600 text-sm">Harga mulai dari</span>
                    <span class="text-xl font-bold text-gray-900">Rp{{ number_format($event->price, 0, ',', '.') }}</span>
                </div>

                <a href="#"
                   class="bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-3 rounded-lg transition flex justify-center items-center gap-2">
                    <i class="fa-solid fa-ticket"></i>
                    Beli Tiket
                </a>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
