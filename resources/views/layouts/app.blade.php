<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SIAKAD') - Universitas Nusantara Cendekia</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN with configuration -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        univ: {
                            50: '#f0f7ff',
                            100: '#e0effe',
                            200: '#bae0fd',
                            300: '#7cc7fb',
                            400: '#36abf7',
                            500: '#0c8fe9',
                            600: '#0171c7',
                            700: '#025aa2',
                            800: '#064c85',
                            900: '#0b406e',
                            950: '#072849',
                        },
                        navy: {
                            800: '#111b33',
                            900: '#0b1329',
                            950: '#060a17',
                        },
                        gold: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Glassmorphism subtle */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        @media print {
            .no-print {
                display: none !important;
            }
            .print-only {
                display: block !important;
            }
            body {
                background: white !important;
                color: black !important;
            }
            .shadow-sm, .shadow, .shadow-md, .shadow-lg, .shadow-xl {
                box-shadow: none !important;
            }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col antialiased selection:bg-univ-500 selection:text-white">

    <!-- Top Announcement / Institutional Bar -->
    <header class="no-print bg-navy-950 text-slate-300 text-xs py-2 border-b border-navy-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-between items-center gap-2">
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center gap-1.5 text-gold-400 font-semibold">
                    <i class="fa-solid fa-award"></i> Akreditasi Unggul (A) BAN-PT
                </span>
                <span class="hidden sm:inline text-slate-500">•</span>
                <span class="hidden sm:inline text-slate-400">
                    <i class="fa-regular fa-calendar-check mr-1 text-univ-400"></i> Tahun Akademik 2026/2027 Ganjil
                </span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-slate-400">
                    <i class="fa-solid fa-server mr-1 text-emerald-400"></i> Server Status: <span class="text-emerald-400 font-medium">Optimal</span>
                </span>
                <span class="text-slate-500">•</span>
                <span class="text-slate-400" id="current-clock">
                    <i class="fa-regular fa-clock mr-1 text-slate-400"></i> WIB
                </span>
            </div>
        </div>
    </header>

    <!-- Main Navigation Bar -->
    <nav class="no-print sticky top-0 z-40 bg-navy-900 border-b border-navy-800 shadow-lg text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- University Brand & Logo -->
                <div class="flex items-center gap-3.5">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 group">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-univ-500 via-univ-600 to-indigo-700 flex items-center justify-center text-white shadow-md shadow-univ-500/20 group-hover:scale-105 transition-transform duration-200 border border-univ-400/30">
                            <i class="fa-solid fa-graduation-cap text-2xl text-gold-400"></i>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-widest text-gold-400 font-bold block">Portal Akademik Terpadu</span>
                            <span class="text-lg font-extrabold tracking-tight text-white block group-hover:text-univ-300 transition-colors">
                                UNIVERSITAS NUSANTARA
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-1.5 lg:gap-2">
                    <a href="{{ route('dashboard') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center gap-2 {{ request()->routeIs('dashboard') ? 'bg-univ-600 text-white shadow-md shadow-univ-600/30' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                        <i class="fa-solid fa-chart-pie text-xs {{ request()->routeIs('dashboard') ? 'text-gold-400' : 'text-slate-400' }}"></i>
                        Beranda
                    </a>

                    <a href="{{ route('mahasiswa.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center gap-2 {{ request()->routeIs('mahasiswa.*') ? 'bg-univ-600 text-white shadow-md shadow-univ-600/30' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                        <i class="fa-solid fa-user-graduate text-xs {{ request()->routeIs('mahasiswa.*') ? 'text-gold-400' : 'text-slate-400' }}"></i>
                        Mahasiswa
                    </a>

                    <a href="{{ route('dosen.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center gap-2 {{ request()->routeIs('dosen.*') ? 'bg-univ-600 text-white shadow-md shadow-univ-600/30' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                        <i class="fa-solid fa-chalkboard-user text-xs {{ request()->routeIs('dosen.*') ? 'text-gold-400' : 'text-slate-400' }}"></i>
                        Dosen
                    </a>

                    <a href="{{ route('prodi.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center gap-2 {{ request()->routeIs('prodi.*') ? 'bg-univ-600 text-white shadow-md shadow-univ-600/30' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                        <i class="fa-solid fa-building-columns text-xs {{ request()->routeIs('prodi.*') ? 'text-gold-400' : 'text-slate-400' }}"></i>
                        Program Studi
                    </a>

                    <a href="{{ route('mata-kuliah.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-all duration-150 flex items-center gap-2 {{ request()->routeIs('mata-kuliah.*') ? 'bg-univ-600 text-white shadow-md shadow-univ-600/30' : 'text-slate-300 hover:text-white hover:bg-navy-800' }}">
                        <i class="fa-solid fa-book-bookmark text-xs {{ request()->routeIs('mata-kuliah.*') ? 'text-gold-400' : 'text-slate-400' }}"></i>
                        Mata Kuliah
                    </a>
                </div>

                <!-- Right Profile / Quick Action -->
                <div class="flex items-center gap-3">
                    <div class="hidden lg:flex items-center gap-3 pl-3 border-l border-navy-800">
                        <div class="text-right">
                            <span class="text-xs font-semibold text-white block">BAAK Pusat</span>
                            <span class="text-[11px] text-emerald-400 block font-medium flex items-center justify-end gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Sesi Aktif
                            </span>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-500 to-gold-400 flex items-center justify-center font-bold text-navy-950 text-sm shadow-md ring-2 ring-white/10">
                            AK
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" type="button" class="md:hidden text-slate-300 hover:text-white p-2 rounded-lg hover:bg-navy-800 focus:outline-none">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Container -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-navy-800 bg-navy-950 px-4 pt-3 pb-4 space-y-1.5">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-univ-600 text-white' : 'text-slate-300 hover:bg-navy-800' }}">
                <i class="fa-solid fa-chart-pie mr-2 text-gold-400"></i> Beranda
            </a>
            <a href="{{ route('mahasiswa.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('mahasiswa.*') ? 'bg-univ-600 text-white' : 'text-slate-300 hover:bg-navy-800' }}">
                <i class="fa-solid fa-user-graduate mr-2 text-gold-400"></i> Mahasiswa
            </a>
            <a href="{{ route('dosen.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dosen.*') ? 'bg-univ-600 text-white' : 'text-slate-300 hover:bg-navy-800' }}">
                <i class="fa-solid fa-chalkboard-user mr-2 text-gold-400"></i> Dosen
            </a>
            <a href="{{ route('prodi.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('prodi.*') ? 'bg-univ-600 text-white' : 'text-slate-300 hover:bg-navy-800' }}">
                <i class="fa-solid fa-building-columns mr-2 text-gold-400"></i> Program Studi
            </a>
            <a href="{{ route('mata-kuliah.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('mata-kuliah.*') ? 'bg-univ-600 text-white' : 'text-slate-300 hover:bg-navy-800' }}">
                <i class="fa-solid fa-book-bookmark mr-2 text-gold-400"></i> Mata Kuliah
            </a>
        </div>
    </nav>

    <!-- Subheader Breadcrumb & University Quick Bar -->
    <div class="no-print bg-white border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex flex-wrap items-center justify-between gap-3 text-xs">
            <div class="flex items-center gap-2 text-slate-500">
                <a href="{{ route('dashboard') }}" class="hover:text-univ-600 transition-colors">
                    <i class="fa-solid fa-house"></i>
                </a>
                <i class="fa-solid fa-chevron-right text-[10px] text-slate-300"></i>
                <span class="font-medium text-slate-700">@yield('title', 'SIAKAD')</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                    <i class="fa-solid fa-shield-halved mr-1 text-blue-600"></i> Sistem Terverifikasi
                </span>
                <span class="hidden sm:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <i class="fa-solid fa-database mr-1 text-emerald-600"></i> Basis Data Terhubung
                </span>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Flash Success Notification -->
        @if(session('success'))
            <div id="flash-alert" class="no-print mb-6 rounded-xl bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 p-4 shadow-sm flex items-start justify-between gap-3 transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-circle-check text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-emerald-900">Operasi Berhasil</h4>
                        <p class="text-xs text-emerald-700 mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" onclick="document.getElementById('flash-alert').style.display='none'" class="text-emerald-500 hover:text-emerald-800 p-1">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        <!-- Validation Errors Notification -->
        @if ($errors->any())
            <div class="no-print mb-6 rounded-xl bg-gradient-to-r from-rose-50 to-red-50 border-l-4 border-rose-500 p-4 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-circle-exclamation text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-rose-900">Terdapat Kesalahan Input Data:</h4>
                        <ul class="mt-1 list-disc list-inside text-xs text-rose-700 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- University Institutional Footer -->
    <footer class="no-print bg-navy-950 text-slate-400 text-xs border-t border-navy-900 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 pb-8 border-b border-navy-800/60">
                <!-- Col 1: University Identity -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 rounded-lg bg-univ-600 flex items-center justify-center text-white text-base">
                            <i class="fa-solid fa-graduation-cap text-gold-400"></i>
                        </div>
                        <span class="font-extrabold text-sm text-white tracking-tight">UNIVERSITAS NUSANTARA CENDEKIA</span>
                    </div>
                    <p class="text-slate-400 leading-relaxed text-xs pr-4">
                        Pusat Pendidikan Tinggi Unggul, Berkarakter, dan Berdaya Saing Global. Mengintegrasikan teknologi informasi akademik modern untuk kemudahan civitas academica dalam perkuliahan dan administrasi.
                    </p>
                    <div class="mt-3 flex items-center gap-4 text-slate-400">
                        <span><i class="fa-solid fa-location-dot text-univ-400 mr-1.5"></i> Kampus Utama: Jl. Terusan Cimanuk No. 100</span>
                    </div>
                </div>

                <!-- Col 2: Layanan Akademik -->
                <div>
                    <h5 class="text-slate-200 font-bold mb-3 tracking-wider uppercase text-[11px]">Layanan Akademik</h5>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="{{ route('mahasiswa.index') }}" class="hover:text-univ-400 transition-colors">Direktori Mahasiswa</a></li>
                        <li><a href="{{ route('dosen.index') }}" class="hover:text-univ-400 transition-colors">Tenaga Pendidik / Dosen</a></li>
                        <li><a href="{{ route('prodi.index') }}" class="hover:text-univ-400 transition-colors">Fakultas & Program Studi</a></li>
                        <li><a href="{{ route('mata-kuliah.index') }}" class="hover:text-univ-400 transition-colors">Katalog Mata Kuliah & KRS</a></li>
                    </ul>
                </div>

                <!-- Col 3: Informasi Kontak -->
                <div>
                    <h5 class="text-slate-200 font-bold mb-3 tracking-wider uppercase text-[11px]">Bantuan & Layanan</h5>
                    <ul class="space-y-2 text-slate-400">
                        <li><i class="fa-solid fa-headset mr-2 text-univ-400"></i> Biro Akademik & Kemahasiswaan</li>
                        <li><i class="fa-regular fa-envelope mr-2 text-univ-400"></i> akademik@univ-nusantara.ac.id</li>
                        <li><i class="fa-solid fa-phone mr-2 text-univ-400"></i> (0262) 231-890</li>
                        <li><i class="fa-solid fa-clock mr-2 text-univ-400"></i> Senin - Jumat (08.00 - 16.00 WIB)</li>
                    </ul>
                </div>
            </div>

            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-slate-500 text-[11px]">
                <div>
                    &copy; {{ date('Y') }} Universitas Nusantara Cendekia. Hak Cipta Dilindungi Undang-Undang.
                </div>
                <div class="flex items-center gap-4">
                    <span>SIAKAD v3.5 Enterprise</span>
                    <span>•</span>
                    <span>Framework Laravel 13</span>
                    <span>•</span>
                    <span class="text-emerald-400"><i class="fa-solid fa-shield mr-1"></i> SSL 256-bit Encrypted</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Real-time clock update
        function updateClock() {
            const clockEl = document.getElementById('current-clock');
            if (clockEl) {
                const now = new Date();
                const timeString = now.toLocaleTimeString('id-ID', { hour12: false });
                clockEl.innerHTML = `<i class="fa-regular fa-clock mr-1 text-slate-400"></i> ${timeString} WIB`;
            }
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Mobile menu toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        // Image file preview helper
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (preview && input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
