@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Data Dosen</h1>
    <a href="{{ route('dosen.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Dosen</a>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="min-w-full text-left">
        <thead class="bg-slate-200">
            <tr>
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">NIP</th>
                <th class="px-4 py-3">Nama Dosen</th>
                <th class="px-4 py-3">Prodi</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosens as $index => $dosen)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ $dosen->nip }}</td>
                    <td class="px-4 py-3">{{ $dosen->nama_dosen }}</td>
                    <td class="px-4 py-3">{{ $dosen->prodi?->nama_prodi ?? '-' }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('dosen.show', $dosen->id) }}" class="text-blue-600">Detail</a>
                        <a href="{{ route('dosen.edit', $dosen->id) }}" class="text-yellow-600">Edit</a>
                        <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
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
