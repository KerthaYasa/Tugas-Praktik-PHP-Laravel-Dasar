<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index() { return response()->json(Mahasiswa::with('prodi.fakultas')->paginate(20)); }
    public function show(Mahasiswa $mahasiswa) { return response()->json($mahasiswa->load('prodi.fakultas')); }

    public function store(Request $request)
    {
        $request->validate([
            'nim'=>'required|unique:mahasiswas,nim',
            'nama'=>'required|string',
            'prodi_id'=>'nullable|exists:program_studis,id',
        ]);
        $m = Mahasiswa::create($request->all());
        return response()->json($m, 201);
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim'=>'required|unique:mahasiswas,nim,'.$mahasiswa->id,
            'nama'=>'required|string',
            'prodi_id'=>'nullable|exists:program_studis,id',
        ]);
        $mahasiswa->update($request->all());
        return response()->json($mahasiswa);
    }

    public function destroy(Mahasiswa $mahasiswa){
        $mahasiswa->delete();
        return response()->json(['message'=>'deleted']);
    }
}
