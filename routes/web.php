<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProfileController;
use App\Models\ProgramStudi;

Route::get('/', function () {
    // Jangan redirect otomatis ke dashboard
    // biarkan hanya menampilkan halaman welcome
    return view('welcome');
})->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('prodi', ProgramStudiController::class);

    // ✅ FIX: pastikan parameter tidak dipotong menjadi {fakulta}
    Route::resource('fakultas', FakultasController::class)
         ->parameters(['fakultas' => 'fakultas']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    // Endpoint Ajax untuk mendapatkan fakultas dari prodi
    Route::get('/get-fakultas/{prodi}', function ($prodiId) {
        $prodi = ProgramStudi::with('fakultas')->find($prodiId);
        return response()->json(['fakultas' => $prodi?->fakultas?->nama_fakultas]);
    })->name('get.fakultas');
});

require __DIR__.'/auth.php';
