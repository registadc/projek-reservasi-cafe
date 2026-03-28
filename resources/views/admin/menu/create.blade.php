@extends('admin.layouts.app')

@section('title','Tambah Menu')

@section('content')

<div class="glass-card">

    <h2 class="card-title mb-3">Tambah Menu</h2>

    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nama Menu --}}
        <div class="form-group">
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" class="form-input" required>
        </div>

        {{-- Deskripsi --}}
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-input" rows="3" required></textarea>
        </div>

        {{-- Harga --}}
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" class="form-input" required>
        </div>

        {{-- Gambar --}}
        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-input" required>
        </div>

        {{-- BUTTON --}}
        <div style="margin-top:15px;">
            <button type="submit" class="card-btn">Simpan</button>

            <a href="{{ route('admin.menu.index') }}" class="table-btn">
                Kembali
            </a>
        </div>

    </form>

</div>

@endsection