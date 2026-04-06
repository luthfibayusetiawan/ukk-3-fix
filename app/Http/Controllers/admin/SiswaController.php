<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Siswa::with('aspirasi');
        if (request('search')) {
            $search = request('search');
            $query->where('nisn', 'like', "%$search%")
                  ->orWhere('nama', 'like', "%$search%");
        }
        if (request('kelas')) {
            $query->where('kelas', request('kelas'));
        }

        $siswas = $query->paginate(10);
        $kelasList = Siswa::distinct('kelas')->pluck('kelas');

        return view('admin.siswa.index', compact('siswas', 'kelasList'));
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
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|unique:siswa,nisn',
            'kelas' => 'required|string|max:10',
            'password' => 'required|string|min:6',
        ], [
            'nama.required' => 'Nama siswa tidak boleh kosong',
            'nisn.required' => 'NISN tidak boleh kosong',
            'nisn.unique' => 'NISN sudah terdaftar',
            'kelas.required' => 'Kelas tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan');
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
    public function edit(string $nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        $siswas = Siswa::with('aspirasi')->paginate(10);
        $kelasList = Siswa::distinct('kelas')->pluck('kelas');

        return view('admin.siswa.index', compact('siswa', 'siswas', 'kelasList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nisn)
    {
        $siswa = Siswa::findOrFail($nisn);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|unique:siswa,nisn,' . $nisn . ',nisn',
            'kelas' => 'required|string|max:10',
            'password' => 'nullable|string|min:6',
        ], [
            'nama.required' => 'Nama siswa tidak boleh kosong',
            'nisn.required' => 'NISN tidak boleh kosong',
            'nisn.unique' => 'NISN sudah terdaftar',
            'kelas.required' => 'Kelas tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        $updateData = [
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
        ];

        if ($request->password) {
            $updateData['password'] = Hash::make($request->password);
        }

        $siswa->update($updateData);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil diperbarui');
    }

    /**
     * Toggle is_active status
     */
    public function toggleActive(string $nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        $siswa->update([
            'is_active' => !$siswa->is_active
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Status siswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
}