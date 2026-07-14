<x-admin-layout>
    <div class="bg-base-200 min-h-screen">

        {{-- Page header --}}
        <div class="px-8 pt-8 pb-0">
            <div class="flex items-end justify-between gap-3 mb-2 flex-wrap">
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Daftar Kampanye Donasi</h1>
                            <p class="text-sm text-base-content/50">Kelola program donasi untuk memberikan dampak lebih luas.</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.campaigns.create') }}" class="btn bg-primary hover:bg-primary/90 text-white border-0 font-bold shadow-sm rounded-lg gap-2">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M12 4v16m8-8H4"/></svg>
                    Tambah Kampanye
                </a>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-3 gap-4 max-sm:grid-cols-1">
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Kampanye</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $campaigns->count() }}</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Aktif</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $campaigns->where('status', 'active')->count() }}</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-base-300 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-rose-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                    </div>
                    <div>
                        <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Tidak Aktif</div>
                        <div class="text-2xl font-black text-base-content mt-0.5">{{ $campaigns->where('status', '!=', 'active')->count() }}</div>
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-lg shrink-0">📢</div>
                    <div>
                        <p class="font-extrabold text-sm text-base-content">Daftar Kampanye Donasi</p>
                        <p class="text-xs text-base-content/50">Seluruh kampanye donasi yang terdaftar di sistem</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-base-200/50">
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Gambar</th>
                                <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Detail Kampanye</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Status</th>
                                <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($campaigns as $campaign)
                                <tr class="hover:bg-base-200/30 transition-colors">
                                    <td>
                                        <div class="avatar">
                                            <div class="w-16 h-12 rounded-lg ring ring-base-300 ring-offset-1">
                                                <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="object-cover">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="font-bold text-sm text-base-content">{{ $campaign->title }}</span>
                                        <div class="flex items-center gap-1.5 text-sm font-semibold text-base-content/60 mt-1">
                                            <svg class="w-3.5 h-3.5 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Target: <strong class="text-base-content">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($campaign->status == 'active')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-600">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('admin.campaigns.show', $campaign->id) }}" class="btn btn-sm btn-ghost text-base-content/50 hover:text-primary hover:bg-primary/5 rounded-lg font-bold">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/></svg>
                                                Detail
                                            </a>
                                            <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn btn-sm btn-ghost text-base-content/50 hover:text-warning hover:bg-warning/5 rounded-lg font-bold">
                                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                                @csrf @method('DELETE')
                                                <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold">
                                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                    Hapus
                                                </button>
                                                <x-confirm-delete-modal entity-name="{{ $campaign->title }}" entity-type="kampanye" />
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="py-16 text-center">
                                            <div class="w-16 h-16 bg-base-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-8 h-8 text-base-content/20" fill="none" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            </div>
                                            <p class="font-extrabold text-base-content">Belum ada kampanye donasi</p>
                                            <p class="text-sm text-base-content/50 mt-1">Mulai dengan membuat kampanye donasi pertama untuk yayasan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
