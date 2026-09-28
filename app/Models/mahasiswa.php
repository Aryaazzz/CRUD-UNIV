<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'prodi_id',
        'foto',
    ];

    public function getFotoUrlAttribute(): string
    {
        if (! empty($this->foto)) {
            if (str_starts_with($this->foto, 'http://') || str_starts_with($this->foto, 'https://')) {
                return $this->foto;
            }

            return asset('storage/'.$this->foto);
        }

        return 'https://ui-avatars.com/api/?name='.urlencode($this->nama).'&background=025aa2&color=ffffff&bold=true&size=256';
    }

    public function prodi()
    {
        return $this->belongsTo(prodi::class, 'prodi_id');
    }

    public function mataKuliahs()
    {
        return $this->belongsToMany(MataKuliah::class, 'mahasiswa_mata_kuliah', 'mahasiswa_id', 'mata_kuliah_id');
    }
}
