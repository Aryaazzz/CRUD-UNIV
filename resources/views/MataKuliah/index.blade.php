@extends('layouts.app')

@section('title', 'Katalog Mata Kuliah & Kurikulum')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-indigo-600 mb-1">
                <i class="fa-solid fa-book-bookmark"></i> Kurikulum & Silabus Perkuliahan
            </div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Katalog Mata Kuliah</h1>
            <p class="text-xs text-slate-500 mt-1">
                Daftar mata kuliah aktif, beban Satuan Kredit Semester (SKS), dan pemantauan jumlah mahasiswa pengambil.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('mata-kuliah.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-600/30 transition-all hover:scale-[1.02]">
                <i class="fa-solid fa-book-medical text-sm"></i> Tambah Mata Kuliah
            </a>
        </div>
    </div>

    <!-- Search & Quick Stats -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="relative flex-1 max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i class="fa-solid fa-magnifying-glass text-xs"></i>
            </div>
            <input type="text" id="mkSearchInput" placeholder="Cari nama mata kuliah atau kode matkul..." 
                   class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
        </div>

        <div class="flex items-center gap-3 text-xs">
            <span class="px-3 py-1.5 rounded-xl bg-indigo-50 text-indigo-700 font-bold border border-indigo-200/60">
                <i class="fa-solid fa-layer-group mr-1"></i> Total: {{ $mataKuliahs->sum('sks') }} SKS
            </span>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs" id="mkTable">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider text-[11px] border-b border-slate-200">
                        <th class="px-4 py-3.5 w-12 text-center">No</th>
                        <th class="px-4 py-3.5 w-32">Kode Matkul</th>
                        <th class="px-4 py-3.5">Nama Mata Kuliah</th>
                        <th class="px-4 py-3.5 text-center w-28">Bobot SKS</th>
                        <th class="px-4 py-3.5 text-center w-36">Peserta Kelas</th>
                        <th class="px-4 py-3.5 text-right w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse ($mataKuliahs as $index => $mk)
                        <tr class="hover:bg-slate-50/70 transition-colors mk-row" 
                            data-name="{{ strtolower($mk->nama_matkul) }}" 
                            data-code="{{ strtolower($mk->kode_matkul) }}">
                            
                            <td class="px-4 py-3.5 text-center text-slate-400 font-mono">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-4 py-3.5 font-mono">
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold bg-navy-900 text-white tracking-wider">
                                    {{ $mk->kode_matkul }}
                                </span>
                            </td>

                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-3">
                                    @if($mk->foto_url)
                                        <img src="{{ $mk->foto_url }}" alt="{{ $mk->nama_matkul }}" class="w-10 h-10 rounded-xl object-cover border border-slate-200 shrink-0 shadow-2xs">
                                    @else
                                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xs shrink-0 border border-indigo-100">
                                            <i class="fa-solid fa-book-open"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <a href="{{ route('mata-kuliah.show', $mk->id) }}" class="font-bold text-slate-800 hover:text-indigo-600 transition-colors text-xs block">
                                            {{ $mk->nama_matkul }}
                                        </a>
                                        <span class="text-[11px] text-slate-400">Semester Reguler • Wajib / Pilihan</span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3.5 text-center">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                    <i class="fa-solid fa-book-open text-[10px] text-indigo-500"></i>
                                    {{ $mk->sks }} SKS
                                </span>
                            </td>

                            <td class="px-4 py-3.5 text-center">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                    <i class="fa-solid fa-users text-[10px] text-blue-500"></i>
                                    {{ $mk->mahasiswas->count() }} Mahasiswa
                                </span>
                            </td>

                            <td class="px-4 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('mata-kuliah.show', $mk->id) }}" 
                                       title="Lihat Detail Peserta"
                                       class="p-1.5 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </a>
                                    
                                    <a href="{{ route('mata-kuliah.edit', $mk->id) }}" 
                                       title="Edit Mata Kuliah"
                                       class="p-1.5 rounded-lg text-slate-500 hover:text-amber-600 hover:bg-amber-50 transition-colors">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>

                                    <form action="{{ route('mata-kuliah.destroy', $mk->id) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah {{ $mk->nama_matkul }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                title="Hapus Mata Kuliah"
                                                class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                            <i class="fa-solid fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <div class="max-w-sm mx-auto">
                                    <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl mb-3 shadow-xs">
                                        <i class="fa-solid fa-book-bookmark"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-800">Belum Ada Mata Kuliah</h4>
                                    <p class="text-xs text-slate-400 mt-1">Daftarkan mata kuliah baru untuk dapat dipilih dalam formulir KRS mahasiswa.</p>
                                    <a href="{{ route('mata-kuliah.create') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 text-white text-xs font-bold hover:bg-indigo-700 transition-colors">
                                        <i class="fa-solid fa-plus"></i> Tambah Mata Kuliah
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-4 py-3 bg-slate-50 border-t border-slate-200 text-xs text-slate-500 flex items-center justify-between">
            <span>Menampilkan <strong class="text-slate-700" id="mkVisibleCount">{{ count($mataKuliahs) }}</strong> mata kuliah</span>
            <span class="text-[11px] text-slate-400">Kurikulum Standar Nasional Dikti</span>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const mkSearchInput = document.getElementById('mkSearchInput');
    const mkRows = document.querySelectorAll('.mk-row');
    const mkVisibleCount = document.getElementById('mkVisibleCount');

    mkSearchInput.addEventListener('input', () => {
        const query = mkSearchInput.value.toLowerCase().trim();
        let matchCount = 0;

        mkRows.forEach(row => {
            const name = row.getAttribute('data-name');
            const code = row.getAttribute('data-code');

            if (name.includes(query) || code.includes(query)) {
                row.style.display = '';
                matchCount++;
            } else {
                row.style.display = 'none';
            }
        });

        if (mkVisibleCount) {
            mkVisibleCount.innerText = matchCount;
        }
    });
</script>
@endpush
