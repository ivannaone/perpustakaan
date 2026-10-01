<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DetailBukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/admin/dashboard', function () {
    $totalBuku = \App\Models\Buku::count();

    $totalAnggota = \App\Models\Anggota::count();

    $totalPeminjaman = \App\Models\Peminjaman::count();

    $totalBukuDipinjam = \App\Models\DetailBuku::where(
        'status',
        'dipinjam'
    )->count();

    return view('dashboard.admin', compact(
        'totalBuku',
        'totalAnggota',
        'totalPeminjaman',
        'totalBukuDipinjam'
    ));
})->middleware(['auth', 'role:admin'])
  ->name('admin.dashboard');

Route::get('/user/dashboard', function () {
    return view('dashboard.user');
})->middleware(['auth', 'role:user'])
  ->name('user.dashboard');

Route::get('/user/buku', [BukuController::class, 'katalog'])
    ->middleware(['auth', 'role:user'])
    ->name('user.buku');

Route::get('/user/peminjaman', [PeminjamanController::class, 'saya'])
    ->middleware(['auth', 'role:user'])
    ->name('user.peminjaman');

Route::get('/user/profil', [ProfileController::class, 'index'])
    ->middleware(['auth', 'role:user'])
    ->name('user.profile');

Route::put('/user/profil', [ProfileController::class, 'update'])
    ->middleware(['auth', 'role:user'])
    ->name('user.profile.update');

Route::get('/user/informasi', function () {
    return view('user.informasi');
})->middleware(['auth', 'role:user'])
  ->name('user.informasi');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('anggota', AnggotaController::class)
        ->parameters([
            'anggota' => 'anggota'
        ]);

    Route::post('/buku/import', [BukuController::class, 'import'])
        ->name('buku.import');

    Route::resource('buku', BukuController::class);

    Route::post(
        '/detail-buku/generate/{buku}',
        [DetailBukuController::class, 'generate']
    )->name('detail-buku.generate');

    Route::resource('detail-buku', DetailBukuController::class);

    Route::post(
        '/peminjaman/{peminjaman}/kembalikan',
        [PeminjamanController::class, 'returnBook']
    )->name('peminjaman.return');

    Route::resource('peminjaman', PeminjamanController::class)
        ->only([
            'index',
            'create',
            'store',
            'destroy'
        ]);

    Route::get(
        '/laporan',
        [LaporanController::class, 'index']
    )->name('laporan.index');

    Route::get(
        '/laporan/peminjaman',
        [LaporanController::class, 'peminjaman']
    )->name('laporan.peminjaman');

    Route::get(
        '/laporan/peminjaman/excel',
        [LaporanController::class, 'excel']
    )->name('laporan.peminjaman.excel');
});