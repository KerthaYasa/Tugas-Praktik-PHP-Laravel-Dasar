<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $query = Mahasiswa::query();

        if($q) {
            $query->where('nim', 'like', "%{$q}%")
                ->orWhere('nama', 'like', "%{$q}%");
        }

        $mahasiswa = $query->orderBy('id','asc')->paginate(8); // 8 per halaman
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim|min:4',
            'nama' => 'required',
            'prodi' => 'required'
        ]);

        Mahasiswa::create($request->only('nim','nama','prodi'));

        return redirect()->route('mahasiswa.index')->with('success','Mahasiswa disimpan.');
    }

    public function show($id)
    {
        $m = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('m'));
    }

    public function edit($id)
    {
        $m = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('m'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|min:4|unique:mahasiswa,nim,'.$id,
            'nama' => 'required',
            'prodi' => 'required'
        ]);

        $m = Mahasiswa::findOrFail($id);
        $m->update($request->only('nim','nama','prodi'));

        return redirect()->route('mahasiswa.index')->with('success','Mahasiswa diperbarui.');
    }

    public function destroy($id)
    {
        $m = Mahasiswa::findOrFail($id);
        $m->delete();
        return redirect()->route('mahasiswa.index')->with('success','Mahasiswa dihapus.');
    }
}
