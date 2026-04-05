@extends('layouts.app-admin')

@section('title', 'Detail Aspirasi')
@section('page-title', 'Detail Aspirasi')

@push('styles')
<style>
    .detail-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }

    .detail-card, .action-card {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .detail-card h5, .action-card h5 {
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

    .form-select, .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-family: inherit;
        margin-bottom: 15px;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background: #0d6efd;
        color: white;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-submit.green {
        background: #198754;
    }

    .btn-submit:hover {
        opacity: 0.9;
    }

    .feedback-item, .histori-item {
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .feedback-header, .histori-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 13px;
    }

    .feedback-header strong, .histori-status {
        color: #2c3e50;
        font-weight: 600;
    }

    .feedback-time, .histori-time {
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

    @media (max-width: 991.98px) {
        .detail-container {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="detail-container">
    <!-- Left: Detail Aspirasi -->
    <div>
        <!-- 1. Informasi Aspirasi -->
        <div class="detail-card">
            <h5>Informasi Aspirasi</h5>
            <div class="info-row">
                <div class="info-label">ID Aspirasi</div>
                <div class="info-value">#ASP-{{ str_pad($aspirasi->id_aspirasi, 3, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Nama Siswa</div>
                <div class="info-value">{{ $aspirasi->siswa->nama ?? '-' }} ({{ $aspirasi->siswa->nisn ?? '-' }})</div>
            </div>
            <div class="info-row">
                <div class="info-label">Kelas</div>
                <div class="info-value">{{ $aspirasi->siswa->kelas ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Kategori</div>
                <div class="info-value">{{ $aspirasi->kategori->ket_kategori ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jenis</div>
                <div class="info-value">
                    <span style="text-transform: capitalize;">{{ $aspirasi->jenis }}</span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Lokasi</div>
                <div class="info-value">{{ $aspirasi->lokasi }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Keterangan</div>
                <div class="info-value">{{ $aspirasi->keterangan }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Status</div>
                <div class="info-value">
                    <span style="text-transform: capitalize;">{{ $aspirasi->status }}</span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Lapor</div>
                <div class="info-value">{{ $aspirasi->created_at->format('d F Y, H:i') }}</div>
            </div>
        </div>

        <!-- 2. Foto Bukti (Selalu Muncul) -->

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
    </div>

    <!-- Right: Actions -->
    <div>
        <!-- 1. Ubah Status -->
        <div class="action-card">
            <h5>Ubah Status</h5>
            <form action="{{ route('admin.aspirasi.update-status', $aspirasi->id_aspirasi) }}" method="POST">
                @csrf
                @method('PUT')
                <select name="status" class="form-select" required>
                    <option value="menunggu" {{ $aspirasi->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="proses" {{ $aspirasi->status == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ $aspirasi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit" class="btn-submit">Simpan Status</button>
            </form>
        </div>

        <!-- 2. Beri Feedback -->
        <div class="action-card">
            <h5>Beri Feedback</h5>
            <form action="{{ route('admin.aspirasi.store-feedback', $aspirasi->id_aspirasi) }}" method="POST">
                @csrf
                <textarea name="pesan" class="form-control" rows="4" placeholder="Tulis feedback untuk siswa..." required></textarea>
                <button type="submit" class="btn-submit green">Kirim Feedback</button>
            </form>
        </div>

        <!-- 3. Riwayat Feedback (Selalu Muncul) -->
        <div class="action-card">
            <h5>Riwayat Feedback</h5>
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
</div>
@endsection