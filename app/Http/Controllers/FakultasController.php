<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fakultas;

class FakultasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 🟦 Index - Daftar Fakultas + Search
    public function index(Request $request)
    {
        $q = $request->query('q');

        $query = Fakultas::withCount('prodi')->orderBy('nama_fakultas', 'asc');

        if ($q) {
            $query->where(function ($query) use ($q) {
                $query->where('nama_fakultas', 'like', "%{$q}%")
                      ->orWhere('kode_fakultas', 'like', "%{$q}%");
            });
        }

        $fakultas = $query->paginate(10);

        return view('fakultas.index', compact('fakultas'));
    }

    // 🟦 Form Tambah Fakultas
    public function create()
    {
        if (!auth()->user()->isAdmin()) abort(403);
        return view('fakultas.create');
    }

    // 🟦 Simpan Fakultas
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $data = $request->validate([
            'kode_fakultas' => 'required|string|max:10|unique:fakultas,kode_fakultas',
            'nama_fakultas' => 'required|string|max:100',
        ]);

        Fakultas::create($data);

        return redirect()->route('fakultas.index')->with('success', '✅ Fakultas berhasil ditambahkan.');
    }

    // 🟦 Detail Fakultas
    public function show(Fakultas $fakultas)
    {
        $fakultas->load('prodi');
        return view('fakultas.show', compact('fakultas'));
    }

    // 🟦 Form Edit
    public function edit(Fakultas $fakultas)
    {
        if (!auth()->user()->isAdmin()) abort(403);
        return view('fakultas.edit', compact('fakultas'));
    }

    // 🟦 Update Data
    public function update(Request $request, Fakultas $fakultas)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $data = $request->validate([
            'kode_fakultas' => 'required|string|max:10|unique:fakultas,kode_fakultas,' . $fakultas->id,
            'nama_fakultas' => 'required|string|max:100',
        ]);

        $fakultas->update($data);

        return redirect()->route('fakultas.index')->with('success', '✅ Fakultas berhasil diperbarui.');
    }

    // 🟦 Hapus Data
    public function destroy(Fakultas $fakultas)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $fakultas->delete();
        return redirect()->route('fakultas.index')->with('success', '🗑️ Fakultas berhasil dihapus.');
    }
}
