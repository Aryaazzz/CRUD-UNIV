@extends('layouts.app')

@section('title', 'Direktori Dosen & Tenaga Pengajar')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-emerald-600 mb-1">
                <i class="fa-solid fa-chalkboard-user"></i> Tenaga Pendidik & Pengajar
            </div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Direktori Dosen Pengampu</h1>
            <p class="text-xs text-slate-500 mt-1">
                Pangkalan data tenaga pengajar, pembimbing akademik, serta penugasan di program studi.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('dosen.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md shadow-emerald-600/30 transition-all hover:scale-[1.02]">
                <i class="fa-solid fa-user-plus text-sm"></i> Tambah Dosen Baru
            </a>
        </div>
    </div>

    <!-- Search & Filter Controls -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-3">
        <!-- Search Input -->
        <div class="relative flex-1 max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <i class="fa-solid fa-magnifying-glass text-xs"></i>
            </div>
            <input type="text" id="dosenSearchInput" placeholder="Cari nama dosen atau NIP..." 
                   class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
        </div>

        <!-- Filter & View Switcher -->
        <div class="flex items-center flex-wrap gap-2 text-xs">
            <select id="dosenProdiFilter" class="px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                <option value="ALL">Semua Program Studi</option>
                @php
                    $uniqueDosenProdis = $dosens->pluck('prodi.nama_prodi')->filter()->unique();
                @endphp
                @foreach($uniqueDosenProdis as $prodName)
                    <option value="{{ strtolower($prodName) }}">{{ $prodName }}</option>
                @endforeach
            </select>

            <!-- View Switcher -->
            <div class="flex items-center p-1 bg-slate-100 rounded-xl border border-slate-200">
                <button type="button" id="dosenTableViewBtn" class="px-3 py-1 rounded-lg text-xs font-bold transition-all bg-white text-emerald-800 shadow-xs">
                    <i class="fa-solid fa-table-list mr-1"></i> Tabel
                </button>
                <button type="button" id="dosenCardViewBtn" class="px-3 py-1 rounded-lg text-xs font-bold transition-all text-slate-500 hover:text-slate-800">
                    <i class="fa-solid fa-address-card mr-1"></i> Kartu Dosen
                </button>
            </div>
        </div>
    </div>

    <!-- VIEW 1: DATA TABLE -->
    <div id="dosenTableContainer" class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs" id="dosenTable">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider text-[11px] border-b border-slate-200">
                        <th class="px-4 py-3.5 w-12 text-center">No</th>
                        <th class="px-4 py-3.5">Nama Dosen & Gelar</th>
                        <th class="px-4 py-3.5">NIP</th>
                        <th class="px-4 py-3.5">Homebase Program Studi</th>
                        <th class="px-4 py-3.5 text-center">Status</th>
                        <th class="px-4 py-3.5 text-right w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse ($dosens as $index => $dosen)
                        <tr class="hover:bg-slate-50/70 transition-colors dosen-row" 
                            data-name="{{ strtolower($dosen->nama_dosen) }}" 
                            data-nip="{{ strtolower($dosen->nip) }}"
                            data-prodi="{{ strtolower($dosen->prodi?->nama_prodi ?? '') }}">
                            
                            <td class="px-4 py-3.5 text-center text-slate-400 font-mono">
                                {{ $index + 1 }}
                            </td>
                            
                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $dosen->foto_url }}" alt="{{ $dosen->nama_dosen }}" 
                                         class="w-9 h-9 rounded-xl object-cover border border-slate-200 shrink-0 shadow-xs">
                                    <div>
                                        <a href="{{ route('dosen.show', $dosen->id) }}" class="font-bold text-slate-800 hover:text-emerald-600 transition-colors block text-xs">
                                            {{ $dosen->nama_dosen }}
                                        </a>
                                        <span class="text-[11px] text-slate-400">Tenaga Pendidik Tetap</span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3.5 font-mono text-slate-600">
                                <span class="px-2 py-0.5 rounded bg-slate-100 border border-slate-200 text-[11px]">
                                    {{ $dosen->nip }}
                                </span>
                            </td>

                            <td class="px-4 py-3.5">
                                @if($dosen->prodi)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <i class="fa-solid fa-building-columns text-[10px] text-emerald-500"></i>
                                        {{ $dosen->prodi->nama_prodi }}
                                    </span>
                                @else
                                    <span class="text-slate-400 italic text-[11px]">Belum terafiliasi</span>
                                @endif
                            </td>

                            <td class="px-4 py-3.5 text-center">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif Mengajar
                                </span>
                            </td>

                            <td class="px-4 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('dosen.show', $dosen->id) }}" 
                                       title="Lihat Profil Dosen"
                                       class="p-1.5 rounded-lg text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition-colors">
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </a>
                                    
                                    <a href="{{ route('dosen.edit', $dosen->id) }}" 
                                       title="Edit Data Dosen"
                                       class="p-1.5 rounded-lg text-slate-500 hover:text-amber-600 hover:bg-amber-50 transition-colors">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>

                                    <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dosen {{ $dosen->nama_dosen }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                title="Hapus Dosen"
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
                                    <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mb-3 shadow-xs">
                                        <i class="fa-solid fa-chalkboard-user"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-800">Belum Ada Data Dosen</h4>
                                    <p class="text-xs text-slate-400 mt-1">Daftarkan tenaga pengajar baru untuk pengampu mata kuliah dan pembimbing akademik.</p>
                                    <a href="{{ route('dosen.create') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 text-white text-xs font-bold hover:bg-emerald-700 transition-colors">
                                        <i class="fa-solid fa-plus"></i> Tambah Dosen
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-4 py-3 bg-slate-50 border-t border-slate-200 text-xs text-slate-500 flex items-center justify-between">
            <span>Menampilkan <strong class="text-slate-700" id="dosenVisibleCount">{{ count($dosens) }}</strong> dosen</span>
            <span class="text-[11px] text-slate-400">Pangkalan Data Dosen Terintegrasi</span>
        </div>
    </div>

    <!-- VIEW 2: FACULTY CARD GRID -->
    <div id="dosenCardContainer" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($dosens as $dosen)
            <div class="dosen-card glass-card rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition-all relative overflow-hidden flex flex-col justify-between"
                 data-name="{{ strtolower($dosen->nama_dosen) }}" 
                 data-nip="{{ strtolower($dosen->nip) }}"
                 data-prodi="{{ strtolower($dosen->prodi?->nama_prodi ?? '') }}">
                
                <div>
                    <div class="flex items-start justify-between gap-3 pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <img src="{{ $dosen->foto_url }}" alt="{{ $dosen->nama_dosen }}" 
                                 class="w-12 h-12 rounded-xl object-cover border border-slate-200 shrink-0 shadow-sm">
                            <div>
                                <h3 class="font-bold text-slate-800 text-sm leading-tight hover:text-emerald-600">
                                    <a href="{{ route('dosen.show', $dosen->id) }}">{{ $dosen->nama_dosen }}</a>
                                </h3>
                                <span class="font-mono text-xs font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded mt-1 inline-block">
                                    NIP: {{ $dosen->nip }}
                                </span>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                            Aktif
                        </span>
                    </div>

                    <div class="mt-4 text-xs space-y-2">
                        <div>
                            <span class="text-slate-400 text-[11px] block">Program Studi Pengampu</span>
                            <span class="font-bold text-slate-800 block mt-0.5">
                                {{ $dosen->prodi?->nama_prodi ?? 'Pusat / Lintas Prodi' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 text-[11px] block">Status Fungsional</span>
                            <span class="text-slate-600 font-medium text-[11px] block">
                                Dosen Pembimbing Akademik
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                    <a href="{{ route('dosen.show', $dosen->id) }}" class="font-bold text-emerald-600 hover:text-emerald-800 flex items-center gap-1">
                        <i class="fa-solid fa-address-card"></i> Lihat Profil Dosen
                    </a>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('dosen.edit', $dosen->id) }}" class="text-slate-400 hover:text-amber-600 p-1" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" 
                              onsubmit="return confirm('Hapus data dosen {{ $dosen->nama_dosen }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-400 hover:text-rose-600 p-1" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    const dosenSearchInput = document.getElementById('dosenSearchInput');
    const dosenProdiFilter = document.getElementById('dosenProdiFilter');
    const dosenRows = document.querySelectorAll('.dosen-row');
    const dosenCards = document.querySelectorAll('.dosen-card');
    const dosenVisibleCount = document.getElementById('dosenVisibleCount');

    function applyDosenFilter() {
        const query = dosenSearchInput.value.toLowerCase().trim();
        const selectedProdi = dosenProdiFilter.value.toLowerCase();
        let matchCount = 0;

        dosenRows.forEach(row => {
            const name = row.getAttribute('data-name');
            const nip = row.getAttribute('data-nip');
            const prodi = row.getAttribute('data-prodi');

            const matchesQuery = name.includes(query) || nip.includes(query);
            const matchesProdi = selectedProdi === 'all' || prodi.includes(selectedProdi);

            if (matchesQuery && matchesProdi) {
                row.style.display = '';
                matchCount++;
            } else {
                row.style.display = 'none';
            }
        });

        dosenCards.forEach(card => {
            const name = card.getAttribute('data-name');
            const nip = card.getAttribute('data-nip');
            const prodi = card.getAttribute('data-prodi');

            const matchesQuery = name.includes(query) || nip.includes(query);
            const matchesProdi = selectedProdi === 'all' || prodi.includes(selectedProdi);

            if (matchesQuery && matchesProdi) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });

        if (dosenVisibleCount) {
            dosenVisibleCount.innerText = matchCount;
        }
    }

    dosenSearchInput.addEventListener('input', applyDosenFilter);
    dosenProdiFilter.addEventListener('change', applyDosenFilter);

    // Switch view
    const dtBtn = document.getElementById('dosenTableViewBtn');
    const dcBtn = document.getElementById('dosenCardViewBtn');
    const dtContainer = document.getElementById('dosenTableContainer');
    const dcContainer = document.getElementById('dosenCardContainer');

    dtBtn.addEventListener('click', () => {
        dtContainer.classList.remove('hidden');
        dcContainer.classList.add('hidden');
        dtBtn.classList.add('bg-white', 'text-emerald-800', 'shadow-xs');
        dtBtn.classList.remove('text-slate-500');
        dcBtn.classList.remove('bg-white', 'text-emerald-800', 'shadow-xs');
        dcBtn.classList.add('text-slate-500');
    });

    dcBtn.addEventListener('click', () => {
        dtContainer.classList.add('hidden');
        dcContainer.classList.remove('hidden');
        dcBtn.classList.add('bg-white', 'text-emerald-800', 'shadow-xs');
        dcBtn.classList.remove('text-slate-500');
        dtBtn.classList.remove('bg-white', 'text-emerald-800', 'shadow-xs');
        dtBtn.classList.add('text-slate-500');
    });
</script>
@endpush
