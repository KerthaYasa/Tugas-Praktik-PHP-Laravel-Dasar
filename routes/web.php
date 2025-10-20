<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;

// Halaman utama
Route::get('/', fn() => redirect()->route('mahasiswa.index'));

// AJAX: ambil prodi berdasarkan fakultas
Route::get('/fakultas/{id}/prodi', [ProdiController::class, 'getByFakultas'])
    ->name('prodi.byFakultas');

// Resource CRUD
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('fakultas', FakultasController::class)->parameters([
    'fakultas' => 'fakultas' // tetap default, jangan ubah jadi fakulta
]);
Route::resource('prodi', ProdiController::class);
