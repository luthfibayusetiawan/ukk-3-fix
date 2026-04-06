<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aspirasi;

class DashboardController extends Controller
{
    public function index()
    {
        $nisn = session('nisn');
        
        $totalAspirasi = Aspirasi::where('nisn', $nisn)->count();
        $menunggu = Aspirasi::where('nisn', $nisn)->where('status', 'menunggu')->count();
        $proses = Aspirasi::where('nisn', $nisn)->where('status', 'proses')->count();
        $selesai = Aspirasi::where('nisn', $nisn)->where('status', 'selesai')->count();

        $recentAspirasi = Aspirasi::where('nisn', $nisn)
            ->with('kategori')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('siswa.dashboard', compact(
            'totalAspirasi',
            'menunggu',
            'proses',
            'selesai',
            'recentAspirasi'
        ));
    }
}