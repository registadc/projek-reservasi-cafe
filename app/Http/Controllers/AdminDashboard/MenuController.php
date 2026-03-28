<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all(); 
        return view('admin.menu.index', compact('menu'));
    }

    public function store()
    {

    }

    public function create()
    {

    }

    public function edit()
    {

    }
    
    public function update()
    {

    }

    public function show(string $id)
    {
        //
    }

    public function destroy()
    {

    }
}
