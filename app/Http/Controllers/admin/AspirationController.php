<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Feedback;
use App\Models\HistoriStatus;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    public function index(Request $request)
    {
        $query = Aspirasi::with(['siswa', 'kategori']);
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('keterangan', 'like', "%$search%")
                  ->orWhere('lokasi', 'like', "%$search%")
                  ->orWhereHas('siswa', function ($q) use ($search) {
                      $q->where('nama', 'like', "%$search%");
                  });
            });
        }

        $aspirasis = $query->orderBy('created_at', 'desc')->paginate(10);
        $kategoris = Kategori::all();

        return view('admin.aspirasi.index', compact('aspirasis', 'kategoris'));
    }

    public function show(string $id_aspirasi)
    {
        $aspirasi = Aspirasi::with(['siswa', 'kategori', 'feedback.admin', 'histori'])
            ->findOrFail($id_aspirasi);
        
        return view('admin.aspirasi.show', compact('aspirasi'));
    }

    public function updateStatus(Request $request, string $id_aspirasi)
    {
        $request->validate([
            'status' => 'required|in:menunggu,proses,selesai'
        ]);

        $aspirasi = Aspirasi::findOrFail($id_aspirasi);
        $aspirasi->update(['status' => $request->status]);

        // Tambah histori
        HistoriStatus::create([
            'id_aspirasi' => $id_aspirasi,
            'status' => $request->status,
            'tanggal' => now()
        ]);

        return redirect()->back()->with('success', 'Status berhasil diubah');
    }

    public function storeFeedback(Request $request, string $id_aspirasi)
    {
        $request->validate([
            'pesan' => 'required|string'
        ]);

        Feedback::create([
            'id_aspirasi' => $id_aspirasi,
            'id_admin' => session('user_id'),
            'pesan' => $request->pesan,
            'created_at' => now()
        ]);

        return redirect()->back()->with('success', 'Feedback berhasil dikirim');
    }
}