<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('landing');
});

// Dashboard - pilih salah satu implementasi
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('penulis', function () {
    return '<h1>Helo Penulis</h1>';
})->middleware(['auth', 'verified', 'role:penulis']);

Route::get('tulisan', function () {
    return view('tulisan');
})->middleware(['auth', 'verified', 'role_or_permission:lihat-tulisan|admin']);

// Donasi Routes
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');

Route::middleware('auth')->group(function () {
    Route::get('/donasi/form', [DonasiController::class, 'form'])->name('form.donasi');
    Route::get('/donasi/create', [DonasiController::class, 'form'])->name('donasi.create');
    Route::post('/donasi/store', [DonasiController::class, 'store'])->name('donasi.store');
});

Route::get('/donasi/hari-ini', [DonasiController::class, 'hariIni'])->name('donasi.hari-ini');

// Riwayat Routes
Route::get('/riwayat', [RiwayatController::class, 'riwayatuser'])
    ->name('riwayat.index')
    ->middleware('auth');

// Penerima Routes
Route::get('/form-penerima/{id}', [PenerimaController::class, 'create'])->name('form.penerima');
Route::post('/form-penerima', [PenerimaController::class, 'store'])
    ->middleware('auth')
    ->name('form.penerima.store');

Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');
Route::put('/admin/user/{user}', [UserController::class, 'update'])->name('admin.user.update');
Route::delete('/admin/user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');

require __DIR__.'/auth.php';