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

       <a href="{{ route('user.profile.edit') }}" class="btn-edit" 
       style="text-decoration: none; font-size: 14px; width: 340px; text-align: center; display: inline-block; padding: 8px 12px; background-color: #d6b8c4; color: white; border-radius: 5px;">
       Edit Profil</a>
    </div>

</div>

@endsection