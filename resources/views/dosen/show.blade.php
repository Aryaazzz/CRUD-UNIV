@extends('layouts.app')

@section('title', 'Detail Dosen')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Detail Dosen</h1>

    <p class="mb-2"><strong>NIP:</strong> {{ $dosen->nip }}</p>
    <p class="mb-2"><strong>Nama Dosen:</strong> {{ $dosen->nama_dosen }}</p>
    <p class="mb-2"><strong>Prodi:</strong> {{ $dosen->prodi?->nama_prodi ?? '-' }}</p>

    <div class="mt-6">
        <a href="{{ route('dosen.index') }}" class="bg-slate-300 px-4 py-2 rounded">Kembali</a>
    </div>
</div>
@endsection
