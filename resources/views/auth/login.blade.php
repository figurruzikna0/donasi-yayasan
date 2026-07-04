<x-guest-layout>
    <div class="card bg-base-100 w-full max-w-md shadow-xl">
        <div class="card-body p-8">
            <div class="text-center mb-6">
                <p class="text-3xl font-black text-emerald-700">🌿 Selamat Datang</p>
                <p class="text-sm text-emerald-500 mt-1">Masuk ke akun Anda</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-control">
                    <label class="label" for="email">
                        <span class="label-text font-bold text-emerald-700 uppercase text-xs tracking-wider">Email</span>
                    </label>
                    <input id="email" type="email" name="email" placeholder="email@anda.com"
                           class="input input-bordered w-full focus:border-emerald-400"
                           :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="form-control mt-4">
                    <label class="label" for="password">
                        <span class="label-text font-bold text-emerald-700 uppercase text-xs tracking-wider">Password</span>
                    </label>
                    <div class="join w-full">
                        <input id="password" type="password" name="password" placeholder="••••••••"
                               class="input input-bordered w-full focus:border-emerald-400 join-item"
                               required autocomplete="current-password" />
                        <button type="button" id="toggleBtn"
                                class="btn btn-outline join-item border-base-300 btn-ghost text-xs font-bold text-emerald-600 px-4"
                                onclick="togglePassword()">SHOW</button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="form-control mt-4">
                    <label class="label cursor-pointer justify-start gap-2" for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember" class="checkbox checkbox-success checkbox-sm" />
                        <span class="label-text text-emerald-600 text-sm">Ingat saya</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="link link-hover text-sm text-emerald-600 font-semibold" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif
                    <button type="submit" class="btn btn-success text-white font-bold px-7">
                        Masuk →
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-5 border-t border-emerald-100 text-center text-sm text-emerald-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition-colors">Daftar di sini</a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const btn = document.getElementById('toggleBtn');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            btn.textContent = isHidden ? 'HIDE' : 'SHOW';
        }
    </script>
</x-guest-layout>
