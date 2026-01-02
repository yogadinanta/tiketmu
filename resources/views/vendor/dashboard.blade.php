@extends('layouts.vendor')

@section('title','Dashboard Vendor')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h3 class="text-xl font-semibold mb-4">Tambah Event</h3>

    @include('vendor.event.form')
    @include('vendor.event.list')
</div>
@endsection

@push('scripts')
    @include('vendor.event.script')

    <script>
        // AJAX riwayat
        document.getElementById('linkRiwayat')?.addEventListener('click', function (e) {
            e.preventDefault();
            fetch(this.href)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('mainContent').innerHTML = html;
                });
        });

        // Logout confirm
        document.getElementById('logoutButton')?.addEventListener('click', () => {
            Swal.fire({
                title: 'Yakin logout?',
                icon: 'warning',
                showCancelButton: true
            }).then(r => {
                if (r.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                }
            });
        });
    </script>
@endpush
