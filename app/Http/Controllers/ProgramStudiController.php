<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramStudi;
use App\Models\Fakultas;

class ProgramStudiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 🟦 Index + Search
    public function index(Request $request)
    {
        $q = $request->query('q');

        $query = ProgramStudi::with('fakultas')
            ->withCount('mahasiswa')
            ->orderBy('nama_prodi', 'asc');

        if ($q) {
            $query->where(function ($query) use ($q) {
                $query->where('nama_prodi', 'like', "%{$q}%")
                      ->orWhere('kode_prodi', 'like', "%{$q}%");
            });
        }

        $prodi = $query->paginate(10);

        return view('prodi.index', compact('prodi'));
    }

    // 🟦 Form Tambah
    public function create()
    {
        if (!auth()->user()->isAdmin()) abort(403);
        $fakultas = Fakultas::orderBy('nama_fakultas', 'asc')->get();
        return view('prodi.create', compact('fakultas'));
    }

    // 🟦 Simpan Data
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $data = $request->validate([
            'kode_prodi' => 'required|string|max:10|unique:program_studis,kode_prodi',
            'nama_prodi' => 'required|string|max:150',
            'fakultas_id' => 'required|exists:fakultas,id',
        ]);

        ProgramStudi::create($data);

        return redirect()->route('prodi.index')->with('success', '✅ Program Studi berhasil ditambahkan.');
    }

    // 🟦 Detail
    public function show(ProgramStudi $prodi)
    {
        $prodi->load('fakultas', 'mahasiswa');
        return view('prodi.show', compact('prodi'));
    }

    // 🟦 Form Edit
    public function edit(ProgramStudi $prodi)
    {
        if (!auth()->user()->isAdmin()) abort(403);
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        return view('prodi.edit', compact('prodi', 'fakultas'));
    }

    // 🟦 Update
    public function update(Request $request, ProgramStudi $prodi)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $data = $request->validate([
            'kode_prodi' => 'required|string|max:10|unique:program_studis,kode_prodi,' . $prodi->id,
            'nama_prodi' => 'required|string|max:150',
            'fakultas_id' => 'required|exists:fakultas,id',
        ]);

        $prodi->update($data);
        return redirect()->route('prodi.index')->with('success', '✅ Program Studi berhasil diperbarui.');
    }

    // 🟦 Hapus
    public function destroy(ProgramStudi $prodi)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $prodi->delete();
        return redirect()->route('prodi.index')->with('success', '🗑️ Program Studi berhasil dihapus.');
    }
}
