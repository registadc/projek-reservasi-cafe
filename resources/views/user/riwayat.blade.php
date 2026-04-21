@extends('user.layouts.app')

@section('content')

<div class="order-wrapper" style="margin-top: 40px; margin-bottom: 40px;">

    <h2 class="title-page">Riwayat Reservasi</h2>

    <div class="order-list">
        @foreach($data as $item)
        <div class="order-card">

            <!-- LEFT -->
            <div class="order-left">
                <div class="status-line">
                    <span class="dot"></span>
                    <span class="status-text {{ $item->status }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </div>

                <div class="order-info">
                    <div>
                        <b>Tanggal</b><br>
                        {{ $item->tanggal_reservasi }}
                    </div>
                    <div>
                        <b>Jam</b><br>
                        {{ $item->jam_reservasi }}
                    </div>
                    <div>
                        <b>Meja</b><br>
                        {{ $item->meja->nomor_meja ?? '-' }}
                    </div>
                    <div>
                        <b>Pembayaran</b><br>
                        {{ $item->metode_pembayaran }}
                    </div>
                </div>

                <div class="order-total">
                    Total: <b>Rp {{ number_format($item->total_harga) }}</b>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="order-right">
                @foreach($item->detail_reservasi as $d)
                <div class="menu-item">
                    <img src="{{ asset('storage/'.$d->menu->gambar) }}" class="menu-img">

                    <div class="menu-detail">
                        {{ $d->menu->nama_menu }}
                        <small>Qty: {{ $d->jumlah }}</small>
                    </div>

                    <div class="menu-price">
                        Rp {{ number_format($d->subtotal) }}
                    </div>
                </div>
                @endforeach

                @if($item->bukti_pembayaran)
                <div class="bukti-box">
                    <p><b>Bukti Pembayaran:</b></p>
                    <img src="{{ asset('storage/'.$item->bukti_pembayaran) }}" class="bukti-img">
                </div>
                @endif

                <div class="order-action">
                    <form action="{{ route('user.reservasi.delete', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Hapus</button>
                    </form>
                </div>
            </div>

        </div>
        @endforeach
    </div>

</div>

@endsection