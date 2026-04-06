<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_aspirasi' => Aspirasi::count(),
            'menunggu' => Aspirasi::where('status', 'Menunggu')->count(),
            'proses' => Aspirasi::where('status', 'Proses')->count(),
            'selesai' => Aspirasi::where('status', 'Selesai')->count(),
            'aspirasi_terbaru' => Aspirasi::with(['siswa', 'kategori'])
                ->latest('created_at')
                ->take(5)
                ->get(),
        ];
        
        return view('admin.dashboard', $data);
    }
}