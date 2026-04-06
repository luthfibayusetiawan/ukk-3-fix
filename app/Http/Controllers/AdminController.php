<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Siswa;
use App\Models\Kategori;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function dashboard()
    {
        $total_aspirasi = Aspirasi::count();
        $menunggu = Aspirasi::where('status', 'Menunggu')->count();
        $proses = Aspirasi::where('status', 'Proses')->count();
        $selesai = Aspirasi::where('status', 'Selesai')->count();
        $aspirasi_terbaru = Aspirasi::with(['siswa', 'kategori'])->latest('created_at')->limit(5)->get();

        return view('admin.dashboard', compact('total_aspirasi', 'menunggu', 'proses', 'selesai', 'aspirasi_terbaru'));
    }
}