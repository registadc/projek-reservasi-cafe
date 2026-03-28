@extends('admin.layouts.app')

@section('title','Detail Menu')

@section('content')

<div class="glass-card">

    <div class="card-header">
        <h2 class="card-title">Detail Menu</h2>
    </div>

    <div class="detail-container">

        <div class="detail-item">
            <span class="label">Nama Menu</span>
            <span class="value">{{ $menu->nama_menu }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Deskripsi</span>
            <span class="value">{{ $menu->deskripsi }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Harga</span>
            <span class="value">Rp {{ number_format($menu->harga) }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Gambar</span>
            <span class="value">
                <img src="{{ asset('storage/'.$menu->gambar) }}" 
                     class="detail-img">
            </span>
        </div>

        <div class="detail-item">
            <span class="label">Dibuat</span>
            <span class="value">{{ $menu->created_at->diffForHumans() }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Diupdate</span>
            <span class="value">{{ $menu->updated_at->diffForHumans() }}</span>
        </div>

    </div>

    <div style="margin-top:20px;">
        <a href="{{ route('admin.menu.index') }}" class="card-btn">
            ← Kembali
        </a>

        <a href="{{ route('admin.menu.edit', $menu->id) }}" class="table-btn edit" style="margin-left: 5x;">
            Edit
        </a>
    </div>

</div>

@endsection