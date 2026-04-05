@extends('layouts.app-admin')

@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')

@push('styles')
<style>
    .siswa-container {
        display: grid;
        gap: 20px;
        margin-bottom: 20px;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .filter-row {
        display: grid;
        grid-template-columns: 1fr 1fr auto;
        gap: 15px;
        align-items: flex-end;
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
        letter-spacing: 0.5px;
    }

    .filter-group input,
    .filter-group select {
        padding: 10px 12px;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        font-size: 13px;
        color: #333;
        font-family: inherit;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }

    .btn-tambah {
        padding: 10px 20px;
        background: #0d6efd;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-tambah:hover {
        background: #0a58ca;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    /* Table Section */
    .table-section {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .table-section h3 {
        font-size: 15px;
        font-weight: 700;
        color: #2c3e50;
        margin: 0 0 15px 0;
        padding: 0;
    }

    .table-responsive-wrapper {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
    }

    .table thead {
        background: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
    }

    .table thead th {
        padding: 12px 15px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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

    /* PERBAIKAN: Action buttons container */
    .table tbody td:last-child {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
        padding: 12px 15px;
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        min-width: 60px;
        height: 30px;
        line-height: 1;
        margin: 0;
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

    .btn-active {
        background: #28a745;
        color: white;
    }

    .btn-active:hover {
        background: #218838;
        transform: translateY(-2px);
    }

    .btn-inactive {
        background: #dc3545;
        color: white;
    }

    .btn-inactive:hover {
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

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s ease;
    }

    .modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        width: 90%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #e9ecef;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 16px;
        color: #2c3e50;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #999;
    }

    .modal-close:hover {
        color: #333;
    }

    .modal-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #666;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        font-size: 13px;
        color: #333;
        font-family: inherit;
        box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }

    .form-group small {
        display: block;
        margin-top: 5px;
        color: #dc3545;
        font-size: 11px;
    }

    .modal-footer {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        padding: 20px;
        border-top: 1px solid #e9ecef;
    }

    .btn-modal-submit {
        padding: 10px 20px;
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-modal-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    .btn-modal-cancel {
        padding: 10px 20px;
        background: #6c757d;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-modal-cancel:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .btn-modal-danger {
        padding: 10px 20px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-modal-danger:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    /* Alert Modal */
    .alert-modal-body {
        padding: 30px 20px;
        text-align: center;
    }

    .alert-modal-body i {
        font-size: 48px;
        margin-bottom: 15px;
    }

    .alert-modal-body i.success {
        color: #28a745;
    }

    .alert-modal-body i.error {
        color: #dc3545;
    }

    .alert-modal-body i.warning {
        color: #ffc107;
    }

    .alert-modal-body p {
        font-size: 15px;
        color: #666;
        margin: 10px 0 0 0;
    }

    /* Responsive */
    @media (max-width: 1199.98px) {
        .filter-row {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 991.98px) {
        .filter-row {
            grid-template-columns: 1fr;
        }

        .filter-section,
        .table-section {
            padding: 15px;
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
            min-width: 50px;
            height: 28px;
        }
    }

    @media (max-width: 768px) {
        .table thead th:nth-child(5),
        .table tbody td:nth-child(5),
        .table thead th:nth-child(6),
        .table tbody td:nth-child(6) {
            display: none;
        }
        
        /* PERBAIKAN: Responsive untuk button di layar kecil */
        .table tbody td:last-child {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
        
        .btn-action {
            width: 100%;
            margin-bottom: 2px;
            height: auto;
            padding: 8px 12px;
            font-size: 11px;
        }
    }

    @media (max-width: 575.98px) {
        .filter-section,
        .table-section {
            padding: 12px;
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
            padding: 6px 8px;
            font-size: 9px;
            min-width: 45px;
        }
    }
</style>
@endpush

@section('content')
<div class="siswa-container">
    <!-- Filter Section -->
    <div class="filter-section">
        <form action="{{ route('admin.siswa.index') }}" method="GET" class="filter-row">
            <div class="filter-group">
                <label>Cari Nama atau NISN</label>
                <input type="text" name="search" placeholder="Cari nama atau NISN..." value="{{ request('search') }}">
            </div>

            <div class="filter-group">
                <label>Semua Kelas</label>
                <select name="kelas">
                    <option value="">Semua Kelas</option>
                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas }}" {{ request('kelas') === $kelas ? 'selected' : '' }}>
                            {{ $kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-tambah">🔍 Filter</button>
        </form>
    </div>

    <!-- Table Section -->
    <div class="table-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h3>Daftar Siswa</h3>
            <button type="button" class="btn-tambah" onclick="openCreateModal()">+ Tambah Siswa</button>
        </div>

        @if($siswas->count() > 0)
            <div class="table-responsive-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Kelas</th>
                            <th>Jumlah Aspirasi</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $key => $siswa)
                        <tr>
                            <td>{{ $siswas->firstItem() + $key }}</td>
                            <td>
                                <strong>{{ $siswa->nama }}</strong>
                            </td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->kelas }}</td>
                            <td>
                                <span style="background: #ffc107; color: #000; padding: 4px 10px; border-radius: 12px; font-size: 12px;">
                                    {{ $siswa->aspirasi->count() ?? 0 }}
                                </span>
                            </td>
                            <td>{{ $siswa->created_at ? $siswa->created_at->format('d M Y') : '-' }}</td>
                            <td>
                                @if($siswa->is_active)
                                    <button type="button" class="btn-action btn-active" onclick="toggleStatus('{{ $siswa->nisn }}')">Aktif</button>
                                @else
                                    <button type="button" class="btn-action btn-inactive" onclick="toggleStatus('{{ $siswa->nisn }}')">Nonaktif</button>
                                @endif
                                <button type="button" class="btn-action btn-edit" onclick="openEditModal(this)" data-nisn="{{ $siswa->nisn }}" data-nama="{{ $siswa->nama }}" data-kelas="{{ $siswa->kelas }}">Edit</button>
                                <button type="button" class="btn-action btn-delete" onclick="openDeleteModal('{{ $siswa->nisn }}', '{{ $siswa->nama }}')">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                {{ $siswas->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <p>Belum ada data siswa</p>
            </div>
        @endif
    </div>
</div>

<!-- Create Modal -->
<div id="createModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Tambah Siswa</h3>
            <button class="modal-close" onclick="closeCreateModal()">&times;</button>
        </div>
        
        <form id="createForm" method="POST" action="{{ route('admin.siswa.store') }}">
            @csrf
            
            <div class="modal-body">
                <div class="form-group">
                    <label for="create_nama">Nama Siswa</label>
                    <input type="text" id="create_nama" name="nama" placeholder="Masukkan nama siswa" required>
                </div>

                <div class="form-group">
                    <label for="create_nisn">NISN</label>
                    <input type="text" id="create_nisn" name="nisn" placeholder="Masukkan NISN" required>
                </div>

                <div class="form-group">
                    <label for="create_kelas">Kelas</label>
                    <input type="text" id="create_kelas" name="kelas" placeholder="Masukkan kelas (contoh: XI IPA 5)" required>
                </div>

                <div class="form-group">
                    <label for="create_password">Password</label>
                    <input type="password" id="create_password" name="password" placeholder="Masukkan password (minimal 6 karakter)" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" onclick="closeCreateModal()">Batal</button>
                <button type="submit" class="btn-modal-submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Siswa</h3>
            <button class="modal-close" onclick="closeEditModal()">&times;</button>
        </div>
        
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_nama">Nama Siswa</label>
                    <input type="text" id="edit_nama" name="nama" placeholder="Masukkan nama siswa" required>
                </div>

                <div class="form-group">
                    <label for="edit_nisn">NISN</label>
                    <input type="text" id="edit_nisn" name="nisn" placeholder="Masukkan NISN" required>
                </div>

                <div class="form-group">
                    <label for="edit_kelas">Kelas</label>
                    <input type="text" id="edit_kelas" name="kelas" placeholder="Masukkan kelas (contoh: XI IPA 5)" required>
                </div>

                <div class="form-group">
                    <label for="edit_password">Password <small style="color: #999;">(kosongkan jika tidak ingin mengubah)</small></label>
                    <input type="password" id="edit_password" name="password" placeholder="Masukkan password baru (opsional)">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn-modal-submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Konfirmasi Hapus</h3>
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
        </div>
        
        <div class="alert-modal-body">
            <i class="fas fa-exclamation-triangle warning"></i>
            <p><strong>Apakah Anda yakin ingin menghapus siswa ini?</strong></p>
            <p id="deleteStudentName" style="margin-top: 5px;"></p>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
            <button type="button" class="btn-modal-danger" onclick="confirmDelete()">Hapus</button>
        </div>
    </div>
</div>

<!-- Success/Error Alert Modal -->
<div id="alertModal" class="modal">
    <div class="modal-content">
        <div class="alert-modal-body">
            <i id="alertIcon" class="fas"></i>
            <p id="alertMessage"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-modal-submit" onclick="closeAlertModal()" style="width: 100%;">OK</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let currentEditNisn = null;
    let currentDeleteNisn = null;

    // Show alert on page load if there's a session message
    @if(session('success'))
        showAlert('success', '{{ session('success') }}');
    @endif

    @if(session('error'))
        showAlert('error', '{{ session('error') }}');
    @endif

    function showAlert(type, message) {
        const alertModal = document.getElementById('alertModal');
        const alertIcon = document.getElementById('alertIcon');
        const alertMessage = document.getElementById('alertMessage');

        if (type === 'success') {
            alertIcon.className = 'fas fa-check-circle success';
        } else {
            alertIcon.className = 'fas fa-times-circle error';
        }

        alertMessage.textContent = message;
        alertModal.classList.add('show');
    }

    function closeAlertModal() {
        document.getElementById('alertModal').classList.remove('show');
    }

    function openCreateModal() {
        document.getElementById('createModal').classList.add('show');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.remove('show');
        document.getElementById('createForm').reset();
    }

    function openEditModal(button) {
        const nisn = button.getAttribute('data-nisn');
        const nama = button.getAttribute('data-nama');
        const kelas = button.getAttribute('data-kelas');

        currentEditNisn = nisn;
        const form = document.getElementById('editForm');
        
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_nisn').value = nisn;
        document.getElementById('edit_kelas').value = kelas;
        document.getElementById('edit_password').value = '';

        form.action = `/admin/siswa/${nisn}`;

        document.getElementById('editModal').classList.add('show');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('show');
        currentEditNisn = null;
    }

    function openDeleteModal(nisn, nama) {
        currentDeleteNisn = nisn;
        document.getElementById('deleteStudentName').textContent = nama;
        document.getElementById('deleteModal').classList.add('show');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('show');
        currentDeleteNisn = null;
    }

    function confirmDelete() {
        if (currentDeleteNisn) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/siswa/${currentDeleteNisn}`;
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = '_token';
                tokenInput.value = csrfToken.content;
                form.appendChild(tokenInput);
            }
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    }

    function toggleStatus(nisn) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/siswa/${nisn}/toggle-active`;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = csrfToken.content;
            form.appendChild(tokenInput);
        }
        
        document.body.appendChild(form);
        form.submit();
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const createModal = document.getElementById('createModal');
        const editModal = document.getElementById('editModal');
        const deleteModal = document.getElementById('deleteModal');
        const alertModal = document.getElementById('alertModal');
        
        if (event.target === createModal) {
            closeCreateModal();
        }
        if (event.target === editModal) {
            closeEditModal();
        }
        if (event.target === deleteModal) {
            closeDeleteModal();
        }
        if (event.target === alertModal) {
            closeAlertModal();
        }
    }
</script>
@endpush