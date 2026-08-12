<!-- ============================================ -->
<!-- profile\partials\delete-user-form.blade.php — bagian hapus akun -->
<!-- ============================================ -->
<!-- Peran     : tombol hapus akun dengan modal konfirmasi (wajib memasukkan password). -->
<!-- Controller: ProfileController@destroy — route('profile.destroy') dengan metode DELETE. -->
<!-- Alur      : klik Delete Account -> modal (Alpine.js) terbuka -> isi password -> -->
<!--             konfirmasi -> akun beserta seluruh datanya dihapus permanen -> logout. -->
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-emerald-700">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-emerald-500">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- TOMBOL HAPUS: memicu event 'open-modal' (Alpine.js) untuk membuka modal konfirmasi -->
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <!-- MODAL KONFIRMASI HAPUS: otomatis terbuka bila ada error validasi pada key 'userDeletion' -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <!-- FORM HAPUS AKUN: metode DELETE menuju route('profile.destroy') -->
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-emerald-700">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>
            <p class="mt-1 text-sm text-emerald-500">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <!-- FIELD PASSWORD: wajib diisi sebagai konfirmasi terakhir sebelum akun dihapus -->
            <div class="mt-6 form-control">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input id="password" name="password" type="password" class="mt-1 w-3/4" placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <!-- TOMBOL BATAL: menutup modal melalui event 'close' (Alpine.js) -->
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <!-- TOMBOL HAPUS AKUN: mengirim form DELETE ke server -->
                <x-danger-button>
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
