<!-- ============================================ -->
<!-- profile\partials\update-profile-information-form.blade.php — form ubah data profil -->
<!-- ============================================ -->
<!-- Peran     : komponen (partial) form perbarui nama & email pengguna, dipakai pada halaman profile/edit. -->
<!-- Controller: ProfileController@update — route('profile.update') dengan metode PATCH. -->
<!-- Alur      : ubah nama/email -> klik Simpan -> PATCH -> session 'profile-updated' -> alert sukses. -->
<section>
    <header>
        <h2 class="text-lg font-semibold text-emerald-700">
            Informasi Profil
        </h2>
        <p class="mt-1 text-sm text-emerald-500">
            Perbarui informasi profil dan alamat email akun Anda.
        </p>
    </header>

    <!-- FORM KIRIM ULANG VERIFIKASI (tersembunyi): dipicu oleh tombol "Klik di sini" di bawah -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- FORM PERBARUI PROFIL: metode PATCH (diubah oleh method('patch')) menuju route('profile.update') -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- FIELD NAMA: wajib diisi; nilai diambil dari data user yang sedang login -->
        <div class="form-control">
            <x-input-label for="name" :value="'Nama'" />
            <x-text-input id="name" name="name" type="text" class="mt-1 w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- FIELD EMAIL: wajib diisi; bila email diubah dan model pengguna memakai MustVerifyEmail, -->
        <!-- pengguna harus verifikasi ulang email baru -->
        <div class="form-control">
            <x-input-label for="email" :value="'Email'" />
            <x-text-input id="email" name="email" type="email" class="mt-1 w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <!-- KONDISI: hanya tampil jika pengguna wajib verifikasi email dan emailnya BELUM diverifikasi -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-base-content/70">
                        Alamat email Anda belum diverifikasi.
                        <button form="send-verification" class="link link-hover text-emerald-600 font-semibold">
                            Klik di sini untuk kirim ulang email verifikasi.
                        </button>
                    </p>
                    <!-- KONDISI: menampilkan alert bila tautan verifikasi baru berhasil dikirim -->
                    @if (session('status') === 'verification-link-sent')
                        <div class="mt-3">
                            <x-alert type="success" message="Tautan verifikasi baru telah dikirim ke alamat email Anda." title="Email Terkirim" />
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <!-- TOMBOL SIMPAN: menyimpan perubahan data profil -->
            <x-primary-button>Simpan</x-primary-button>

            <!-- ALERT SUKSES: muncul 3 detik (Alpine.js) bila session status = profile-updated -->
            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                    <x-alert type="success" message="Data profil berhasil diperbarui." title="Tersimpan" />
                </div>
            @endif
        </div>
    </form>
</section>
