<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 shadow-inner mb-3 mx-auto flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
        </div>
        <h1 class="text-xl font-bold text-emerald-800">Buat Akun Baru</h1>
        <p class="text-sm text-emerald-500">Daftar untuk menjadi donatur</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-control">
            <label class="label" for="name">
                <span class="label-text font-bold text-emerald-700 uppercase text-xs tracking-wider">Nama Lengkap</span>
            </label>
            <input id="name" type="text" name="name" placeholder="Budi Santoso"
                   class="input input-bordered w-full bg-emerald-50/50 border-emerald-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 rounded-xl px-4 py-3 text-sm transition-all"
                   :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <div class="form-control mt-4">
            <label class="label" for="email">
                <span class="label-text font-bold text-emerald-700 uppercase text-xs tracking-wider">Email</span>
            </label>
            <input id="email" type="email" name="email" placeholder="email@anda.com"
                   class="input input-bordered w-full bg-emerald-50/50 border-emerald-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 rounded-xl px-4 py-3 text-sm transition-all"
                   :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div class="form-control mt-4">
            <label class="label" for="phone">
                <span class="label-text font-bold text-emerald-700 uppercase text-xs tracking-wider">No. WhatsApp / HP</span>
            </label>
            <input id="phone" type="text" name="phone" placeholder="081234567890"
                   class="input input-bordered w-full bg-emerald-50/50 border-emerald-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 rounded-xl px-4 py-3 text-sm transition-all"
                   :value="old('phone')" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-1.5" />
        </div>

        <div class="form-control mt-4">
            <label class="label" for="address">
                <span class="label-text font-bold text-emerald-700 uppercase text-xs tracking-wider">Alamat Lengkap</span>
            </label>
            <textarea id="address" name="address" rows="2" placeholder="Alamat lengkap..."
                      class="input input-bordered w-full bg-emerald-50/50 border-emerald-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 rounded-xl px-4 py-3 text-sm transition-all min-h-[80px]">{{ old('address') }}</textarea>
            <x-input-error :messages="$errors->get('address')" class="mt-1.5" />
        </div>

        <div class="form-control mt-4">
            <label class="label" for="nik">
                <span class="label-text font-bold text-emerald-700 uppercase text-xs tracking-wider">NIK</span>
            </label>
            <input id="nik" type="text" name="nik" placeholder="16 digit NIK"
                   class="input input-bordered w-full bg-emerald-50/50 border-emerald-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 rounded-xl px-4 py-3 text-sm transition-all"
                   :value="old('nik')" required maxlength="16" />
            <x-input-error :messages="$errors->get('nik')" class="mt-1.5" />
        </div>

        <div class="form-control mt-4">
            <label class="label" for="password">
                <span class="label-text font-bold text-emerald-700 uppercase text-xs tracking-wider">Password</span>
            </label>
            <div class="join w-full">
                <input id="password" type="password" name="password" placeholder="Min 8 karakter"
                       class="input input-bordered w-full bg-emerald-50/50 border-emerald-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 rounded-xl px-4 py-3 text-sm transition-all join-item"
                       required autocomplete="new-password" />
                <button type="button" onclick="togglePassword('password', 'eyeIcon')" class="btn btn-outline join-item border-emerald-200 bg-emerald-50/50 hover:bg-emerald-100 border-l-0 rounded-r-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" id="eyeIcon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="form-control mt-4">
            <label class="label" for="password_confirmation">
                <span class="label-text font-bold text-emerald-700 uppercase text-xs tracking-wider">Konfirmasi Password</span>
            </label>
            <div class="join w-full">
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi password"
                       class="input input-bordered w-full bg-emerald-50/50 border-emerald-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 rounded-xl px-4 py-3 text-sm transition-all join-item"
                       required autocomplete="new-password" />
                <button type="button" onclick="togglePassword('password_confirmation', 'eyeIconConfirm')" class="btn btn-outline join-item border-emerald-200 bg-emerald-50/50 hover:bg-emerald-100 border-l-0 rounded-r-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" id="eyeIconConfirm">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="link link-hover text-sm text-emerald-600 font-semibold" href="{{ route('login') }}">
                Sudah punya akun? Masuk
            </a>
            <button type="submit" class="btn btn-success text-white font-bold rounded-xl px-6 py-2.5 text-sm shadow-sm hover:shadow-md transition-all">
                Daftar
            </button>
        </div>
    </form>

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
