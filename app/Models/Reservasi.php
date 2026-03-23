<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasi';

    protected $fillable = [
        'id_user','id_meja','tanggal_reservasi','jam_reservasi','jumlah_orang',
        'total_harga','metode_pembayaran','bukti_pembayaran','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'id_meja');
    }

    public function detail_reservasi()
    {
        return $this->hasMany(DetailReservasi::class, 'id_reservasi');
    }
}
