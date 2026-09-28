@extends('layouts.app')

@section('title', 'Detail Mata Kuliah - ' . $mataKuliah->nama_matkul)

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Action Bar -->
    <div class="no-print flex items-center justify-between bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
        <a href="{{ route('mata-kuliah.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-indigo-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition-colors">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Katalog Mata Kuliah
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('mata-kuliah.edit', $mataKuliah->id) }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold shadow-xs transition-all">
                <i class="fa-solid fa-pen-to-square text-sm"></i> Edit Mata Kuliah
            </a>
        </div>
    </div>

    <!-- Course Info Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <!-- University Header -->
        <div class="pb-6 border-b-2 border-slate-900 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                @if($mataKuliah->foto_url)
                    <img src="{{ $mataKuliah->foto_url }}" alt="{{ $mataKuliah->nama_matkul }}" class="w-16 h-16 rounded-2xl object-cover shrink-0 shadow-sm border border-slate-200">
                @else
                    <div class="w-16 h-16 rounded-2xl bg-navy-950 text-gold-400 flex items-center justify-center text-3xl shrink-0 shadow-sm">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                @endif
                <div>
                    <span class="text-xs uppercase tracking-widest font-extrabold text-indigo-700 block">KEMENTERIAN PENDIDIKAN TINGGI, RISET, DAN TEKNOLOGI</span>
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">UNIVERSITAS NUSANTARA CENDEKIA</h2>
                    <p class="text-xs text-slate-500 font-medium">Biro Kurikulum & Pembelajaran • Akreditasi Unggul (A)</p>
                </div>
            </div>
            <div class="hidden sm:block text-right">
                <span class="inline-block px-3 py-1 rounded-md bg-indigo-900 text-white text-xs font-bold font-mono">
                    {{ $mataKuliah->kode_matkul }}
                </span>
                <span class="text-[11px] text-slate-400 block mt-1">{{ $mataKuliah->sks }} SKS Kredit</span>
            </div>
        </div>

        <div class="text-center py-4 border-b border-slate-200">
            <h3 class="text-lg font-extrabold uppercase tracking-wide text-slate-800">{{ $mataKuliah->nama_matkul }}</h3>
            <span class="text-xs text-slate-500">Katalog Silabus Kurikulum Semester Aktif</span>
        </div>

        <!-- Course Meta Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 my-6 text-xs bg-slate-50 p-5 rounded-2xl border border-slate-200/70">
            <div>
                <span class="text-slate-400 font-medium block">Kode Mata Kuliah</span>
                <span class="font-extrabold text-slate-800 font-mono text-sm block mt-0.5">{{ $mataKuliah->kode_matkul }}</span>
            </div>
            <div>
                <span class="text-slate-400 font-medium block">Bobot Satuan Kredit</span>
                <span class="font-extrabold text-indigo-700 text-sm block mt-0.5">{{ $mataKuliah->sks }} SKS (Teori & Praktik)</span>
            </div>
            <div>
                <span class="text-slate-400 font-medium block">Total Peserta Kelas</span>
                <span class="font-extrabold text-slate-800 text-sm block mt-0.5">{{ $mataKuliah->mahasiswas->count() }} Mahasiswa</span>
            </div>
        </div>

        <!-- Enrolled Students Table -->
        <div class="mt-6">
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-users text-indigo-600"></i> Daftar Mahasiswa Terdaftar (Peserta Kelas)
                </h4>
                <span class="text-xs font-semibold text-slate-500">
                    Kapasitas Kelas: <strong>{{ $mataKuliah->mahasiswas->count() }} / 40</strong>
                </span>
            </div>

            <div class="border border-slate-200 rounded-xl overflow-hidden">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-100 text-slate-600 font-bold uppercase text-[11px] border-b border-slate-200">
                        <tr>
                            <th class="py-2.5 px-3 text-center w-12">No</th>
                            <th class="py-2.5 px-3 w-32">NIM</th>
                            <th class="py-2.5 px-3">Nama Mahasiswa</th>
                            <th class="py-2.5 px-3">Program Studi</th>
                            <th class="py-2.5 px-3 text-center w-28">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @forelse($mataKuliah->mahasiswas as $idx => $mhs)
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-2.5 px-3 text-center text-slate-400 font-mono">{{ $idx + 1 }}</td>
                                <td class="py-2.5 px-3 font-mono font-bold text-slate-600">{{ $mhs->nim }}</td>
                                <td class="py-2.5 px-3 font-bold text-slate-800">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ $mhs->foto_url }}" alt="{{ $mhs->nama }}" class="w-6 h-6 rounded-md object-cover border border-slate-200 shrink-0">
                                        <a href="{{ route('mahasiswa.show', $mhs->id) }}" class="hover:text-univ-600">
                                            {{ $mhs->nama }}
                                        </a>
                                    </div>
                                </td>
                                <td class="py-2.5 px-3">{{ $mhs->prodi?->nama_prodi ?? '-' }}</td>
                                <td class="py-2.5 px-3 text-center">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Terdaftar
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400 italic">
                                    Belum ada mahasiswa yang mengambil mata kuliah ini dalam KRS.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
