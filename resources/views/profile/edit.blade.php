<x-app-layout>
    <div class="bg-base-200 min-h-screen">

        {{-- Header --}}
        <div class="bg-gradient-to-br from-primary via-primary to-primary/90 text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-white/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-white/10 rounded-full blur-3xl"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/15 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <h1 class="text-xl sm:text-2xl font-bold">Edit Profil</h1>
                            <p class="text-primary-content/60 text-xs sm:text-sm mt-0.5">Kelola data diri dan pengaturan akun</p>
                        </div>
                    </div>
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="btn btn-sm bg-white/20 hover:bg-white/30 text-white border-0 backdrop-blur-sm rounded-lg font-bold flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-4 space-y-5 pb-8">

            @if(session('success'))
                <x-alert type="success" message="{{ session('success') }}" />
            @endif
            @if(session('error'))
                <x-alert type="error" message="{{ session('error') }}" />
            @endif

            {{-- ══ DATA DIRI ══ --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-xl border border-base-300 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center text-base">👤</div>
                    <div>
                        <h2 class="font-bold text-base-content">Data Diri</h2>
                        <p class="text-xs text-base-content/40">Informasi profil akun Anda</p>
                    </div>
                </div>
                <div class="p-6">
                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div class="flex flex-col sm:flex-row gap-6 items-start">
                            <div class="flex-shrink-0 text-center w-full sm:w-auto">
                                <div class="avatar">
                                    <div class="w-24 h-24 rounded-full ring ring-base-300 ring-offset-2 ring-offset-white mx-auto">
                                        @if($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) . '?v=' . now()->timestamp }}" id="preview-avatar" alt="Avatar" class="object-cover">
                                        @else
                                            <div id="preview-avatar" class="w-full h-full bg-primary/10 text-primary font-black text-3xl flex items-center justify-center uppercase">{{ substr($user->name, 0, 1) }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex gap-2 justify-center mt-3">
                                    <label for="avatar" class="btn btn-xs bg-primary/10 hover:bg-primary/20 text-primary border-primary/20 rounded-lg font-bold cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Ganti
                                    </label>
                                    @if($user->avatar)
                                        <button type="button" id="btn-hapus-foto" class="btn btn-xs bg-rose-50 hover:bg-rose-100 text-rose-600 border-rose-200 rounded-lg font-bold">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Hapus
                                        </button>
                                    @endif
                                </div>
                                <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden">
                                <input type="hidden" name="remove_avatar" id="remove_avatar" value="0">
                                @error('avatar')
                                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex-1 space-y-4 w-full">
                                <div>
                                    <label class="text-xs font-bold text-base-content/50 uppercase tracking-wider block mb-1.5">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input input-bordered w-full border-base-300 focus:border-primary rounded-lg text-sm" required>
                                    @error('name')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label class="text-xs font-bold text-base-content/50 uppercase tracking-wider block mb-1.5">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input input-bordered w-full border-base-300 focus:border-primary rounded-lg text-sm" required>
                                    @error('email')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>

                                @if($user->role !== 'admin')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-xs font-bold text-base-content/50 uppercase tracking-wider block mb-1.5">No. WhatsApp</label>
                                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="input input-bordered w-full border-base-300 focus:border-primary rounded-lg text-sm" placeholder="08xxxx">
                                        @error('phone')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="text-xs font-bold text-base-content/50 uppercase tracking-wider block mb-1.5">NIK</label>
                                        <input type="text" name="nik" value="{{ old('nik', $user->nik) }}" class="input input-bordered w-full border-base-300 focus:border-primary rounded-lg text-sm" placeholder="Nomor Induk Kependudukan">
                                        @error('nik')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="text-xs font-bold text-base-content/50 uppercase tracking-wider block mb-1.5">Alamat</label>
                                    <textarea name="address" rows="3" class="textarea textarea-bordered w-full border-base-300 focus:border-primary rounded-lg text-sm" placeholder="Alamat lengkap">{{ old('address', $user->address) }}</textarea>
                                    @error('address')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pt-4 border-t border-base-200">
                            <button type="submit" class="btn btn-sm bg-primary hover:bg-primary/90 text-white border-0 rounded-lg font-bold px-6">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Simpan Data
                            </button>
                            @if (session('status') === 'profile-updated')
                                <span class="inline-flex items-center gap-1 text-emerald-600 font-semibold text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Data berhasil disimpan
                                </span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- ══ UBAH PASSWORD ══ --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-xl border border-base-300 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-400/10 flex items-center justify-center text-base">🔒</div>
                    <div>
                        <h2 class="font-bold text-base-content">Ubah Password</h2>
                        <p class="text-xs text-base-content/40">Perbarui kata sandi akun Anda</p>
                    </div>
                </div>
                <div class="p-6">
                    <form method="post" action="{{ route('password.update') }}" class="space-y-4 max-w-lg">
                        @csrf
                        @method('put')

                        <div>
                            <label class="text-xs font-bold text-base-content/50 uppercase tracking-wider block mb-1.5">Password Saat Ini</label>
                            <div class="join w-full">
                                <input type="password" name="current_password" id="current_password" class="input input-bordered w-full border-base-300 focus:border-primary rounded-lg join-item text-sm" required>
                                <button type="button" class="btn btn-outline border-base-300 join-item toggle-pw rounded-lg" data-target="current_password">
                                    <svg class="w-4 h-4 text-base-content/40 toggle-eye" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </div>
                            @error('current_password', 'updatePassword')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-bold text-base-content/50 uppercase tracking-wider block mb-1.5">Password Baru</label>
                                <div class="join w-full">
                                    <input type="password" name="password" id="new_password" class="input input-bordered w-full border-base-300 focus:border-primary rounded-lg join-item text-sm" required>
                                    <button type="button" class="btn btn-outline border-base-300 join-item toggle-pw rounded-lg" data-target="new_password">
                                        <svg class="w-4 h-4 text-base-content/40 toggle-eye" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                </div>
                                @error('password', 'updatePassword')<p class="text-xs text-rose-500 mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="text-xs font-bold text-base-content/50 uppercase tracking-wider block mb-1.5">Konfirmasi Password</label>
                                <div class="join w-full">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="input input-bordered w-full border-base-300 focus:border-primary rounded-lg join-item text-sm" required>
                                    <button type="button" class="btn btn-outline border-base-300 join-item toggle-pw rounded-lg" data-target="password_confirmation">
                                        <svg class="w-4 h-4 text-base-content/40 toggle-eye" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <button type="submit" class="btn btn-sm bg-primary hover:bg-primary/90 text-white border-0 rounded-lg font-bold px-6">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Ubah Password
                            </button>
                            @if (session('status') === 'password-updated')
                                <span class="inline-flex items-center gap-1 text-emerald-600 font-semibold text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Password berhasil diubah
                                </span>
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
                var el = document.getElementById('preview-avatar');
                if (el.tagName === 'IMG') {
                    el.src = URL.createObjectURL(this.files[0]);
                } else {
                    var img = new Image();
                    img.id = 'preview-avatar';
                    img.className = 'object-cover w-full h-full rounded-full';
                    img.src = URL.createObjectURL(this.files[0]);
                    el.parentNode.replaceChild(img, el);
                }
                document.getElementById('remove_avatar').value = '0';
            }
        });

        document.getElementById('btn-hapus-foto')?.addEventListener('click', function() {
            var container = document.getElementById('preview-avatar').parentNode;
            var existing = document.getElementById('preview-avatar');
            if (existing.tagName === 'IMG') {
                var div = document.createElement('div');
                div.id = 'preview-avatar';
                div.className = 'w-full h-full bg-primary/10 text-primary font-black text-3xl flex items-center justify-center uppercase';
                div.textContent = '{{ substr($user->name, 0, 1) }}';
                container.replaceChild(div, existing);
            }
            document.getElementById('remove_avatar').value = '1';
            document.getElementById('avatar').value = '';
        });

        document.querySelectorAll('.toggle-pw').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var input = document.getElementById(this.dataset.target);
                var eye = this.querySelector('.toggle-eye');
                if (input.type === 'password') {
                    input.type = 'text';
                    eye.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.052 10.052 0 012.467-3.638m3.34-2.044A9.966 9.966 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.99 9.99 0 01-2.283 3.542M3 3l18 18"></path>';
                } else {
                    input.type = 'password';
                    eye.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
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
                    err.className = 'text-xs text-rose-500 mt-1';
                    confirm.closest('.form-control').appendChild(err);
                }
                err.textContent = 'Konfirmasi password tidak cocok dengan password baru.';
            }
        });
    </script>
</x-app-layout>