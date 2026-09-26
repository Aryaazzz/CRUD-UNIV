@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Mahasiswa</h1>

    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-medium">NIM</label>
            <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Nama Mahasiswa</label>
            <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Prodi</label>
            <select name="prodi_id" class="w-full border rounded px-3 py-2" required>
                @foreach($prodis as $prodi)
                    <option value="{{ $prodi->id }}" {{ $mahasiswa->prodi_id == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Mata Kuliah</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach($mataKuliahs as $mk)
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="mata_kuliah[]" value="{{ $mk->id }}" {{ $mahasiswa->mataKuliahs->contains($mk->id) ? 'checked' : '' }}>
                        <span>{{ $mk->nama_matkul }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('mahasiswa.index') }}" class="bg-slate-300 px-4 py-2 rounded">Kembali</a>
        </div>
    </form>
</div>
@endsection
