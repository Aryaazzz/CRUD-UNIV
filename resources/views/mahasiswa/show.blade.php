@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Detail Mahasiswa</h1>

    <p class="mb-2"><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
    <p class="mb-2"><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
    <p class="mb-2"><strong>Prodi:</strong> {{ $mahasiswa->prodi?->nama_prodi ?? '-' }}</p>

    <h2 class="text-xl font-semibold mt-6 mb-3">Mata Kuliah</h2>
    @if($mahasiswa->mataKuliahs->isEmpty())
        <p class="text-slate-500">Belum mengambil mata kuliah.</p>
    @else
        <ul class="list-disc ml-6">
            @foreach($mahasiswa->mataKuliahs as $mk)
                <li>{{ $mk->nama_matkul }} ({{ $mk->kode_matkul }})</li>
            @endforeach
        </ul>
    @endif

    <div class="mt-6">
        <a href="{{ route('mahasiswa.index') }}" class="bg-slate-300 px-4 py-2 rounded">Kembali</a>
    </div>
</div>
@endsection
