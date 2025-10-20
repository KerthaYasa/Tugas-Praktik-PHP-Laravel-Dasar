<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // pastikan merujuk ke nama tabel yang sebenarnya di DB
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'prodi_id', // jika sudah ditambahkan kolom ini
    ];

    public function prodi()
    {
        return $this->belongsTo(\App\Models\Prodi::class, 'prodi_id');
    }
}

