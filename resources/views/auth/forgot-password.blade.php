<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 shadow-inner mb-3 mx-auto flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
            </svg>
        </div>
        <h1 class="text-xl font-bold text-emerald-800">Lupa Password</h1>
        <p class="text-sm text-emerald-500">Masukkan email Anda untuk mendapatkan tautan reset</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-control">
            <label class="label" for="email">
                <span class="label-text font-bold text-emerald-700 uppercase text-xs tracking-wider">Email</span>
            </label>
            <input id="email" type="email" name="email" placeholder="email@anda.com"
                   class="input input-bordered w-full bg-emerald-50/50 border-emerald-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 rounded-xl px-4 py-3 text-sm transition-all"
                   :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="link link-hover text-sm text-emerald-600 font-semibold" href="{{ route('login') }}">
                Kembali ke halaman masuk
            </a>
            <button type="submit" class="btn btn-success text-white font-bold rounded-xl px-6 py-2.5 text-sm shadow-sm hover:shadow-md transition-all">
                Kirim Tautan Reset
            </button>
        </div>
    </form>
</x-guest-layout>
