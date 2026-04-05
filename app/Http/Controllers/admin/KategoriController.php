<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::with('aspirasi')->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ket_kategori' => 'required|string|max:255|unique:kategori,ket_kategori',
        ], [
            'ket_kategori.required' => 'Nama kategori tidak boleh kosong',
            'ket_kategori.unique' => 'Nama kategori sudah ada',
        ]);

        Kategori::create([
            'ket_kategori' => $request->ket_kategori,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        $kategoris = Kategori::with('aspirasi')->get();
        return view('admin.kategori.index', compact('kategori', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);

        $request->validate([
            'ket_kategori' => 'required|string|max:255|unique:kategori,ket_kategori,' . $id_kategori . ',id_kategori',
        ], [
            'ket_kategori.required' => 'Nama kategori tidak boleh kosong',
            'ket_kategori.unique' => 'Nama kategori sudah ada',
        ]);

        $kategori->update([
            'ket_kategori' => $request->ket_kategori,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
