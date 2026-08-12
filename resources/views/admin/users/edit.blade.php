{{--
    ============================================================
    admin\users\edit.blade.php — Edit Data User
    ============================================================
    Halaman form untuk memperbarui data user (donatur/admin).
    Data $user dikirim dari AdminUserController.edit() dan form
    dikirim ke AdminUserController.update() via route
    admin.users.update (metode PUT).
    Alur halaman: header + tombol kembali → kartu profil user
    (avatar, nama, email, tanggal bergabung) → form edit berisi
    Nama, Email, No. HP/WA, NIK (khusus donatur), Alamat, dan Role
    → tombol Simpan Perubahan.
--}}
{{-- ADMIN_USERS_EDIT: halaman edit data user --}}
<x-admin-layout>
<div class="bg-gradient-to-b from-base-200 to-base-300 min-h-0">

    {{-- Header halaman: judul dan tombol kembali ke daftar user --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-600 to-teal-500">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(255,255,255,0.12),transparent_70%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_right,rgba(16,185,129,0.2),transparent_60%)]"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <div class="flex items-center gap-2.5 mb-1">
                        <span class="w-8 h-0.5 rounded-full bg-emerald-300/60"></span>
                        <span class="text-emerald-200/80 text-xs font-bold uppercase tracking-widest">Konten</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Edit User</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Perbarui informasi data user</p>
                </div>
                {{-- Tombol kembali ke halaman daftar user --}}
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 pb-12 space-y-6">
        {{-- User info + form card --}}
        {{-- Kartu utama: informasi singkat user + form edit --}}
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            {{-- Info user: avatar, nama, email, tanggal bergabung --}}
            <div class="p-5 flex items-center gap-4 border-b border-base-200">
                <div class="avatar">
                    <div class="w-12 h-12 rounded-full ring ring-base-300 ring-offset-1">
                        {{-- Tampilkan foto avatar user jika ada, selain itu placeholder ui-avatars --}}
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=b3e093&color=5c8148&bold=true&size=64" alt="">
                        @endif
                    </div>
                </div>
                <div>
                    <p class="font-bold text-base-content">{{ $user->name }}</p>
                    <p class="text-sm text-base-content/60">{{ $user->email }}</p>
                    <p class="text-xs text-base-content/40">Bergabung {{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <div class="p-6">
                {{-- Menampilkan pesan error validasi jika ada --}}
                @if($errors->any())
                    <x-alert type="error" :errors="$errors->all()" />
                @endif

                {{-- Form update user (metode PUT ke route admin.users.update) --}}
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Kolom: Nama Lengkap --}}
                        <div class="form-control">
                            <label class="label"><span class="label-text font-semibold text-base-content">Nama Lengkap</span></label>
                            <input type="text" name="name" class="input input-bordered" value="{{ old('name', $user->name) }}" required>
                        </div>
                        {{-- Kolom: Email --}}
                        <div class="form-control">
                            <label class="label"><span class="label-text font-semibold text-base-content">Email</span></label>
                            <input type="email" name="email" class="input input-bordered" value="{{ old('email', $user->email) }}" required>
                        </div>
                        {{-- Kolom: No. HP / WhatsApp --}}
                        <div class="form-control">
                            <label class="label"><span class="label-text font-semibold text-base-content">No. HP / WA</span></label>
                            <input type="text" name="phone" class="input input-bordered" value="{{ old('phone', $user->phone) }}" placeholder="081234567890">
                        </div>
                        {{-- Kolom NIK hanya tampil untuk user ber-role donatur --}}
                        @if($user->role === 'donatur')
                        <div class="form-control">
                            <label class="label"><span class="label-text font-semibold text-base-content">NIK</span></label>
                            <input type="text" name="nik" class="input input-bordered" value="{{ old('nik', $user->nik) }}" placeholder="16 digit NIK">
                        </div>
                        @endif
                    </div>

                    {{-- Kolom: Alamat Lengkap (textarea) --}}
                    <div class="form-control mt-4">
                        <label class="label"><span class="label-text font-semibold text-base-content">Alamat Lengkap</span></label>
                        <textarea name="address" class="textarea textarea-bordered" rows="3" placeholder="Alamat lengkap...">{{ old('address', $user->address) }}</textarea>
                    </div>

                    {{-- Kolom: Role (dropdown donatur / admin) --}}
                    <div class="form-control mt-4">
                        <label class="label"><span class="label-text font-semibold text-base-content">Role</span></label>
                        <select name="role" class="select select-bordered">
                            <option value="donatur" {{ $user->role == 'donatur' ? 'selected' : '' }}>Donatur</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    {{-- Area tombol: Kembali (batal) dan Simpan Perubahan --}}
                    <div class="flex items-center justify-between mt-8 pt-4 border-t border-base-200">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm font-bold gap-2">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Kembali
                        </a>
                        <button type="submit" class="btn bg-primary hover:bg-primary/90 text-white border-0 font-bold shadow-sm rounded-lg gap-2">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path d="M5 13l4 4L19 7"/></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-admin-layout>
