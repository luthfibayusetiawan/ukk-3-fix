<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function index(Request $request)
    {
        $nisn = session('nisn');
        $status = $request->query('status');
        $kategori = $request->query('kategori');
        $jenis = $request->query('jenis');
        $query = Aspirasi::where('nisn', $nisn);
        
        if ($status && $status != '') {
            $query->where('status', strtolower($status));
        }
        
        if ($kategori && $kategori != '') {
            $query->where('id_kategori', $kategori);
        }
        
        if ($jenis && $jenis != '') {
            $query->where('jenis', strtolower($jenis));
        }
        
        $aspirasi = $query->with('kategori')->orderBy('created_at', 'desc')->paginate(10);
        $kategoris = Kategori::all();
        
        return view('siswa.aspirasi.index', compact('aspirasi', 'kategoris', 'status', 'kategori', 'jenis'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('siswa.aspirasi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $nisn = session('nisn');
        
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'jenis' => 'required|in:kerusakan,saran',
            'lokasi' => 'required|string|max:50',
            'keterangan' => 'required|string',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:5120'
        ]);
        
        $validated['nisn'] = $nisn;
        $validated['status'] = 'menunggu';
        $validated['created_at'] = now();
        
        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/aspirasi', $filename);
            $validated['foto_bukti'] = $filename;
        }
        
        Aspirasi::create($validated);
        return redirect()->route('siswa.aspirasi.index')->with('success', 'Aspirasi berhasil ditambahkan');
    }

    public function show($id_aspirasi)
    {
        $nisn = session('nisn');
        $aspirasi = Aspirasi::where('id_aspirasi', $id_aspirasi)
            ->where('nisn', $nisn)
            ->with(['kategori', 'feedback.admin'])
            ->firstOrFail();
        
        return view('siswa.aspirasi.show', compact('aspirasi'));
    }
}