@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Data Mahasiswa</h1>
    <a href="{{ route('mahasiswa.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Mahasiswa</a>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="min-w-full text-left">
        <thead class="bg-slate-200">
            <tr>
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">NIM</th>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Prodi</th>
                <th class="px-4 py-3">Mata Kuliah</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswas as $index => $mahasiswa)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ $mahasiswa->nim }}</td>
                    <td class="px-4 py-3">{{ $mahasiswa->nama }}</td>
                    <td class="px-4 py-3">{{ $mahasiswa->prodi?->nama_prodi ?? '-' }}</td>
                    <td class="px-4 py-3">
                        @foreach($mahasiswa->mataKuliahs as $mk)
                            <span class="inline-block bg-slate-200 rounded px-2 py-1 text-xs mr-1">{{ $mk->nama_matkul }}</span>
                        @endforeach
                    </td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="text-blue-600">Detail</a>
                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="text-yellow-600">Edit</a>
                        <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
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
