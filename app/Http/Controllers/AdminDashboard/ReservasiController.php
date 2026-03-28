<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Models\Reservasi;
use App\Http\Controllers\Controller;
use App\Models\DetailReservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasi = Reservasi::with(['user','meja'])->latest()->get();
        return view('admin.reservasi.index', compact('reservasi'));
    }

    public function show($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        // ambil detail reservasi
        $detail = DetailReservasi::where('id_reservasi', $id)->get();

        return view('admin.reservasi.show', compact('reservasi', 'detail'));
    }
}
