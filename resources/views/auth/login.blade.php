<x-guest-layout>
    <style>
        :root {
            --honeydew: #f1faeeff;
            --frosted-blue: #a8dadcff;
            --cerulean: #457b9dff;
            --oxford-navy: #1d3557ff;
        }

        /* Override background bawaan layout guest Breeze */
        body {
            background-color: var(--honeydew) !important;
            color: var(--oxford-navy);
        }

        .login-wrapper {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 12px;
            border: 1px solid var(--frosted-blue);
            box-shadow: 0 10px 25px rgba(69, 123, 157, 0.1);
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .custom-label {
            color: var(--oxford-navy);
            font-weight: 700;
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
            background-color: #ffffff;
            border: 1px solid var(--frosted-blue);
            color: var(--oxford-navy);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .custom-input:focus {
            outline: none;
            border-color: var(--cerulean);
            box-shadow: 0 0 0 3px rgba(69, 123, 157, 0.2);
        }

        /* JS Toggle Password Button */
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--cerulean);
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: bold;
            user-select: none;
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: var(--oxford-navy);
        }

        .custom-checkbox {
            accent-color: var(--cerulean);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .custom-link {
            color: var(--cerulean);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .custom-link:hover {
            color: var(--oxford-navy);
            text-decoration: underline;
        }

        .custom-btn {
            background-color: var(--oxford-navy);
            color: var(--honeydew);
            font-weight: bold;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .custom-btn:hover {
            background-color: var(--cerulean);
            box-shadow: 0 5px 15px rgba(69, 123, 157, 0.3);
            transform: translateY(-1px);
        }
    </style>

    <div class="login-wrapper">
        <x-auth-session-status class="mb-4 text-green-600 font-bold" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="custom-label">{{ __('Email Address') }}</label>
                <div class="input-group">
                    <input id="email" class="custom-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@example.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm font-medium" />
            </div>

            <!-- Password -->
            <div class="mt-6">
                <label for="password" class="custom-label">{{ __('Password') }}</label>
                <div class="input-group">
                    <input id="password" class="custom-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    <span class="toggle-password" onclick="togglePassword()">SHOW</span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm font-medium" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-6">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="custom-checkbox" name="remember">
                    <span class="ms-2 text-sm font-medium" style="color: var(--cerulean);">{{ __('Remember me') }}</span>
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
                toggleText.style.color = "var(--oxford-navy)";
            } else {
                passwordInput.type = "password";
                toggleText.textContent = "SHOW";
                toggleText.style.color = "var(--cerulean)";
            }
        }
    </script>
</x-guest-layout>