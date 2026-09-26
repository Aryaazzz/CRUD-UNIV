<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class prodi extends Model
{
    protected $table = 'prodi_tabel';

    protected $fillable = [
        'nama_prodi',
        'kode_prodi',
    ];

    public function mahasiswas()
    {
        return $this->hasMany(mahasiswa::class, 'prodi_id');
    }

    public function dosens()
    {
        return $this->hasMany(Dosen::class, 'prodi_id');
    }
}
