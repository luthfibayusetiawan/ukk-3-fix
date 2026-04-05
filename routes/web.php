<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\AspirationController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\SiswaController;
use App\Http\Controllers\siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\siswa\AspirasiController as SiswaAspirasiController;

// Login Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Aspirasi Routes
    Route::get('/aspirasi', [AspirationController::class, 'index'])->name('admin.aspirasi.index');
    Route::get('/aspirasi/{id_aspirasi}', [AspirationController::class, 'show'])->name('admin.aspirasi.show');
    Route::put('/aspirasi/{id_aspirasi}/status', [AspirationController::class, 'updateStatus'])->name('admin.aspirasi.update-status');
    Route::post('/aspirasi/{id_aspirasi}/feedback', [AspirationController::class, 'storeFeedback'])->name('admin.aspirasi.store-feedback');
    
    // Kategori Routes
    Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/kategori/{id_kategori}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::put('/kategori/{id_kategori}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/kategori/{id_kategori}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');
    
    // Siswa Routes
    Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('/siswa/{nisn}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/siswa/{nisn}', [SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::post('/siswa/{nisn}/toggle-active', [SiswaController::class, 'toggleActive'])->name('admin.siswa.toggle-active');
    Route::delete('/siswa/{nisn}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
});

// Siswa Routes
Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
    
    // Aspirasi Routes
    Route::get('/aspirasi', [SiswaAspirasiController::class, 'index'])->name('siswa.aspirasi.index');
    Route::get('/aspirasi/create', [SiswaAspirasiController::class, 'create'])->name('siswa.aspirasi.create');
    Route::post('/aspirasi', [SiswaAspirasiController::class, 'store'])->name('siswa.aspirasi.store');
    Route::get('/aspirasi/{id_aspirasi}', [SiswaAspirasiController::class, 'show'])->name('siswa.aspirasi.show');
});
