<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode_matkul',
        'nama_matkul',
        'sks',
    ];

    public function mahasiswas()
    {
        return $this->belongsToMany(mahasiswa::class, 'mahasiswa_mata_kuliah', 'mata_kuliah_id', 'mahasiswa_id');
    }
}
