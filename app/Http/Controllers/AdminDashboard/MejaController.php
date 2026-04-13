<?php

namespace App\Http\Controllers\AdminDashboard;
use App\Models\Meja;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meja = Meja::all(); 
        return view('admin.meja.index', compact('meja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.meja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|unique:meja,nomor_meja',
            'kapasitas' => 'required|numeric|min:1',
        ]);

        Meja::create([
            'nomor_meja' => $request->nomor_meja,
            'kapasitas' => $request->kapasitas,
            'status' => $request->status
        ]);

        return redirect()->route('admin.meja.index')
            ->with('success', 'Meja berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $meja = Meja::find($id);
        return view('admin.meja.show', compact('meja'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $meja = Meja::findOrFail($id);
        return view('admin.meja.edit', compact('meja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nomor_meja' => 'required|unique:meja,nomor_meja,' . $id,
            'kapasitas' => 'required|numeric|min:1',
            'status' => 'required|in:tersedia,terisi'
        ]);

        $meja = Meja::findOrFail($id);
        $meja->nomor_meja = $request->nomor_meja;
        $meja->kapasitas = $request->kapasitas;
        $meja->status = $request->status;
        $meja->save();

        return redirect()->route('admin.meja.index')
            ->with('success', 'Meja berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meja = Meja::findOrFail($id);
        $meja->delete();

        return redirect()->route('admin.meja.index')
            ->with('success', 'Meja berhasil dihapus');
    }
}
