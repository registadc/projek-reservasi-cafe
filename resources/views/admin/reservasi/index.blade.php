@extends('admin.layouts.app')

@section('title','dashboard')

@section('content')
    <div class="glass-card table-card">

    <div class="card-header" style="display:flex; justify-content:space-between;">
        <div>
            <h2 class="card-title">Data Reservasi</h2>
            <p class="card-subtitle">Reservasi dari user</p>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Orang</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($reservasi as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $r->user->name ?? $r->id_user }}</td>

                    <td>{{ $r->tanggal_reservasi }}</td>

                    <td>{{ $r->jam_reservasi }}</td>

                    <td>{{ $r->jumlah_orang }}</td>

                    <td>Rp {{ number_format($r->total_harga) }}</td>

                    <td>
                        <span class="status-badge 
                            {{ $r->status == 'pending' ? 'pending' : '' }}
                            {{ $r->status == 'confirmed' ? 'completed' : '' }}
                            {{ $r->status == 'canceled' ? 'cancelled' : '' }}">
                            
                            {{ ucfirst($r->status) }}
                        </span>
                    </td>

                    <td style="text-align:center;">
                        <a href="{{ route('admin.reservasi.show', $r->id) }}" 
                           class="table-btn detail">
                            Detail
                        </a>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">
                        Belum ada reservasi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection