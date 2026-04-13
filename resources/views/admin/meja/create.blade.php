@extends('admin.layouts.app')

@section('title','Tambah Meja')

@section('content')

<div class="glass-card">

    <h2 class="card-title mb-3">Tambah Meja</h2>

    <form action="{{ route('admin.meja.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nomor Meja</label>
            <input type="text" name="nomor_meja" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" class="form-input" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-input" required>
                <option value="tersedia">Tersedia</option>
                <option value="terisi">Terisi</option>
            </select>
        </div>

        <div style="margin-top:15px;">
            <button type="submit" class="card-btn">Simpan</button>

            <a href="{{ route('admin.meja.index') }}" class="table-btn">
                Kembali
            </a>
        </div>

    </form>

</div>

@endsection