<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $fillable = [
        'nama_menu','deskripsi','harga','gambar'
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_meja');
    }
}
