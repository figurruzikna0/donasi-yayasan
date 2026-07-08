<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Edit Data User
        </h2>
    </x-slot>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-lg border border-emerald-200">
                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-lg">👤</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Edit User: {{ $user->name }}</h3>
                        <p class="text-white/75 text-sm">Perbarui informasi data user</p>
                    </div>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <x-alert type="error" :errors="$errors->all()" />
                    @endif

                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="flex items-center gap-4 mb-5 pb-4 border-b border-emerald-100">
                            <div class="avatar">
                                <div class="w-16 h-16 rounded-full ring ring-emerald-200 ring-offset-2">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="object-cover">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=b3e093&color=5c8148&bold=true&size=64" alt="">
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="font-bold text-emerald-700">{{ $user->name }}</p>
                                <p class="text-sm text-emerald-500">{{ $user->email }}</p>
                                <p class="text-xs text-emerald-400">Bergabung {{ $user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold text-emerald-700">Nama Lengkap</span></label>
                                <input type="text" name="name" class="input input-bordered" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold text-emerald-700">Email</span></label>
                                <input type="email" name="email" class="input input-bordered" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold text-emerald-700">No. HP / WA</span></label>
                                <input type="text" name="phone" class="input input-bordered" value="{{ old('phone', $user->phone) }}" placeholder="081234567890">
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold text-emerald-700">NIK</span></label>
                                <input type="text" name="nik" class="input input-bordered" value="{{ old('nik', $user->nik) }}" placeholder="16 digit NIK">
                            </div>
                        </div>

                        <div class="form-control mt-4">
                            <label class="label"><span class="label-text font-semibold text-emerald-700">Alamat Lengkap</span></label>
                            <textarea name="address" class="textarea textarea-bordered" rows="3" placeholder="Alamat lengkap...">{{ old('address', $user->address) }}</textarea>
                        </div>

                        <div class="form-control mt-4">
                            <label class="label"><span class="label-text font-semibold text-emerald-700">Role</span></label>
                            <select name="role" class="select select-bordered">
                                <option value="donatur" {{ $user->role == 'donatur' ? 'selected' : '' }}>Donatur</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-between mt-8 pt-4 border-t border-emerald-100">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline">← Kembali</a>
                            <button type="submit" class="btn btn-success text-white font-bold">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
