@extends('layouts.app')

@section('title', 'Pendaftaran Tenaga Pendidik / Dosen')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-emerald-600 mb-1">
                <i class="fa-solid fa-user-tie"></i> Sumber Daya Manusia & Pendidik
            </div>
            <h1 class="text-xl font-extrabold text-slate-800 tracking-tight">Tambah Dosen Baru</h1>
            <p class="text-xs text-slate-500 mt-1">Daftarkan tenaga pengajar ke dalam pangkalan data perguruan tinggi.</p>
        </div>
        <a href="{{ route('dosen.index') }}" class="text-xs font-bold text-slate-600 hover:text-emerald-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition-colors">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
        <form action="{{ route('dosen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Upload Foto Profil Dosen -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">
                    Foto Profil Dosen <span class="text-xs text-slate-400 font-normal">(Opsional)</span>
                </label>
                <div class="flex items-center gap-4 p-3.5 bg-slate-50/70 rounded-2xl border border-slate-200">
                    <div class="w-16 h-16 rounded-xl bg-white border-2 border-slate-200 flex items-center justify-center overflow-hidden shrink-0 shadow-xs">
                        <img id="dosenPreview" src="https://ui-avatars.com/api/?name=Dosen+Baru&background=0b1329&color=f59e0b&bold=true&size=128" alt="Preview" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-1 flex-1">
                        <input type="file" name="foto" id="fotoDosenInput" accept="image/png,image/jpeg,image/webp,image/jpg"
                               onchange="previewImage(this, 'dosenPreview')"
                               class="block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                        <p class="text-[11px] text-slate-400">Format: JPG, PNG, WEBP. Maksimal ukuran 3MB.</p>
                    </div>
                </div>
            </div>

            <!-- NIP -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">
                    Nomor Induk Pegawai (NIP / NIDN) <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-hashtag"></i>
                    </span>
                    <input type="text" name="nip" value="{{ old('nip') }}" required 
                           placeholder="Contoh: 19870001" 
                           class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 font-mono transition-all">
                </div>
                <span class="text-[11px] text-slate-400 mt-1 block">NIP harus bersifat unik sebagai pengenal resmi dosen.</span>
            </div>

            <!-- Nama Dosen -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">
                    Nama Lengkap Beserta Gelar Akademik <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-user-tie"></i>
                    </span>
                    <input type="text" name="nama_dosen" value="{{ old('nama_dosen') }}" required 
                           placeholder="Contoh: Dr. Budi Santoso, M.Kom." 
                           class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                </div>
            </div>

            <!-- Program Studi -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">
                    Homebase Program Studi <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-building-columns"></i>
                    </span>
                    <select name="prodi_id" required 
                            class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all font-medium">
                        <option value="">-- Pilih Program Studi --</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }} ({{ $prodi->kode_prodi }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('dosen.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md shadow-emerald-600/30 transition-all hover:scale-[1.02] flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Data Dosen
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
