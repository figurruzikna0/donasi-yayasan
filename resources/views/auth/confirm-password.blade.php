<x-guest-layout>
    <div class="card bg-base-100 w-full max-w-md shadow-xl">
        <div class="card-body p-8">
            <div class="mb-4 text-sm text-base-content/70">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="form-control">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-6">
                    <x-primary-button>
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
