<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\Fakultas;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 🟦 Index - Search + Filter
    public function index(Request $request)
    {
        $q = $request->query('q');
        $fakultasId = $request->query('fakultas_id');
        $prodiId = $request->query('prodi_id');

        $query = Mahasiswa::with(['prodi','prodi.fakultas']);

        if ($q) {
            $query->where(function($qb) use ($q){
                $qb->where('nim', 'like', "%{$q}%")
                ->orWhere('nama', 'like', "%{$q}%")
                ->orWhereHas('prodi', function($q2) use ($q){
                    $q2->where('nama_prodi', 'like', "%{$q}%");
                });
            });
        }

        if ($fakultasId) {
            // hanya ambil mahasiswa yang prodi nya punya fakultas sesuai
            $query->whereHas('prodi', function($q) use ($fakultasId) {
                $q->where('fakultas_id', $fakultasId);
            });
        }

        if ($prodiId) {
            $query->where('prodi_id', $prodiId);
        }

        $mahasiswa = $query->orderBy('nama')->paginate(10);

        // data untuk dropdown filter
        $allFakultas = \App\Models\Fakultas::orderBy('nama_fakultas')->get();
        $allProdi = \App\Models\ProgramStudi::with('fakultas')->orderBy('nama_prodi')->get();

        return view('mahasiswa.index', compact('mahasiswa','allFakultas','allProdi','q'));
    }

    // 🟦 Form Tambah
    public function create()
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $prodi = ProgramStudi::with('fakultas')->orderBy('nama_prodi')->get();
        return view('mahasiswa.create', compact('prodi'));
    }

    // 🟦 Simpan
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $data = $request->validate([
            'nim' => 'required|string|max:15|unique:mahasiswas,nim',
            'nama' => 'required|string|max:150',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'prodi_id' => 'required|exists:program_studis,id',
        ]);

        Mahasiswa::create($data);
        return redirect()->route('mahasiswa.index')->with('success', '✅ Mahasiswa berhasil ditambahkan.');
    }

    // 🟦 Detail
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('prodi.fakultas');
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    // 🟦 Form Edit
    public function edit(Mahasiswa $mahasiswa)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $prodi = ProgramStudi::with('fakultas')->orderBy('nama_prodi')->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'prodi'));
    }

    // 🟦 Update
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $data = $request->validate([
            'nim' => 'required|string|max:15|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:150',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'prodi_id' => 'required|exists:program_studis,id',
        ]);

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index')->with('success', '✅ Mahasiswa berhasil diperbarui.');
    }

    // 🟦 Hapus
    public function destroy(Mahasiswa $mahasiswa)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', '🗑️ Mahasiswa berhasil dihapus.');
    }
}
