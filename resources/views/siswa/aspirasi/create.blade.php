@extends('layouts.siswa')

@section('page-title', 'Tambah Aspirasi')

@push('styles')
<style>
    .aspirasi-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .section-card {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    .section-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #0066ff 0%, #0052cc 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-control, .form-select {
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #0066ff;
        box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        outline: none;
    }

    .jenis-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .jenis-card {
        position: relative;
        padding: 20px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .jenis-card:hover {
        border-color: #0066ff;
        background: #f8fbff;
    }

    .jenis-card input[type="radio"] {
        position: absolute;
        opacity: 0;
    }

    .jenis-card input[type="radio"]:checked + .jenis-content {
        color: #0066ff;
    }

    .jenis-card input[type="radio"]:checked ~ .jenis-card {
        border-color: #0066ff;
        background: #f8fbff;
    }

    .jenis-card.active {
        border-color: #0066ff;
        background: #f8fbff;
    }

    .jenis-content {
        pointer-events: none;
    }

    .jenis-icon {
        font-size: 32px;
        margin-bottom: 10px;
    }

    .jenis-text {
        font-weight: 600;
        font-size: 14px;
        color: #2c3e50;
    }

    .upload-area {
        border: 2px dashed #e0e0e0;
        border-radius: 8px;
        padding: 40px 20px;
        text-align: center;
        background: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        border-color: #0066ff;
        background: #f8fbff;
    }

    .upload-area.active {
        border-color: #0066ff;
        background: #f8fbff;
    }

    .upload-icon {
        font-size: 48px;
        color: #6c757d;
        margin-bottom: 15px;
    }

    .upload-text {
        font-size: 15px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .upload-hint {
        font-size: 13px;
        color: #999;
    }

    .file-preview {
        margin-top: 15px;
        padding: 12px 15px;
        background: #e7f3ff;
        border: 1px solid #b3d9ff;
        border-radius: 6px;
        display: none;
        align-items: center;
        gap: 10px;
    }

    .file-preview.show {
        display: flex;
    }

    .file-preview i {
        color: #0066ff;
        font-size: 20px;
    }

    .file-name {
        flex: 1;
        color: #0066ff;
        font-weight: 600;
        font-size: 14px;
    }

    .file-remove {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        font-size: 18px;
        padding: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .file-remove:hover {
        color: #c82333;
    }

    .helper-text {
        font-size: 13px;
        color: #6c757d;
        margin-top: 8px;
        display: block;
    }

    .btn-submit {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #0066ff 0%, #0052cc 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 102, 255, 0.3);
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 13px;
        margin-top: 8px;
    }

    @media (max-width: 768px) {
        .jenis-options {
            grid-template-columns: 1fr;
        }

        .section-card {
            padding: 20px;
        }

        .aspirasi-container {
            padding: 0 15px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="aspirasi-container">
        <form action="{{ route('siswa.aspirasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Kategori & Jenis -->
            <div class="section-card">
                <div class="section-header">
                    <h3 class="section-title">Informasi Dasar</h3>
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select class="form-select @error('id_kategori') is-invalid @enderror" 
                            id="id_kategori" name="id_kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->ket_kategori }} 
                            </option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jenis -->
                <div>
                    <label class="form-label">Jenis</label>
                    <div class="jenis-options">
                        <div class="jenis-card" onclick="selectJenis('kerusakan')">
                            <input class="form-check-input" type="radio" name="jenis" id="kerusakan" 
                                   value="kerusakan" {{ old('jenis') == 'kerusakan' ? 'checked' : '' }} required>
                            <div class="jenis-content">
                                <div class="jenis-icon">
                                    <i class="fas fa-exclamation-circle" style="color: #dc3545;"></i>
                                </div>
                                <div class="jenis-text">Kerusakan</div>
                            </div>
                        </div>
                        <div class="jenis-card" onclick="selectJenis('saran')">
                            <input class="form-check-input" type="radio" name="jenis" id="saran" 
                                   value="saran" {{ old('jenis') == 'saran' ? 'checked' : '' }}>
                            <div class="jenis-content">
                                <div class="jenis-icon">
                                    <i class="fas fa-lightbulb" style="color: #ffc107;"></i>
                                </div>
                                <div class="jenis-text">Saran</div>
                            </div>
                        </div>
                    </div>
                    @error('jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Lokasi & Keterangan -->
            <div class="section-card">
                <div class="section-header">
                    <h3 class="section-title">Detail Aspirasi</h3>
                </div>

                <!-- Lokasi -->
                <div class="mb-4">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                           id="lokasi" name="lokasi" 
                           placeholder="Contoh: Kelas XII RPL 3, Laboratorium Komputer, dll" 
                           value="{{ old('lokasi') }}" required>
                    <small class="helper-text">Sebutkan lokasi spesifik dari kerusakan/saran</small>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div>
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                              id="keterangan" name="keterangan" rows="5" 
                              placeholder="Jelaskan detail dari kerusakan/saran anda..." required>{{ old('keterangan') }}</textarea>
                    <small class="helper-text">Berikan penjelasan yang jelas dan detail</small>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Foto Bukti -->
            <div class="section-card">
                <div class="section-header">
                    <h3 class="section-title">Foto Bukti (Opsional)</h3>
                </div>

                <div class="upload-area" id="uploadArea" onclick="document.getElementById('foto_bukti').click()">
                    <input type="file" id="foto_bukti" name="foto_bukti" class="d-none" accept="image/jpeg,image/png,image/jpg">
                    <div class="upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="upload-text">Klik untuk Upload Foto</div>
                    <div class="upload-hint">Format: JPG, PNG (Maksimal 5 MB)</div>
                </div>

                <div class="file-preview" id="filePreview">
                    <i class="fas fa-file-image"></i>
                    <span class="file-name" id="fileName"></span>
                    <button type="button" class="file-remove" onclick="removeFile()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                @error('foto_bukti')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="section-card">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i>
                    <span>Kirim Aspirasi</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Jenis selection
    function selectJenis(type) {
        // Remove active from all
        document.querySelectorAll('.jenis-card').forEach(card => {
            card.classList.remove('active');
        });
        
        // Add active to selected
        const selectedCard = document.getElementById(type).closest('.jenis-card');
        selectedCard.classList.add('active');
        
        // Check the radio
        document.getElementById(type).checked = true;
    }

    // Initialize active jenis on load
    document.addEventListener('DOMContentLoaded', function() {
        const checkedJenis = document.querySelector('input[name="jenis"]:checked');
        if (checkedJenis) {
            checkedJenis.closest('.jenis-card').classList.add('active');
        }
    });

    // File upload handling
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('foto_bukti');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            fileName.textContent = file.name;
            filePreview.classList.add('show');
            uploadArea.classList.add('active');
        }
    });

    function removeFile() {
        fileInput.value = '';
        filePreview.classList.remove('show');
        uploadArea.classList.remove('active');
    }

    // Drag and drop
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('active');
    });

    uploadArea.addEventListener('dragleave', () => {
        if (!fileInput.files.length) {
            uploadArea.classList.remove('active');
        }
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            const event = new Event('change', { bubbles: true });
            fileInput.dispatchEvent(event);
        }
    });
</script>
@endsection