@extends('layouts.app')

@section('title', 'Perbarui Data Mahasiswa - ' . $mahasiswa->nama)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-amber-600 mb-1">
                <i class="fa-solid fa-user-pen"></i> Pemutakhiran Berkas Akademik
            </div>
            <h1 class="text-xl font-extrabold text-slate-800 tracking-tight">Edit Data Mahasiswa</h1>
            <p class="text-xs text-slate-500 mt-1">Perbarui informasi identitas pokok dan penyesuaian kartu rencana studi.</p>
        </div>
        <a href="{{ route('mahasiswa.index') }}" class="text-xs font-bold text-slate-600 hover:text-univ-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition-colors">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <!-- Main Edit Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Section 1: Identitas Pokok -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 pb-2 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-id-badge text-amber-600"></i> Identitas Pokok Mahasiswa
                </h3>

                <!-- Upload & Ganti Foto Profil -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Foto Pasfoto Mahasiswa <span class="text-xs text-slate-400 font-normal">(Opsional - Ubah pasfoto mahasiswa)</span>
                    </label>
                    <div class="flex items-center gap-4 p-3.5 bg-slate-50/70 rounded-2xl border border-slate-200">
                        <div class="w-16 h-16 rounded-xl bg-white border-2 border-slate-200 flex items-center justify-center overflow-hidden shrink-0 shadow-xs">
                            <img id="mahasiswaEditPreview" src="{{ $mahasiswa->foto_url }}" alt="{{ $mahasiswa->nama }}" class="w-full h-full object-cover">
                        </div>
                        <div class="space-y-1 flex-1">
                            <input type="file" name="foto" id="fotoInput" accept="image/png,image/jpeg,image/webp,image/jpg"
                                   onchange="previewImage(this, 'mahasiswaEditPreview')"
                                   class="block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100 cursor-pointer">
                            <p class="text-[11px] text-slate-400">Pilih berkas baru jika ingin mengganti foto (JPG, PNG, WEBP, maks 3MB). Biarkan kosong jika tidak ingin mengubah.</p>
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
                            <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" required 
                                   class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-univ-500/20 focus:border-univ-500 font-mono transition-all">
                        </div>
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
                                @foreach($prodis as $prodi)
                                    <option value="{{ $prodi->id }}" {{ old('prodi_id', $mahasiswa->prodi_id) == $prodi->id ? 'selected' : '' }}>
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
                        <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" required 
                               class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-univ-500/20 focus:border-univ-500 transition-all">
                    </div>
                </div>
            </div>

            <!-- Section 2: KRS Selection -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-2">
                            <i class="fa-solid fa-book-open text-amber-600"></i> Pengambilan Mata Kuliah (KRS)
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Centang mata kuliah yang diambil mahasiswa.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-72 overflow-y-auto pr-1">
                    @foreach($mataKuliahs as $mk)
                        @php
                            $isChecked = is_array(old('mata_kuliah')) 
                                ? in_array($mk->id, old('mata_kuliah')) 
                                : $mahasiswa->mataKuliahs->contains($mk->id);
                        @endphp
                        <label class="flex items-start gap-3 p-3 rounded-xl border border-slate-200/80 hover:border-amber-300 hover:bg-amber-50/30 cursor-pointer transition-all">
                            <input type="checkbox" name="mata_kuliah[]" value="{{ $mk->id }}" 
                                   {{ $isChecked ? 'checked' : '' }}
                                   class="mt-0.5 rounded border-slate-300 text-amber-600 focus:ring-amber-500/20">
                            <div class="flex-1 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-slate-800">{{ $mk->nama_matkul }}</span>
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-800">
                                        {{ $mk->sks }} SKS
                                    </span>
                                </div>
                                <span class="font-mono text-[10px] text-slate-400 block mt-0.5">{{ $mk->kode_matkul }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('mahasiswa.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold shadow-md shadow-amber-500/30 transition-all hover:scale-[1.02] flex items-center gap-2">
                    <i class="fa-solid fa-check"></i> Perbarui Data Mahasiswa
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
