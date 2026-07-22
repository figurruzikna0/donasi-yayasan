{{-- ADMIN_USERS_EDIT: halaman edit data user -- menampilkan form perbarui profil dan role user --}}
<x-admin-layout>
    <div class="bg-base-200 min-h-screen">

        <div class="px-8 pt-8 pb-0">
            <div class="flex items-end justify-between gap-3 mb-2 flex-wrap">
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/></svg>
                        </span>
                        <div>
                            {{-- BAGIAN: judul halaman dan tombol kembali ke daftar user --}}
                            <h1 class="text-2xl font-black text-base-content">Edit User</h1>
                            <p class="text-sm text-base-content/50">Perbarui informasi data user</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm font-bold gap-2">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6 max-w-2xl">
            {{-- BAGIAN: kartu informasi profil user saat ini (foto, nama, email, tanggal bergabung) --}}
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="p-5 flex items-center gap-4 border-b border-base-200">
                    <div class="avatar">
                        <div class="w-12 h-12 rounded-full ring ring-base-300 ring-offset-1">
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
                    @if($errors->any())
                        <x-alert type="error" :errors="$errors->all()" />
                    @endif

                    {{-- BAGIAN: form edit user dengan input nama, email, no HP, alamat, dan role --}}
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold text-base-content">Nama Lengkap</span></label>
                                <input type="text" name="name" class="input input-bordered" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold text-base-content">Email</span></label>
                                <input type="email" name="email" class="input input-bordered" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold text-base-content">No. HP / WA</span></label>
                                <input type="text" name="phone" class="input input-bordered" value="{{ old('phone', $user->phone) }}" placeholder="081234567890">
                            </div>
                            @if($user->role === 'donatur')
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold text-base-content">NIK</span></label>
                                <input type="text" name="nik" class="input input-bordered" value="{{ old('nik', $user->nik) }}" placeholder="16 digit NIK">
                            </div>
                            @endif
                        </div>

                        <div class="form-control mt-4">
                            <label class="label"><span class="label-text font-semibold text-base-content">Alamat Lengkap</span></label>
                            <textarea name="address" class="textarea textarea-bordered" rows="3" placeholder="Alamat lengkap...">{{ old('address', $user->address) }}</textarea>
                        </div>

                        <div class="form-control mt-4">
                            <label class="label"><span class="label-text font-semibold text-base-content">Role</span></label>
                            <select name="role" class="select select-bordered">
                                <option value="donatur" {{ $user->role == 'donatur' ? 'selected' : '' }}>Donatur</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        {{-- BAGIAN: tombol aksi kembali dan simpan perubahan --}}
                        <div class="flex items-center justify-between mt-8 pt-4 border-t border-base-200">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm font-bold gap-2">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Kembali
                            </a>
                            <button type="submit" class="btn bg-primary hover:bg-primary/90 text-white border-0 font-bold shadow-sm rounded-lg gap-2">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 13l4 4L19 7"/></svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
