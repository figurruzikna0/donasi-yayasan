<x-guest-layout>
    <div class="card bg-base-100 w-full max-w-md border-t-4 border-t-emerald-500 shadow-xl">
        <div class="card-body p-8">
            <div class="text-center mb-6">
                <p class="text-2xl font-extrabold text-emerald-700">🌿 Selamat Datang</p>
                <p class="text-sm text-emerald-500">Masuk ke dashboard admin Baitul Yatim</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-control">
                    <label class="label" for="email">
                        <span class="label-text font-semibold text-emerald-700 uppercase text-xs tracking-wider">Email Address</span>
                    </label>
                    <input id="email" type="email" name="email" placeholder="admin@example.com"
                           class="input input-bordered w-full bg-emerald-50/50 focus:bg-white"
                           :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="form-control mt-4">
                    <label class="label" for="password">
                        <span class="label-text font-semibold text-emerald-700 uppercase text-xs tracking-wider">Password</span>
                    </label>
                    <div class="join w-full">
                        <input id="password" type="password" name="password" placeholder="••••••••"
                               class="input input-bordered w-full bg-emerald-50/50 focus:bg-white join-item"
                               required autocomplete="current-password" />
                        <span class="btn btn-outline join-item border-base-300 btn-ghost text-xs font-bold text-emerald-600"
                              onclick="togglePassword()">SHOW</span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="form-control mt-4">
                    <label class="label cursor-pointer justify-start gap-2" for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember" class="checkbox checkbox-success" />
                        <span class="label-text text-emerald-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="divider my-5"></div>

                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="link link-hover text-sm text-emerald-600 font-semibold" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <button type="submit" class="btn btn-success text-white font-bold px-8">
                        {{ __('Log in') }} →
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input      = document.getElementById('password');
            const toggleBtn  = event.currentTarget;
            const isHidden   = input.type === 'password';
            input.type       = isHidden ? 'text' : 'password';
            toggleBtn.textContent  = isHidden ? 'HIDE' : 'SHOW';
        }
    </script>
</x-guest-layout>