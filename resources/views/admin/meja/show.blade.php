@extends('admin.layouts.app')

@section('title','Detail Meja')

@section('content')

<div class="glass-card">

    <div class="card-header">
        <h2 class="card-title">Detail Meja</h2>
    </div>

    <div class="detail-container">

        <div class="detail-item">
            <span class="label">Nomor Meja</span>
            <span class="value">{{ $meja->nomor_meja }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Kapasitas</span>
            <span class="value">{{ $meja->kapasitas }} orang</span>
        </div>

        <div class="detail-item">
            <span class="label">Status</span>
            <span class="value">{{ $meja->status }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Dibuat</span>
            <span class="value">{{ $meja->created_at->diffForHumans() }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Diupdate</span>
            <span class="value">{{ $meja->updated_at->diffForHumans() }}</span>
        </div>

    </div>

    <div style="margin-top:20px;">
        <a href="{{ route('admin.meja.index') }}" class="card-btn">
            ← Kembali
        </a>

        <a href="{{ route('admin.meja.edit', $meja->id) }}" class="table-btn edit" style="margin-left: 5x;">
            Edit
        </a>
    </div>

</div>

@endsection