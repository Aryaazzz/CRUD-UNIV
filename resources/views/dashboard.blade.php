@extends('layouts.app')

@section('title', 'Beranda Akademik')

@section('content')
<div class="space-y-8">
    <!-- Hero Banner with University Identity -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-navy-950 via-navy-900 to-univ-900 text-white p-6 sm:p-8 shadow-xl border border-navy-800">
        <!-- Background decorative pattern -->
        <div class="absolute -right-10 -bottom-10 w-72 h-72 rounded-full bg-univ-600/10 blur-3xl pointer-events-none"></div>
        <div class="absolute right-20 top-0 w-52 h-52 rounded-full bg-gold-400/5 blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-xs text-xs font-semibold text-gold-400 mb-3 border border-white/10">
                    <i class="fa-solid fa-graduation-cap"></i> Sistem Informasi Akademik Universitas Nusantara Cendekia
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                    Selamat Datang di Portal SIAKAD Terpadu
                </h1>
                <p class="mt-2 text-sm text-slate-300 leading-relaxed">
                    Kelola data mahasiswa, dosen pengampu, kurikulum program studi, dan KRS secara terintegrasi, akurat, dan transparan.
                </p>
            </div>

            <!-- Quick Action Shortcuts -->
            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('mahasiswa.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-univ-500 to-univ-600 hover:from-univ-600 hover:to-univ-700 text-white text-xs font-bold shadow-md shadow-univ-600/30 transition-all hover:scale-[1.02]">
                    <i class="fa-solid fa-user-plus text-sm"></i> Tambah Mahasiswa
                </a>
                <a href="{{ route('dosen.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold border border-white/15 backdrop-blur-xs transition-all hover:scale-[1.02]">
                    <i class="fa-solid fa-user-tie text-sm"></i> Tambah Dosen
                </a>
                <a href="{{ route('mata-kuliah.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold border border-white/15 backdrop-blur-xs transition-all hover:scale-[1.02]">
                    <i class="fa-solid fa-book-medical text-sm"></i> Tambah Matkul
                </a>
            </div>
        </div>
    </div>

    <!-- 4 KPI Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card 1: Mahasiswa -->
        <div class="glass-card rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Mahasiswa</span>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalMahasiswa }}</h3>
                </div>
                <div class="w-13 h-13 rounded-2xl bg-blue-50 text-univ-600 flex items-center justify-center text-xl shadow-xs group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-emerald-600 font-semibold flex items-center gap-1">
                    <i class="fa-solid fa-circle-check text-[10px]"></i> Status Terdaftar
                </span>
                <a href="{{ route('mahasiswa.index') }}" class="text-univ-600 hover:text-univ-800 font-semibold flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">
                    Lihat Data <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <!-- Card 2: Dosen -->
        <div class="glass-card rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Dosen Pengampu</span>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalDosen }}</h3>
                </div>
                <div class="w-13 h-13 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-xs group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-500 font-medium">Tenaga Pengajar Aktif</span>
                <a href="{{ route('dosen.index') }}" class="text-univ-600 hover:text-univ-800 font-semibold flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">
                    Lihat Data <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <!-- Card 3: Program Studi -->
        <div class="glass-card rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Program Studi</span>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalProdi }}</h3>
                </div>
                <div class="w-13 h-13 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-xs group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-gold-600 font-semibold flex items-center gap-1">
                    <i class="fa-solid fa-certificate text-[10px]"></i> Akreditasi A & B
                </span>
                <a href="{{ route('prodi.index') }}" class="text-univ-600 hover:text-univ-800 font-semibold flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">
                    Lihat Data <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <!-- Card 4: Mata Kuliah & SKS -->
        <div class="glass-card rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Mata Kuliah / SKS</span>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-1">{{ $totalMataKuliah }} <span class="text-sm font-semibold text-slate-400">({{ $totalSks }} SKS)</span></h3>
                </div>
                <div class="w-13 h-13 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl shadow-xs group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-500 font-medium">Beban SKS Semester</span>
                <a href="{{ route('mata-kuliah.index') }}" class="text-univ-600 hover:text-univ-800 font-semibold flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">
                    Katalog Matkul <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Section: 2 Columns -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left 2 Cols: Recent Students & Program Studies -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Recent Students Card -->
            <div class="glass-card rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                            <i class="fa-solid fa-user-graduate text-univ-600"></i> Mahasiswa Terbaru
                        </h3>
                        <p class="text-xs text-slate-400 mt-0.5">Daftar mahasiswa terdaftar beserta program studi & KRS</p>
                    </div>
                    <a href="{{ route('mahasiswa.index') }}" class="text-xs font-bold text-univ-600 hover:text-univ-800 px-3 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors">
                        Lihat Semua ({{ $totalMahasiswa }})
                    </a>
                </div>

                @if($recentMahasiswas->isEmpty())
                    <div class="text-center py-12 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                        <i class="fa-solid fa-user-slash text-3xl text-slate-300 mb-2"></i>
                        <p class="text-sm font-semibold text-slate-600">Belum ada data mahasiswa</p>
                        <a href="{{ route('mahasiswa.create') }}" class="mt-3 inline-flex items-center gap-1.5 px-3 py-1.5 bg-univ-600 text-white rounded-lg text-xs font-semibold">
                            <i class="fa-solid fa-plus"></i> Tambah Pertama
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-slate-400 uppercase tracking-wider font-semibold border-b border-slate-100">
                                    <th class="pb-3 pl-2">Mahasiswa</th>
                                    <th class="pb-3">Program Studi</th>
                                    <th class="pb-3">KRS Diambil</th>
                                    <th class="pb-3 pr-2 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                                @foreach($recentMahasiswas as $mhs)
                                    <tr class="hover:bg-slate-50/70 transition-colors">
                                        <td class="py-3.5 pl-2">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $mhs->foto_url }}" alt="{{ $mhs->nama }}" class="w-9 h-9 rounded-xl object-cover border border-slate-200 shrink-0 shadow-xs">
                                                <div>
                                                    <span class="font-bold text-slate-800 block text-xs">{{ $mhs->nama }}</span>
                                                    <span class="text-[11px] text-slate-400 font-mono">{{ $mhs->nim }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3.5">
                                            @if($mhs->prodi)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                                    <i class="fa-solid fa-bookmark text-[9px] text-univ-500"></i> {{ $mhs->prodi->nama_prodi }}
                                                </span>
                                            @else
                                                <span class="text-slate-400 italic text-[11px]">-</span>
                                            @endif
                                        </td>
                                        <td class="py-3.5">
                                            @if($mhs->mataKuliahs->isEmpty())
                                                <span class="text-slate-400 text-[11px] italic">Belum ada KRS</span>
                                            @else
                                                <div class="flex flex-wrap gap-1 max-w-xs">
                                                    @foreach($mhs->mataKuliahs->take(2) as $mk)
                                                        <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200/60">
                                                            {{ $mk->nama_matkul }}
                                                        </span>
                                                    @endforeach
                                                    @if($mhs->mataKuliahs->count() > 2)
                                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600">
                                                            +{{ $mhs->mataKuliahs->count() - 2 }}
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-3.5 pr-2 text-right">
                                            <a href="{{ route('mahasiswa.show', $mhs->id) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-bold text-univ-600 hover:text-univ-800 hover:bg-blue-50 transition-colors">
                                                <i class="fa-solid fa-id-card"></i> Profil
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Program Studi Distribution Card -->
            <div class="glass-card rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                            <i class="fa-solid fa-chart-bar text-univ-600"></i> Distribusi Fakultas & Program Studi
                        </h3>
                        <p class="text-xs text-slate-400 mt-0.5">Rasio mahasiswa dan dosen per program studi</p>
                    </div>
                    <a href="{{ route('prodi.index') }}" class="text-xs font-bold text-univ-600 hover:text-univ-800 px-3 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors">
                        Kelola Prodi
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($prodis as $prodi)
                        <div class="p-4 rounded-xl border border-slate-200/80 bg-slate-50/50 hover:bg-white hover:shadow-sm transition-all">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-navy-900 text-white">
                                        {{ $prodi->kode_prodi }}
                                    </span>
                                    <h4 class="font-bold text-slate-800 text-sm mt-1.5">{{ $prodi->nama_prodi }}</h4>
                                </div>
                                <span class="w-8 h-8 rounded-lg bg-univ-100 text-univ-700 flex items-center justify-center text-xs font-bold">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            <div class="grid grid-cols-2 gap-2 mt-4 pt-3 border-t border-slate-200/60 text-xs">
                                <div>
                                    <span class="text-slate-400 text-[11px] block">Mahasiswa</span>
                                    <span class="font-extrabold text-slate-800 text-base">{{ $prodi->mahasiswas_count }}</span>
                                    <span class="text-[10px] text-slate-500">orang</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 text-[11px] block">Dosen Pengampu</span>
                                    <span class="font-extrabold text-slate-800 text-base">{{ $prodi->dosens_count }}</span>
                                    <span class="text-[10px] text-slate-500">dosen</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-6 text-slate-400 text-xs">
                            Belum ada program studi yang didaftarkan.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right 1 Col: Academic Calendar & Recent Lecturers -->
        <div class="space-y-8">
            <!-- Academic Calendar Widget -->
            <div class="glass-card rounded-2xl p-6 shadow-sm border-t-4 border-t-gold-500">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-calendar-days text-gold-500"></i> Kalender Akademik 2026/2027
                    </h3>
                    <span class="text-[10px] font-bold uppercase bg-amber-100 text-amber-800 px-2 py-0.5 rounded">Ganjil</span>
                </div>

                <div class="space-y-3.5 text-xs">
                    <div class="p-3 rounded-xl bg-blue-50/70 border border-blue-100 flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex flex-col items-center justify-center font-bold shrink-0">
                            <span class="text-[9px] uppercase leading-none">Sep</span>
                            <span class="text-xs leading-none">28</span>
                        </div>
                        <div>
                            <span class="font-bold text-blue-900 block">Masa Registrasi & KRS</span>
                            <p class="text-[11px] text-blue-700 mt-0.5">Batas akhir validasi rencana studi oleh dosen wali</p>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-700 text-white flex flex-col items-center justify-center font-bold shrink-0">
                            <span class="text-[9px] uppercase leading-none">Okt</span>
                            <span class="text-xs leading-none">05</span>
                        </div>
                        <div>
                            <span class="font-bold text-slate-800 block">Awal Perkuliahan Efektif</span>
                            <p class="text-[11px] text-slate-500 mt-0.5">Pertemuan tatap muka minggu ke-1 s.d ke-7</p>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-700 text-white flex flex-col items-center justify-center font-bold shrink-0">
                            <span class="text-[9px] uppercase leading-none">Nov</span>
                            <span class="text-xs leading-none">23</span>
                        </div>
                        <div>
                            <span class="font-bold text-slate-800 block">Ujian Tengah Semester (UTS)</span>
                            <p class="text-[11px] text-slate-500 mt-0.5">Evaluasi hasil belajar paruh semester</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Faculty Members Card -->
            <div class="glass-card rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-chalkboard-user text-univ-600"></i> Dosen Pembimbing
                    </h3>
                    <a href="{{ route('dosen.index') }}" class="text-[11px] font-bold text-univ-600 hover:text-univ-800">
                        Lihat Semua
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($recentDosens as $dosen)
                        <div class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 transition-colors border border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($dosen->nama_dosen, 0, 2)) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-xs text-slate-800">{{ $dosen->nama_dosen }}</h4>
                                    <span class="text-[11px] text-slate-400 font-mono">NIP: {{ $dosen->nip }}</span>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                {{ $dosen->prodi?->kode_prodi ?? 'Pusat' }}
                            </span>
                        </div>
                    @empty
                        <p class="text-slate-400 text-xs italic">Belum ada dosen terdaftar.</p>
                    @endforelse
                </div>
            </div>

            <!-- Academic Support Badge -->
            <div class="rounded-2xl p-5 bg-gradient-to-br from-univ-900 to-navy-950 text-white shadow-md border border-navy-800 text-xs">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 rounded-lg bg-gold-500 text-navy-950 flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <span class="font-bold text-gold-400">Pusat Layanan Akademik (BAAK)</span>
                </div>
                <p class="text-slate-300 leading-relaxed text-[11px] mt-1">
                    Kendala input nilai, revisi KRS, atau administrasi data induk mahasiswa dapat dilaporkan melalui loket pelayanan mahasiswa.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
