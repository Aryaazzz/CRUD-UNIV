<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliahs = MataKuliah::with('mahasiswas')->get();

        return view('MataKuliah.index', compact('mataKuliahs'));
    }

    public function create()
    {
        return view('MataKuliah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matkul' => 'required|string|max:20|unique:mata_kuliah,kode_matkul',
            'nama_matkul' => 'required|string|max:100',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        MataKuliah::create($validated);

        return redirect()->route('mata-kuliah.index')->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $mataKuliah = MataKuliah::with('mahasiswas')->findOrFail($id);

        return view('MataKuliah.show', compact('mataKuliah'));
    }

    public function edit(string $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);

        return view('MataKuliah.edit', compact('mataKuliah'));
    }

    public function update(Request $request, string $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);

        $validated = $request->validate([
            'kode_matkul' => 'required|string|max:20|unique:mata_kuliah,kode_matkul,' . $mataKuliah->id,
            'nama_matkul' => 'required|string|max:100',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        $mataKuliah->update($validated);

        return redirect()->route('mata-kuliah.index')->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->mahasiswas()->detach();
        $mataKuliah->delete();

        return redirect()->route('mata-kuliah.index')->with('success', 'Data mata kuliah berhasil dihapus.');
    }
}
