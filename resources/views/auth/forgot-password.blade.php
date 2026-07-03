<x-guest-layout>
    <div class="card bg-base-100 w-full max-w-md shadow-xl">
        <div class="card-body p-8">
            <div class="mb-4 text-sm text-base-content/70">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-control">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-6">
                    <x-primary-button>
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
