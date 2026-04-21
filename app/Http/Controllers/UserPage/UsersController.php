<?php

namespace App\Http\Controllers\UserPage;

use App\Http\Controllers\Controller;
use App\Models\DetailReservasi;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UsersController extends Controller
{
    public function dashboard()
    {

    }

    public function userMenu()
    {
        $drinkMenus = Menu::where('kategori', 'drink')->get();
        $breadMenus = Menu::where('kategori', 'bread')->get();

        return view('user.dashboard', compact('drinkMenus', 'breadMenus'));
    }

    public function destroy($id)
    {
         //proses hapus data
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.dashboard')->with('success', 'Data user berhasil dihapus.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

  public function reservasiForm()
{
    $mejas = Meja::all();

    // ambil meja yang sudah dipakai
    $mejaTerpakai = Reservasi::whereIn('status', ['pending','approved'])
        ->pluck('id_meja')
        ->toArray();

    return view('user.reservasi.step1', compact('mejas','mejaTerpakai'));
}

    public function reservasiMenu(Request $request)
    {
         $menus = Menu::all();

        return view('user.reservasi.step2', [
            'menus' => $menus,
            'data' => $request->all()
        ]);
    }

    public function reservasiCheckout(Request $request)
    {
        $menus = $request->menu_id ?? [];
        $qtys = $request->qty ?? [];

        $total = 0;
        $selectedMenus = [];

        foreach ($menus as $menu_id) {
            $menu = Menu::find($menu_id);
            $qty = $qtys[$menu_id] ?? 0;

            if ($menu && $qty > 0) {
                $subtotal = $menu->harga * $qty;
                $total += $subtotal;

                $selectedMenus[$menu_id] = $qty;
            }
        }

        return view('user.reservasi.step3', [
            'menus' => $selectedMenus,
            'total' => $total,
            'data' => $request->all()
        ]);
    }

public function reservasiStore(Request $request)
{
    $menus = $request->menu_id ?? [];
    $qtys = $request->qty ?? [];

    $total = 0;

    $request->validate([
        'id_meja' => 'required',
        'tanggal_reservasi' => 'required',
        'jam_reservasi' => 'required',
        'jumlah_orang' => 'required',
        'metode_pembayaran' => 'required',
        'bukti_pembayaran' => 'required_if:metode_pembayaran,transfer'
    ]);

    foreach ($menus as $menu_id) {
        $menu = Menu::find($menu_id);
        $qty = $qtys[$menu_id] ?? 0;

        if ($menu && $qty > 0) {
            $total += $menu->harga * $qty;
        }
    }

    // upload bukti
    $bukti = null;
    if ($request->hasFile('bukti_pembayaran')) {
        $bukti = $request->file('bukti_pembayaran')->store('bukti', 'public');
    }

        // CEK apakah meja sudah dipakai
$cek = Reservasi::where('id_meja', $request->id_meja)
    ->where('tanggal_reservasi', $request->tanggal_reservasi)
    ->where('jam_reservasi', $request->jam_reservasi)
    ->whereIn('status', ['pending', 'approved'])
    ->exists();

if ($cek) {
    return back()->with('error', 'Meja sudah dibooking!');
}

    $reservasi = Reservasi::create([
        'id_user' => auth()->id(),
        'id_meja' => $request->id_meja,
        'tanggal_reservasi' => $request->tanggal_reservasi,
        'jam_reservasi' => $request->jam_reservasi,
        'jumlah_orang' => $request->jumlah_orang,
        'total_harga' => $total,
        'metode_pembayaran' => $request->metode_pembayaran,
        'bukti_pembayaran' => $bukti,
        'status' => 'pending'
    ]);

    foreach ($menus as $menu_id) {
        $qty = $qtys[$menu_id] ?? 0;

        if ($qty > 0) {
            $menu = Menu::find($menu_id);

            DetailReservasi::create([
                'id_reservasi' => $reservasi->id,
                'id_menu' => $menu_id,
                'jumlah' => $qty,
                'subtotal' => $menu->harga * $qty
            ]);
        }
    }

    return redirect()->route('user.riwayat')->with('success','Reservasi berhasil!');
}

    public function step2()
    {
        $menus = Menu::all();
        return view('user.reservasi.step2', compact('menus'));
    }

    public function riwayat()
    {
        $data = Reservasi::with('detail_reservasi.menu')
            ->where('id_user', auth()->id())
            ->latest()
            ->get();
        
        $meja = $data->pluck('meja')->filter()->values();

        return view('user.riwayat', compact('data','meja'));
    }


    public function destroyReservasi($id)
    {
        $reservasi = Reservasi::with('meja')->findOrFail($id);

        // ambil tanggal hari ini
        $today = Carbon::today();

        // ubah tanggal reservasi ke format Carbon
        $tanggalReservasi = Carbon::parse($reservasi->tanggal_reservasi);

        //  VALIDASI kalo reservasi udah di approve dan tanggal reservasi masih hari ini atau belum terjadi, maka gak bisa dihapus
        if ($reservasi->status != 'rejected' && $tanggalReservasi >= $today) {
            return back()->with('error', 'Reservasi tidak bisa dihapus!');
        }

        //  BALIKIN STATUS MEJA karna reservasi dihapus, jadi meja nya harus balik ke tersedia
        if ($reservasi->meja) {
            $reservasi->meja->update([
                'status' => 'tersedia'
            ]);
        }

        //  HAPUS DETAIL
        DetailReservasi::where('id_reservasi', $id)->delete();

        //  HAPUS RESERVASI
        $reservasi->delete();

        return back()->with('success', 'Reservasi berhasil dihapus');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile berhasil diperbarui.');
    }
    
}