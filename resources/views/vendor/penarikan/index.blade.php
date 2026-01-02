@extends('layouts.vendor')

@section('title', 'Penarikan Saldo')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Judul -->
    <div class="flex items-center gap-3">
        <h1 class="text-2xl font-bold">Penarikan Saldo</h1>
    </div>

    <!-- Saldo -->
    <div class="bg-white rounded-xl p-6 shadow">
        <p class="text-gray-500">Saldo Tersedia</p>
        <p class="text-3xl font-semibold text-green-600">
            Rp {{ number_format($saldo, 0, ',', '.') }}
        </p>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form Penarikan -->
    <div class="bg-white rounded-xl p-6 shadow">
        <h2 class="text-lg font-semibold mb-4">Ajukan Penarikan</h2>

        <form action="{{ route('vendor.penarikan.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Jumlah Penarikan</label>
               <label class="block text-sm font-medium mb-1">Jumlah</label>

<input type="text"
       id="jumlah_display"
       class="w-full border rounded-lg px-4 py-2 focus:ring"
       placeholder="Masukkan jumlah"
       oninput="formatRupiah(this)"
       autocomplete="off">

<input type="hidden"
       name="jumlah"
       id="jumlah"
       value="{{ old('jumlah') }}">


                @error('jumlah')
                    <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>

           <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <!-- Nama Bank -->
    <div>
        <label class="block mb-1 font-medium">Nama Bank</label>
        <input type="text"
               name="bank"
               value="{{ old('bank') }}"
               class="w-full border rounded-lg px-4 py-2 focus:ring"
               placeholder="Contoh: BCA" required>

        @error('bank')
            <small class="text-red-600">{{ $message }}</small>
        @enderror
    </div>

    <!-- Nomor Rekening -->
    <div>
        <label class="block mb-1 font-medium">Nomor Rekening</label>
        <input type="text"
               name="no_rekening"
               value="{{ old('no_rekening') }}"
               class="w-full border rounded-lg px-4 py-2 focus:ring"
               placeholder="Contoh: 1234567890"
               required>

        @error('no_rekening')
            <small class="text-red-600">{{ $message }}</small>
        @enderror
    </div>

</div>


            <button type="submit"
                    class="bg-[#00345e] hover:bg-[#014174] text-white px-6 py-2 rounded-lg font-medium">
                Ajukan Penarikan
            </button>
        </form>
    </div>

    <!-- Riwayat -->
    <div class="bg-white rounded-xl p-6 shadow">
        <h2 class="text-lg font-semibold mb-4">Riwayat Penarikan</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b text-left">
                        <th class="py-2">Tanggal</th>
                        <th class="py-2">Jumlah</th>
                        <th class="py-2">Bank</th>
                        <th class="py-2">No Rekening</th>
                        <th class="py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penarikans as $p)
                        <tr class="border-b last:border-0">
                            <td class="py-2">
                                {{ $p->created_at->format('d M Y') }}
                            </td>
                            <td class="py-2">
                                Rp {{ number_format($p->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="py-2">
                                {{ $p->bank }}
                            </td>
                            <td class="py-2">
                                {{ $p->no_rekening }}
                            </td>
                            <td class="py-2">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    @if($p->status === 'berhasil') bg-green-100 text-green-700
                                    @elseif($p->status === 'diproses') bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">
                                Belum ada penarikan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
function formatRupiah(input) {
    let angka = input.value.replace(/[^0-9]/g, '');
    
    if (!angka) {
        document.getElementById('jumlah').value = '';
        input.value = '';
        return;
    }

    document.getElementById('jumlah').value = angka;

    input.value = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(angka);
}
</script>

@endsection


