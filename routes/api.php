<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MahasiswaController;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', [AuthController::class, 'user'])->name('api.user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    
    // TAMBAHKAN ->names() biar gak bentrok dengan web route
    Route::apiResource('mahasiswa', MahasiswaController::class)->names([
        'index' => 'api.mahasiswa.index',
        'store' => 'api.mahasiswa.store',
        'show' => 'api.mahasiswa.show',
        'update' => 'api.mahasiswa.update',
        'destroy' => 'api.mahasiswa.destroy',
    ]);
});

Route::get('/health', function() {
    return response()->json(['status'=>'ok','timestamp'=>now()->toIso8601String()]);
});