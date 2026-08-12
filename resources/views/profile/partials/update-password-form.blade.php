<!-- ============================================ -->
<!-- profile\partials\update-password-form.blade.php — form ganti password -->
<!-- ============================================ -->
<!-- Peran     : komponen (partial) form penggantian password akun, dipakai pada halaman profile/edit. -->
<!-- Controller: PasswordController@update — route('password.update') dengan metode PUT. -->
<!-- Alur      : isi password lama, baru, dan konfirmasi -> Simpan -> validasi (bagian 'updatePassword') -->
<!--             -> session 'password-updated' -> alert sukses. -->
<section>
    <header>
        <h2 class="text-lg font-semibold text-emerald-700">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-emerald-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <!-- FORM GANTI PASSWORD: metode PUT menuju route('password.update') -->
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- FIELD PASSWORD SAAT INI: wajib cocok dengan password yang sedang dipakai -->
        <div class="form-control">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 w-full" autocomplete="current-password" />
            <!-- Error khusus diambil dari key validasi 'updatePassword' -->
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- FIELD PASSWORD BARU: wajib diisi (aturan min. 8 karakter divalidasi di PasswordController) -->
        <div class="form-control">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- FIELD KONFIRMASI PASSWORD BARU: wajib sama dengan password baru -->
        <div class="form-control">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <!-- TOMBOL SIMPAN: menyimpan password baru ke database -->
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <!-- ALERT SUKSES: muncul 3 detik (Alpine.js) bila session status = password-updated -->
            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                    <x-alert type="success" message="Kata sandi berhasil diperbarui." title="Tersimpan" />
                </div>
            @endif
        </div>
    </form>
</section>
