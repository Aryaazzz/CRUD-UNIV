<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Universitas')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800">
    <nav class="bg-slate-900 text-white shadow">
        <div class="max-w-6xl mx-auto px-4 py-4 flex gap-6">
            <a href="{{ route('prodi.index') }}" class="hover:text-cyan-300">Prodi</a>
            <a href="{{ route('mahasiswa.index') }}" class="hover:text-cyan-300">Mahasiswa</a>
            <a href="{{ route('dosen.index') }}" class="hover:text-cyan-300">Dosen</a>
            <a href="{{ route('mata-kuliah.index') }}" class="hover:text-cyan-300">Mata Kuliah</a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto p-6">
        @if(session('success'))
            <div class="mb-4 rounded bg-green-100 border border-green-300 text-green-700 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
