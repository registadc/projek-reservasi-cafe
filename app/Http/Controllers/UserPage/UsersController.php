<?php

namespace App\Http\Controllers\UserPage;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
}