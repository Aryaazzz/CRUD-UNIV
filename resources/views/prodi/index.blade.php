@extends('layouts.app')

@section('title', 'Data Prodi')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Data Prodi</h1>
    <a href="{{ route('prodi.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Prodi</a>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="min-w-full text-left">
        <thead class="bg-slate-200">
            <tr>
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">Nama Prodi</th>
                <th class="px-4 py-3">Kode Prodi</th>
                <th class="px-4 py-3">Mahasiswa</th>
                <th class="px-4 py-3">Dosen</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prodis as $index => $prodi)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ $prodi->nama_prodi }}</td>
                    <td class="px-4 py-3">{{ $prodi->kode_prodi }}</td>
                    <td class="px-4 py-3">{{ $prodi->mahasiswas_count }}</td>
                    <td class="px-4 py-3">{{ $prodi->dosens_count }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('prodi.show', $prodi->id) }}" class="text-blue-600">Detail</a>
                        <a href="{{ route('prodi.edit', $prodi->id) }}" class="text-yellow-600">Edit</a>
                        <form action="{{ route('prodi.destroy', $prodi->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
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
