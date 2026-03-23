<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailReservasi extends Model
{
    protected $table = 'detail_reservasi';

    protected $fillable = [
        'id_reservasi','id_menu','jumlah','subtotal'
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi');
    }

    public function detail_reservasi()
    {
        return $this->hasMany(DetailReservasi::class, 'id_menu');
    }
}
