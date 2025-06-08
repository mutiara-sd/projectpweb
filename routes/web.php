<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'role:admin']);

Route::get('penulis', function () {
    return '<h1>Helo Penulis</h1>';
})->middleware(['auth', 'verified', 'role:penulis']);

Route::get('tulisan', function () {
    return view('tulisan');
})->middleware(['auth', 'verified', 'role_or_permission:lihat-tulisan|admin']);

Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');

Route::get('/donasi/form', [DonasiController::class, 'form'])
    ->middleware('auth')
    ->name('form.donasi');

Route::post('/donasi/store', [DonasiController::class, 'store'])
    ->middleware('auth')
    ->name('donasi.store');

Route::get('/donasi/create', [DonasiController::class, 'form'])
    ->middleware('auth')
    ->name('donasi.create');

Route::get('/dashboard', [DonasiController::class, 'dashboardList'])->middleware(['auth'])->name('dashboard');

Route::get('/donasi/hari-ini', [DonasiController::class, 'hariIni'])->name('donasi.hari-ini');

Route::get('/riwayat', [App\Http\Controllers\RiwayatController::class, 'riwayatuser'])->name('riwayat.index');


require __DIR__.'/auth.php';
