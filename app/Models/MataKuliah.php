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
        'foto',
    ];

    public function getFotoUrlAttribute(): ?string
    {
        if (! empty($this->foto)) {
            if (str_starts_with($this->foto, 'http://') || str_starts_with($this->foto, 'https://')) {
                return $this->foto;
            }

            return asset('storage/'.$this->foto);
        }

        return null;
    }

    public function mahasiswas()
    {
        return $this->belongsToMany(mahasiswa::class, 'mahasiswa_mata_kuliah', 'mata_kuliah_id', 'mahasiswa_id');
    }
}
