<x-app-layout>
    <div class="bg-base-200 min-h-0">
        <div class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-emerald-500 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black">⚙️ Edit Profil</h1>
                        <p class="text-emerald-100 text-sm mt-1">Kelola data diri dan pengaturan akun</p>
                    </div>
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="btn btn-outline border-white text-white hover:bg-white hover:text-emerald-700 btn-sm font-bold">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

            {{-- ════════════════ DATA DIRI ════════════════ --}}
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>👤 Data Diri</span>
                    </h2>

                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        @method('patch')

                        <div class="flex flex-col sm:flex-row gap-6 items-start">
                            <div class="flex-shrink-0 text-center">
                                <div class="avatar">
                                    <div class="w-24 h-24 rounded-full ring ring-emerald-200 ring-offset-2">
                                        @if($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" id="preview-avatar" alt="Avatar" class="object-cover">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=b3e093&color=5c8148&bold=true&size=96" id="preview-avatar" alt="" class="object-cover">
                                        @endif
                                    </div>
                                </div>
                                <div class="flex gap-2 justify-center mt-3">
                                    <label for="avatar" class="btn btn-sm btn-success text-white font-bold cursor-pointer">
                                        📷 Ganti
                                    </label>
                                    @if($user->avatar)
                                        <button type="button" id="btn-hapus-foto" class="btn btn-sm btn-outline btn-error font-bold">
                                            🗑 Hapus
                                        </button>
                                    @endif
                                </div>
                                <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden">
                                <input type="hidden" name="remove_avatar" id="remove_avatar" value="0">
                                @error('avatar')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex-1 space-y-4 w-full">
                                <div class="form-control w-full">
                                    <label class="label"><span class="label-text font-semibold text-emerald-700">Nama Lengkap</span></label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500 focus:ring-emerald-500" required>
                                    @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                </div>

                                <div class="form-control w-full">
                                    <label class="label"><span class="label-text font-semibold text-emerald-700">Email</span></label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500" required>
                                    @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                </div>

                                @if($user->role !== 'admin')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="form-control w-full">
                                        <label class="label"><span class="label-text font-semibold text-emerald-700">No. WhatsApp</span></label>
                                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500" placeholder="08xxxx">
                                        @error('phone')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="form-control w-full">
                                        <label class="label"><span class="label-text font-semibold text-emerald-700">NIK</span></label>
                                        <input type="text" name="nik" value="{{ old('nik', $user->nik) }}" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500" placeholder="Nomor Induk Kependudukan">
                                        @error('nik')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <div class="form-control w-full">
                                    <label class="label"><span class="label-text font-semibold text-emerald-700">Alamat</span></label>
                                    <textarea name="address" rows="3" class="textarea textarea-bordered w-full border-emerald-200 focus:border-emerald-500" placeholder="Alamat lengkap">{{ old('address', $user->address) }}</textarea>
                                    @error('address')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pt-3 border-t border-emerald-100">
                            <button type="submit" class="btn btn-success text-white font-bold">💾 Simpan Data</button>
                            @if (session('status') === 'profile-updated')
                                <span class="text-emerald-600 font-semibold text-sm">✓ Data berhasil disimpan</span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- ════════════════ UBAH PASSWORD ════════════════ --}}
            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="card-body p-6">
                    <h2 class="card-title text-emerald-700 border-b border-emerald-100 pb-3 mb-4">
                        <span>🔒 Ubah Password</span>
                    </h2>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-4 max-w-lg">
                        @csrf
                        @method('put')

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-semibold text-emerald-700">Password Saat Ini</span></label>
                            <div class="join w-full">
                                <input type="password" name="current_password" id="current_password" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500 join-item" required>
                                <button type="button" class="btn btn-outline border-emerald-200 join-item toggle-pw" data-target="current_password">👁</button>
                            </div>
                            @error('current_password', 'updatePassword')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="form-control w-full">
                                <label class="label"><span class="label-text font-semibold text-emerald-700">Password Baru</span></label>
                                <div class="join w-full">
                                    <input type="password" name="password" id="new_password" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500 join-item" required>
                                    <button type="button" class="btn btn-outline border-emerald-200 join-item toggle-pw" data-target="new_password">👁</button>
                                </div>
                                @error('password', 'updatePassword')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="form-control w-full">
                                <label class="label"><span class="label-text font-semibold text-emerald-700">Konfirmasi Password</span></label>
                                <div class="join w-full">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="input input-bordered w-full border-emerald-200 focus:border-emerald-500 join-item" required>
                                    <button type="button" class="btn btn-outline border-emerald-200 join-item toggle-pw" data-target="password_confirmation">👁</button>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pt-3">
                            <button type="submit" class="btn btn-success text-white font-bold">🔑 Ubah Password</button>
                            @if (session('status') === 'password-updated')
                                <span class="text-emerald-600 font-semibold text-sm">✓ Password berhasil diubah</span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('avatar')?.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                document.getElementById('preview-avatar').src = URL.createObjectURL(this.files[0]);
                document.getElementById('remove_avatar').value = '0';
            }
        });

        document.getElementById('btn-hapus-foto')?.addEventListener('click', function() {
            document.getElementById('preview-avatar').src = 'https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=b3e093&color=5c8148&bold=true&size=96';
            document.getElementById('remove_avatar').value = '1';
            document.getElementById('avatar').value = '';
        });

        document.querySelectorAll('.toggle-pw').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var input = document.getElementById(this.dataset.target);
                if (input.type === 'password') {
                    input.type = 'text';
                    this.textContent = '🙈';
                } else {
                    input.type = 'password';
                    this.textContent = '👁';
                }
            });
        });

        document.querySelector('form[action="{{ route('password.update') }}"]')?.addEventListener('submit', function(e) {
            var pw = document.getElementById('new_password');
            var confirm = document.getElementById('password_confirmation');
            var err = document.getElementById('pw-confirm-error');
            if (pw.value !== confirm.value) {
                e.preventDefault();
                if (!err) {
                    err = document.createElement('p');
                    err.id = 'pw-confirm-error';
                    err.className = 'text-xs text-red-500 mt-1';
                    confirm.closest('.form-control').appendChild(err);
                }
                err.textContent = 'Konfirmasi password tidak cocok dengan password baru.';
            }
        });
    </script>
</x-app-layout>