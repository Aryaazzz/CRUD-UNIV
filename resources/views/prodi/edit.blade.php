@extends('layouts.app')

@section('title', 'Edit Prodi')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Prodi</h1>

    <form action="{{ route('prodi.update', $prodi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-medium">Nama Prodi</label>
            <input type="text" name="nama_prodi" value="{{ old('nama_prodi', $prodi->nama_prodi) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Kode Prodi</label>
            <input type="text" name="kode_prodi" value="{{ old('kode_prodi', $prodi->kode_prodi) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('prodi.index') }}" class="bg-slate-300 px-4 py-2 rounded">Kembali</a>
        </div>
    </form>
</div>
@endsection
