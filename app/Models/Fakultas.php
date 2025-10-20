<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    // jangan masukkan jumlah_prodi di fillable karena dihitung otomatis
    protected $fillable = ['nama_fakultas', 'dekan'];

    public function prodi()
    {
        return $this->hasMany(\App\Models\Prodi::class, 'fakultas_id');
    }
}
