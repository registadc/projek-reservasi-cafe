@extends('admin.layouts.app')

@section('title','Tambah Users')

@section('content')

<div class="glass-card">

    <h2 class="card-title mb-3">Tambah Users</h2>

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-input" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>


        <div style="margin-top:15px;">
            <button type="submit" class="card-btn">Simpan</button>

            <a href="{{ route('admin.users.index') }}" class="table-btn">
                Kembali
            </a>
        </div>

    </form>

</div>

@endsection