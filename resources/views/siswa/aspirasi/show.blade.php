@extends('layouts.siswa')
@section('page-title', 'Detail Aspirasi')
@section('content')

<style>
    .detail-card {

        background: white;

        padding: 25px;

        border-radius: 8px;

        box-shadow: 0 2px 4px rgba(0,0,0,0.1);

        margin-bottom: 20px;

    }
    .detail-card h5 {

        font-size: 16px;

        font-weight: 600;

        margin-bottom: 20px;

        padding-bottom: 15px;

        border-bottom: 2px solid #f0f0f0;

        color: #2c3e50;

    }
    .info-row {

        display: grid;

        grid-template-columns: 150px 1fr;

        padding: 12px 0;

        border-bottom: 1px solid #f5f5f5;

    }
    .info-row:last-child {

        border-bottom: none;

    }
    .info-label {

        font-weight: 600;

        color: #666;

        font-size: 14px;

    }
    .info-value {

        color: #2c3e50;

        font-size: 14px;

    }
    .photo-grid {

        display: grid;

        grid-template-columns: repeat(2, 1fr);

        gap: 15px;

        margin-top: 15px;

    }
    .photo-grid img {

        width: 100%;

        height: 200px;

        object-fit: cover;

        border-radius: 8px;

        border: 1px solid #e9ecef;

    }
    .feedback-item {

        padding: 15px;

        background: #f8f9fa;

        border-radius: 8px;

        margin-bottom: 10px;

    }
    .feedback-header {

        display: flex;

        justify-content: space-between;

        margin-bottom: 8px;

        font-size: 13px;

    }
    .feedback-header strong {

        color: #2c3e50;

    }
    .feedback-time {

        color: #999;

        font-size: 12px;

    }
    .feedback-text {

        font-size: 14px;

        color: #666;

        line-height: 1.5;

    }
    .empty-message {

        text-align: center;

        color: #999;

        font-size: 14px;

        padding: 20px;

    }

</style>

<div class="container-fluid py-4">
    <!-- 1. Informasi Aspirasi -->
    <div class="detail-card">
        <h5>Informasi Aspirasi</h5>
        <div class="info-row">
            <div class="info-label">ID Aspirasi</div>
            <div class="info-value">#ASP-{{ str_pad($aspirasi->id_aspirasi, 3, '0', STR_PAD_LEFT) }}</div>
        </div>

        <div class="info-row">

            <div class="info-label">Lokasi</div>

            <div class="info-value">{{ $aspirasi->lokasi }}</div>

        </div>

        <div class="info-row">
            <div class="info-label">Kategori</div>
            <div class="info-value">{{ $aspirasi->kategori->ket_kategori ?? '-' }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Jenis</div>
            <div class="info-value" style="text-transform: capitalize;">{{ $aspirasi->jenis }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Keterangan</div>
            <div class="info-value">{{ $aspirasi->keterangan }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Status</div>
            <div class="info-value" style="text-transform: capitalize;">{{ $aspirasi->status }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">Tanggal Lapor</div>
            <div class="info-value">{{ $aspirasi->created_at->format('d F Y, H:i') }}</div>
        </div>
    </div>

    <!-- 2. Foto Bukti -->
    <div class="detail-card">
        <h5>Foto Bukti</h5>
        @if($aspirasi->foto_bukti)
            <div class="photo-grid">
                <img src="{{ asset('storage/aspirasi/' . $aspirasi->foto_bukti) }}" alt="Foto Bukti">
            </div>
        @else
            <div class="empty-message">-</div>
        @endif
    </div>

    <!-- 3. Feedback dari Admin -->
    <div class="detail-card">
        <h5>Feedback dari Admin</h5>
        @if($aspirasi->feedback && $aspirasi->feedback->count() > 0)
            @foreach($aspirasi->feedback->sortByDesc('created_at') as $fb)
            <div class="feedback-item">
                <div class="feedback-header">
                    <strong>{{ $fb->admin->username ?? 'Admin' }}</strong>
                    <span class="feedback-time">{{ \Carbon\Carbon::parse($fb->created_at)->format('d M Y, H:i') }}</span>
                </div>
                <div class="feedback-text">{{ $fb->pesan }}</div>
            </div>
            @endforeach
        @else
            <div class="empty-message">-</div>
        @endif
    </div>
</div>

@endsection