<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('matakuliah', 'public');
        }

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
            'kode_matkul' => 'required|string|max:20|unique:mata_kuliah,kode_matkul,'.$mataKuliah->id,
            'nama_matkul' => 'required|string|max:100',
            'sks' => 'required|integer|min:1|max:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($request->hasFile('foto')) {
            if ($mataKuliah->foto && Storage::disk('public')->exists($mataKuliah->foto)) {
                Storage::disk('public')->delete($mataKuliah->foto);
            }
            $validated['foto'] = $request->file('foto')->store('matakuliah', 'public');
        }

        $mataKuliah->update($validated);

        return redirect()->route('mata-kuliah.index')->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        if ($mataKuliah->foto && Storage::disk('public')->exists($mataKuliah->foto)) {
            Storage::disk('public')->delete($mataKuliah->foto);
        }
        $mataKuliah->mahasiswas()->detach();
        $mataKuliah->delete();

        return redirect()->route('mata-kuliah.index')->with('success', 'Data mata kuliah berhasil dihapus.');
    }
}
