@extends('layouts.app-admin')

@section('title', 'Kategori')
@section('page-title', 'Kategori')

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

    .form-group input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        font-family: inherit;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
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
        align-items: center;
        justify-content: center;
    }

    .modal.show {
        display: flex;
    }

    .modal-content {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        width: 90%;
        max-width: 400px;
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
        margin-bottom: 20px;
        padding-bottom: 15px;
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
        margin-bottom: 20px;
    }

    .modal-footer {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
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

        .modal-content {
            width: 95%;
            padding: 20px;
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

        .btn-submit {
            padding: 10px;
            font-size: 13px;
        }

        .form-group input {
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

        .modal-content {
            width: 95%;
            padding: 15px;
        }

        .modal-header h3 {
            font-size: 14px;
        }
    }
</style>
@endpush

@section('content')
<div class="kategori-container">
    <!-- Form Tambah Kategori -->
    <div class="form-section">
        <h3>Tambah Kategori</h3>
        
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="ket_kategori">Nama Kategori</label>
                <input 
                    type="text" 
                    id="ket_kategori" 
                    name="ket_kategori" 
                    placeholder="Masukkan nama kategori"
                    required
                >
                @error('ket_kategori')
                    <small style="color: #dc3545;">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Simpan Kategori</button>
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
                                <button type="button" class="btn-action btn-edit" data-id="{{ $kat->id_kategori }}" data-nama="{{ $kat->ket_kategori }}" onclick="openEditModal(this)">
                                    Edit
                                </button>
                                <button type="button" class="btn-action btn-delete" onclick="deleteKategori({{ $kat->id_kategori }})">
                                    Hapus
                                </button>
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

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Kategori</h3>
            <button class="modal-close" onclick="closeEditModal()">&times;</button>
        </div>
        
        <form id="editForm" method="POST" onsubmit="return validateForm()">
            @csrf
            @method('PUT')
            <input type="hidden" id="editId" name="editId" value="0">
            
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_ket_kategori">Nama Kategori</label>
                    <input 
                        type="text" 
                        id="edit_ket_kategori" 
                        name="ket_kategori" 
                        placeholder="Masukkan nama kategori"
                        required
                    >
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn-modal-submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    console.log('Kategori script loaded');
    
    let currentEditId = null;
    
    function openEditModal(button) {
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        
        console.log('openEditModal called with id:', id, 'nama:', nama);
        
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        const input = document.getElementById('edit_ket_kategori');
        const idInput = document.getElementById('editId');

        if (!modal || !form || !input || !idInput) {
            console.error('Modal elements not found!');
            return;
        }

        // Store ID in variable and set form action
        currentEditId = id;
        form.action = `/admin/kategori/${id}`;
        idInput.value = id;
        input.value = nama;
        
        console.log('Form action:', form.action);
        console.log('ID input value:', idInput.value);
        
        // Show modal
        modal.classList.add('show');
    }

    function validateForm() {
        const form = document.getElementById('editForm');
        const idInput = document.getElementById('editId');
        
        console.log('Form action before submit:', form.action);
        console.log('ID from hidden input:', idInput.value);
        
        if (!idInput.value || idInput.value === '0') {
            alert('Error: ID tidak ditemukan');
            return false;
        }
        
        // Ensure action is set
        if (!form.action || form.action === '' || form.action.endsWith('/0')) {
            form.action = `/admin/kategori/${idInput.value}`;
        }
        
        console.log('Final form action:', form.action);
        console.log('Form will submit to:', form.action);
        
        return true;
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.remove('show');
        currentEditId = null;
    }

    function deleteKategori(id) {
        if (confirm('Yakin ingin menghapus?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/kategori/${id}`;
            
            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = '_token';
                tokenInput.value = csrfToken.content;
                form.appendChild(tokenInput);
            }
            
            // Add method spoofing for DELETE
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target === modal) {
            closeEditModal();
        }
    }
</script>
@endpush
