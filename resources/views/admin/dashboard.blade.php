@extends('layouts.app-admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .stat-card h3 {
        font-size: 14px;
        color: #666;
        margin: 0 0 10px 0;
        font-weight: 500;
        text-transform: uppercase;
    }

    .stat-card .number {
        font-size: 36px;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
    }

    .stat-card .footer {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #eee;
        font-size: 13px;
        color: #999;
    }

    /* Activity Card */
    .activity-card {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .activity-card h2 {
        font-size: 18px;
        font-weight: 600;
        margin: 0 0 20px 0;
        color: #2c3e50;
    }

    .activity-item {
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-left {
        flex: 1;
    }

    .activity-title {
        font-weight: 600;
        font-size: 15px;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .activity-desc {
        font-size: 14px;
        color: #666;
    }

    .badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        white-space: nowrap;
    }

    .badge-menunggu {
        background: #ffc107;
        color: #000;
    }

    .badge-proses {
        background: #0d6efd;
        color: white;
    }

    .badge-selesai {
        background: #198754;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .empty-state i {
        font-size: 64px;
        margin-bottom: 15px;
        color: #ddd;
    }

    /* Responsive */
    @media (max-width: 1199.98px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 991.98px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            padding: 20px;
        }

        .stat-card h3 {
            font-size: 12px;
        }

        .stat-card .number {
            font-size: 28px;
        }

        .stat-card .footer {
            font-size: 12px;
            margin-top: 10px;
            padding-top: 10px;
        }

        .activity-card {
            padding: 20px;
        }

        .activity-card h2 {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .activity-item {
            padding: 12px 0;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .activity-right {
            width: 100%;
        }

        .activity-desc {
            font-size: 13px;
        }
    }

    @media (max-width: 575.98px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 12px;
            margin-bottom: 15px;
        }

        .stat-card {
            padding: 15px;
        }

        .stat-card h3 {
            font-size: 11px;
            margin-bottom: 8px;
        }

        .stat-card .number {
            font-size: 24px;
        }

        .stat-card .footer {
            font-size: 11px;
            margin-top: 8px;
            padding-top: 8px;
        }

        .activity-card {
            padding: 15px;
        }

        .activity-card h2 {
            font-size: 15px;
            margin-bottom: 12px;
        }

        .activity-title {
            font-size: 14px;
        }

        .activity-desc {
            font-size: 12px;
        }

        .badge {
            padding: 5px 12px;
            font-size: 11px;
        }

        .empty-state {
            padding: 40px 15px;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .empty-state p {
            font-size: 14px;
        }
    }
</style>
@endpush

@section('content')
<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Aspirasi</h3>
        <div class="number">{{ $total_aspirasi ?? 0 }}</div>
        <div class="footer">
            <i class=""></i> Semua data aspirasi
        </div>
    </div>

    <div class="stat-card">
        <h3>Menunggu</h3>
        <div class="number">{{ $menunggu ?? 0 }}</div>
        <div class="footer">
            <i class=""></i> Perlu ditindaklanjuti
        </div>
    </div>

    <div class="stat-card">
        <h3>Proses</h3>
        <div class="number">{{ $proses ?? 0 }}</div>
        <div class="footer">
            <i class=""></i> Dalam penanganan
        </div>
    </div>

    <div class="stat-card">
        <h3>Selesai</h3>
        <div class="number">{{ $selesai ?? 0 }}</div>
        <div class="footer">
            <i class=""></i> Aspirasi terselesaikan
        </div>
    </div>
</div>

<!-- Aktivitas Terbaru -->
<div class="activity-card">
    <h2>Aktivitas Terbaru</h2>
    
    @if(isset($aspirasi_terbaru) && $aspirasi_terbaru->count() > 0)
        @foreach($aspirasi_terbaru as $aspirasi)
        <div class="activity-item">
            <div class="activity-left">
                <div class="activity-title">{{ $aspirasi->kategori->ket_kategori ?? 'Kategori' }}</div>
                <div class="activity-desc">
                    {{ $aspirasi->keterangan }} - {{ $aspirasi->siswa->nama ?? 'Siswa' }}
                </div>
            </div>
            <div class="activity-right">
                <span class="badge badge-{{ strtolower($aspirasi->status) }}">
                    {{ $aspirasi->status }}
                </span>
            </div>
        </div>
        @endforeach
    @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <p>Belum ada aktivitas terbaru</p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    console.log('Dashboard loaded!');
</script>
@endpush