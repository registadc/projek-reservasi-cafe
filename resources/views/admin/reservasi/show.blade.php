@extends('admin.layouts.app')

@section('title','Detail Reservasi')

@section('content')

<div class="content-grid">

    {{-- ================= INFO RESERVASI ================= --}}
    <div class="glass-card">
        <h2 class="card-title mb-3">Informasi Reservasi</h2>

        <div class="info-grid">
            <div>
                <p><strong>ID Reservasi</strong></p>
                <span>{{ $reservasi->id }}</span>
            </div>

            <div>
                <p><strong>User</strong></p>
                <span>{{ $reservasi->user->name ?? $reservasi->id_user }}</span>
            </div>

            <div>
                <p><strong>Tanggal</strong></p>
                <span>{{ $reservasi->tanggal_reservasi }}</span>
            </div>

            <div>
                <p><strong>Jam</strong></p>
                <span>{{ $reservasi->jam_reservasi }}</span>
            </div>

            <div>
                <p><strong>Jumlah Orang</strong></p>
                <span>{{ $reservasi->jumlah_orang }}</span>
            </div>

            <div>
                <p><strong>Total Harga</strong></p>
                <span>Rp {{ number_format($reservasi->total_harga) }}</span>
            </div>

            <div>
                <p><strong>Status</strong></p>
                <span class="status-badge 
                    {{ $reservasi->status == 'pending' ? 'pending' : '' }}
                    {{ $reservasi->status == 'confirmed' ? 'completed' : '' }}
                    {{ $reservasi->status == 'canceled' ? 'cancelled' : '' }}">
                    {{ ucfirst($reservasi->status) }}
                </span>
            </div>
        </div>
    </div>

    {{-- ================= PEMBAYARAN ================= --}}
    <div class="glass-card">
        <h2 class="card-title mb-3">Pembayaran</h2>

        <p><strong>Metode Pembayaran:</strong></p>
        <p>{{ $reservasi->metode_pembayaran ?? '-' }}</p>

        <p><strong>Bukti Pembayaran:</strong></p>

        @if($reservasi->bukti_pembayaran)
            <img src="{{ asset('storage/'.$reservasi->bukti_pembayaran) }}"
                 class="bukti-img"
                 onclick="window.open(this.src)">
        @else
            <p>- Tidak ada bukti pembayaran -</p>
        @endif
    </div>

</div>


{{-- ================= DETAIL MENU ================= --}}
<div class="glass-card table-card mt-3">

    <div class="card-header">
        <h2 class="card-title">Detail Pesanan Menu</h2>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($detail as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $d->menu->nama_menu ?? $d->id_menu }}
                    </td>

                    <td>{{ $d->jumlah }}</td>

                    <td>Rp {{ number_format($d->subtotal) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">
                        Tidak ada data menu
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>


{{-- ================= BUTTON ================= --}}
<div style="margin-top:20px;">
    <a href="{{ route('admin.reservasi.index') }}" class="card-btn">
        ← Kembali
    </a>
</div>

@endsection