<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';

    /**
     * Gunakan $fillable — daftar kolom yang boleh di-mass assign.
     * Jangan menggunakan daftar kolom yang ingin diassign di $guarded.
     */
    protected $fillable = [
        'nim',
        'nama',
        'email',
        'alamat',
        'telepon',
        'prodi_id',
    ];

    /**
     * Relasi: Mahasiswa belongs to ProgramStudi
     */
    public function prodi(): BelongsTo
    {
        return $this->belongsTo(ProgramStudi::class, 'prodi_id');
    }

    /**
     * Accessor: Akses fakultas langsung tanpa perlu ->prodi->fakultas
     * Contoh: $mahasiswa->fakultas->nama_fakultas
     */
    public function getFakultasAttribute()
    {
        return $this->prodi?->fakultas;
    }
}
