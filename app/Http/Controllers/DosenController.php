<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::with('prodi')->get();

        return view('dosen.index', compact('dosens'));
    }

    public function create()
    {
        $prodis = prodi::all();

        return view('dosen.create', compact('prodis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:dosen,nip',
            'nama_dosen' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi_tabel,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        Dosen::create($validated);

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $dosen = Dosen::with('prodi')->findOrFail($id);

        return view('dosen.show', compact('dosen'));
    }

    public function edit(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        $prodis = prodi::all();

        return view('dosen.edit', compact('dosen', 'prodis'));
    }

    public function update(Request $request, string $id)
    {
        $dosen = Dosen::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:dosen,nip,'.$dosen->id,
            'nama_dosen' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi_tabel,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($request->hasFile('foto')) {
            if ($dosen->foto && Storage::disk('public')->exists($dosen->foto)) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $validated['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        $dosen->update($validated);

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        if ($dosen->foto && Storage::disk('public')->exists($dosen->foto)) {
            Storage::disk('public')->delete($dosen->foto);
        }
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus.');
    }
}
