<?php

namespace App\Http\Controllers\UserPage;

use App\Http\Controllers\Controller;
use App\Models\Menu;

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
}