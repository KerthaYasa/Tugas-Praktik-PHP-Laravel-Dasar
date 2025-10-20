<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::with('fakultas')
            ->withCount('mahasiswa')
            ->orderBy('nama_prodi')
            ->paginate(10);

        return view('prodi.index', compact('prodi'));
    }

    public function create()
    {
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        return view('prodi.create', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:100|unique:prodi,nama_prodi',
            'kaprodi' => 'required|string|max:100',
            'fakultas_id' => 'required|exists:fakultas,id'
        ]);

        Prodi::create($request->only(['nama_prodi', 'kaprodi', 'fakultas_id']));
        return redirect()->route('prodi.index')->with('success', 'Data prodi berhasil ditambahkan!');
    }

    public function show(Prodi $prodi)
    {
        $prodi->loadCount('mahasiswa'); // ✅ Load count mahasiswa
        return view('prodi.show', ['p' => $prodi]);
    }

    public function edit(Prodi $prodi)
    {
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        return view('prodi.edit', ['p' => $prodi, 'fakultas' => $fakultas]);
    }

    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:100|unique:prodi,nama_prodi,' . $prodi->id,
            'kaprodi' => 'required|string|max:100',
            'fakultas_id' => 'required|exists:fakultas,id'
        ]);

        $prodi->update($request->only(['nama_prodi', 'kaprodi', 'fakultas_id']));
        return redirect()->route('prodi.index')->with('success', 'Data prodi berhasil diperbarui!');
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        return redirect()->route('prodi.index')->with('success', 'Data prodi berhasil dihapus!');
    }

    public function getByFakultas($id)
    {
        $prodi = Prodi::where('fakultas_id', $id)->get(['id', 'nama_prodi']);
        return response()->json($prodi);
    }
}