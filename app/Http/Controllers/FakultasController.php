<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::withCount('prodi')->orderBy('nama_fakultas')->paginate(10);
        return view('fakultas.index', compact('fakultas'));
    }

    public function create()
    {
        return view('fakultas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fakultas' => 'required|string|max:150|unique:fakultas,nama_fakultas',
            'dekan' => 'nullable|string|max:150',
        ], [
            'nama_fakultas.required' => 'Nama fakultas wajib diisi.',
            'nama_fakultas.unique' => 'Nama fakultas ini sudah terdaftar.',
            'nama_fakultas.max' => 'Nama fakultas maksimal 150 karakter.',
        ]);

        Fakultas::create($request->only(['nama_fakultas','dekan']));
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil ditambahkan!');
    }

    public function show(Fakultas $fakultas)
    {
        return view('fakultas.show', compact('fakultas'));
    }

    public function edit(Fakultas $fakultas)
    {
        return view('fakultas.edit', compact('fakultas'));
    }

    public function update(Request $request, Fakultas $fakultas)
    {
        $request->validate([
            'nama_fakultas' => 'required|string|max:150|unique:fakultas,nama_fakultas,' . $fakultas->id,
            'dekan' => 'nullable|string|max:150',
        ], [
            'nama_fakultas.required' => 'Nama fakultas wajib diisi.',
            'nama_fakultas.unique' => 'Nama fakultas ini sudah terdaftar.',
            'nama_fakultas.max' => 'Nama fakultas maksimal 150 karakter.',
        ]);

        $fakultas->update($request->only(['nama_fakultas','dekan']));
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil diperbarui!');
    }

    public function destroy(Fakultas $fakultas)
    {
        $fakultas->delete();
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil dihapus!');
    }
}
