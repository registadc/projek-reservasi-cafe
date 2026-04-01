@extends('admin.layouts.app')

@section('title','Index Menu')

@section('content')
<div class="glass-card table-card">
    <div class="card-header">
        <h2 class="card-title">Daftar Menu</h2>
        <a href="{{ route('admin.menu.create') }}" class="card-btn">
            + Tambah Menu
        </a>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($menu as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_menu }}</td>
                    <td>Rp {{ number_format($item->harga) }}</td>

                    <td>
                         <img src="{{ asset('storage/'.$item->gambar) }}" 
                            width="60" 
                            style="border-radius:8px;">
                    </td>

                    <td>{{ $item->kategori }}</td>

                    <td>
                        <a href="{{ route('admin.menu.show', $item->id) }}" class="table-btn detail">
                            Detail
                        </a>
                        <a href="{{ route('admin.menu.edit', $item->id) }}" class="table-btn edit">Edit</a>

                        <button onclick="deleteAction('{{ route('admin.menu.destroy', $item->id) }}')"
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

<form action="{{ route('admin.menu.destroy', 0) }}" method="post" id="delete-action" class="d-inline">
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