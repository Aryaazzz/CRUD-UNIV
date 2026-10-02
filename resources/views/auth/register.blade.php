<x-guest-layout>
    <div class="mb-5">
        <h3 class="text-base font-bold text-slate-800">Pendaftaran Akun Baru</h3>
        <p class="text-xs text-slate-500 mt-0.5">Daftarkan akun untuk staf atau sivitas akademika.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-semibold text-slate-700 mb-1">
                <i class="fa-regular fa-user text-slate-400 mr-1"></i> Nama Lengkap
            </label>
            <input id="name" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name" 
                   placeholder="Contoh: Dr. Budi Santoso / Staf BAAK"
                   class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-univ-500 focus:border-univ-500 transition-colors">
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">
                <i class="fa-regular fa-envelope text-slate-400 mr-1"></i> Alamat Email
            </label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username" 
                   placeholder="nama@univ-nusantara.ac.id"
                   class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-univ-500 focus:border-univ-500 transition-colors">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-semibold text-slate-700 mb-1">
                <i class="fa-solid fa-key text-slate-400 mr-1"></i> Kata Sandi
            </label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password" 
                   placeholder="Minimal 8 karakter"
                   class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-univ-500 focus:border-univ-500 transition-colors">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 mb-1">
                <i class="fa-solid fa-lock text-slate-400 mr-1"></i> Konfirmasi Kata Sandi
            </label>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password" 
                   placeholder="Ulangi kata sandi"
                   class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-univ-500 focus:border-univ-500 transition-colors">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-univ-600 hover:bg-univ-700 text-white text-xs font-bold tracking-wide shadow-md shadow-univ-600/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                <i class="fa-solid fa-user-plus"></i>
                <span>Daftar Sekarang</span>
            </button>
        </div>

        <div class="pt-3 border-t border-slate-100 text-center text-xs text-slate-500">
            Sudah memiliki akun? 
            <a href="{{ route('login') }}" class="font-bold text-univ-600 hover:text-univ-800 hover:underline">
                Masuk di sini
            </a>
        </div>
    </form>
</x-guest-layout>
