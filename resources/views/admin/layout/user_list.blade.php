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
          @if($user->role === 'admin')
            <span class="badge-active">Admin</span>
          @elseif($user->role === 'vendor')
            <span class="badge-pending">Vendor</span>
          @else
            <span class="badge-success">User</span>
          @endif
        </td>
        <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
        <td>
          <span class="p-relative">
            <button class="dropdown-btn transparent-btn" type="button" title="More info">
              <div class="sr-only">More info</div>
              <i data-feather="more-horizontal" aria-hidden="true"></i>
            </button>
            <ul class="users-item-dropdown dropdown">
              <li>
                <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
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
