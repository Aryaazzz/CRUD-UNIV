<?php

namespace App\Http\Controllers;

use App\Models\prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class prodiController extends Controller
{
    public function index()
    {
        $prodis = prodi::withCount('mahasiswas')->withCount('dosens')->get();

        return view('prodi.index', compact('prodis'));
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prodi' => 'required|string|max:100',
            'kode_prodi' => 'required|string|max:20|unique:prodi_tabel,kode_prodi',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('prodi', 'public');
        }

        prodi::create($validated);

        return redirect()->route('prodi.index')->with('success', 'Data prodi berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $prodi = prodi::with(['mahasiswas', 'dosens'])->findOrFail($id);

        return view('prodi.show', compact('prodi'));
    }

    public function edit(string $id)
    {
        $prodi = prodi::findOrFail($id);

        return view('prodi.edit', compact('prodi'));
    }

    public function update(Request $request, string $id)
    {
        $prodi = prodi::findOrFail($id);

        $validated = $request->validate([
            'nama_prodi' => 'required|string|max:100',
            'kode_prodi' => 'required|string|max:20|unique:prodi_tabel,kode_prodi,'.$prodi->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($request->hasFile('foto')) {
            if ($prodi->foto && Storage::disk('public')->exists($prodi->foto)) {
                Storage::disk('public')->delete($prodi->foto);
            }
            $validated['foto'] = $request->file('foto')->store('prodi', 'public');
        }

        $prodi->update($validated);

        return redirect()->route('prodi.index')->with('success', 'Data prodi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $prodi = prodi::findOrFail($id);
        if ($prodi->foto && Storage::disk('public')->exists($prodi->foto)) {
            Storage::disk('public')->delete($prodi->foto);
        }
        $prodi->delete();

        return redirect()->route('prodi.index')->with('success', 'Data prodi berhasil dihapus.');
    }
}
