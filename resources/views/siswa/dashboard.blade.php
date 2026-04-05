@extends('layouts.siswa')

@section('page-title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Stats Grid -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted small mb-3">Total Aspirasi</h5>
                    <h2 class="fw-bold">{{ $totalAspirasi }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted small mb-3">Menunggu</h5>
                    <h2 class="fw-bold">{{ $menunggu }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted small mb-3">Proses</h5>
                    <h2 class="fw-bold">{{ $proses }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-muted small mb-3">Selesai</h5>
                    <h2 class="fw-bold">{{ $selesai }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="card-title mb-0">
                <i class="fas fa-history me-2"></i>Aspirasi Terbaru Anda
            </h5>
        </div>
        <div class="card-body">
            @if($recentAspirasi->count() > 0)
                @foreach($recentAspirasi as $aspirasi)
                <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                    <div>
                        <h6 class="mb-1 fw-bold">{{ $aspirasi->kategori->nama }}</h6>
                        <p class="mb-0 text-muted small">{{ Str::limit($aspirasi->keterangan, 50) }}</p>
                        <small class="text-muted">{{ $aspirasi->created_at->format('d M Y H:i') }}</small>
                    </div>
                    <span class="badge {{ 
                        $aspirasi->status == 'menunggu' ? 'bg-warning text-dark' : 
                        ($aspirasi->status == 'proses' ? 'bg-info' : 'bg-success') 
                    }}">
                        {{ ucfirst($aspirasi->status) }}
                    </span>
                </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="mt-3 text-muted">Belum ada aspirasi</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
