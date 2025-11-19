<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-xl mx-auto mt-10 p-8 bg-white shadow-xl rounded-2xl border border-gray-100">

    {{-- ===================== NOTIFIKASI ERROR ===================== --}}
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

    @if (session('error'))
        <div class="mb-5 p-4 rounded-lg bg-red-100 border border-red-300 text-red-700">
            <strong class="font-semibold">Gagal:</strong>
            <p class="text-sm mt-1">{{ session('error') }}</p>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-5 p-4 rounded-lg bg-green-100 border border-green-300 text-green-700">
            <strong class="font-semibold">Berhasil:</strong>
            <p class="text-sm mt-1">{{ session('success') }}</p>
        </div>
    @endif

    {{-- ======================= FORM EDIT =========================== --}}
    <h2 class="text-2xl font-bold text-gray-700 mb-6 flex items-center gap-2">
        <i class="fa-solid fa-user-pen text-blue-600"></i>
        Edit User
    </h2>

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="space-y-5">
        @csrf

        <!-- Nama -->
        <div>
            <label class="block font-medium text-gray-600 mb-1">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <!-- Email -->
        <div>
            <label class="block font-medium text-gray-600 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
        </div>

        <!-- Saldo -->
        <div>
            <label class="block font-medium text-gray-600 mb-1">Saldo User</label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                <input type="number" name="saldo" value="{{ old('saldo', $user->saldo) }}"
                    class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
            </div>
        </div>

        <!-- Tombol -->
        <div class="pt-3">
            <button
                class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold shadow-md hover:bg-blue-700 active:scale-[0.98] transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
