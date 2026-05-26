<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Progres II (Model & Controller)
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => redirect()->route('login'));

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard — Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    });

    // Dashboard — User
    Route::middleware('role:user')->group(function () {
        Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('dashboard.user');
    });

    // Barang & Laporan — read (Admin & User)
    Route::middleware('role:admin,user')->group(function () {
        Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
        Route::get('/barang/search', [BarangController::class, 'search'])->name('barang.search');

        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
        Route::get('/laporan/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
    });

    // Barang — write (Admin only) — HARUS sebelum route {barang}
    Route::middleware('role:admin')->group(function () {
        Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
        Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
        Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
    });

    // Barang — detail (Admin & User)
    Route::middleware('role:admin,user')->group(function () {
        Route::get('/barang/{barang}', [BarangController::class, 'show'])->name('barang.show');
    });
});
