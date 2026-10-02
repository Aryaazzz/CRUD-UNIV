<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Autentikasi - Universitas Nusantara Cendekia</title>

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
    </style>
</head>
<body class="bg-gradient-to-br from-navy-950 via-slate-900 to-navy-900 text-slate-800 min-h-screen flex flex-col justify-between antialiased selection:bg-univ-500 selection:text-white">

    <!-- Header bar -->
    <header class="py-4 px-6 flex justify-between items-center border-b border-navy-800/80 bg-navy-950/60 backdrop-blur-md">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-univ-500 via-univ-600 to-indigo-700 flex items-center justify-center text-white shadow-md shadow-univ-500/20 group-hover:scale-105 transition-transform duration-200 border border-univ-400/30">
                <i class="fa-solid fa-graduation-cap text-lg text-gold-400"></i>
            </div>
            <div>
                <span class="text-[10px] uppercase tracking-widest text-gold-400 font-bold block">Portal Akademik</span>
                <span class="text-sm font-extrabold tracking-tight text-white block">UNIVERSITAS NUSANTARA</span>
            </div>
        </a>
        <a href="{{ route('dashboard') }}" class="text-xs text-slate-400 hover:text-white transition-colors flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </header>

    <!-- Main Auth Form Container -->
    <div class="flex-1 flex flex-col justify-center items-center px-4 py-12">
        <div class="w-full sm:max-w-md bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden">
            <!-- Card Header Pattern -->
            <div class="bg-gradient-to-r from-univ-700 to-navy-900 p-6 text-white text-center relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 text-white/5 text-8xl pointer-events-none">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div class="w-12 h-12 mx-auto rounded-xl bg-white/10 backdrop-blur-md flex items-center justify-center text-xl text-gold-400 mb-3 border border-white/20">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <h2 class="text-lg font-extrabold tracking-tight text-white">SIAKAD Enterprise</h2>
                <p class="text-xs text-slate-300 mt-1">Sistem Informasi Akademik Terintegrasi</p>
            </div>

            <!-- Content Slot -->
            <div class="p-6 sm:p-8">
                {{ $slot }}
            </div>
        </div>

        <p class="mt-6 text-xs text-slate-400 text-center">
            &copy; {{ date('Y') }} Universitas Nusantara Cendekia. Dilindungi oleh Enkripsi SSL 256-bit.
        </p>
    </div>

    <!-- Minimal footer -->
    <footer class="py-3 text-center text-slate-500 text-[11px] border-t border-navy-900">
        Biro Administrasi Akademik & Kemahasiswaan (BAAK)
    </footer>

</body>
</html>
