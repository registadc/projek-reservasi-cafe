@extends('user.layouts.app')

@section('content')

<div class="reservasi-container">

    <form action="{{ route('reservasi.checkout') }}" method="POST" class="card-reservasi">
    @csrf

    <!-- 🔥 KIRIM DATA STEP 1 -->
    <input type="hidden" name="id_meja" value="{{ $data['id_meja'] }}">
    <input type="hidden" name="tanggal_reservasi" value="{{ $data['tanggal_reservasi'] }}">
    <input type="hidden" name="jam_reservasi" value="{{ $data['jam_reservasi'] }}">
    <input type="hidden" name="jumlah_orang" value="{{ $data['jumlah_orang'] }}">

    <h3>MENU :</h3>
    <hr>

    @foreach($menus as $menu)
    <div class="menu-card">

        <!-- 🔥 checkbox -->
        <input type="checkbox"
               name="menu_id[]"
               value="{{ $menu->id }}"
               class="check-menu"
               data-harga="{{ $menu->harga }}">

        <!-- gambar -->
        <img src="{{ asset('storage/'.$menu->gambar) }}">

        <!-- isi -->
        <div class="menu-content">
            <div class="menu-header">
                <span>{{ $menu->nama_menu }}</span>
                <span>Rp {{ number_format($menu->harga) }}</span>
            </div>

            <small>{{ $menu->deskripsi }}</small>

            <!-- 🔥 qty FIX -->
            <div class="qty-modern">
                <button type="button" class="btn-minus">-</button>

                <input type="number"
                       name="qty[{{ $menu->id }}]"
                       value="0"
                       min="0"
                       class="qty-input">

                <button type="button" class="btn-plus">+</button>
            </div>
        </div>

    </div>
    @endforeach

    <!-- TOTAL -->
    <div class="total-box">
        Total: Rp <span id="totalHarga">0</span>
    </div>

    <!-- BUTTON -->
    <div class="btn-group">
        <a href="{{ route('reservasi.form') }}" class="btn-pink">Kembali</a>
        <button type="submit" class="btn-pink">Selanjutnya</button>
    </div>

</form>

</div>

</div>

@endsection


<script>
document.addEventListener('DOMContentLoaded', function () {

    const cards = document.querySelectorAll('.menu-card');

    function hitungTotal() {
        let total = 0;

        cards.forEach(card => {
            const checkbox = card.querySelector('.check-menu');
            const qtyInput = card.querySelector('.qty-input');
            const harga = parseInt(checkbox.dataset.harga);
            const qty = parseInt(qtyInput.value) || 0;

            if (checkbox.checked && qty > 0) {
                total += harga * qty;
            }
        });

        document.getElementById('totalHarga').innerText =
            total.toLocaleString('id-ID');
    }

    cards.forEach(card => {
        const minus = card.querySelector('.btn-minus');
        const plus = card.querySelector('.btn-plus');
        const qtyInput = card.querySelector('.qty-input');
        const checkbox = card.querySelector('.check-menu');

        plus.addEventListener('click', () => {
            qtyInput.value = parseInt(qtyInput.value) + 1;
            checkbox.checked = true;
            hitungTotal();
        });

        minus.addEventListener('click', () => {
            let val = parseInt(qtyInput.value);
            if (val > 0) val--;

            qtyInput.value = val;

            if (val === 0) checkbox.checked = false;

            hitungTotal();
        });

        checkbox.addEventListener('change', () => {
            if (checkbox.checked && qtyInput.value == 0) {
                qtyInput.value = 1;
            }
            if (!checkbox.checked) {
                qtyInput.value = 0;
            }
            hitungTotal();
        });

        qtyInput.addEventListener('input', hitungTotal);
    });

});
</script>