<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\mahasiswa;
use App\Models\prodi;
use Illuminate\Http\Request;

class mahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = mahasiswa::with(['prodi', 'mataKuliahs'])->get();

        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $prodis = prodi::all();
        $mataKuliahs = MataKuliah::all();

        return view('mahasiswa.create', compact('prodis', 'mataKuliahs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi_tabel,id',
            'mata_kuliah' => 'nullable|array',
            'mata_kuliah.*' => 'exists:mata_kuliah,id',
        ]);

        $mahasiswa = mahasiswa::create([
            'nim' => $validated['nim'],
            'nama' => $validated['nama'],
            'prodi_id' => $validated['prodi_id'],
        ]);

        if (!empty($validated['mata_kuliah'])) {
            $mahasiswa->mataKuliahs()->sync($validated['mata_kuliah']);
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $mahasiswa = mahasiswa::with(['prodi', 'mataKuliahs'])->findOrFail($id);

        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(string $id)
    {
        $mahasiswa = mahasiswa::with('mataKuliahs')->findOrFail($id);
        $prodis = prodi::all();
        $mataKuliahs = MataKuliah::all();

        return view('mahasiswa.edit', compact('mahasiswa', 'prodis', 'mataKuliahs'));
    }

    public function update(Request $request, string $id)
    {
        $mahasiswa = mahasiswa::findOrFail($id);

        $validated = $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi_tabel,id',
            'mata_kuliah' => 'nullable|array',
            'mata_kuliah.*' => 'exists:mata_kuliah,id',
        ]);

        $mahasiswa->update([
            'nim' => $validated['nim'],
            'nama' => $validated['nama'],
            'prodi_id' => $validated['prodi_id'],
        ]);

        $mahasiswa->mataKuliahs()->sync($validated['mata_kuliah'] ?? []);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $mahasiswa = mahasiswa::findOrFail($id);
        $mahasiswa->mataKuliahs()->detach();
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
