<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $prodiId = $request->input('prodi_id');
        $fakultasId = $request->input('fakultas_id');

        $query = Mahasiswa::with(['prodi.fakultas']);

        // Filter pencarian NIM atau Nama
        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nim', 'like', "%{$q}%")
                    ->orWhere('nama', 'like', "%{$q}%");
            });
        }

        // Filter berdasarkan Prodi
        if ($prodiId) {
            $query->where('prodi_id', $prodiId);
        }

        // Filter berdasarkan Fakultas
        if ($fakultasId) {
            $query->whereHas('prodi', function ($sub) use ($fakultasId) {
                $sub->where('fakultas_id', $fakultasId);
            });
        }

        // Gunakan $query yang sudah difilter
        $mahasiswa = $query->orderBy('nim', 'asc')->paginate(10);
        
        $allProdi = Prodi::with('fakultas')->orderBy('nama_prodi')->get();
        $allFakultas = Fakultas::orderBy('nama_fakultas')->get();

        return view('mahasiswa.index', compact('mahasiswa', 'allProdi', 'allFakultas'));
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', ['m' => $mahasiswa]);
    }

    public function create()
    {
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        $prodi = [];
        $mahasiswa = new Mahasiswa();

        return view('mahasiswa.create', compact('fakultas', 'prodi', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi,id'
        ]);

        Mahasiswa::create($request->all());
        
        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        $prodi = Prodi::where('fakultas_id', $mahasiswa->prodi->fakultas->id ?? null)
                      ->orderBy('nama_prodi')
                      ->get();

        return view('mahasiswa.edit', compact('mahasiswa', 'fakultas', 'prodi'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi,id'
        ]);

        $mahasiswa->update($request->all());
        
        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        
        return redirect()->route('mahasiswa.index')
                         ->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}