
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\MasyarakatController;

// Route login admin
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route registrasi masyarakat
Route::get('/register', [MasyarakatController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [MasyarakatController::class, 'register'])->name('register.post');



// Dashboard routes sesuai role

use App\Http\Controllers\Admin\DashboardController;

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/pengaduan/{id}/status', [DashboardController::class, 'updateStatus'])->name('admin.pengaduan.status');
Route::get('/admin/laporan', [DashboardController::class, 'laporan'])->name('admin.laporan');
Route::get('/admin/pengaduan/{id}/detail', [DashboardController::class, 'detailPengaduan'])->name('admin.pengaduan.detail');
Route::get('/admin/pengaduan/export-pdf', [DashboardController::class, 'exportPdf'])->name('admin.pengaduan.exportPdf');

Route::get('/petugas/dashboard', function () {
    return view('petugas.dashboard');
})->name('petugas.dashboard');


Route::get('/masyarakat/dashboard', [MasyarakatController::class, 'dashboard'])->name('masyarakat.dashboard');
Route::get('/masyarakat/pengaduan/{id}/detail', [MasyarakatController::class, 'detailPengaduan'])->name('masyarakat.pengaduan.detail');
Route::get('/masyarakat/pengaduan/tambah', [MasyarakatController::class, 'showFormPengaduan'])->name('pengaduan.form');
Route::post('/masyarakat/pengaduan', [MasyarakatController::class, 'storePengaduan'])->name('pengaduan.store');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
    Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
    Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
});
