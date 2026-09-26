@extends('layouts.app')

@section('title', 'Edit Dosen')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Dosen</h1>

    <form action="{{ route('dosen.update', $dosen->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-medium">NIP</label>
            <input type="text" name="nip" value="{{ old('nip', $dosen->nip) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Nama Dosen</label>
            <input type="text" name="nama_dosen" value="{{ old('nama_dosen', $dosen->nama_dosen) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-medium">Prodi</label>
            <select name="prodi_id" class="w-full border rounded px-3 py-2" required>
                @foreach($prodis as $prodi)
                    <option value="{{ $prodi->id }}" {{ $dosen->prodi_id == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('dosen.index') }}" class="bg-slate-300 px-4 py-2 rounded">Kembali</a>
        </div>
    </form>
</div>
@endsection
