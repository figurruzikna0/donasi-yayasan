<!-- ============================================ -->
<!-- auth\login.blade.php — halaman login pengguna -->
<!-- ============================================ -->
<!-- Peran     : form masuk akun (email, password, ingat saya, lupa password, daftar). -->
<!-- Controller: AuthenticatedSessionController — route('login') untuk GET dan POST. -->
<!-- Alur      : isi email + password -> POST -> validasi -> redirect ke dashboard. -->
{{-- AUTH_LOGIN: halaman masuk (login) pengguna -- form email, password, checkbox ingat saya, tautan lupa password & daftar --}}
<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-700 shadow-inner mb-3 mx-auto flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
            </svg>
        </div>
        <h1 class="text-xl font-bold text-slate-800">Masuk ke Akun</h1>
        <p class="text-sm text-slate-500">Silakan masuk untuk melanjutkan</p>
    </div>

    <!-- FORM LOGIN: mengirim data ke route('login') metode POST; csrf wajib untuk keamanan -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- FIELD EMAIL: wajib diisi (required), format email; nilai old('email') dipertahankan bila validasi gagal -->
        <div class="form-control">
            <label class="label" for="email">
                <span class="label-text font-bold text-slate-600 uppercase text-xs tracking-wider">Email</span>
            </label>
            <input id="email" type="email" name="email" placeholder="email@anda.com"
                   class="input input-bordered w-full bg-white border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 rounded-lg px-4 py-3 text-sm transition-all"
                   :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- FIELD PASSWORD: wajib diisi (required); tombol mata (JS togglePassword) untuk lihat/sembunyikan isi password -->
        <div class="form-control mt-4">
            <label class="label" for="password">
                <span class="label-text font-bold text-slate-600 uppercase text-xs tracking-wider">Password</span>
            </label>
            <div class="flex w-full">
                <input id="password" type="password" name="password" placeholder="••••••••"
                       class="input input-bordered w-full bg-white border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 rounded-l-lg px-4 py-3 text-sm transition-all"
                       required autocomplete="current-password" />
                <button type="button" onclick="togglePassword('password', 'eyeIcon')" class="btn border-slate-300 border-l-0 rounded-r-lg bg-white hover:bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" id="eyeIcon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- CHECKBOX "INGAT SAYA": bila dicentang, sesi login diperpanjang memakai remember token -->
        <div class="form-control mt-4">
            <label class="label cursor-pointer justify-start gap-2" for="remember_me">
                <input id="remember_me" type="checkbox" name="remember" class="checkbox checkbox-sm rounded border-slate-300 text-emerald-700 focus:ring-emerald-500" />
                <span class="label-text text-slate-600 text-sm">Ingat saya</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            <!-- TAUTAN "LUPA PASSWORD": hanya dirender jika route password.request terdaftar di sistem -->
            @if (Route::has('password.request'))
                <a class="link link-hover text-sm text-emerald-700 font-semibold" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
            <!-- TOMBOL SUBMIT: mengirim form login ke server -->
            <button type="submit" class="btn bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-lg px-6 py-2.5 text-sm shadow-sm hover:shadow-md transition-all border-0">
                Masuk
            </button>
        </div>
    </form>

    <!-- TAUTAN DAFTAR: mengarahkan pengguna yang belum punya akun ke halaman registrasi -->
    <div class="mt-6 pt-5 border-t border-slate-200 text-center text-sm text-slate-500">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-bold text-emerald-700 hover:text-emerald-800 transition-colors">Daftar</a>
    </div>

    <!-- SCRIPT JS: fungsi togglePassword() menampilkan/menyembunyikan isi kolom password beserta ikon mata -->
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
            } else {
                input.type = 'password';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }
        }
    </script>
</x-guest-layout>
