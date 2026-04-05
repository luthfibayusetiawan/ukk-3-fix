@extends('layouts.app-admin')

@section('title', 'Data Aspirasi')
@section('page-title', 'Data Aspirasi')

@push('styles')
<style>
    /* Filter Section */
    .filter-section {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 25px;
    }

    .filter-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 0;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        font-size: 12px;
        font-weight: 600;
        color: #666;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .filter-group select,
    .filter-group input {
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        font-family: inherit;
        transition: border-color 0.3s ease;
    }

    .filter-group select:focus,
    .filter-group input:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    /* Table Section */
    .table-section {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .table-responsive-wrapper {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .table thead {
        background-color: #f8f9fa;
    }

    .table thead th {
        padding: 16px 12px;
        font-size: 13px;
        font-weight: 600;
        color: #2c3e50;
        text-align: left;
        border-bottom: 2px solid #e9ecef;
        text-transform: uppercase;
    }

    .table tbody tr {
        border-bottom: 1px solid #e9ecef;
        transition: background-color 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .table tbody td {
        padding: 14px 12px;
        font-size: 13px;
        color: #2c3e50;
    }

    .table tbody td:first-child {
        font-weight: 600;
        color: #666;
    }

    .badge-status {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
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

    .btn-detail {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        color: white;
    }

    /* Empty State */
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

    .empty-state p {
        font-size: 16px;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 1199.98px) {
        .filter-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 991.98px) {
        .filter-section {
            padding: 20px;
        }

        .filter-row {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .table {
            font-size: 12px;
        }

        .table thead th {
            padding: 12px 10px;
            font-size: 11px;
        }

        .table tbody td {
            padding: 10px;
            font-size: 12px;
        }

        .badge-status {
            padding: 5px 10px;
            font-size: 11px;
        }

        .btn-detail {
            padding: 6px 12px;
            font-size: 11px;
        }
    }

    @media (max-width: 768px) {
        .table-responsive-wrapper {
            font-size: 12px;
        }

        .table thead th {
            padding: 10px 8px;
            font-size: 10px;
        }

        .table tbody td {
            padding: 8px;
            font-size: 11px;
        }

        /* Hide some columns on smaller screens */
        .table .col-lokasi {
            display: none;
        }

        .table .col-jenis {
            display: none;
        }
    }

    @media (max-width: 575.98px) {
        .filter-section {
            padding: 15px;
            margin-bottom: 15px;
        }

        .table-section {
            border-radius: 4px;
        }

        .table {
            font-size: 11px;
        }

        .table thead th {
            padding: 8px 6px;
            font-size: 9px;
        }

        .table tbody td {
            padding: 6px;
            font-size: 10px;
        }

        .badge-status {
            padding: 4px 8px;
            font-size: 10px;
        }

        .btn-detail {
            padding: 5px 10px;
            font-size: 10px;
        }

        /* Additional hidden columns for mobile */
        .table .col-keterangan {
            display: none;
        }

        .table .col-tanggal {
            display: none;
        }
    }
</style>
@endpush

@section('content')
<!-- Filter Section -->
<div class="filter-section">
    <form method="GET" action="{{ route('admin.aspirasi.index') }}" id="filterForm">
        <div class="filter-row">
            <div class="filter-group">
                <label for="status">Status</label>
                <select name="status" id="status" onchange="document.getElementById('filterForm').submit()">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" onchange="document.getElementById('filterForm').submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id_kategori }}" {{ request('kategori') == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->ket_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="jenis">Jenis</label>
                <select name="jenis" id="jenis" onchange="document.getElementById('filterForm').submit()">
                    <option value="">Semua Jenis</option>
                    <option value="kerusakan" {{ request('jenis') == 'kerusakan' ? 'selected' : '' }}>Kerusakan</option>
                    <option value="saran" {{ request('jenis') == 'saran' ? 'selected' : '' }}>Saran</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="search">Cari Aspirasi</label>
                <input type="text" name="search" id="search" placeholder="Cari aspirasi..." value="{{ request('search') }}">
            </div>
        </div>
    </form>
</div>

<!-- Table Section -->
<div class="table-section">
    @if($aspirasis->count() > 0)
        <div class="table-responsive-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Kategori</th>
                        <th class="col-lokasi">Lokasi</th>
                        <th class="col-keterangan">Keterangan</th>
                        <th class="col-jenis">Jenis</th>
                        <th>Status</th>
                        <th class="col-tanggal">Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aspirasis as $key => $aspirasi)
                    <tr>
                        <td>{{ $aspirasis->firstItem() + $key }}</td>
                        <td>
                            <strong>{{ $aspirasi->siswa->nama ?? '-' }}</strong>
                            <br>
                            <small style="color: #999;">{{ $aspirasi->siswa->nisn ?? '-' }}</small>
                        </td>
                        <td>{{ $aspirasi->kategori->ket_kategori ?? '-' }}</td>
                        <td class="col-lokasi">{{ $aspirasi->lokasi ?? '-' }}</td>
                        <td class="col-keterangan">{{ Str::limit($aspirasi->keterangan, 30) }}</td>
                        <td class="col-jenis">
                            <span style="text-transform: capitalize;">{{ $aspirasi->jenis ?? '-' }}</span>
                        </td>
                        <td style="text-transform: capitalize;">
                            {{ $aspirasi->status }}
                        </td>
                        <td class="col-tanggal">
                            {{ $aspirasi->created_at ? $aspirasi->created_at->format('d M Y') : '-' }}
                        </td>
                        <td>
                            <a href="{{ route('admin.aspirasi.show', $aspirasi->id_aspirasi) }}" class="btn-detail">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="padding: 20px; background: white; border-top: 1px solid #e9ecef;">
            {{ $aspirasis->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <p>Tidak ada data aspirasi</p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    let searchTimeout;
    document.getElementById('search').addEventListener('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            document.getElementById('filterForm').submit();
        }, 500);
    });
</script>
@endpush
