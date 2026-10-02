<x-guest-layout>
    <div class="mb-5">
        <h3 class="text-base font-bold text-slate-800">Masuk ke Portal</h3>
        <p class="text-xs text-slate-500 mt-0.5">Gunakan akun Anda untuk mengakses sistem akademik.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

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
                   autofocus 
                   autocomplete="username" 
                   placeholder="nama@univ-nusantara.ac.id"
                   class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-univ-500 focus:border-univ-500 transition-colors">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="block text-xs font-semibold text-slate-700">
                    <i class="fa-solid fa-key text-slate-400 mr-1"></i> Kata Sandi
                </label>
                @if (Route::has('password.request'))
                    <a class="text-[11px] text-univ-600 hover:text-univ-800 hover:underline" href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>

            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password" 
                   placeholder="••••••••"
                   class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-univ-500 focus:border-univ-500 transition-colors">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-univ-600 focus:ring-univ-500" name="remember">
                <span class="text-xs text-slate-600">Ingat Saya</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-univ-600 hover:bg-univ-700 text-white text-xs font-bold tracking-wide shadow-md shadow-univ-600/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Masuk Sekarang</span>
            </button>
        </div>

        <div class="pt-3 border-t border-slate-100 text-center text-xs text-slate-500">
            Belum memiliki akun? 
            <a href="{{ route('register') }}" class="font-bold text-univ-600 hover:text-univ-800 hover:underline">
                Daftar Akun Baru
            </a>
        </div>
    </form>
</x-guest-layout>
