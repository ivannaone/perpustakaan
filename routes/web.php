<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;

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
    return view('dashboard.admin');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

Route::get('/user/dashboard', function () {
    return view('dashboard.user');
})->middleware(['auth', 'role:user'])->name('user.dashboard');



Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('anggota', AnggotaController::class)
        ->parameters([
            'anggota' => 'anggota'
        ]);

    Route::resource('buku', BukuController::class);

});