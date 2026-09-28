@extends('layouts.app')

@section('title', 'Pendaftaran Mahasiswa Baru')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-univ-600 mb-1">
                <i class="fa-solid fa-user-plus"></i> Formulir Registrasi Akademik
            </div>
            <h1 class="text-xl font-extrabold text-slate-800 tracking-tight">Pendaftaran Mahasiswa Baru</h1>
            <p class="text-xs text-slate-500 mt-1">Masukkan data identitas dan pilih mata kuliah awal (KRS Paket).</p>
        </div>
        <a href="{{ route('mahasiswa.index') }}" class="text-xs font-bold text-slate-600 hover:text-univ-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition-colors">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
        <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Section 1: Data Identitas -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 pb-2 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-id-badge text-univ-600"></i> Identitas Pokok Mahasiswa
                </h3>

                <!-- Upload Foto Profil -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Foto Pasfoto Mahasiswa <span class="text-xs text-slate-400 font-normal">(Opsional - Ditampilkan pada KTM & Dokumen KRS)</span>
                    </label>
                    <div class="flex items-center gap-4 p-3.5 bg-slate-50/70 rounded-2xl border border-slate-200">
                        <div class="w-16 h-16 rounded-xl bg-white border-2 border-slate-200 flex items-center justify-center overflow-hidden shrink-0 shadow-xs">
                            <img id="mahasiswaPreview" src="https://ui-avatars.com/api/?name=Mahasiswa+Baru&background=025aa2&color=ffffff&bold=true&size=128" alt="Preview" class="w-full h-full object-cover">
                        </div>
                        <div class="space-y-1 flex-1">
                            <input type="file" name="foto" id="fotoInput" accept="image/png,image/jpeg,image/webp,image/jpg"
                                   onchange="previewImage(this, 'mahasiswaPreview')"
                                   class="block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-univ-50 file:text-univ-700 hover:file:bg-univ-100 cursor-pointer">
                            <p class="text-[11px] text-slate-400">Format yang didukung: JPG, PNG, WEBP. Maksimal 3MB. Disarankan rasio pasfoto 3:4 atau 1:1.</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- NIM -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Nomor Induk Mahasiswa (NIM) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                                <i class="fa-solid fa-hashtag"></i>
                            </span>
                            <input type="text" name="nim" value="{{ old('nim') }}" required 
                                   placeholder="Contoh: 20260001" 
                                   class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-univ-500/20 focus:border-univ-500 font-mono transition-all">
                        </div>
                        <span class="text-[11px] text-slate-400 mt-1 block">NIM harus unik dan menjadi identitas login mahasiswa.</span>
                    </div>

                    <!-- Program Studi -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Program Studi <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                                <i class="fa-solid fa-building-columns"></i>
                            </span>
                            <select name="prodi_id" required 
                                    class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-univ-500/20 focus:border-univ-500 transition-all font-medium">
                                <option value="">-- Pilih Program Studi --</option>
                                @foreach($prodis as $prodi)
                                    <option value="{{ $prodi->id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->nama_prodi }} ({{ $prodi->kode_prodi }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Nama Lengkap Mahasiswa <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="text" name="nama" value="{{ old('nama') }}" required 
                               placeholder="Nama lengkap sesuai ijazah/KTP" 
                               class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-univ-500/20 focus:border-univ-500 transition-all">
                    </div>
                </div>
            </div>

            <!-- Section 2: Pemilihan Mata Kuliah (KRS) -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-2">
                            <i class="fa-solid fa-book-open text-univ-600"></i> Rencana Studi (KRS Awal)
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Pilih mata kuliah yang akan diambil mahasiswa pada semester ini.</p>
                    </div>
                    <span class="text-xs font-semibold text-univ-600 bg-blue-50 px-2.5 py-1 rounded-lg">
                        Opsional
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-72 overflow-y-auto pr-1">
                    @forelse($mataKuliahs as $mk)
                        <label class="flex items-start gap-3 p-3 rounded-xl border border-slate-200/80 hover:border-univ-300 hover:bg-blue-50/30 cursor-pointer transition-all">
                            <input type="checkbox" name="mata_kuliah[]" value="{{ $mk->id }}" 
                                   {{ is_array(old('mata_kuliah')) && in_array($mk->id, old('mata_kuliah')) ? 'checked' : '' }}
                                   class="mt-0.5 rounded border-slate-300 text-univ-600 focus:ring-univ-500/20">
                            <div class="flex-1 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-slate-800">{{ $mk->nama_matkul }}</span>
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-700">
                                        {{ $mk->sks }} SKS
                                    </span>
                                </div>
                                <span class="font-mono text-[10px] text-slate-400 block mt-0.5">{{ $mk->kode_matkul }}</span>
                            </div>
                        </label>
                    @empty
                        <div class="col-span-2 text-center py-6 text-slate-400 text-xs italic">
                            Belum ada mata kuliah yang terdaftar di sistem.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('mahasiswa.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-univ-600 hover:bg-univ-700 text-white text-xs font-bold shadow-md shadow-univ-600/30 transition-all hover:scale-[1.02] flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Data Mahasiswa
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
