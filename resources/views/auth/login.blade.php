<x-guest-layout>
    <style>
        :root {
            --black: #020202ff;
            --evergreen: #0d2818ff;
            --black-forest: #04471cff;
            --sea-green: #058c42ff;
            --malachite: #16db65ff;
        }

        /* Override background bawaan layout guest Breeze */
        body {
            background-color: var(--black) !important;
            color: white;
        }

        .login-wrapper {
            background-color: var(--evergreen);
            padding: 2.5rem;
            border-radius: 12px;
            border: 1px solid var(--black-forest);
            box-shadow: 0 10px 25px rgba(22, 219, 101, 0.05);
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .custom-label {
            color: var(--malachite);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .input-group {
            position: relative;
            margin-top: 0.25rem;
        }

        .custom-input {
            width: 100%;
            background-color: var(--black);
            border: 1px solid var(--black-forest);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .custom-input:focus {
            outline: none;
            border-color: var(--sea-green);
            box-shadow: 0 0 0 3px rgba(5, 140, 66, 0.3);
        }

        /* JS Toggle Password Button */
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--sea-green);
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: bold;
            user-select: none;
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: var(--malachite);
        }

        .custom-checkbox {
            accent-color: var(--sea-green);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .custom-link {
            color: var(--sea-green);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .custom-link:hover {
            color: var(--malachite);
            text-decoration: underline;
        }

        .custom-btn {
            background-color: var(--sea-green);
            color: var(--black);
            font-weight: bold;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .custom-btn:hover {
            background-color: var(--malachite);
            box-shadow: 0 0 15px rgba(22, 219, 101, 0.4);
            transform: translateY(-1px);
        }
    </style>

    <div class="login-wrapper">
        <x-auth-session-status class="mb-4 text-green-400" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="custom-label">{{ __('Email Address') }}</label>
                <div class="input-group">
                    <input id="email" class="custom-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@example.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <div class="mt-6">
                <label for="password" class="custom-label">{{ __('Password') }}</label>
                <div class="input-group">
                    <input id="password" class="custom-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    <span class="toggle-password" onclick="togglePassword()">SHOW</span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <div class="block mt-6">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="custom-checkbox" name="remember">
                    <span class="ms-2 text-sm" style="color: #cbd5e1;">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-8">
                @if (Route::has('password.request'))
                    <a class="text-sm custom-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="custom-btn">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleText = document.querySelector(".toggle-password");
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleText.textContent = "HIDE";
                toggleText.style.color = "var(--malachite)";
            } else {
                passwordInput.type = "password";
                toggleText.textContent = "SHOW";
                toggleText.style.color = "var(--sea-green)";
            }
        }
    </script>
</x-guest-layout>