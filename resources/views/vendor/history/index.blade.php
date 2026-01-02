@extends('layouts.vendor')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="max-w-9xl mx-auto px-6">

    <!-- PAGE HEADER -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-3">
            <i class="fa-solid fa-receipt text-[#00345e]"></i>
            Riwayat Transaksi
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Daftar mutasi saldo & aktivitas transaksi Anda
        </p>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

        @if($histories->count())
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr class="text-gray-600 font-medium">
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Keterangan</th>
                            <th class="px-6 py-4">Sumber</th>
                            <th class="px-6 py-4">Tipe</th>
                            <th class="px-6 py-4 text-right">Jumlah</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($histories as $history)
                            <tr class="hover:bg-gray-50 transition">

                                <!-- Tanggal -->
                                <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                    {{ $history->created_at->format('d M Y H:i') }}
                                </td>

                                <!-- Keterangan -->
                                <td class="px-6 py-4 text-gray-700">
                                    <div class="font-medium">
                                        {{ $history->description }}
                                    </div>

                                    {{-- Info tambahan untuk deposit --}}
                                    @if($history->source === 'deposit' && $history->deposit)
                                        <div class="text-xs text-gray-500 mt-1">
                                            Order ID: {{ $history->deposit->order_id }}
                                        </div>
                                    @endif
                                </td>

                                <!-- Sumber -->
                                <td class="px-6 py-4">
                                    @if($history->source === 'deposit')
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                            Deposit
                                        </span>
                                    @elseif($history->source === 'event')
                                        <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700">
                                            Event
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                            Admin
                                        </span>
                                    @endif
                                </td>

                                <!-- Tipe -->
                                <td class="px-6 py-4">
                                    @if($history->type === 'tambah')
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            <i class="fa-solid fa-arrow-up text-[10px]"></i>
                                            Tambah
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            <i class="fa-solid fa-arrow-down text-[10px]"></i>
                                            Kurang
                                        </span>
                                    @endif
                                </td>

                                <!-- Jumlah -->
                                <td class="px-6 py-4 text-right font-semibold whitespace-nowrap">
                                    @if($history->type === 'tambah')
                                        <span class="text-green-600">
                                            + Rp{{ number_format($history->amount, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-red-600">
                                            - Rp{{ number_format($history->amount, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $histories->links() }}
            </div>

        @else
            <!-- EMPTY STATE -->
            <div class="p-10 text-center text-gray-500">
                <i class="fa-solid fa-folder-open text-4xl mb-3"></i>
                <p class="font-medium">Belum ada riwayat transaksi</p>
                <p class="text-sm mt-1">
                    Semua aktivitas saldo akan muncul di sini
                </p>
            </div>
        @endif

    </div>
</div>
@endsection
