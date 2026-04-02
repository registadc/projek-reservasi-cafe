<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
        'gambar' => 'required|image|mimes:jpg,jpeg,png,jfif|max:2048',
        'kategori' => 'required|in:drink,bread'
    ]);

    // upload gambar
    $gambar = $request->file('gambar')->store('menu', 'public');

    // simpan ke database
    Menu::create([
        'nama_menu' => $request->nama_menu,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'gambar' => $gambar,
        'kategori' => $request->kategori
    ]);

    return redirect()->route('admin.menu.index')
        ->with('success', 'Menu berhasil ditambahkan');
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required|in:drink,bread',
        ]);

        $menu = Menu::findOrFail($id);

        if ($request->hasFile('gambar')) {
            // hapus gambar lama
            Storage::disk('public')->delete($menu->gambar);

            // upload gambar baru
            $gambar = $request->file('gambar')->store('menu', 'public');
            $menu->gambar = $gambar;
        }

        $menu->nama_menu = $request->nama_menu;
        $menu->deskripsi = $request->deskripsi;
        $menu->harga = $request->harga;
        $menu->kategori = $request->kategori;
        $menu->save();

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil diperbarui');
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
