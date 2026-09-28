<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $fillable = [
        'nip',
        'nama_dosen',
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

        return 'https://ui-avatars.com/api/?name='.urlencode($this->nama_dosen).'&background=0b1329&color=f59e0b&bold=true&size=256';
    }

    public function prodi()
    {
        return $this->belongsTo(prodi::class, 'prodi_id');
    }
}
