<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

// Saat user buka halaman utama "/", arahkan langsung ke daftar mahasiswa
Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

// Buat route resource CRUD mahasiswa
Route::resource('mahasiswa', MahasiswaController::class);
