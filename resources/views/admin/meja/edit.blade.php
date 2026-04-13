@extends('admin.layouts.app')

@section('title','Edit Meja')

@section('content')

<div class="glass-card">

    <h2 class="card-title mb-3">Edit Meja</h2>

    <form action="{{ route('admin.meja.update', $meja->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Nomor Meja</label>
            <input type="text" name="nomor_meja" class="form-input" value="{{ old('nomor_meja') ?? $meja->nomor_meja }}">
            @error('nomor_meja')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" class="form-input" value="{{ old('kapasitas') ?? $meja->kapasitas }}" min="1">
            @error('kapasitas')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-input" required>
                <option value="tersedia" {{ $meja->status == 'tersedia' ? 'selected' : '' }}>
                    Tersedia
                </option>
                <option value="terisi" {{ $meja->status == 'terisi' ? 'selected' : '' }}>
                    Terisi
                </option>
            </select>
        </div>

        <div style="margin-top:15px;">
            <button type="submit" class="card-btn">Simpan</button>

            <a href="{{ route('admin.meja.index') }}" class="card-btn">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection