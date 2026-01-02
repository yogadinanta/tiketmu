@extends('layouts.vendor')

@section('title', 'Riwayat Pemesanan Tiket')

@section('content')

<div class="max-w-9xl mx-auto p-4">

    <h1 class="text-2xl font-bold mb-6">Riwayat Pemesanan Tiket</h1>

    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Order ID</th>
                    <th class="px-4 py-3 text-left">Event</th>
                    <th class="px-4 py-3 text-left">Pembeli</th>
                    <th class="px-4 py-3 text-center">Jumlah</th>
                    <th class="px-4 py-3 text-right">Total</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($orders as $order)
                    <tr>
                        <td class="px-4 py-3 font-mono">
                            {{ $order->order_id }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $order->event->title }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $order->user->name }}
                            <div class="text-xs text-gray-500">
                                {{ $order->user->email }}
                            </div>
                        </td>

                        <td class="px-4 py-3 text-center">
                            {{ $order->quantity }}
                        </td>

                        <td class="px-4 py-3 text-right font-semibold">
                            Rp{{ number_format($order->total_price, 0, ',', '.') }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if($order->status === 'paid')
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
                                    PAID
                                </span>
                            @elseif($order->status === 'pending')
                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded">
                                    PENDING
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">
                                    FAILED
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            {{ $order->created_at->format('d M Y H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                            Belum ada pemesanan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>

</div>

@endsection
