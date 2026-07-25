<section>
    <header>
        <h2 class="text-lg font-semibold text-emerald-700">
            Informasi Profil
        </h2>
        <p class="mt-1 text-sm text-emerald-500">
            Perbarui informasi profil dan alamat email akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-control">
            <x-input-label for="name" :value="'Nama'" />
            <x-text-input id="name" name="name" type="text" class="mt-1 w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="form-control">
            <x-input-label for="email" :value="'Email'" />
            <x-text-input id="email" name="email" type="email" class="mt-1 w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-base-content/70">
                        Alamat email Anda belum diverifikasi.
                        <button form="send-verification" class="link link-hover text-emerald-600 font-semibold">
                            Klik di sini untuk kirim ulang email verifikasi.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <div class="mt-3">
                            <x-alert type="success" message="Tautan verifikasi baru telah dikirim ke alamat email Anda." title="Email Terkirim" />
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Simpan</x-primary-button>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                    <x-alert type="success" message="Data profil berhasil diperbarui." title="Tersimpan" />
                </div>
            @endif
        </div>
    </form>
</section>
