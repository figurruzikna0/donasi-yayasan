<!-- ============================================ -->
<!-- admin\campaigns\index.blade.php              -->
<!-- Halaman daftar kampanye donasi (CRUD)        -->
<!-- Dipakai oleh Admin\CampaignController@index  -->
<!-- Alur: menampilkan statistik kampanye, filter -->
<!-- status (Semua/Aktif/Selesai) via Alpine,     -->
<!-- dan tabel kampanye dengan aksi per baris     -->
<!-- ============================================ -->
<x-admin-layout>
<div class="bg-gradient-to-b from-base-200 to-base-300 min-h-0">

    <!-- Header halaman: judul dan tombol tambah kampanye -->
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
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Daftar Kampanye Donasi</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Kelola program donasi untuk memberikan dampak lebih luas.</p>
                </div>
                <!-- Tombol menuju halaman create kampanye -->
                <a href="{{ route('admin.campaigns.create') }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-4 h-4"><path d="M12 4v16m8-8H4"/></svg>
                    Tambah Kampanye
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 pb-12 space-y-6">

        {{-- Summary Cards --}}
        <!-- ============================================ -->
        <!-- Kartu ringkasan statistik kampanye:          -->
        <!-- 1. Total kampanye (semua data $campaigns)    -->
        <!-- 2. Kampanye aktif (status 'active')          -->
        <!-- 3. Kampanye tidak aktif (status selain active)-->
        <!-- ============================================ -->
        <div class="grid grid-cols-3 gap-4 max-sm:grid-cols-1">
            <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Total Kampanye</div>
                    <div class="text-2xl font-black text-base-content mt-0.5">{{ $campaigns->count() }}</div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <div class="text-[0.65rem] font-bold uppercase tracking-widest text-base-content/40">Aktif</div>
                    <div class="text-2xl font-black text-base-content mt-0.5">{{ $campaigns->where('status', 'active')->count() }}</div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
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
        <!-- ============================================ -->
        <!-- Kartu tabel daftar kampanye. Memakai Alpine   -->
        <!-- x-data { cFilter: 'all' } untuk filter tab    -->
        <!-- status tanpa reload (baris disaring via       -->
        <!-- x-show berdasarkan nilai cFilter)             -->
        <!-- ============================================ -->
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden" x-data="{ cFilter: 'all' }">
            <div class="px-6 py-4 border-b border-base-200 flex items-center justify-between gap-3 flex-wrap">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-lg shrink-0">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38a.496.496 0 01-.661-.19 12.813 12.813 0 01-1.127-3.626m2.923-2.858a9.292 9.292 0 00-2.923 2.858m2.923-2.858a9.538 9.538 0 012.645-2.077 9.118 9.118 0 013.424-1.003M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    <div>
                        <p class="font-extrabold text-sm text-base-content">Daftar Kampanye Donasi</p>
                        <p class="text-xs text-base-content/50">Seluruh kampanye donasi yang terdaftar di sistem</p>
                    </div>
                </div>
                {{-- Filter tabs --}}
                <!-- Tab filter status: mengubah nilai cFilter pada -->
                <!-- klik; baris tabel disaring otomatis oleh x-show -->
                <div class="flex gap-1 flex-wrap">
                    <button @click="cFilter = 'all'" :class="cFilter === 'all' ? 'bg-primary text-white shadow-sm' : 'bg-base-200 text-base-content/60 hover:bg-base-300'" class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all">Semua</button>
                    <button @click="cFilter = 'active'" :class="cFilter === 'active' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100'" class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all">Aktif</button>
                    <button @click="cFilter = 'completed'" :class="cFilter === 'completed' ? 'bg-rose-600 text-white shadow-sm' : 'bg-rose-50 text-rose-600 hover:bg-rose-100'" class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all">Selesai</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <!-- Header kolom: Gambar, Detail Kampanye, Status, Aksi -->
                        <tr class="bg-base-200/50">
                            <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">Gambar</th>
                            <th class="text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">Detail Kampanye</th>
                            <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">Status</th>
                            <th class="text-center text-[0.65rem] font-extrabold uppercase tracking-widest text-base-content/40 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- forelse: tampilkan baris tiap kampanye; baris -->
                        <!-- disaring oleh x-show sesuai nilai cFilter -->
                        @forelse($campaigns as $campaign)
                            <tr x-show="cFilter === 'all' || cFilter === '{{ $campaign->status }}'" x-transition:enter.duration.200ms class="hover:bg-base-200/30 transition-colors">
                                <td>
                                    <!-- Gambar kampanye dari folder storage -->
                                    <div class="avatar">
                                        <div class="w-16 h-12 rounded-lg ring ring-base-300 ring-offset-1">
                                            <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="object-cover">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <!-- Judul kampanye dan target dana (diformat ribuan) -->
                                    <span class="font-bold text-sm text-base-content whitespace-nowrap">{{ $campaign->title }}</span>
                                    <div class="flex items-center gap-1.5 text-sm font-semibold text-base-content/60 mt-1 whitespace-nowrap">
                                        <svg class="w-3.5 h-3.5 text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Target: <strong class="text-base-content">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</strong>
                                    </div>
                                </td>
                                <td class="text-center whitespace-nowrap">
                                    <!-- Badge status: hijau "Aktif" bila active, merah "Tidak Aktif" bila lainnya -->
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
                                    <!-- Tombol aksi per baris: Detail, Edit, Hapus -->
                                    <div class="flex items-center justify-center gap-1 whitespace-nowrap">
                                        <!-- Tombol melihat detail kampanye -->
                                        <a href="{{ route('admin.campaigns.show', $campaign->id) }}" class="btn btn-sm btn-ghost text-base-content/50 hover:text-primary hover:bg-primary/5 rounded-lg font-bold">
                                            Detail
                                        </a>
                                        <!-- Tombol mengubah kampanye -->
                                        <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn btn-sm btn-ghost text-base-content/50 hover:text-warning hover:bg-warning/5 rounded-lg font-bold">
                                            Edit
                                        </a>
                                        <!-- Form hapus kampanye: method DELETE; submit dicegah -->
                                        <!-- lalu memunculkan modal konfirmasi (Alpine x-data 'open') -->
                                        <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" method="POST" x-data="{ open: false }" @submit.prevent="open = true">
                                            @csrf @method('DELETE')
                                            <button type="button" @click="open = true" class="btn btn-sm btn-ghost text-base-content/50 hover:text-error hover:bg-error/5 rounded-lg font-bold">
                                                Hapus
                                            </button>
                                            <!-- Modal konfirmasi hapus kampanye (komponen reusable) -->
                                            <x-confirm-delete-modal entity-name="{{ $campaign->title }}" entity-type="kampanye" />
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <!-- Kondisi daftar kosong: baris tetap tampil saat filter "Semua" -->
                            <tr x-show="cFilter === 'all'">
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
