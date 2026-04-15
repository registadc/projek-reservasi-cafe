@extends('user.layouts.app')

@section('content')


<div class="reservasi-container">
    <div class="card-reservasi" >

        <h2>FORM RESERVASI</h2>

        <form action="{{ route('reservasi.menu') }}" method="POST">
    @csrf

    <label>Tanggal</label>
    <input type="date" name="tanggal_reservasi" required syle="width:200px;">

    <label>Jam</label><br>
    <input type="time" name="jam_reservasi" required style="width:440px;">
    <br>

    <label>Jumlah Orang</label>
    <input type="number" name="jumlah_orang" required>

    <label>Pilih Meja</label>
    <select name="id_meja" required>
        <option value="">-- pilih meja --</option>

        @foreach($mejas as $meja)
            <option value="{{ $meja->id }}">
                {{ $meja->nomor_meja }} - kapasitas {{ $meja->kapasitas }} orang
            </option>
        @endforeach

    </select>

    <button type="submit" class="btn-pink">Selanjutnya</button>
</form>

    </div>
</div>

@endsection