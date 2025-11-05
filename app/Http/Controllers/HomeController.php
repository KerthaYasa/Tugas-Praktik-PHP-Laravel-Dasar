<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\Fakultas;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        // gunakan fallback 0 jika model tidak tersedia
        $totalMahasiswa = class_exists(Mahasiswa::class) ? Mahasiswa::count() : 0;
        $totalProdi     = class_exists(ProgramStudi::class) ? ProgramStudi::count() : 0;
        $totalFakultas  = class_exists(Fakultas::class) ? Fakultas::count() : 0;

        return view('dashboard', compact('totalMahasiswa', 'totalProdi', 'totalFakultas'));
    }
}
