<x-app-layout>
    <div class="bg-gradient-to-r from-primary via-primary to-secondary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-2xl sm:text-3xl font-black">Pengurus Yayasan</h1>
            <p class="text-primary-content/70 text-sm mt-1">Amanah dan berdedikasi tinggi demi kemaslahatan para mustahik.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if($daftarPendiri->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach($daftarPendiri as $person)
                    @php
                        $words = explode(' ', $person->nama);
                        $initials = '';
                        foreach ($words as $w) { $initials .= strtoupper(substr($w, 0, 1)); if (strlen($initials) >= 2) break; }
                    @endphp
                    <div class="card bg-base-100 shadow-md border border-base-200 rounded-2xl p-5 text-center hover:shadow-lg hover:border-primary/20 transition-all duration-300">
                        <div class="avatar mx-auto mb-3">
                            <div class="w-20 rounded-full ring-2 ring-primary/20 ring-offset-2">
                                @if($person->foto)
                                    <img src="{{ asset('storage/' . $person->foto) . '?v=' . now()->timestamp }}" alt="{{ $person->nama }}" class="object-cover">
                                @else
                                    <div class="w-full h-full bg-primary/10 text-primary font-bold flex items-center justify-center text-xl">{{ $initials }}</div>
                                @endif
                            </div>
                        </div>
                        <h3 class="font-bold text-sm text-base-content">{{ $person->nama }}</h3>
                        <p class="text-xs text-primary font-semibold mt-0.5">{{ $person->jabatan ?? 'Pengurus' }}</p>
                        @if($person->deskripsi)
                            <p class="text-xs text-base-content/50 mt-2 leading-relaxed">{{ Str::limit($person->deskripsi, 80) }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 text-sm text-base-content/40 border-2 border-dashed border-base-300 rounded-xl bg-base-200/50">
                Belum ada data pengurus.
            </div>
        @endif
    </div>
</x-app-layout>
