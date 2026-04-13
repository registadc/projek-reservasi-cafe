@extends('admin.layouts.app')

@section('title','Edit Menu')

@section('content')

<div class="glass-card">

    <h2 class="card-title mb-3">Edit Menu</h2>

    <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" class="form-input" value="{{ old('nama_menu') ?? $menu->nama_menu }}">
            @error('nama_menu')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-input" rows="3">{{ old('deskripsi') ?? $menu->deskripsi }}</textarea>
             @error('deskripsi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" class="form-input" value="{{ old('harga') ?? $menu->harga }}">
            @error('harga')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Gambar</label>

            <input type="file" name="gambar" class="form-input">

            
            <input type="hidden" name="gambar_lama" value="{{ $menu->gambar }}">

            <div style="margin-top:10px;">
                <img src="{{ asset('storage/'.$menu->gambar) }}" 
                    width="100" 
                    style="border-radius:10px;">
            </div>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" class="form-input" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="drink" {{ $menu->kategori == 'drink' ? 'selected' : '' }}>
                    Drink
                </option>
                <option value="bread" {{ $menu->kategori == 'bread' ? 'selected' : '' }}>
                    Bread
                </option>
            </select>
        </div>

        <div style="margin-top:15px;">
            <button type="submit" class="card-btn">Simpan</button>

            <a href="{{ route('admin.menu.index') }}" class="card-btn">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection