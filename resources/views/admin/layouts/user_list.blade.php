{{-- Tambahkan SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="users-table table-wrapper">
  <table class="posts-table">
    <thead>
      <tr class="users-table-info">
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Saldo</th>
        <th>Dibuat Pada</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
       <td>
  <select onchange="updateRole(this, '{{ $user->id }}')" class="form-select p-1 rounded border-gray-300">
    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
    <option value="vendor" {{ $user->role == 'vendor' ? 'selected' : '' }}>Vendor</option>
    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
  </select>
</td>

  <!-- === KOLOM SALDO === -->
    <td>
        Rp {{ number_format($user->saldo ?? 0, 0, ',', '.') }}
    </td>
<style>
  .form-select {
  background-color: #f9fafb;
  border-radius: 0.375rem;
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
}

</style>

<script>
  // Fungsi konfirmasi dan update role via AJAX
  function updateRole(selectElement, userId) {
    const newRole = selectElement.value;

    Swal.fire({
      title: 'Ubah Role?',
      text: `Yakin ingin mengubah role menjadi "${newRole}"?`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, ubah!',
      cancelButtonText: 'Batal',
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {
        fetch(`/admin/users/update-role/${userId}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ role: newRole })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            Swal.fire({
              title: 'Berhasil!',
              text: data.message,
              icon: 'success',
              timer: 1500,
              showConfirmButton: false
            });
          } else {
            Swal.fire('Gagal!', data.message, 'error');
          }
        })
        .catch(() => {
          Swal.fire('Error!', 'Terjadi kesalahan server.', 'error');
        });
      } else {
        // Kembalikan ke role sebelumnya jika dibatalkan
        selectElement.value = selectElement.getAttribute('data-original') || '{{ $user->role }}';
      }
    });
  }
</script>

        <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
        <td>
          <span class="p-relative">
            <button class="dropdown-btn transparent-btn" type="button" title="More info">
              <div class="sr-only">More info</div>
              <i data-feather="more-horizontal" aria-hidden="true"></i>
            </button>
            <ul class="users-item-dropdown dropdown">
              <li>
              <a href="{{ route('admin.user.edit', $user->id) }}">Edit</a>

              </li>
              <li>
                <a href="#" 
                   onclick="confirmDelete('{{ route('admin.users.delete', $user->id) }}')" 
                   class="text-red-500 hover:text-red-700 font-medium">
                   Hapus
                </a>
              </li>
            </ul>
          </span>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{-- ===================== SCRIPT SECTION ===================== --}}
<script>
  // Fungsi konfirmasi hapus user
  function confirmDelete(url) {
    Swal.fire({
      title: 'Yakin ingin menghapus?',
      text: "Data user ini akan dihapus permanen!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e3342f',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal',
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    });
  }

  // Menampilkan notifikasi jika ada session success/error
  document.addEventListener('DOMContentLoaded', function() {

    @if (session('success'))
      Swal.fire({
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#3085d6'
      });
    @endif

    @if (session('error'))
      Swal.fire({
        title: 'Gagal!',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonText: 'OK',
        confirmButtonColor: '#d33'
      });
    @endif

  });
</script>
