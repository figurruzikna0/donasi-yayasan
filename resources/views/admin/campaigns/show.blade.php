<!-- ============================================ -->
<!-- admin\campaigns\show.blade.php               -->
<!-- Halaman detail satu kampanye donasi          -->
<!-- Dipakai oleh Admin\CampaignControllershow   -->
<!-- Alur: menampilkan atribut $campaign (judul,  -->
<!-- status, gambar, deskripsi, target, terkumpul,-->
<!-- slug, dibuat) plus tombol Edit & Kembali     -->
<!-- ============================================ -->
<x-admin-layout>
<div class="bg-gradient-to-b from-base-200 to-base-300 min-h-0">

    <!-- Header halaman detail kampanye -->
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-600 to-teal-500">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(255,255,255,0.12),transparent_70%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_right,rgba(16,185,129,0.2),transparent_60%)]"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <div class="flex items-center gap-2.5 mb-1">
                        <span class="w-8 h-0.5 rounded-full bg-emerald-300/60"></span>
                        <span class="text-emerald-200/80 text-xs font-bold uppercase tracking-widest">Konten</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Detail Kampanye</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">{{ $campaign?->title ?? 'Kampanye tidak ditemukan' }}</p>
                </div>
                <div class="flex gap-2">
                    <!-- Tombol Edit hanya tampil bila data $campaign tersedia -->
                    @if($campaign)
                        <a href="{{ route('admin.campaigns.edit', $campaign) }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-amber-600 font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit
                        </a>
                    @endif
                    <!-- Tombol kembali ke daftar kampanye -->
                    <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline border-white/40 text-white hover:bg-white hover:text-emerald-700 font-bold rounded-xl gap-2 backdrop-blur-sm bg-white/5">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" class="w-4 h-4"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 pb-12 space-y-6">

        <!-- Kondisi if(!$campaign): tampilkan pesan error bila data tidak ditemukan -->
        @if(!$campaign)
            <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-red-200">
                <div class="px-8 py-12 text-center">
                    <p class="text-red-500 font-bold text-lg">Kampanye tidak ditemukan</p>
                    <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline border-emerald-300 text-emerald-600 font-bold mt-4">← Kembali</a>
                </div>
            </div>
        @else

        <!-- Kartu utama detail kampanye -->
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-base-200 overflow-hidden">
            <div class="px-8 py-6 space-y-6">

                <!-- Baris judul kampanye dan badge status -->
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-base-content/40 font-bold">Judul Kampanye</p>
                        <p class="text-lg font-bold text-emerald-700">{{ $campaign->title }}</p>
                    </div>
                    <!-- Badge status: hijau "Aktif" bila active, abu-abu bila nonaktif -->
                    <span class="badge {{ $campaign->status == 'active' ? 'badge-success' : 'badge-ghost' }} badge-lg">
                        {{ $campaign->status == 'active' ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>

                <!-- Gambar kampanye (tampil bila ada) -->
                @if($campaign->image)
                    <div>
                        <p class="text-xs uppercase tracking-wider text-base-content/40 font-bold mb-2">Gambar</p>
                        <img src="{{ asset('storage/' . $campaign->image) }}" class="w-full max-h-64 object-cover rounded-xl border border-base-200" alt="{{ $campaign->title }}">
                    </div>
                @endif

                <!-- Deskripsi kampanye -->
                <div>
                    <p class="text-xs uppercase tracking-wider text-base-content/40 font-bold mb-1">Deskripsi</p>
                    <div class="text-sm text-base-content/70 bg-base-200 rounded-xl p-4 border border-base-200">
                        {{ $campaign->description }}
                    </div>
                </div>

                <!-- Grid target dana dan dana terkumpul -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                        <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Target Dana</p>
                        <!-- Target dana diformat dengan pemisah ribuan -->
                        <p class="text-xl font-black text-emerald-700">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                        <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Terkumpul</p>
                        <p class="text-xl font-black text-emerald-700">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</p>
                        <!-- Progress bar pencapaian dana; hanya tampil bila target > 0 -->
                        @if($campaign->target_amount > 0)
                            <progress class="progress progress-success w-full mt-2" value="{{ $campaign->collected_amount }}" max="{{ $campaign->target_amount }}"></progress>
                        @endif
                    </div>
                </div>

                <!-- Metadata: slug dan waktu pembuatan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-base-content/40 font-bold">Slug</p>
                        <p class="text-base-content/70">{{ $campaign->slug }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-base-content/40 font-bold">Dibuat</p>
                        <p class="text-base-content/70">{{ $campaign->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

            </div>
        </div>
        @endif
    </div>
</div>
</x-admin-layout>
