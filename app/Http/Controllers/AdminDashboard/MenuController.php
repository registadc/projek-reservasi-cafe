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

    public function store(Request $request)
    {
          $request->validate([
        'nama_menu' => 'required',
        'deskripsi' => 'required',
        'harga' => 'required|numeric',
        'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // upload gambar
    $gambar = $request->file('gambar')->store('menu', 'public');

    // simpan ke database
    Menu::create([
        'nama_menu' => $request->nama_menu,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'gambar' => $gambar,
    ]);

    return redirect()->route('admin.menu.index')
        ->with('success', 'Menu berhasil ditambahkan');
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function edit()
    {

    }
    
    public function update()
    {

    }

    public function show(string $id)
    {
         $menu = Menu::find($id);
        return view('admin.menu.show', compact('menu'));
    }

    public function destroy($id)
    {
         //proses hapus data
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Data menu berhasil dihapus.');
    }
}
