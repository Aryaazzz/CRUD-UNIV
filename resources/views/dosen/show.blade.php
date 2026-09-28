@extends('layouts.app')

@section('title', 'Profil Dosen - ' . $dosen->nama_dosen)

@section('content')
<div class="space-y-6 max-w-3xl mx-auto">
    <!-- Action Bar -->
    <div class="no-print flex items-center justify-between bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
        <a href="{{ route('dosen.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700 px-3 py-2 rounded-xl hover:bg-slate-50 transition-colors">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Dosen
        </a>
        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold shadow-xs transition-all">
                <i class="fa-solid fa-print text-sm"></i> Cetak Kartu Dosen
            </button>
            <a href="{{ route('dosen.edit', $dosen->id) }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold shadow-xs transition-all">
                <i class="fa-solid fa-pen-to-square text-sm"></i> Edit Data
            </a>
        </div>
    </div>

    <!-- Official Faculty ID Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <!-- University Header -->
        <div class="pb-6 border-b-2 border-slate-900 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-navy-950 text-gold-400 flex items-center justify-center text-3xl shrink-0 shadow-sm">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div>
                    <span class="text-xs uppercase tracking-widest font-extrabold text-emerald-700 block">KEMENTERIAN PENDIDIKAN TINGGI, RISET, DAN TEKNOLOGI</span>
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">UNIVERSITAS NUSANTARA CENDEKIA</h2>
                    <p class="text-xs text-slate-500 font-medium">Direktorat Sumber Daya Manusia & Pendidik • Akreditasi Unggul (A)</p>
                </div>
            </div>
            <div class="hidden sm:block text-right">
                <span class="inline-block px-3 py-1 rounded-md bg-emerald-800 text-white text-xs font-bold font-mono">
                    TENAGA PENDIDIK
                </span>
                <span class="text-[11px] text-slate-400 block mt-1">Status: Aktif Mengajar</span>
            </div>
        </div>

        <div class="text-center py-4 border-b border-slate-200">
            <h3 class="text-lg font-extrabold uppercase tracking-wide text-slate-800">LEMBAR PROFIL TENAGA PENGAJAR</h3>
        </div>

        <!-- Faculty Profile Card Body -->
        <div class="my-6 flex flex-col sm:flex-row items-center sm:items-start gap-6 bg-slate-50/80 p-6 rounded-2xl border border-slate-200/70">
            <img src="{{ $dosen->foto_url }}" alt="{{ $dosen->nama_dosen }}" 
                 class="w-28 h-28 rounded-2xl object-cover shrink-0 shadow-md border-2 border-white ring-4 ring-emerald-500/20">

            <div class="flex-1 space-y-3 text-xs w-full">
                <div class="flex border-b border-slate-200/60 pb-2">
                    <span class="w-36 text-slate-400 font-medium">Nomor Induk Pegawai</span>
                    <span class="font-bold text-slate-800 font-mono text-sm">: {{ $dosen->nip }}</span>
                </div>
                <div class="flex border-b border-slate-200/60 pb-2">
                    <span class="w-36 text-slate-400 font-medium">Nama Lengkap & Gelar</span>
                    <span class="font-bold text-slate-900 text-sm">: {{ $dosen->nama_dosen }}</span>
                </div>
                <div class="flex border-b border-slate-200/60 pb-2">
                    <span class="w-36 text-slate-400 font-medium">Homebase Program Studi</span>
                    <span class="font-bold text-emerald-700">: {{ $dosen->prodi?->nama_prodi ?? 'Pusat / Lintas Fakultas' }}</span>
                </div>
                <div class="flex border-b border-slate-200/60 pb-2">
                    <span class="w-36 text-slate-400 font-medium">Kode Program Studi</span>
                    <span class="font-mono text-slate-700 font-semibold">: {{ $dosen->prodi?->kode_prodi ?? '-' }}</span>
                </div>
                <div class="flex">
                    <span class="w-36 text-slate-400 font-medium">Status Fungsional</span>
                    <span class="font-bold text-emerald-600">: <i class="fa-solid fa-circle-check text-[10px]"></i> Dosen Tetap Universitas</span>
                </div>
            </div>
        </div>

        <!-- Academic Assignment Summary -->
        <div class="p-5 rounded-xl bg-blue-50/50 border border-blue-100 text-xs">
            <h4 class="font-bold text-blue-900 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-blue-600"></i> Tugas & Kewajiban Tridharma Perguruan Tinggi
            </h4>
            <p class="text-blue-800 leading-relaxed">
                Tenaga pengajar berwenang dalam penyusunan Rencana Pembelajaran Semester (RPS), pengesahan Kartu Rencana Studi (KRS) mahasiswa bimbingan, serta evaluasi hasil penilaian akademik semester.
            </p>
        </div>
    </div>
</div>
@endsection
