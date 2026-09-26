@extends('layouts.app')

@section('title', 'Detail Mata Kuliah')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Detail Mata Kuliah</h1>

    <p class="mb-2"><strong>Kode:</strong> {{ $mataKuliah->kode_matkul }}</p>
    <p class="mb-2"><strong>Nama:</strong> {{ $mataKuliah->nama_matkul }}</p>
    <p class="mb-2"><strong>SKS:</strong> {{ $mataKuliah->sks }}</p>

    <h2 class="text-xl font-semibold mt-6 mb-3">Mahasiswa yang Mengambil</h2>
    @if($mataKuliah->mahasiswas->isEmpty())
        <p class="text-slate-500">Belum ada mahasiswa yang mengambil.</p>
    @else
        <ul class="list-disc ml-6">
            @foreach($mataKuliah->mahasiswas as $mahasiswa)
                <li>{{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})</li>
            @endforeach
        </ul>
    @endif

    <div class="mt-6">
        <a href="{{ route('mata-kuliah.index') }}" class="bg-slate-300 px-4 py-2 rounded">Kembali</a>
    </div>
</div>
@endsection
