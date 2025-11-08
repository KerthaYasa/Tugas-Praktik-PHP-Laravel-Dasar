<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Models\ProgramStudi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama (saat pertama kali membuka web)
Route::get('/', function () {
    // Jika sudah login, arahkan ke dashboard
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    // Jika belum login, tampilkan halaman welcome
    return view('welcome');
})->name('welcome');

// Grup route yang hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {

    // Dashboard utama
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // CRUD Data Mahasiswa
    Route::resource('mahasiswa', MahasiswaController::class);

    // CRUD Program Studi
    Route::resource('prodi', ProgramStudiController::class);

    // CRUD Fakultas
    Route::resource('fakultas', FakultasController::class)
         ->parameters(['fakultas' => 'fakultas']);

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ganti password
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    // API untuk mendapatkan fakultas berdasarkan prodi
    Route::get('/get-fakultas/{prodi}', function ($prodiId) {
        $prodi = ProgramStudi::with('fakultas')->find($prodiId);
        return response()->json(['fakultas' => $prodi?->fakultas?->nama_fakultas]);
    })->name('get.fakultas');
});

// Auth routes (login, register, forgot-password, dll)
require __DIR__.'/auth.php';
