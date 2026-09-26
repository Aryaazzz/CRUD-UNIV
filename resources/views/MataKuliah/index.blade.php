@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Data Mata Kuliah</h1>
    <a href="{{ route('mata-kuliah.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Mata Kuliah</a>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="min-w-full text-left">
        <thead class="bg-slate-200">
            <tr>
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">Kode</th>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">SKS</th>
                <th class="px-4 py-3">Mahasiswa</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mataKuliahs as $index => $mk)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ $mk->kode_matkul }}</td>
                    <td class="px-4 py-3">{{ $mk->nama_matkul }}</td>
                    <td class="px-4 py-3">{{ $mk->sks }}</td>
                    <td class="px-4 py-3">{{ $mk->mahasiswas->count() }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('mata-kuliah.show', $mk->id) }}" class="text-blue-600">Detail</a>
                        <a href="{{ route('mata-kuliah.edit', $mk->id) }}" class="text-yellow-600">Edit</a>
                        <form action="{{ route('mata-kuliah.destroy', $mk->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
