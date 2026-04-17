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
        $meja = $reservasi->pluck('meja')->filter()->values();
        return view('admin.reservasi.index', compact('reservasi','meja'));
    }

    public function show($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        // ambil detail reservasi
        $detail = DetailReservasi::where('id_reservasi', $id)->get();

        // ambil data meja yang dipesan
        $meja = $reservasi->meja;

        return view('admin.reservasi.show', compact('reservasi', 'detail','meja'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reservasi = Reservasi::with('meja')->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        // update status reservasi
        $reservasi->status = $request->status;
        $reservasi->save();

        // kalo reserv nya di approve maka status meja nya terisi
        if ($request->status == 'approved') {
            if ($reservasi->meja) {
                $reservasi->meja->update([
                    'status' => 'tidak tersedia'
                ]);
            }
        }

        if ($request->status == 'rejected') {
            if ($reservasi->meja) {
                $reservasi->meja->update([
                    'status' => 'tersedia'
                ]);
            }
        }

        return back()->with('success', 'Status berhasil diupdate');
    }

    public function destroy($id)
{
    $reservasi = Reservasi::findOrFail($id);

    // Hapus detail reservasi dulu (relasi)
    $reservasi->detailReservasi()->delete();

    // Baru hapus reservasi
    $reservasi->delete();

    return redirect()->back()->with('success', 'Reservasi berhasil dihapus');
}
}
