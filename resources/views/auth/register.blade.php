<x-guest-layout>
    <div class="card bg-base-100 w-full max-w-md shadow-xl">
        <div class="card-body p-8">
            <div class="text-center mb-6">
                <p class="text-2xl font-extrabold text-emerald-700">🌿 Daftar Akun</p>
                <p class="text-sm text-emerald-500">Buat akun donatur Baitul Yatim</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-control">
                    <x-input-label for="name" value="Nama Lengkap" />
                    <x-text-input id="name" class="mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Contoh: Budi Santoso" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="form-control mt-4">
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" class="mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="email@anda.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="form-control mt-4">
                    <x-input-label for="phone" value="No. WhatsApp / HP Aktif" />
                    <x-text-input id="phone" class="mt-1 w-full" type="text" name="phone" :value="old('phone')" required placeholder="081234567890" />
                    <label class="label"><span class="label-text-alt text-emerald-500">Nomor ini digunakan untuk notifikasi donasi & sponsorship</span></label>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="form-control mt-4">
                    <x-input-label for="address" value="Alamat Lengkap" />
                    <textarea id="address" name="address" class="textarea textarea-bordered mt-1 w-full" rows="2" required placeholder="Alamat lengkap...">{{ old('address') }}</textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="form-control mt-4">
                    <x-input-label for="nik" value="NIK (Nomor Induk Kependudukan)" />
                    <x-text-input id="nik" class="mt-1 w-full" type="text" name="nik" :value="old('nik')" required placeholder="16 digit NIK" maxlength="16" />
                    <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                </div>

                <div class="form-control mt-4">
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" class="mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Min 8 karakter" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="form-control mt-4">
                    <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                    <x-text-input id="password_confirmation" class="mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a class="link link-hover text-sm text-emerald-600 font-semibold" href="{{ route('login') }}">
                        Sudah punya akun?
                    </a>
                    <x-primary-button>
                        Daftar
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
