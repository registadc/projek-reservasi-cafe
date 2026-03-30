<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Models\Reservasi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {

        $totalUsers = User::count();
        $totalReservasi = Reservasi::count();
        $totalMenu = Menu::count();

    $reservasiChart = Reservasi::select(
            DB::raw('MONTH(tanggal_reservasi) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan');

    $maxReservasi = $reservasiChart->max();

    return view('admin.dashboard', compact('reservasiChart', 'maxReservasi','totalMenu','totalReservasi','totalUsers'));
    }
}

    

