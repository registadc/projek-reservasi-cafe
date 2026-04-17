@extends('user.layouts.app')

@section('content')

<div class="reservasi-container">

<form action="{{ route('reservasi.store') }}" method="POST" enctype="multipart/form-data" class="card-reservasi">
@csrf

<h3>Checkout</h3>
<hr>

<!-- 🔥 DATA STEP 1 (WAJIB) -->
<input type="hidden" name="id_meja" value="{{ $data['id_meja'] }}">
<input type="hidden" name="tanggal_reservasi" value="{{ $data['tanggal_reservasi'] }}">
<input type="hidden" name="jam_reservasi" value="{{ $data['jam_reservasi'] }}">
<input type="hidden" name="jumlah_orang" value="{{ $data['jumlah_orang'] }}">

<!-- 🔥 LIST MENU -->
<div class="checkout-menu">
    @foreach($menus as $id => $qty)
        @php
            $menu = \App\Models\Menu::find($id);
            $subtotal = $menu->harga * $qty;
        @endphp

        <div class="checkout-item">
            <span>{{ $menu->nama_menu }} (x{{ $qty }})</span>
            <span>Rp {{ number_format($subtotal) }}</span>
        </div>

        <input type="hidden" name="menu_id[]" value="{{ $id }}">
        <input type="hidden" name="qty[{{ $id }}]" value="{{ $qty }}">
    @endforeach
</div>

<hr>

<!--  TOTAL -->
<div class="total-box">
    Total: Rp {{ number_format($total) }}
</div>

<!--  METODE -->
<label>Metode Pembayaran</label>
<select name="metode_pembayaran" id="metode" required>
    <option value="cash">Cash</option>
    <option value="transfer">Transfer</option>
</select>

<!--  TRANSFER -->
<div id="transferBox" style="display:none; margin-top:10px;">
    <p>No Rekening: <b>123456789 (BCA)</b></p>

    <label>Upload Bukti</label>
    <input type="file" name="bukti_pembayaran">
</div>


<!-- BUTTON -->
<div class="btn-group">

    <!-- tombol kembali -->
    <button type="button" class="btn-pink" onclick="goBack()">Kembali</button>

    <!-- tombol submit -->
    <button type="submit" class="btn-pink" id="btnSubmit">
        Konfirmasi
    </button>

</div>

</form>

</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {

    const metode = document.getElementById('metode');
    const box = document.getElementById('transferBox');
    const file = document.getElementById('buktiInput');

    metode.addEventListener('change', function(){

        if (this.value === 'transfer') {
            box.style.display = 'block';
            file.required = true;
        } else {
            box.style.display = 'none';
            file.required = false;
            file.value = ""; // reset file
        }
    });

    // PREVIEW
    file.addEventListener('change', function(e){
        const preview = document.getElementById('previewImg');
        const selected = e.target.files[0];

        if(selected){
            preview.src = URL.createObjectURL(selected);
            preview.style.display = 'block';
        }
    });

});

document.querySelector('form').addEventListener('submit', function(){
    document.getElementById('btnSubmit').disabled = true;
});

function goBack() {
    window.history.back();
}
</script>