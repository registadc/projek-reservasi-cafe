@extends('admin.layouts.app')

@section('title','Index Users')

@section('content')
<div class="glass-card table-card">
    <div class="card-header">
        <h2 class="card-title">Daftar Users</h2>
        <a href="{{ route('admin.users.create') }}" class="card-btn">
            + Tambah Users
        </a>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($user as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>*****</td>
                    <td>{{ $item->role }}</td>

                    <td>
                        <a href="{{ route('admin.users.show', $item->id) }}" class="table-btn detail">
                            Detail
                        </a>

                        <button onclick="deleteAction('{{ route('admin.users.destroy', $item->id) }}')"
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

<form action="{{ route('admin.users.destroy', 0) }}" method="post" id="delete-action" class="d-inline">
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