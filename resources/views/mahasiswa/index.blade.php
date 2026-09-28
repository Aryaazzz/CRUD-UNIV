@extends('layouts.app')

@section('title', 'Direktori Mahasiswa')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-univ-600 mb-1">
                <i class="fa-solid fa-user-graduate"></i> Biro Administrasi Akademik & Kemahasiswaan
            </div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Direktori Mahasiswa</h1>
            <p class="text-xs text-slate-500 mt-1">
                Kelola data induk mahasiswa, program studi, serta pemetaan Kartu Rencana Studi (KRS).
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('mahasiswa.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-univ-600 hover:bg-univ-700 text-white text-xs font-bold shadow-md shadow-univ-600/30 transition-all hover:scale-[1.02]">
                <i class="fa-solid fa-user-plus text-sm"></i> Tambah Mahasiswa Baru
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
            <input type="text" id="searchInput" placeholder="Cari nama mahasiswa atau NIM..." 
                   class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-univ-500/20 focus:border-univ-500 transition-all">
        </div>

        <!-- Filter & View Switcher -->
        <div class="flex items-center flex-wrap gap-2 text-xs">
            <select id="prodiFilter" class="px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-univ-500/20 focus:border-univ-500">
                <option value="ALL">Semua Program Studi</option>
                @php
                    $uniqueProdis = $mahasiswas->pluck('prodi.nama_prodi')->filter()->unique();
                @endphp
                @foreach($uniqueProdis as $prodName)
                    <option value="{{ strtolower($prodName) }}">{{ $prodName }}</option>
                @endforeach
            </select>

            <!-- View Switcher (Table vs Card) -->
            <div class="flex items-center p-1 bg-slate-100 rounded-xl border border-slate-200">
                <button type="button" id="tableViewBtn" class="px-3 py-1 rounded-lg text-xs font-bold transition-all bg-white text-univ-700 shadow-xs">
                    <i class="fa-solid fa-table-list mr-1"></i> Tabel
                </button>
                <button type="button" id="cardViewBtn" class="px-3 py-1 rounded-lg text-xs font-bold transition-all text-slate-500 hover:text-slate-800">
                    <i class="fa-solid fa-id-card mr-1"></i> Kartu (KTM)
                </button>
            </div>
        </div>
    </div>

    <!-- VIEW 1: DATA TABLE -->
    <div id="tableViewContainer" class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-xs" id="mhsTable">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider text-[11px] border-b border-slate-200">
                        <th class="px-4 py-3.5 w-12 text-center">No</th>
                        <th class="px-4 py-3.5">Mahasiswa</th>
                        <th class="px-4 py-3.5">NIM</th>
                        <th class="px-4 py-3.5">Program Studi</th>
                        <th class="px-4 py-3.5">Mata Kuliah (KRS)</th>
                        <th class="px-4 py-3.5 text-center">Status</th>
                        <th class="px-4 py-3.5 text-right w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse ($mahasiswas as $index => $mahasiswa)
                        <tr class="hover:bg-slate-50/70 transition-colors mhs-row" 
                            data-name="{{ strtolower($mahasiswa->nama) }}" 
                            data-nim="{{ strtolower($mahasiswa->nim) }}"
                            data-prodi="{{ strtolower($mahasiswa->prodi?->nama_prodi ?? '') }}">
                            
                            <td class="px-4 py-3.5 text-center text-slate-400 font-mono">
                                {{ $index + 1 }}
                            </td>
                            
                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $mahasiswa->foto_url }}" alt="{{ $mahasiswa->nama }}" 
                                         class="w-9 h-9 rounded-xl object-cover border border-slate-200 shrink-0 shadow-xs">
                                    <div>
                                        <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="font-bold text-slate-800 hover:text-univ-600 transition-colors block text-xs">
                                            {{ $mahasiswa->nama }}
                                        </a>
                                        <span class="text-[11px] text-slate-400">Angkatan {{ substr($mahasiswa->nim, 0, 4) ?: '2023' }}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3.5 font-mono text-slate-600">
                                <span class="px-2 py-0.5 rounded bg-slate-100 border border-slate-200 text-[11px]">
                                    {{ $mahasiswa->nim }}
                                </span>
                            </td>

                            <td class="px-4 py-3.5">
                                @if($mahasiswa->prodi)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                        <i class="fa-solid fa-graduation-cap text-[10px] text-blue-500"></i>
                                        {{ $mahasiswa->prodi->nama_prodi }}
                                    </span>
                                @else
                                    <span class="text-slate-400 italic text-[11px]">Belum ditentukan</span>
                                @endif
                            </td>

                            <td class="px-4 py-3.5">
                                @if($mahasiswa->mataKuliahs->isEmpty())
                                    <span class="text-slate-400 italic text-[11px]">Belum mengambil KRS</span>
                                @else
                                    <div class="flex flex-wrap gap-1 max-w-sm">
                                        @foreach($mahasiswa->mataKuliahs as $mk)
                                            <span class="inline-flex items-center gap-1 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-md px-2 py-0.5 text-[10px] font-semibold border border-slate-200 transition-colors">
                                                <span>{{ $mk->nama_matkul }}</span>
                                                <span class="text-univ-600 font-bold">({{ $mk->sks }} SKS)</span>
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>

                            <td class="px-4 py-3.5 text-center">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                </span>
                            </td>

                            <td class="px-4 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" 
                                       title="Lihat Profil & KRS"
                                       class="p-1.5 rounded-lg text-slate-500 hover:text-univ-600 hover:bg-blue-50 transition-colors">
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </a>
                                    
                                    <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" 
                                       title="Edit Data Mahasiswa"
                                       class="p-1.5 rounded-lg text-slate-500 hover:text-amber-600 hover:bg-amber-50 transition-colors">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>

                                    <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa {{ $mahasiswa->nama }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                title="Hapus Mahasiswa"
                                                class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                            <i class="fa-solid fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center">
                                <div class="max-w-sm mx-auto">
                                    <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 text-univ-600 flex items-center justify-center text-2xl mb-3 shadow-xs">
                                        <i class="fa-solid fa-user-graduate"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-800">Belum Ada Data Mahasiswa</h4>
                                    <p class="text-xs text-slate-400 mt-1">Daftarkan mahasiswa baru untuk memulai pemetaan akademik dan rencana studi.</p>
                                    <a href="{{ route('mahasiswa.create') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-univ-600 text-white text-xs font-bold hover:bg-univ-700 transition-colors">
                                        <i class="fa-solid fa-plus"></i> Tambah Mahasiswa
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer / Count -->
        <div class="px-4 py-3 bg-slate-50 border-t border-slate-200 text-xs text-slate-500 flex items-center justify-between">
            <span>Menampilkan <strong class="text-slate-700" id="visibleCount">{{ count($mahasiswas) }}</strong> mahasiswa</span>
            <span class="text-[11px] text-slate-400">Database SIAKAD Terverifikasi</span>
        </div>
    </div>

    <!-- VIEW 2: KARTU TANDA MAHASISWA (KTM) GRID -->
    <div id="cardViewContainer" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($mahasiswas as $mahasiswa)
            <div class="mhs-card glass-card rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition-all relative overflow-hidden flex flex-col justify-between"
                 data-name="{{ strtolower($mahasiswa->nama) }}" 
                 data-nim="{{ strtolower($mahasiswa->nim) }}"
                 data-prodi="{{ strtolower($mahasiswa->prodi?->nama_prodi ?? '') }}">
                
                <!-- Card Header: University Accent Banner -->
                <div>
                    <div class="flex items-start justify-between gap-3 pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <img src="{{ $mahasiswa->foto_url }}" alt="{{ $mahasiswa->nama }}" 
                                 class="w-12 h-12 rounded-xl object-cover border border-slate-200 shrink-0 shadow-sm">
                            <div>
                                <h3 class="font-bold text-slate-800 text-sm leading-tight hover:text-univ-600">
                                    <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}">{{ $mahasiswa->nama }}</a>
                                </h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="font-mono text-xs font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                                        {{ $mahasiswa->nim }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">
                            Aktif
                        </span>
                    </div>

                    <!-- Program Studi -->
                    <div class="mt-3.5 text-xs">
                        <span class="text-slate-400 text-[11px] block">Program Studi</span>
                        <span class="font-bold text-slate-800 block mt-0.5">
                            {{ $mahasiswa->prodi?->nama_prodi ?? 'Belum terdaftar di Prodi' }}
                        </span>
                    </div>

                    <!-- Enrolled Courses Preview -->
                    <div class="mt-3 text-xs">
                        <div class="flex items-center justify-between text-slate-400 text-[11px] mb-1.5">
                            <span>Mata Kuliah Terdaftar</span>
                            <span class="font-bold text-univ-700">{{ $mahasiswa->mataKuliahs->sum('sks') }} SKS</span>
                        </div>
                        <div class="flex flex-wrap gap-1">
                            @forelse($mahasiswa->mataKuliahs->take(3) as $mk)
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200/60">
                                    {{ $mk->nama_matkul }}
                                </span>
                            @empty
                                <span class="text-slate-400 text-[11px] italic">Belum mengambil KRS</span>
                            @endforelse
                            @if($mahasiswa->mataKuliahs->count() > 3)
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600">
                                    +{{ $mahasiswa->mataKuliahs->count() - 3 }} lainnya
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Card Actions Footer -->
                <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                    <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="font-bold text-univ-600 hover:text-univ-800 flex items-center gap-1">
                        <i class="fa-solid fa-id-card"></i> Lihat Profil Lengkap
                    </a>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="text-slate-400 hover:text-amber-600 p-1" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" 
                              onsubmit="return confirm('Hapus data mahasiswa {{ $mahasiswa->nama }}?')">
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
    // Live Search & Filter Functionality
    const searchInput = document.getElementById('searchInput');
    const prodiFilter = document.getElementById('prodiFilter');
    const mhsRows = document.querySelectorAll('.mhs-row');
    const mhsCards = document.querySelectorAll('.mhs-card');
    const visibleCount = document.getElementById('visibleCount');

    function applyFilter() {
        const query = searchInput.value.toLowerCase().trim();
        const selectedProdi = prodiFilter.value.toLowerCase();
        let matchCount = 0;

        // Filter Table rows
        mhsRows.forEach(row => {
            const name = row.getAttribute('data-name');
            const nim = row.getAttribute('data-nim');
            const prodi = row.getAttribute('data-prodi');

            const matchesQuery = name.includes(query) || nim.includes(query);
            const matchesProdi = selectedProdi === 'all' || prodi.includes(selectedProdi);

            if (matchesQuery && matchesProdi) {
                row.style.display = '';
                matchCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Filter Cards
        mhsCards.forEach(card => {
            const name = card.getAttribute('data-name');
            const nim = card.getAttribute('data-nim');
            const prodi = card.getAttribute('data-prodi');

            const matchesQuery = name.includes(query) || nim.includes(query);
            const matchesProdi = selectedProdi === 'all' || prodi.includes(selectedProdi);

            if (matchesQuery && matchesProdi) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });

        if (visibleCount) {
            visibleCount.innerText = matchCount;
        }
    }

    searchInput.addEventListener('input', applyFilter);
    prodiFilter.addEventListener('change', applyFilter);

    // View Switcher logic
    const tableViewBtn = document.getElementById('tableViewBtn');
    const cardViewBtn = document.getElementById('cardViewBtn');
    const tableViewContainer = document.getElementById('tableViewContainer');
    const cardViewContainer = document.getElementById('cardViewContainer');

    tableViewBtn.addEventListener('click', () => {
        tableViewContainer.classList.remove('hidden');
        cardViewContainer.classList.add('hidden');
        tableViewBtn.classList.add('bg-white', 'text-univ-700', 'shadow-xs');
        tableViewBtn.classList.remove('text-slate-500');
        cardViewBtn.classList.remove('bg-white', 'text-univ-700', 'shadow-xs');
        cardViewBtn.classList.add('text-slate-500');
    });

    cardViewBtn.addEventListener('click', () => {
        tableViewContainer.classList.add('hidden');
        cardViewContainer.classList.remove('hidden');
        cardViewBtn.classList.add('bg-white', 'text-univ-700', 'shadow-xs');
        cardViewBtn.classList.remove('text-slate-500');
        tableViewBtn.classList.remove('bg-white', 'text-univ-700', 'shadow-xs');
        tableViewBtn.classList.add('text-slate-500');
    });
</script>
@endpush
