@extends('layouts.vendor')

@section('title','Deposit Sukses')

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-3xl mx-auto text-center">
    <h2 class="text-xl font-semibold text-green-600 mb-4">Pembayaran Berhasil!</h2>
    <p>{{ $message ?? 'Terima kasih telah melakukan deposit.' }}</p>
    <a href="{{ route('vendor.deposit.index') }}" class="mt-4 inline-block bg-[#00345e] text-white py-2 px-4 rounded-lg hover:opacity-90">Kembali ke Deposit</a>
</div>
@endsection
