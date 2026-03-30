@extends('admin.layouts.app')

@section('title','Detail Users')

@section('content')

<div class="glass-card">

    <div class="card-header">
        <h2 class="card-title">Detail Users</h2>
    </div>

    <div class="detail-container">

        <div class="detail-item">
            <span class="label">Nama User</span>
            <span class="value">{{ $user->name }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Email</span>
            <span class="value">{{ $user->email }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Password</span>
            <span class="value">{{ $user->password }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Role</span>
            <span class="value">{{ $user->role }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Dibuat</span>
            <span class="value">{{ $user->created_at->diffForHumans() }}</span>
        </div>

        <div class="detail-item">
            <span class="label">Diupdate</span>
            <span class="value">{{ $user->updated_at->diffForHumans() }}</span>
        </div>

    </div>

    <div style="margin-top:20px;">
        <a href="{{ route('admin.users.index') }}" class="card-btn">
            ← Kembali
        </a>
    </div>

</div>

@endsection