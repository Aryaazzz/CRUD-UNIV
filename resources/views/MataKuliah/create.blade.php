@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Tambah Mata Kuliah</h1>

    <form action="{{ route('mata-kuliah.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-2 font-medium">Kode Mata Kuliah</label>
            <input type="text" name="kode_matkul" value="{{ old('kode_matkul') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Nama Mata Kuliah</label>
            <input type="text" name="nama_matkul" value="{{ old('nama_matkul') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">SKS</label>
            <input type="number" name="sks" value="{{ old('sks') }}" min="1" max="6" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('mata-kuliah.index') }}" class="bg-slate-300 px-4 py-2 rounded">Kembali</a>
        </div>
    </form>
</div>
@endsection
