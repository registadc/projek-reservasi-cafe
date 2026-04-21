@extends('user.layouts.app')

@section('content')
<div class="profile-container">

    <div class="profile-card">
        <h2>Edit Profil</h2>

        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf

            <div class="profile-item">
                <label>Nama</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" required>
            </div>

            <div class="profile-item">
                <label>Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" required>
            </div>

            <div class="profile-item">
                <label>Password Baru (biarkan kosong jika tidak ingin mengubah)</label>
                <input type="password" name="password">
            </div>

            <button type="submit" class="btn-edit" style="background-color: #874975; color: white;">Simpan Perubahan</button>
        </form>
    </div>

</div>
@endsection
