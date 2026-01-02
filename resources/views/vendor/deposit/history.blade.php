{{-- Riwayat Deposit --}}
<h3 class="text-lg font-semibold text-gray-700 mt-8 mb-4">Riwayat Deposit Terbaru</h3>
<div class="overflow-x-auto">
    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Order ID</th>
                <th class="border px-4 py-2">Nominal</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($deposits as $deposit)
            <tr>
                <td class="border px-4 py-2">{{ $deposit->id }}</td>
                <td class="border px-4 py-2">{{ $deposit->order_id }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($deposit->amount,0,',','.') }}</td>
               <td class="border px-4 py-2 text-center">
    @php
        $statusMap = [
            'success' => [
                'label' => 'Succes',
                'bg' => 'bg-green-100',
                'text' => 'text-green-700',
                'dot' => 'bg-green-500'
            ],
            'failed' => [
                'label' => 'Failed',
                'bg' => 'bg-red-100',
                'text' => 'text-red-700',
                'dot' => 'bg-red-500'
            ],
            'pending' => [
                'label' => 'Pending',
                'bg' => 'bg-yellow-100',
                'text' => 'text-yellow-700',
                'dot' => 'bg-yellow-500'
            ],
        ];

        $status = $statusMap[$deposit->status] ?? [
            'label' => ucfirst($deposit->status),
            'bg' => 'bg-gray-100',
            'text' => 'text-gray-700',
            'dot' => 'bg-gray-500'
        ];
    @endphp

    <span class="inline-flex items-center gap-2 px-4 py-1 rounded-full text-sm font-medium
        {{ $status['bg'] }} {{ $status['text'] }}">
        <span class="w-2 h-2 rounded-full {{ $status['dot'] }}"></span>
        {{ $status['label'] }}
    </span>
</td>


                <td class="border px-4 py-2">{{ $deposit->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="border px-4 py-2 text-center text-gray-500">Belum ada riwayat deposit</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
