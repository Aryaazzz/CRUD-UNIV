@extends('layouts.app')

@section('title', 'Detail Prodi')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Detail Prodi</h1>

    <p class="mb-2"><strong>Nama Prodi:</strong> {{ $prodi->nama_prodi }}</p>
    <p class="mb-2"><strong>Kode Prodi:</strong> {{ $prodi->kode_prodi }}</p>

    <h2 class="text-xl font-semibold mt-6 mb-3">Mahasiswa</h2>
    @if($prodi->mahasiswas->isEmpty())
        <p class="text-slate-500">Belum ada mahasiswa.</p>
    @else
        <ul class="list-disc ml-6">
            @foreach($prodi->mahasiswas as $mahasiswa)
                <li>{{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})</li>
            @endforeach
        </ul>
    @endif

    <h2 class="text-xl font-semibold mt-6 mb-3">Dosen</h2>
    @if($prodi->dosens->isEmpty())
        <p class="text-slate-500">Belum ada dosen.</p>
    @else
        <ul class="list-disc ml-6">
            @foreach($prodi->dosens as $dosen)
                <li>{{ $dosen->nama_dosen }} ({{ $dosen->nip }})</li>
            @endforeach
        </ul>
    @endif

    <div class="mt-6">
        <a href="{{ route('prodi.index') }}" class="bg-slate-300 px-4 py-2 rounded">Kembali</a>
    </div>
</div>
@endsection
