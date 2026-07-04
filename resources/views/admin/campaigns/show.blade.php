<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">
            Detail Kampanye
        </h2>
    </x-slot>

    <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="card bg-base-100 shadow-lg border border-emerald-200">

                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white text-lg">💰</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Detail Kampanye</h3>
                        <p class="text-white/80 text-sm">{{ $campaign->title }}</p>
                    </div>
                </div>

                <div class="card-body p-8 space-y-6">

                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold">Judul Kampanye</p>
                            <p class="text-lg font-bold text-emerald-700">{{ $campaign->title }}</p>
                        </div>
                        <span class="badge {{ $campaign->status == 'active' ? 'badge-success' : 'badge-ghost' }} badge-lg">
                            {{ $campaign->status == 'active' ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>

                    @if($campaign->image)
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-2">Gambar</p>
                            <img src="{{ asset('storage/' . $campaign->image) }}" class="w-full max-h-64 object-cover rounded-xl border border-emerald-200" alt="{{ $campaign->title }}">
                        </div>
                    @endif

                    <div>
                        <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold mb-1">Deskripsi</p>
                        <div class="text-sm text-base-content/70 bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            {{ $campaign->description }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Target Dana</p>
                            <p class="text-xl font-black text-emerald-700">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                            <p class="text-xs text-emerald-500 font-bold uppercase tracking-wider">Terkumpul</p>
                            <p class="text-xl font-black text-emerald-700">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</p>
                            @if($campaign->target_amount > 0)
                                <progress class="progress progress-success w-full mt-2" value="{{ $campaign->collected_amount }}" max="{{ $campaign->target_amount }}"></progress>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold">Slug</p>
                            <p class="text-base-content/70">{{ $campaign->slug }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-500 font-bold">Dibuat</p>
                            <p class="text-base-content/70">{{ $campaign->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-emerald-100">
                        <a href="{{ route('admin.campaigns.edit', $campaign) }}" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-0 font-bold">
                            ✏️ Edit Kampanye
                        </a>
                        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline border-emerald-300 text-emerald-600 font-bold">
                            ← Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>