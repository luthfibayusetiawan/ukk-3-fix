@extends('layouts.app')

@section('title', 'Lapcare - Sistem Pengaduan Sekolah')

@push('styles')
<style>
    /* Custom container with better spacing */
    .custom-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* LEFT SIDE - Lebih besar (55-60%) */
    .left-column {
        padding-right: 3.5rem !important;
    }

    .left-content {
        max-width: 90%;
    }

    /* RIGHT SIDE - Lebih kecil (40-45%) */
    .right-column {
        padding-left: 2rem !important;
    }

    /* Logo styling */
    .logo-container {
        margin-bottom: 2rem;
    }

    .logo {
        height: 160px;
        width: 160px;
        object-fit: contain;
    }

    /* Title styling */
    .main-title {
        font-size: 2.4rem;
        line-height: 1.3;
        color: #333333;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    /* Description styling */
    .description {
        font-size: 1.05rem;
        line-height: 1.7;
        color: #666666;
        margin-bottom: 2.5rem;
    }

    /* Features list */
    .feature-list {
        margin-top: 2rem;
    }

    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 1rem;
    }

    .check-icon {
        color: var(--primary-blue);
        margin-top: 2px;
        font-size: 1.1rem;
    }

    .feature-text {
        color: #555555;
        font-size: 1rem;
    }

    /* Right side card */
    .login-card {
        background-color: #f8f9fa;
        border-radius: 1.2rem;
        padding: 2.5rem;
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
        position: relative;
        z-index: 1;
    }

    .card-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333333;
        margin-bottom: 0.5rem;
    }

    .card-subtitle {
        font-size: 0.95rem;
        color: #6c757d;
        margin-bottom: 1.8rem;
    }

    /* Role buttons styling */
    .role-buttons-container {
        margin-bottom: 2rem;
    }

    .role-button {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 22px 15px;
        border: 2px solid #dee2e6;
        border-radius: 0.8rem;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        height: 100%;
        min-height: 120px;
        background-color: #ffffff;
    }

    .role-button.active-role {
        background-color: var(--primary-blue);
        color: white;
        border-color: var(--primary-blue);
        box-shadow: 0 8px 20px rgba(0, 0, 255, 0.2);
    }

    .role-button.active-role .role-icon {
        color: white;
        transform: scale(1.1);
    }

    .role-button.inactive-role {
        background-color: #ffffff;
        color: #333333;
        border-color: #dee2e6;
    }

    /* Enhanced hover effects */
    .role-button:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    #btnSiswa:hover {
        background-color: var(--light-blue);
        border-color: var(--accent-blue);
        color: var(--dark-blue);
        box-shadow: 0 10px 25px rgba(77, 171, 247, 0.2);
    }

    #btnSiswa:hover .role-icon {
        color: var(--dark-blue);
        transform: scale(1.12) translateY(-2px);
    }

    #btnAdmin:hover {
        background-color: var(--light-yellow);
        border-color: var(--accent-yellow);
        color: var(--dark-yellow);
        box-shadow: 0 10px 25px rgba(255, 212, 59, 0.2);
    }

    #btnAdmin:hover .role-icon {
        color: var(--dark-yellow);
        transform: scale(1.12) translateY(-2px);
    }

    .active-role#btnSiswa:hover,
    .active-role#btnAdmin:hover {
        background-color: #1a1aff;
        border-color: #1a1aff;
        color: white;
        box-shadow: 0 10px 25px rgba(0, 0, 255, 0.25);
    }

    .active-role#btnSiswa:hover .role-icon,
    .active-role#btnAdmin:hover .role-icon {
        color: white;
    }

    .role-icon {
        font-size: 2.2rem;
        transition: all 0.3s ease;
    }

    .role-text {
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 0.3px;
    }

    /* Form styling */
    .form-label {
        font-weight: 500;
        color: #495057;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .form-control {
        padding: 0.85rem 1rem;
        border: 1.5px solid #ced4da;
        border-radius: 0.6rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.25rem rgba(0, 0, 255, 0.15);
    }

    /* Password input wrapper */
    .password-wrapper {
        position: relative;
    }

    .password-wrapper .form-control {
        padding-right: 3rem;
    }

    .toggle-password {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        padding: 0.5rem;
        transition: color 0.3s ease;
        z-index: 10;
    }

    .toggle-password:hover {
        color: var(--primary-blue);
    }

    .toggle-password i {
        font-size: 1.1rem;
    }

    .submit-button {
        background-color: #000000;
        color: white;
        padding: 1rem;
        border: none;
        border-radius: 0.6rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 0.5rem;
    }

    .submit-button:hover {
        background-color: #333333;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Pulsing effect for active buttons */
    @keyframes pulse-glow {
        0% { box-shadow: 0 0 0 0 rgba(0, 0, 255, 0.3); }
        70% { box-shadow: 0 0 0 8px rgba(0, 0, 255, 0); }
        100% { box-shadow: 0 0 0 0 rgba(0, 0, 255, 0); }
    }

    .active-role {
        animation: pulse-glow 2s infinite;
    }

    /* Popup Styles - Only Error Popup on Landing Page */
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        backdrop-filter: blur(5px);
    }

    .popup-content {
        background: white;
        padding: 2.5rem 3rem;
        border-radius: 1.5rem;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        width: 90%;
        animation: popupAppear 0.3s ease-out;
    }

    @keyframes popupAppear {
        0% {
            transform: scale(0.7);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .popup-icon.error {
        font-size: 4rem;
        color: #dc3545;
        margin-bottom: 1rem;
    }

    .popup-title {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .popup-message {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 1.5rem;
    }

    /* Loading Popup Specific */
    .loading-spinner {
        width: 60px;
        height: 60px;
        border: 5px solid #f3f3f3;
        border-top: 5px solid var(--primary-blue);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 1.5rem;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .loading-text {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .loading-subtext {
        font-size: 1rem;
        color: #888;
        font-style: italic;
    }

    /* Disable form during submission */
    .form-submitting {
        pointer-events: none;
        opacity: 0.7;
    }

    /* Responsive adjustments */
    @media (max-width: 1199.98px) {
        .left-column {
            padding-right: 2rem !important;
        }
        
        .right-column {
            padding-left: 1.5rem !important;
        }
        
        .main-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 991.98px) {
        .left-column,
        .right-column {
            padding-right: 1rem !important;
            padding-left: 1rem !important;
        }
        
        .left-content {
            max-width: 100%;
            text-align: center;
        }
        
        .logo-container {
            display: flex;
            justify-content: center;
        }
        
        .main-title {
            font-size: 2rem;
        }
        
        .login-card {
            margin-top: 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
    }

    @media (max-width: 767.98px) {
        .main-title {
            font-size: 1.8rem;
        }
        
        .description {
            font-size: 1rem;
        }
        
        .login-card {
            padding: 2rem;
        }
        
        .card-title {
            font-size: 1.6rem;
        }
        
        .popup-content {
            padding: 2rem;
        }
        
        .popup-title {
            font-size: 1.6rem;
        }
        
        .popup-message {
            font-size: 1rem;
        }
        
        .loading-text {
            font-size: 1.2rem;
        }
    }

    @media (max-width: 575.98px) {
        .role-button {
            min-height: 110px;
            padding: 18px 10px;
        }
        
        .role-icon {
            font-size: 2rem;
        }
        
        .login-card {
            padding: 1.5rem;
        }
    }

    /* Remove hover effects on touch devices */
    @media (hover: none) and (pointer: coarse) {
        .role-button:hover {
            transform: none;
            box-shadow: none;
        }
        
        .active-role {
            animation: none;
        }
    }
</style>
@endpush

@section('body')
<div class="min-vh-100 d-flex align-items-center py-4 py-lg-5">
    <div class="container-fluid custom-container px-3 px-lg-4">
        <div class="row align-items-center">
            
            <!-- Column kiri - Lebih besar (55-60%) -->
            <div class="col-lg-7 col-xl-7 left-column mb-4 mb-lg-0">
                <div class="left-content">
                    <!-- Logo -->
                    <div class="logo-container">
                        <img src="{{ asset('storage/images/logogo.png') }}" alt="Lapcare Logo" class="logo">
                    </div>

                    <!-- Title -->
                    <h1 class="main-title">
                        Aplikasi Sarana dan Prasarana<br>
                        Sistem Pengaduan Sekolah Digital
                    </h1>

                    <!-- Description -->
                    <p class="description">
                        Platform modern untuk menyampaikan aspirasi dan pengaduan terkait sarana prasarana sekolah. 
                        Pantau status pengaduan secara real-time dan dapatkan umpan balik dari admin sekolah dengan cepat dan efisien.
                    </p>

                    <!-- Features List -->
                    <div class="feature-list">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-check-circle check-icon"></i>
                                    <span class="feature-text">Sampaikan aspirasi dengan mudah</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-check-circle check-icon"></i>
                                    <span class="feature-text">Pantau status pengaduan real-time</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-check-circle check-icon"></i>
                                    <span class="feature-text">Dapatkan umpan balik dari admin</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-check-circle check-icon"></i>
                                    <span class="feature-text">Interface intuitif & user-friendly</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN - Lebih kecil (40-45%) -->
            <div class="col-lg-5 col-xl-5 right-column">
                <div class="login-card">
                    <!-- Card Header -->
                    <div class="text-center mb-4">
                        <h2 class="card-title">Masuk ke Sistem</h2>
                        <p class="card-subtitle">Pilih role Anda untuk melanjutkan</p>
                    </div>

                    <!-- Role Selection -->
                    <div class="role-buttons-container">
                        <div class="row g-3">
                            <div class="col-6">
                                <button id="btnSiswa" class="role-button w-100 active-role" onclick="switchRole('siswa')">
                                    <i class="fas fa-user-graduate role-icon"></i>
                                    <span class="role-text">Siswa</span>
                                </button>
                            </div>
                            <div class="col-6">
                                <button id="btnAdmin" class="role-button w-100 inactive-role" onclick="switchRole('admin')">
                                    <i class="fas fa-user-shield role-icon"></i>
                                    <span class="role-text">Admin</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Login Form - Siswa -->
                    <form method="POST" action="{{ route('login.post') }}" id="loginFormSiswa" style="display: block;">
                        @csrf
                        <input type="hidden" name="role" value="siswa">
                        
                        <div class="mb-3">
                            <label class="form-label">NISN</label>
                            <input type="number" name="nisn" class="form-control" placeholder="Masukkan NISN" value="{{ old('nisn') }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <div class="password-wrapper">
                                <input type="password" id="passwordSiswa" name="password" class="form-control" placeholder="Masukkan password" required>
                                <button type="button" class="toggle-password" onclick="togglePassword('passwordSiswa', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="submit-button" onclick="return validateAndShowLoading('siswa')">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk sebagai Siswa
                        </button>
                    </form>

                    <!-- Login Form - Admin -->
                    <form method="POST" action="{{ route('login.post') }}" id="loginFormAdmin" style="display: none;">
                        @csrf
                        <input type="hidden" name="role" value="admin">
                        
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="{{ old('username') }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <div class="password-wrapper">
                                <input type="password" id="passwordAdmin" name="password" class="form-control" placeholder="Masukkan password" required>
                                <button type="button" class="toggle-password" onclick="togglePassword('passwordAdmin', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="submit-button" onclick="return validateAndShowLoading('admin')">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk sebagai Admin
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Popup Loading -->
<div class="popup-overlay" id="loadingPopup">
    <div class="popup-content">
        <div class="loading-spinner"></div>
        <p class="loading-text">Loading...</p>
        <p class="loading-subtext">sabar ya beb</p>
    </div>
</div>

<!-- Popup Error -->
<div class="popup-overlay" id="errorPopup">
    <div class="popup-content">
        <i class="fas fa-times-circle popup-icon error"></i>
        <h3 class="popup-title">Login Gagal!</h3>
        <p class="popup-message" id="errorMessage">Username atau password salah</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let isSubmitting = false;

    function switchRole(role) {
        const btnSiswa = document.getElementById('btnSiswa');
        const btnAdmin = document.getElementById('btnAdmin');
        const formSiswa = document.getElementById('loginFormSiswa');
        const formAdmin = document.getElementById('loginFormAdmin');

        if (role === 'siswa') {
            formSiswa.style.display = 'block';
            formAdmin.style.display = 'none';

            btnSiswa.classList.remove('inactive-role');
            btnSiswa.classList.add('active-role');
            
            btnAdmin.classList.remove('active-role');
            btnAdmin.classList.add('inactive-role');
        } else {
            formAdmin.style.display = 'block';
            formSiswa.style.display = 'none';

            btnAdmin.classList.remove('inactive-role');
            btnAdmin.classList.add('active-role');
            
            btnSiswa.classList.remove('active-role');
            btnSiswa.classList.add('inactive-role');
        }
    }

    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Keep role active after error
    document.addEventListener('DOMContentLoaded', function() {
        @if(old('role'))
            const oldRole = '{{ old('role') }}';
            if (oldRole === 'admin') {
                switchRole('admin');
            } else {
                switchRole('siswa');
            }
        @endif

        // Cek apakah ada error dari server
        @if($errors->has('login'))
            showErrorPopup('{{ $errors->first('login') }}');
        @endif
    });

    // Fungsi untuk menampilkan popup
    function showPopup(popupId) {
        document.getElementById(popupId).style.display = 'flex';
    }

    function hidePopup(popupId) {
        document.getElementById(popupId).style.display = 'none';
    }

    // Fungsi untuk menampilkan popup error
    function showErrorPopup(message) {
        document.getElementById('errorMessage').textContent = message;
        showPopup('errorPopup');
        
        // Auto hide setelah 3 detik
        setTimeout(function() {
            hidePopup('errorPopup');
        }, 3000);
    }

    // Fungsi untuk validasi form sebelum submit
    function validateForm(role) {
        if (role === 'siswa') {
            const nisn = document.querySelector('input[name="nisn"]').value;
            const password = document.getElementById('passwordSiswa').value;
            
            if (!nisn || !password) {
                showErrorPopup('Harap isi semua field!');
                return false;
            }
            return true;
        } else {
            const username = document.querySelector('input[name="username"]').value;
            const password = document.getElementById('passwordAdmin').value;
            
            if (!username || !password) {
                showErrorPopup('Harap isi semua field!');
                return false;
            }
            return true;
        }
    }

    // Fungsi untuk menangani submit dengan loading
    function validateAndShowLoading(role) {
        // Cegah double submit
        if (isSubmitting) {
            return false;
        }

        // Validasi form
        if (!validateForm(role)) {
            return false;
        }

        isSubmitting = true;
        
        // Tampilkan loading
        showPopup('loadingPopup');
        
        // Nonaktifkan form
        const form = role === 'siswa' ? 
            document.getElementById('loginFormSiswa') : 
            document.getElementById('loginFormAdmin');
        
        form.classList.add('form-submitting');
        
        // Submit form setelah 2 detik
        setTimeout(function() {
            form.submit();
        }, 2000);
        
        return false; // Mencegah submit langsung
    }

    // Reset state jika halaman dimuat ulang karena error
    window.addEventListener('pageshow', function() {
        hidePopup('loadingPopup');
        isSubmitting = false;
        
        const forms = document.querySelectorAll('form');
        forms.forEach(form => form.classList.remove('form-submitting'));
    });
</script>
@endpush