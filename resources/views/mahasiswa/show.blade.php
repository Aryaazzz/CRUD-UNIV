@extends('layouts.app')

@section('title', 'Profil Mahasiswa & KRS - ' . $mahasiswa->nama)

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Action Bar (hidden when printing) -->
    <div class="no-print flex flex-wrap items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs">
        <a href="{{ route('mahasiswa.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-univ-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition-colors">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Mahasiswa
        </a>
        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold shadow-xs transition-all">
                <i class="fa-solid fa-print text-sm"></i> Cetak KRS
            </button>
            <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold shadow-xs transition-all">
                <i class="fa-solid fa-pen-to-square text-sm"></i> Edit Mahasiswa
            </a>
        </div>
    </div>

    <!-- Official Student Profile Card & KRS Paper -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <!-- University Header (Visible in print & web) -->
        <div class="pb-6 border-b-2 border-slate-900 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-navy-950 text-gold-400 flex items-center justify-center text-3xl shrink-0 shadow-sm">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <span class="text-xs uppercase tracking-widest font-extrabold text-univ-700 block">KEMENTERIAN PENDIDIKAN TINGGI, RISET, DAN TEKNOLOGI</span>
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">UNIVERSITAS NUSANTARA CENDEKIA</h2>
                    <p class="text-xs text-slate-500 font-medium">Biro Administrasi Akademik dan Kemahasiswaan (BAAK) • Akreditasi Unggul (A)</p>
                </div>
            </div>
            <div class="hidden sm:block text-right">
                <span class="inline-block px-3 py-1 rounded-md bg-navy-900 text-white text-xs font-bold font-mono">
                    FORM KRS-01
                </span>
                <span class="text-[11px] text-slate-400 block mt-1">T.A. 2026/2027 Ganjil</span>
            </div>
        </div>

        <div class="text-center py-4 border-b border-slate-200">
            <h3 class="text-lg font-extrabold uppercase tracking-wide text-slate-800">KARTU RENCANA STUDI (KRS)</h3>
            <span class="text-xs text-slate-500">Status Registrasi Akademik: <strong class="text-emerald-700">Telah Disetujui Dosen Wali</strong></span>
        </div>

        <!-- Student Biodata Grid -->
        <!-- Student Biodata Card with Photo -->
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-5 my-6 text-xs bg-slate-50/80 p-5 rounded-xl border border-slate-200/70">
            <!-- Pasfoto Mahasiswa -->
            <div class="shrink-0 text-center">
                <img src="{{ $mahasiswa->foto_url }}" alt="{{ $mahasiswa->nama }}" 
                     class="w-24 h-32 rounded-lg object-cover border-2 border-slate-300 shadow-xs mx-auto">
                <span class="text-[10px] text-slate-400 mt-1 block uppercase font-mono">Pasfoto 3x4</span>
            </div>

            <!-- Biodata Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-1 w-full">
                <div class="space-y-2">
                    <div class="flex">
                        <span class="w-32 text-slate-400 font-medium">Nomor Induk (NIM)</span>
                        <span class="font-bold text-slate-800 font-mono">: {{ $mahasiswa->nim }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-slate-400 font-medium">Nama Lengkap</span>
                        <span class="font-bold text-slate-800">: {{ $mahasiswa->nama }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-slate-400 font-medium">Tahun Angkatan</span>
                        <span class="font-bold text-slate-800">: {{ substr($mahasiswa->nim, 0, 4) ?: '2023' }}</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex">
                        <span class="w-32 text-slate-400 font-medium">Program Studi</span>
                        <span class="font-bold text-univ-700">: {{ $mahasiswa->prodi?->nama_prodi ?? 'Belum terdaftar' }} ({{ $mahasiswa->prodi?->kode_prodi ?? '-' }})</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-slate-400 font-medium">Jenjang Pendidikan</span>
                        <span class="font-bold text-slate-800">: Sarjana (S1)</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-slate-400 font-medium">Status Akademik</span>
                        <span class="font-bold text-emerald-600">: <i class="fa-solid fa-circle-check text-[10px]"></i> Aktif Kuliah</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course List Table -->
        <div class="mt-6">
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-list-check text-univ-600"></i> Rincian Mata Kuliah yang Diambil
                </h4>
                <span class="text-xs font-semibold text-slate-600">
                    Total Beban: <strong class="text-univ-700">{{ $mahasiswa->mataKuliahs->sum('sks') }} SKS</strong>
                </span>
            </div>

            <div class="border border-slate-200 rounded-xl overflow-hidden">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-100 text-slate-600 font-bold uppercase text-[11px] border-b border-slate-200">
                        <tr>
                            <th class="py-2.5 px-3 text-center w-12">No</th>
                            <th class="py-2.5 px-3 w-28">Kode Matkul</th>
                            <th class="py-2.5 px-3">Nama Mata Kuliah</th>
                            <th class="py-2.5 px-3 text-center w-20">Bobot SKS</th>
                            <th class="py-2.5 px-3 text-center w-28">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @forelse($mahasiswa->mataKuliahs as $idx => $mk)
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-2.5 px-3 text-center text-slate-400 font-mono">{{ $idx + 1 }}</td>
                                <td class="py-2.5 px-3 font-mono font-bold text-slate-600">{{ $mk->kode_matkul }}</td>
                                <td class="py-2.5 px-3 font-bold text-slate-800">{{ $mk->nama_matkul }}</td>
                                <td class="py-2.5 px-3 text-center font-bold text-univ-700">{{ $mk->sks }} SKS</td>
                                <td class="py-2.5 px-3 text-center">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                        Disetujui
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400 italic">
                                    Mahasiswa belum memilih mata kuliah pada semester ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-slate-50 font-bold text-xs border-t border-slate-200 text-slate-800">
                        <tr>
                            <td colspan="3" class="py-3 px-3 text-right">TOTAL SKS DIAMBIL :</td>
                            <td class="py-3 px-3 text-center text-univ-700 text-sm">{{ $mahasiswa->mataKuliahs->sum('sks') }} SKS</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Academic Signatures for Official Printout -->
        <div class="mt-12 pt-6 grid grid-cols-2 text-center text-xs text-slate-600">
            <div>
                <p>Mengetahui,</p>
                <p class="font-bold text-slate-800">Dosen Pembimbing Akademik,</p>
                <div class="h-16"></div>
                <p class="font-bold text-slate-800 underline">Dr. Ir. Budi Santoso, M.Kom.</p>
                <p class="text-[11px] text-slate-400 font-mono">NIP. 19870001</p>
            </div>
            <div>
                <p>Garut, {{ date('d F Y') }}</p>
                <p class="font-bold text-slate-800">Mahasiswa Yang Bersangkutan,</p>
                <div class="h-16"></div>
                <p class="font-bold text-slate-800 underline">{{ $mahasiswa->nama }}</p>
                <p class="text-[11px] text-slate-400 font-mono">NIM. {{ $mahasiswa->nim }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
