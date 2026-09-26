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
    ];

    public function prodi()
    {
        return $this->belongsTo(prodi::class, 'prodi_id');
    }
}
