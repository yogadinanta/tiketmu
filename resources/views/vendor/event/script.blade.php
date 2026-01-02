@push('scripts')
<script>
function deleteEvent(id) {
    Swal.fire({
        title: 'Yakin hapus?',
        text: "Event akan dihapus permanen",
        icon: 'warning',
        showCancelButton: true
    }).then(result => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-'+id).submit();
        }
    });
}
</script>
@endpush
