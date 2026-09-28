@extends('layouts.app')

@section('title', 'Perbarui Data Dosen - ' . $dosen->nama_dosen)

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-amber-600 mb-1">
                <i class="fa-solid fa-user-pen"></i> Pemutakhiran Tenaga Pengajar
            </div>
            <h1 class="text-xl font-extrabold text-slate-800 tracking-tight">Edit Data Dosen</h1>
            <p class="text-xs text-slate-500 mt-1">Perbarui nomor induk, gelar akademik, atau mutasi program studi.</p>
        </div>
        <a href="{{ route('dosen.index') }}" class="text-xs font-bold text-slate-600 hover:text-emerald-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition-colors">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <!-- Edit Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8">
        <form action="{{ route('dosen.update', $dosen->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Upload & Ganti Foto Profil Dosen -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">
                    Foto Profil Dosen <span class="text-xs text-slate-400 font-normal">(Opsional)</span>
                </label>
                <div class="flex items-center gap-4 p-3.5 bg-slate-50/70 rounded-2xl border border-slate-200">
                    <div class="w-16 h-16 rounded-xl bg-white border-2 border-slate-200 flex items-center justify-center overflow-hidden shrink-0 shadow-xs">
                        <img id="dosenEditPreview" src="{{ $dosen->foto_url }}" alt="{{ $dosen->nama_dosen }}" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-1 flex-1">
                        <input type="file" name="foto" id="fotoDosenInput" accept="image/png,image/jpeg,image/webp,image/jpg"
                               onchange="previewImage(this, 'dosenEditPreview')"
                               class="block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100 cursor-pointer">
                        <p class="text-[11px] text-slate-400">Pilih berkas baru jika ingin mengganti foto (JPG, PNG, WEBP, maks 3MB). Biarkan kosong jika tidak ingin mengubah.</p>
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
                    <input type="text" name="nip" value="{{ old('nip', $dosen->nip) }}" required 
                           class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 font-mono transition-all">
                </div>
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
                    <input type="text" name="nama_dosen" value="{{ old('nama_dosen', $dosen->nama_dosen) }}" required 
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
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id }}" {{ old('prodi_id', $dosen->prodi_id) == $prodi->id ? 'selected' : '' }}>
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
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold shadow-md shadow-amber-500/30 transition-all hover:scale-[1.02] flex items-center gap-2">
                    <i class="fa-solid fa-check"></i> Perbarui Data Dosen
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
