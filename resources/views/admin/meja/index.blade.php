@extends('admin.layouts.app')

@section('title','Index Meja')

@section('content')
<div class="glass-card table-card">
    <div class="card-header">
        <h2 class="card-title">Daftar Meja</h2>
         <a href="{{ route('admin.meja.create') }}" class="card-btn">
            + Tambah Meja
        </a>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No Meja</th>
                    <th>Kapasitas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($meja as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kapasitas }} orang</td>
                    <td>{{ $item->status }}</td>

                    <td>
                        <a href="{{ route('admin.meja.show', $item->id) }}" class="table-btn detail">
                            Detail
                        </a>

                        <a href="{{ route('admin.meja.edit', $item->id) }}" class="table-btn edit">Edit</a>

                         <button onclick="deleteAction('{{ route('admin.meja.destroy', $item->id) }}')"
                            class="table-btn delete">
                         Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<form action="{{ route('admin.meja.destroy', 0) }}" method="POST" id="delete-action">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function deleteAction(url) {
    Swal.fire({
        title: 'Yakin hapus?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-action').action = url;
            document.getElementById('delete-action').submit();
        }
    })
}
</script>
@endpush