@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah Baru')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-indigo-600 mb-1">
                <i class="fa-solid fa-book-medical"></i> Kurikulum & Silabus
            </div>
            <h1 class="text-xl font-extrabold text-slate-800 tracking-tight">Tambah Mata Kuliah</h1>
            <p class="text-xs text-slate-500 mt-1">Daftarkan mata kuliah baru beserta beban SKS ke dalam katalog kurikulum.</p>
        </div>
        <a href="{{ route('mata-kuliah.index') }}" class="text-xs font-bold text-slate-600 hover:text-indigo-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition-colors">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
        <form action="{{ route('mata-kuliah.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Upload Cover / Foto Modul Matkul -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">
                    Cover / Banner Mata Kuliah <span class="text-xs text-slate-400 font-normal">(Opsional)</span>
                </label>
                <div class="flex items-center gap-4 p-3.5 bg-slate-50/70 rounded-2xl border border-slate-200">
                    <div class="w-16 h-16 rounded-xl bg-white border-2 border-slate-200 flex items-center justify-center overflow-hidden shrink-0 shadow-xs">
                        <img id="matkulPreview" src="https://ui-avatars.com/api/?name=Mata+Kuliah&background=4f46e5&color=ffffff&bold=true&size=128" alt="Preview" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-1 flex-1">
                        <input type="file" name="foto" id="fotoMatkulInput" accept="image/png,image/jpeg,image/webp,image/jpg"
                               onchange="previewImage(this, 'matkulPreview')"
                               class="block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                        <p class="text-[11px] text-slate-400">Format: JPG, PNG, WEBP. Maksimal ukuran 3MB.</p>
                    </div>
                </div>
            </div>

            <!-- Kode Matkul -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">
                    Kode Mata Kuliah <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-barcode"></i>
                    </span>
                    <input type="text" name="kode_matkul" value="{{ old('kode_matkul') }}" required 
                           placeholder="Contoh: MK001, CS101, TIF204" 
                           class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 uppercase font-mono font-bold transition-all">
                </div>
                <span class="text-[11px] text-slate-400 mt-1 block">Kode unik penanda kurikulum mata kuliah.</span>
            </div>

            <!-- Nama Matkul -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">
                    Nama Mata Kuliah <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-book"></i>
                    </span>
                    <input type="text" name="nama_matkul" value="{{ old('nama_matkul') }}" required 
                           placeholder="Contoh: Pemrograman Web & Piranti Bergerak" 
                           class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>
            </div>

            <!-- SKS -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">
                    Bobot SKS (Satuan Kredit Semester) <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-layer-group"></i>
                    </span>
                    <input type="number" name="sks" value="{{ old('sks', 3) }}" min="1" max="6" required 
                           class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-bold transition-all">
                </div>
                <span class="text-[11px] text-slate-400 mt-1 block">Rentang bobot 1 sampai 6 SKS.</span>
            </div>

            <!-- Form Actions -->
            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('mata-kuliah.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-600/30 transition-all hover:scale-[1.02] flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Mata Kuliah
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
