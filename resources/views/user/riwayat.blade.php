@extends('user.layouts.app')

@section('content')

<div class="reservasi-container">

<div class="card-reservasi">

<h3>Riwayat Reservasi</h3>
<hr>

@foreach($data as $item)
<div class="history-card">

    <!-- HEADER -->
    <div class="history-header" onclick="toggleDetail({{ $item->id }})">

        <div>
            <b>Rp {{ number_format($item->total_harga) }}</b><br>
            <small>{{ $item->tanggal_reservasi }} - {{ $item->jam_reservasi }}</small>
        </div>

        <!-- STATUS -->
        <div>
            @if($item->status == 'pending')
                <span class="status pending">Pending</span>
            @elseif($item->status == 'approved')
                <span class="status approved">Approved</span>
            @else
                <span class="status rejected">Rejected</span>
            @endif
        </div>

    </div>

    <!-- DETAIL -->
    <div class="history-detail" id="detail-{{ $item->id }}">

        @foreach($item->detail_reservasi as $d)
        <div class="detail-item">
            <span>{{ $d->menu->nama_menu }} x{{ $d->jumlah }}</span>
            <span>Rp {{ number_format($d->subtotal) }}</span>
        </div>
        @endforeach

        <P><b>Nomor Meja :</b> {{ $item->meja->nomor_meja ?? 'N/A' }}</P>

        <form action="{{ route('user.reservasi.delete', $item->id) }}" method="POST" 
            onsubmit="return confirm('Yakin mau hapus reservasi ini?')">
            @csrf
            @method('DELETE')

            <button class="btn-delete">Hapus Reservasi</button>
        </form>

        @if($item->bukti_pembayaran)
        <div class="bukti-box">
            <p>Bukti Pembayaran:</p>
            <img src="{{ asset('storage/'.$item->bukti_pembayaran) }}" class="bukti-img">
        </div>
        @endif

    </div>

</div>
@endforeach

</div>
</div>

@endsection

<script>
function toggleDetail(id) {
    const el = document.getElementById('detail-' + id);
    el.style.display = el.style.display === 'block' ? 'none' : 'block';
}
</script>