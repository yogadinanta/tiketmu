@extends('layouts.admin')

@section('title','Edit User')

@section('content')

<div class="max-w-7xl mx-auto mt-10 p-8 bg-white shadow-xl rounded-2xl border border-gray-100">

    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="mb-5 p-4 rounded-lg bg-red-100 border border-red-300 text-red-700">
            <strong class="font-semibold">Terjadi kesalahan:</strong>
            <ul class="mt-2 ml-4 list-disc text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- SUCCESS --}}
    @if (session('success'))
        <div class="mb-5 p-4 rounded-lg bg-green-100 border border-green-300 text-green-700">
            <strong class="font-semibold">Berhasil:</strong>
            <p class="text-sm mt-1">{{ session('success') }}</p>
        </div>
    @endif

    <h2 class="text-2xl font-bold text-gray-700 mb-6 flex items-center gap-2">
        Edit User
    </h2>

    <form action="{{ route('admin.users.update', $user->id) }}"
          method="POST"
          class="space-y-5">

        @csrf
        @method('PUT')

        {{-- NAMA --}}
        <div>
            <label class="block font-medium text-gray-600 mb-1">Nama Lengkap</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $user->name) }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block font-medium text-gray-600 mb-1">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
        </div>

        {{-- SALDO --}}
        <div>
            <label class="block font-medium text-gray-600 mb-1">Saldo User</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                <input type="number"
                       name="saldo"
                       value="{{ old('saldo', $user->saldo ?? 0) }}"
                       class="w-full p-3 pl-10 border rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>
        </div>

        {{-- STATUS --}}
        <div>
            <label class="block font-medium text-gray-600 mb-1">Status</label>
            <select name="is_active"
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
                <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- INPUT USER --}}
    {{-- ... input name, email, dll ... --}}

    {{-- BUTTON --}}
    <div class="pt-3 flex gap-2">
        <a href="{{ route('admin.users.index') }}"
           class="w-1/2 text-center bg-gray-200 py-3 rounded-xl font-semibold hover:bg-gray-300">
            Batal
        </a>

        <button type="submit"
            class="w-1/2 bg-[#00345e] text-white py-3 rounded-xl font-semibold hover:bg-[#051827]">
            Simpan
        </button>
    </div>
</form>


<div class="pt-4">
    <form action="{{ route('admin.users.destroy', $user->id) }}"
          method="POST"
          class="delete-form">

        @csrf
        @method('DELETE')

        <button type="button"
                onclick="confirmDelete(this)"
                class="w-full bg-red-600 text-white py-3 rounded-xl font-semibold hover:bg-red-700">
            Hapus User
        </button>
    </form>
</div>
<script>
function confirmDelete(button) {
    const form = button.closest('form');

    Swal.fire({
        title: 'Hapus User?',
        html: '<span class="text-gray-600">Data ini tidak bisa dikembalikan.</span>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        buttonsStyling: false,
        customClass: {
            popup: 'rounded-2xl shadow-xl',
            title: 'text-xl font-bold',
            confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl mr-2',
            cancelButton: 'bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>






@endsection 
