<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\mahasiswa;
use App\Models\MataKuliah;
use App\Models\prodi;
use Illuminate\Database\Seeder;

class UniversitasSeeder extends Seeder
{
    public function run(): void
    {
        $prodiTeknik = prodi::create([
            'nama_prodi' => 'Teknik Informatika',
            'kode_prodi' => 'TI',
        ]);

        $prodiAkuntansi = prodi::create([
            'nama_prodi' => 'Akuntansi',
            'kode_prodi' => 'AK',
        ]);

        $dosen1 = Dosen::create([
            'nip' => '19870001',
            'nama_dosen' => 'Budi Santoso',
            'prodi_id' => $prodiTeknik->id,
        ]);

        $dosen2 = Dosen::create([
            'nip' => '19870002',
            'nama_dosen' => 'Siti Lestari',
            'prodi_id' => $prodiTeknik->id,
        ]);

        $dosen3 = Dosen::create([
            'nip' => '19870003',
            'nama_dosen' => 'Rina Wijaya',
            'prodi_id' => $prodiAkuntansi->id,
        ]);

        $mahasiswa1 = mahasiswa::create([
            'nim' => '20230001',
            'nama' => 'Andi Pratama',
            'prodi_id' => $prodiTeknik->id,
        ]);

        $mahasiswa2 = mahasiswa::create([
            'nim' => '20230002',
            'nama' => 'Dewi Lestari',
            'prodi_id' => $prodiTeknik->id,
        ]);

        $mahasiswa3 = mahasiswa::create([
            'nim' => '20230003',
            'nama' => 'Rizki Maulana',
            'prodi_id' => $prodiAkuntansi->id,
        ]);

        $matkul1 = MataKuliah::create([
            'kode_matkul' => 'MK001',
            'nama_matkul' => 'Basis Data',
            'sks' => 3,
        ]);

        $matkul2 = MataKuliah::create([
            'kode_matkul' => 'MK002',
            'nama_matkul' => 'Pemrograman Web',
            'sks' => 3,
        ]);

        $matkul3 = MataKuliah::create([
            'kode_matkul' => 'MK003',
            'nama_matkul' => 'Akuntansi Keuangan',
            'sks' => 3,
        ]);

        $mahasiswa1->mataKuliahs()->attach([$matkul1->id, $matkul2->id]);
        $mahasiswa2->mataKuliahs()->attach([$matkul2->id, $matkul3->id]);
        $mahasiswa3->mataKuliahs()->attach([$matkul3->id]);

        $this->command->info('Seeder Universitas berhasil dijalankan.');
    }
}
