@extends('layouts.app-admin')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@push('styles')
<style>
    /* Main Container */
    .kategori-container {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    /* Form Section */
    .form-section {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        height: fit-content;
    }

    .form-section h3 {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        font-family: inherit;
        transition: border-color 0.3s ease;
        resize: vertical;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    .form-group textarea {
        min-height: 60px;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    .btn-back {
        width: 100%;
        margin-top: 10px;
        padding: 12px;
        background: #6c757d;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-back:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    /* Table Section */
    .table-section {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .table-section h3 {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        padding: 20px 25px;
        margin: 0;
        border-bottom: 1px solid #e9ecef;
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
        padding: 14px 15px;
        font-size: 12px;
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
        padding: 12px 15px;
        font-size: 13px;
        color: #2c3e50;
    }

    .table tbody td:first-child {
        font-weight: 600;
        color: #666;
    }

    .btn-action {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-right: 5px;
    }

    .btn-edit {
        background: #ffc107;
        color: #000;
    }

    .btn-edit:hover {
        background: #ffb300;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
        transform: translateY(-2px);
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
        .kategori-container {
            grid-template-columns: 1fr;
        }

        .form-section {
            height: auto;
        }
    }

    @media (max-width: 991.98px) {
        .kategori-container {
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-section,
        .table-section {
            padding: 20px;
        }

        .form-section h3,
        .table-section h3 {
            font-size: 15px;
        }

        .table thead th {
            padding: 10px 12px;
            font-size: 11px;
        }

        .table tbody td {
            padding: 10px 12px;
            font-size: 12px;
        }

        .btn-action {
            padding: 5px 10px;
            font-size: 10px;
        }
    }

    @media (max-width: 768px) {
        .table-responsive-wrapper {
            font-size: 11px;
        }

        .table thead th {
            padding: 8px 10px;
            font-size: 10px;
        }

        .table tbody td {
            padding: 8px 10px;
            font-size: 11px;
        }

        .table .col-keterangan {
            display: none;
        }
    }

    @media (max-width: 575.98px) {
        .form-section,
        .table-section {
            padding: 15px;
        }

        .form-section h3,
        .table-section h3 {
            font-size: 14px;
            padding: 15px 0;
        }

        .table {
            font-size: 10px;
        }

        .table thead th {
            padding: 6px 8px;
            font-size: 9px;
        }

        .table tbody td {
            padding: 6px 8px;
            font-size: 10px;
        }

        .btn-action {
            padding: 4px 8px;
            font-size: 9px;
            margin-right: 3px;
        }

        .btn-submit,
        .btn-back {
            padding: 10px;
            font-size: 13px;
        }

        .form-group input,
        .form-group textarea {
            padding: 8px 10px;
            font-size: 13px;
        }

        .form-group label {
            font-size: 12px;
        }

        .empty-state {
            padding: 40px 15px;
        }

        .empty-state i {
            font-size: 48px;
        }
    }
</style>
@endpush

@section('content')
<div class="kategori-container">
    <!-- Form Edit Kategori -->
    <div class="form-section">
        <h3>Edit Kategori</h3>
        
        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="ket_kategori">Nama Kategori</label>
                <input 
                    type="text" 
                    id="ket_kategori" 
                    name="ket_kategori" 
                    placeholder="Masukkan nama kategori"
                    value="{{ $kategori->ket_kategori }}"
                    required
                >
                @error('ket_kategori')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Perbarui Kategori</button>
            <a href="{{ route('admin.kategori.index') }}" class="btn-back">Kembali</a>
        </form>
    </div>

    <!-- Daftar Kategori -->
    <div class="table-section">
        <h3>Daftar Kategori</h3>
        
        @if($kategoris->count() > 0)
            <div class="table-responsive-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Jumlah Aspirasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoris as $key => $kat)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $kat->ket_kategori }}</td>
                            <td>
                                <span style="background: #ffc107; color: #000; padding: 4px 10px; border-radius: 12px; font-size: 12px;">
                                    {{ $kat->aspirasi->count() ?? 0 }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.kategori.edit', $kat->id) }}" class="btn-action btn-edit">
                                    Edit
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $kat->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>Belum ada kategori</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    console.log('Edit Kategori page loaded!');
</script>
@endpush
