<?php

namespace Tests\Feature;

use App\Models\Dosen;
use App\Models\mahasiswa;
use App\Models\MataKuliah;
use App\Models\prodi;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AcademicPhotoUploadTest extends TestCase
{
    public function test_can_upload_photo_when_creating_mahasiswa(): void
    {
        Storage::fake('public');

        $prodi = prodi::first() ?? prodi::create([
            'nama_prodi' => 'Teknik Informatika Test',
            'kode_prodi' => 'TITEST',
        ]);

        $file = UploadedFile::fake()->image('pasfoto_student.jpg', 300, 400);

        $response = $this->post(route('mahasiswa.store'), [
            'nim' => '99990001',
            'nama' => 'Test Student Photo',
            'prodi_id' => $prodi->id,
            'foto' => $file,
        ]);

        $response->assertRedirect(route('mahasiswa.index'));

        $student = mahasiswa::where('nim', '99990001')->first();
        $this->assertNotNull($student);
        $this->assertNotNull($student->foto);
        Storage::disk('public')->assertExists($student->foto);

        // Clean up
        $student->delete();
    }

    public function test_can_upload_photo_when_creating_dosen(): void
    {
        Storage::fake('public');

        $prodi = prodi::first() ?? prodi::create([
            'nama_prodi' => 'Sistem Informasi Test',
            'kode_prodi' => 'SITEST',
        ]);

        $file = UploadedFile::fake()->image('dosen_portrait.png', 300, 300);

        $response = $this->post(route('dosen.store'), [
            'nip' => '88880001',
            'nama_dosen' => 'Dr. Test Dosen, M.Kom',
            'prodi_id' => $prodi->id,
            'foto' => $file,
        ]);

        $response->assertRedirect(route('dosen.index'));

        $dosen = Dosen::where('nip', '88880001')->first();
        $this->assertNotNull($dosen);
        $this->assertNotNull($dosen->foto);
        Storage::disk('public')->assertExists($dosen->foto);

        // Clean up
        $dosen->delete();
    }

    public function test_can_upload_photo_when_creating_prodi(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('prodi_logo.png', 200, 200);

        $response = $this->post(route('prodi.store'), [
            'nama_prodi' => 'Rekayasa Perangkat Lunak Test',
            'kode_prodi' => 'RPLTEST',
            'foto' => $file,
        ]);

        $response->assertRedirect(route('prodi.index'));

        $prodi = prodi::where('kode_prodi', 'RPLTEST')->first();
        $this->assertNotNull($prodi);
        $this->assertNotNull($prodi->foto);
        Storage::disk('public')->assertExists($prodi->foto);

        // Clean up
        $prodi->delete();
    }

    public function test_can_upload_photo_when_creating_mata_kuliah(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('course_cover.jpg', 600, 400);

        $response = $this->post(route('mata-kuliah.store'), [
            'kode_matkul' => 'MKTEST99',
            'nama_matkul' => 'Machine Learning & AI',
            'sks' => 3,
            'foto' => $file,
        ]);

        $response->assertRedirect(route('mata-kuliah.index'));

        $mk = MataKuliah::where('kode_matkul', 'MKTEST99')->first();
        $this->assertNotNull($mk);
        $this->assertNotNull($mk->foto);
        Storage::disk('public')->assertExists($mk->foto);

        // Clean up
        $mk->delete();
    }
}
