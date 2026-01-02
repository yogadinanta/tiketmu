@extends('layouts.admin')

@section('title','Daftar User')

@section('content')

<h3 class="text-lg font-semibold text-gray-700 mb-4">
    Daftar User
</h3>

{{-- SEARCH & FILTER --}}
<form method="GET" action="{{ route('admin.users.index') }}" class="mb-4 px-4">
    <div class="flex items-center justify-between">

        {{-- SEARCH (MENTOK KIRI) --}}
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama atau email..."
            class="w-72 px-4 py-2 border rounded-lg
                   focus:outline-none focus:ring focus:ring-blue-200"
        >

        {{-- FILTER (MENTOK KANAN) --}}
        <div class="flex items-center gap-2">

            <select name="role"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="vendor" {{ request('role') == 'vendor' ? 'selected' : '' }}>Vendor</option>
                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>

            <select name="is_active"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                <option value="">Semua Status</option>
                <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Nonaktif</option>
            </select>

            <button
                type="submit"
                class="px-5 py-2 bg-[#00345e] text-white rounded-lg hover:bg-[#062239]">
                Filter
            </button>

            <a href="{{ route('admin.users.index') }}"
               class="px-5 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                Reset
            </a>

        </div>
    </div>
</form>


{{-- TABLE --}}
<div class="relative w-full overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full border-collapse border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-3 text-left">ID</th>
                <th class="border px-4 py-3 text-left">Nama</th>
                <th class="border px-4 py-3 text-left">Email</th>
                <th class="border px-4 py-3 text-center">Status</th>
                <th class="border px-4 py-3 text-center">Saldo</th>
                <th class="border px-4 py-3 text-left">Tanggal Daftar</th>
                <th class="border px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $user->id }}</td>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>

                    <td class="border px-4 py-2 text-center">
                        @php
                            $status = $user->is_active
                                ? ['Aktif','bg-green-100 text-green-700','bg-green-500']
                                : ['Nonaktif','bg-red-100 text-red-700','bg-red-500'];
                        @endphp
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium {{ $status[1] }}">
                            <span class="w-2 h-2 rounded-full {{ $status[2] }}"></span>
                            {{ $status[0] }}
                        </span>
                    </td>

                    <td class="border px-4 py-2 text-center">
                        Rp {{ number_format($user->saldo ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="border px-4 py-2">
                        {{ $user->created_at->format('d-m-Y H:i') }}
                    </td>

                    <td class="border px-4 py-2 text-center">
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="inline-flex items-center gap-1 px-3 py-1 text-sm
                                  bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="border px-4 py-6 text-center text-gray-500">
                        Belum ada user
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $users->withQueryString()->links() }}
</div>

@endsection
