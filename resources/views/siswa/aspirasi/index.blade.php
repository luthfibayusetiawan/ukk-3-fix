@extends('layouts.siswa')

@section('page-title', 'Aspirasi Saya')

@section('content')
<div class="container-fluid py-4">
    <!-- Alert Success -->
    @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter Section -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('siswa.aspirasi.index') }}" method="GET" class="d-flex gap-3 flex-wrap">
                <!-- Filter Status -->
                <div style="flex: 1; min-width: 150px;">
                    <select class="form-select form-select-sm" name="status" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ $status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="proses" {{ $status == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <!-- Filter Kategori -->
                <div style="flex: 1; min-width: 150px;">
                    <select class="form-select form-select-sm" name="kategori" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id_kategori }}" {{ $kategori == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->ket_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Jenis -->
                <div style="flex: 1; min-width: 150px;">
                    <select class="form-select form-select-sm" name="jenis" onchange="this.form.submit()">
                        <option value="">Semua Jenis</option>
                        <option value="kerusakan" {{ $jenis == 'kerusakan' ? 'selected' : '' }}>Kerusakan</option>
                        <option value="saran" {{ $jenis == 'saran' ? 'selected' : '' }}>Saran</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            @if($aspirasi->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 4%;" class="text-center">No</th>
                                <th style="width: 12%;">Kategori</th>
                                <th style="width: 12%;">Lokasi</th>
                                <th style="width: 20%;">Keterangan</th>
                                <th style="width: 10%;" class="text-center">Jenis</th>
                                <th style="width: 12%;" class="text-center">Status</th>
                                <th style="width: 12%;" class="text-center">Tanggal</th>
                                <th style="width: 8%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aspirasi as $key => $asp)
                                <tr>
                                    <td class="text-center fw-bold">{{ ($aspirasi->currentPage() - 1) * $aspirasi->perPage() + $key + 1 }}</td>
                                    <td>
                                        <span class="text-dark">{{ $asp->kategori->ket_kategori }}</span>
                                    </td>
                                    <td>{{ $asp->lokasi }}</td>
                                    <td>
                                        <span title="{{ $asp->keterangan }}" class=" text-dark">
                                            {{ Str::limit($asp->keterangan, 35, '...') }}
                                        </span>
                                    </td>
                                   <td class="text-center">
                                        <span class="text-dark">
                                            {{ ucfirst($asp->jenis) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-dark">
                                            {{ ucfirst($asp->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $asp->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('siswa.aspirasi.show', $asp->id_aspirasi) }}" class="btn btn-sm btn-primary">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($aspirasi->hasPages())
                    <div class="mt-4">
                        {{ $aspirasi->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="mt-3 text-muted">Belum ada aspirasi. <a href="{{ route('siswa.aspirasi.create') }}" class="text-primary fw-bold">Buat aspirasi baru</a></p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .form-select-sm {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }
</style>
@endsection
