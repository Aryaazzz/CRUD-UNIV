@extends('layouts.app')

@section('title', 'Program Studi & Fakultas')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-amber-600 mb-1">
                <i class="fa-solid fa-building-columns"></i> Fakultas & Departemen
            </div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Program Studi Akademik</h1>
            <p class="text-xs text-slate-500 mt-1">
                Manajemen struktur program studi, kode departemen, kuota mahasiswa, serta distribusi tenaga pendidik.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('prodi.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold shadow-md shadow-amber-500/30 transition-all hover:scale-[1.02]">
                <i class="fa-solid fa-plus text-sm"></i> Tambah Program Studi
            </a>
        </div>
    </div>

    <!-- Department Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($prodis as $prodi)
            <div class="glass-card rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition-all relative overflow-hidden flex flex-col justify-between">
                <div>
                    <!-- Top Badge -->
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2.5">
                            @if($prodi->foto_url)
                                <img src="{{ $prodi->foto_url }}" alt="{{ $prodi->nama_prodi }}" class="w-8 h-8 rounded-lg object-cover border border-slate-200 shadow-2xs">
                            @endif
                            <span class="px-2.5 py-1 rounded-lg text-xs font-mono font-extrabold bg-navy-900 text-white tracking-wider">
                                {{ $prodi->kode_prodi }}
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-gold-100 text-gold-800 border border-gold-300/60">
                            <i class="fa-solid fa-star text-[9px]"></i> Akreditasi A
                        </span>
                    </div>

                    <!-- Department Title -->
                    <h3 class="text-base font-extrabold text-slate-800 mt-3 leading-snug hover:text-univ-600">
                        <a href="{{ route('prodi.show', $prodi->id) }}">{{ $prodi->nama_prodi }}</a>
                    </h3>
                    <span class="text-[11px] text-slate-400 block mt-0.5">Program Sarjana (S1) Reguler</span>

                    <!-- Department Metrics Grid -->
                    <div class="grid grid-cols-2 gap-3 mt-5 p-3 rounded-xl bg-slate-50 border border-slate-200/60 text-xs">
                        <div>
                            <span class="text-slate-400 text-[11px] block">Mahasiswa Aktif</span>
                            <span class="font-extrabold text-slate-800 text-lg block mt-0.5">{{ $prodi->mahasiswas_count }}</span>
                            <span class="text-[10px] text-slate-500">terdaftar</span>
                        </div>
                        <div>
                            <span class="text-slate-400 text-[11px] block">Dosen Homebase</span>
                            <span class="font-extrabold text-slate-800 text-lg block mt-0.5">{{ $prodi->dosens_count }}</span>
                            <span class="text-[10px] text-slate-500">pengampu</span>
                        </div>
                    </div>
                </div>

                <!-- Card Actions -->
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                    <a href="{{ route('prodi.show', $prodi->id) }}" class="font-bold text-univ-600 hover:text-univ-800 flex items-center gap-1.5">
                        <i class="fa-solid fa-eye"></i> Detail & Anggota
                    </a>
                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('prodi.edit', $prodi->id) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                        </a>
                        <form action="{{ route('prodi.destroy', $prodi->id) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus program studi {{ $prodi->nama_prodi }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50" title="Hapus">
                                <i class="fa-solid fa-trash text-sm"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white p-12 rounded-2xl border border-slate-200 text-center">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl mb-3 shadow-xs">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
                <h4 class="text-sm font-bold text-slate-800">Belum Ada Program Studi</h4>
                <p class="text-xs text-slate-400 mt-1">Tambahkan program studi pertama untuk mengelompokkan mahasiswa dan dosen.</p>
                <a href="{{ route('prodi.create') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-500 text-white text-xs font-bold hover:bg-amber-600 transition-colors">
                    <i class="fa-solid fa-plus"></i> Tambah Prodi
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
