@extends('layouts.app')

@section('title', 'Tambah Prodi')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Tambah Prodi</h1>

    <form action="{{ route('prodi.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-2 font-medium">Nama Prodi</label>
            <input type="text" name="nama_prodi" value="{{ old('nama_prodi') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Kode Prodi</label>
            <input type="text" name="kode_prodi" value="{{ old('kode_prodi') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('prodi.index') }}" class="bg-slate-300 px-4 py-2 rounded">Kembali</a>
        </div>
    </form>
</div>
@endsection
