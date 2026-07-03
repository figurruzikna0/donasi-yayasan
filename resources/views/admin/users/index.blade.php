<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Kelola Data User
        </h2>
    </x-slot>

    <div class="bg-base-200 p-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-end justify-between gap-3 mb-7 flex-wrap">
                <div>
                    <nav class="text-sm text-emerald-500 mb-1">
                        <a href="{{ route('admin.dashboard') }}" class="link link-hover text-emerald-600">Dashboard</a>
                        <span class="mx-1">/</span>
                        <span class="text-emerald-600">Data User</span>
                    </nav>
                    <h1 class="text-2xl font-black text-emerald-700">Data Seluruh User</h1>
                    <p class="text-sm text-emerald-500 mt-1">Kelola data donatur dan admin yang terdaftar.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success mb-5">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error mb-5">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="card bg-base-100 shadow-md border border-emerald-200">
                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-4 flex items-center gap-3">
                    <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center text-lg">👥</div>
                    <div>
                        <p class="text-white font-extrabold text-sm">User Terdaftar</p>
                        <p class="text-white/75 text-xs">Total: {{ $users->total() }} akun</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="w-9 rounded-full">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=b3e093&color=5c8148&bold=true" alt="">
                                                </div>
                                            </div>
                                            <div class="font-bold text-sm text-emerald-700">{{ $user->name }}</div>
                                        </div>
                                    </td>
                                    <td class="text-sm">{{ $user->email }}</td>
                                    <td class="text-sm">{{ $user->phone ?? '-' }}</td>
                                    <td>
                                        @if($user->isAdmin())
                                            <span class="badge badge-error badge-sm">Admin</span>
                                        @else
                                            <span class="badge badge-success badge-sm">Donatur</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->email_verified_at)
                                            <span class="badge badge-success badge-sm">Terverifikasi</span>
                                        @else
                                            <span class="badge badge-ghost badge-sm">Belum Verifikasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-ghost">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-3.5 h-3.5"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                Edit
                                            </a>
                                            @if(!$user->isAdmin())
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                      onsubmit="return confirm('Hapus user {{ $user->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-error">
                                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-3.5 h-3.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-10 text-base-content/60">Belum ada user terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($users->hasPages())
                    <div class="p-4 border-t border-emerald-100">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
