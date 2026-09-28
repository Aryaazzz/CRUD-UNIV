@extends('layouts.app')

@section('title', 'Program Studi - ' . $prodi->nama_prodi)

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Action Bar -->
    <div class="no-print flex items-center justify-between bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
        <a href="{{ route('prodi.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-amber-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition-colors">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Program Studi
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('prodi.edit', $prodi->id) }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold shadow-xs transition-all">
                <i class="fa-solid fa-pen-to-square text-sm"></i> Edit Data Prodi
            </a>
        </div>
    </div>

    <!-- Department Header Banner -->
    <div class="bg-gradient-to-r from-navy-950 via-navy-900 to-slate-900 rounded-2xl p-6 sm:p-8 text-white shadow-md border border-navy-800">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                @if($prodi->foto_url)
                    <img src="{{ $prodi->foto_url }}" alt="{{ $prodi->nama_prodi }}" class="w-16 h-16 rounded-2xl object-cover shrink-0 shadow-lg border-2 border-white/20">
                @else
                    <div class="w-16 h-16 rounded-2xl bg-amber-500 text-navy-950 flex items-center justify-center text-3xl font-extrabold shrink-0 shadow-lg">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                @endif
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="px-2.5 py-0.5 rounded text-xs font-mono font-bold bg-white/20 text-gold-400">
                            KODE: {{ $prodi->kode_prodi }}
                        </span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                            Akreditasi Unggul (A)
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">{{ $prodi->nama_prodi }}</h1>
                    <p class="text-xs text-slate-300 mt-1">Fakultas Ilmu Terapan • Jenjang Sarjana (S1)</p>
                </div>
            </div>

            <!-- Quick Metrics -->
            <div class="flex items-center gap-4 bg-white/10 px-5 py-3 rounded-xl border border-white/10 text-xs">
                <div class="text-center">
                    <span class="text-slate-300 text-[10px] block uppercase font-medium">Mahasiswa</span>
                    <span class="text-xl font-extrabold text-white block">{{ $prodi->mahasiswas->count() }}</span>
                </div>
                <span class="text-white/20 text-xl">|</span>
                <div class="text-center">
                    <span class="text-slate-300 text-[10px] block uppercase font-medium">Dosen</span>
                    <span class="text-xl font-extrabold text-gold-400 block">{{ $prodi->dosens->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 2 Column Layout: Mahasiswa & Dosen in this Department -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Col 1: Mahasiswa Terdaftar -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                    <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-user-graduate text-univ-600"></i> Mahasiswa Terdaftar ({{ $prodi->mahasiswas->count() }})
                    </h3>
                    <a href="{{ route('mahasiswa.create') }}" class="text-[11px] font-bold text-univ-600 hover:text-univ-800">
                        + Tambah
                    </a>
                </div>

                <div class="space-y-2.5 max-h-96 overflow-y-auto pr-1">
                    @forelse($prodi->mahasiswas as $mhs)
                        <div class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 transition-colors border border-slate-100">
                            <div class="flex items-center gap-3">
                                <img src="{{ $mhs->foto_url }}" alt="{{ $mhs->nama }}" class="w-8 h-8 rounded-lg object-cover shrink-0 border border-slate-200">
                                <div>
                                    <h4 class="font-bold text-xs text-slate-800">{{ $mhs->nama }}</h4>
                                    <span class="text-[11px] text-slate-400 font-mono">{{ $mhs->nim }}</span>
                                </div>
                            </div>
                            <a href="{{ route('mahasiswa.show', $mhs->id) }}" class="text-[11px] font-bold text-univ-600 hover:text-univ-800 px-2 py-1 rounded bg-blue-50">
                                Profil
                            </a>
                        </div>
                    @empty
                        <p class="text-slate-400 text-xs italic text-center py-8">Belum ada mahasiswa di program studi ini.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Col 2: Dosen Pengampu Homebase -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                    <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-chalkboard-user text-emerald-600"></i> Dosen Pengampu ({{ $prodi->dosens->count() }})
                    </h3>
                    <a href="{{ route('dosen.create') }}" class="text-[11px] font-bold text-emerald-600 hover:text-emerald-800">
                        + Tambah
                    </a>
                </div>

                <div class="space-y-2.5 max-h-96 overflow-y-auto pr-1">
                    @forelse($prodi->dosens as $dosen)
                        <div class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 transition-colors border border-slate-100">
                            <div class="flex items-center gap-3">
                                <img src="{{ $dosen->foto_url }}" alt="{{ $dosen->nama_dosen }}" class="w-8 h-8 rounded-lg object-cover shrink-0 border border-slate-200">
                                <div>
                                    <h4 class="font-bold text-xs text-slate-800">{{ $dosen->nama_dosen }}</h4>
                                    <span class="text-[11px] text-slate-400 font-mono">NIP: {{ $dosen->nip }}</span>
                                </div>
                            </div>
                            <a href="{{ route('dosen.show', $dosen->id) }}" class="text-[11px] font-bold text-emerald-600 hover:text-emerald-800 px-2 py-1 rounded bg-emerald-50">
                                Profil
                            </a>
                        </div>
                    @empty
                        <p class="text-slate-400 text-xs italic text-center py-8">Belum ada dosen pengampu di program studi ini.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
