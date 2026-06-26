<x-guest-layout>
    <style>
        :root {
            --celadon:       #b3e093;
            --lime-cream:    #d6ec89;
            --muted-olive:   #a1c181;
            --muted-olive-2: #8bb650;
            --sage-green:    #76a45b;
            --fern:          #5c8148;
        }

        body {
            background: linear-gradient(145deg, #eafcd4 0%, var(--lime-cream) 50%, var(--celadon) 100%) !important;
            min-height: 100vh;
        }

        .login-wrapper {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 16px;
            border: 1px solid var(--celadon);
            box-shadow: 0 12px 30px rgba(92, 129, 72, 0.14);
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            overflow: hidden;
            position: relative;
        }

        /* Signature: thin gradient top bar */
        .login-wrapper::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--fern), var(--sage-green), var(--muted-olive), var(--lime-cream));
        }

        .login-title {
            color: var(--fern);
            font-size: 1.35rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
        }

        .login-subtitle {
            color: var(--sage-green);
            font-size: 0.85rem;
            margin-bottom: 1.75rem;
        }

        .custom-label {
            color: var(--fern);
            font-weight: 700;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.4rem;
            display: block;
        }

        .input-group {
            position: relative;
            margin-top: 0.25rem;
        }

        .custom-input {
            width: 100%;
            background-color: #f6fdf0;
            border: 1.5px solid var(--celadon);
            color: var(--fern);
            padding: 0.75rem 1rem;
            border-radius: 10px;
            transition: all 0.25s ease;
            font-size: 0.95rem;
            box-sizing: border-box;
        }

        .custom-input::placeholder {
            color: var(--muted-olive);
            opacity: 0.7;
        }

        .custom-input:focus {
            outline: none;
            border-color: var(--muted-olive-2);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(139, 182, 80, 0.2);
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--sage-green);
            cursor: pointer;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            user-select: none;
            transition: color 0.2s ease;
        }

        .toggle-password:hover {
            color: var(--fern);
        }

        .custom-checkbox {
            accent-color: var(--muted-olive-2);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .remember-label {
            color: var(--sage-green);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .custom-link {
            color: var(--sage-green);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            transition: color 0.2s ease;
        }

        .custom-link:hover {
            color: var(--fern);
            text-decoration: underline;
        }

        .custom-btn {
            background: linear-gradient(135deg, var(--muted-olive-2) 0%, var(--sage-green) 100%);
            color: #ffffff;
            font-weight: 700;
            padding: 0.75rem 1.75rem;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 3px 12px rgba(92, 129, 72, 0.28);
            font-size: 0.9rem;
            letter-spacing: 0.02em;
        }

        .custom-btn:hover {
            background: linear-gradient(135deg, var(--sage-green) 0%, var(--fern) 100%);
            box-shadow: 0 6px 20px rgba(92, 129, 72, 0.38);
            transform: translateY(-1px);
        }

        .custom-btn:active {
            transform: translateY(0);
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--celadon), transparent);
            margin: 1.5rem 0;
        }
    </style>

    <div class="login-wrapper">

        {{-- Header --}}
        <div>
            <p class="login-title">🌿 Selamat Datang</p>
            <p class="login-subtitle">Masuk ke dashboard admin Baitul Yatim</p>
        </div>

        <x-auth-session-status
            class="mb-4 text-sm font-bold px-4 py-2 rounded-lg"
            style="background-color: var(--celadon); color: var(--fern); border: 1px solid var(--muted-olive);"
            :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="custom-label">{{ __('Email Address') }}</label>
                <div class="input-group">
                    <input id="email"
                           class="custom-input"
                           type="email"
                           name="email"
                           :value="old('email')"
                           required
                           autofocus
                           autocomplete="username"
                           placeholder="admin@example.com" />
                </div>
                <x-input-error :messages="$errors->get('email')"
                               class="mt-2 text-red-500 text-sm font-medium" />
            </div>

            {{-- Password --}}
            <div class="mt-5">
                <label for="password" class="custom-label">{{ __('Password') }}</label>
                <div class="input-group">
                    <input id="password"
                           class="custom-input"
                           type="password"
                           name="password"
                           required
                           autocomplete="current-password"
                           placeholder="••••••••"
                           style="padding-right: 3.5rem;" />
                    <span class="toggle-password" onclick="togglePassword()">SHOW</span>
                </div>
                <x-input-error :messages="$errors->get('password')"
                               class="mt-2 text-red-500 text-sm font-medium" />
            </div>

            {{-- Remember Me --}}
            <div class="mt-5">
                <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                    <input id="remember_me"
                           type="checkbox"
                           class="custom-checkbox"
                           name="remember">
                    <span class="remember-label">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="divider"></div>

            {{-- Actions --}}
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="custom-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="custom-btn">
                    {{ __('Log in') }} →
                </button>
            </div>

        </form>
    </div>

    <script>
        function togglePassword() {
            const input      = document.getElementById('password');
            const toggleBtn  = document.querySelector('.toggle-password');
            const isHidden   = input.type === 'password';

            input.type       = isHidden ? 'text' : 'password';
            toggleBtn.textContent  = isHidden ? 'HIDE' : 'SHOW';
            toggleBtn.style.color  = isHidden ? 'var(--fern)' : 'var(--sage-green)';
        }
    </script>
</x-guest-layout>