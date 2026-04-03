@extends('user.layouts.app')

@section('content')

<div class="profile-container">

    <div class="profile-card">
        <h2>Profil User</h2>

        <div class="profile-item">
            <label>Nama</label>
            <p>{{ Auth::user()->name }}</p>
        </div>

        <div class="profile-item">
            <label>Email</label>
            <p>{{ Auth::user()->email }}</p>
        </div>

        <div class="profile-item">
            <label>Password</label>
            <p>*******</p>
        </div>

        <button class="btn-edit">Edit Profil</button>
    </div>

</div>

@endsection