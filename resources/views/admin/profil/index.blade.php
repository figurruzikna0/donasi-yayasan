<x-admin-layout>
    <div class="bg-base-200 min-h-screen">

        {{-- Page header --}}
        <div class="px-8 pt-8 pb-0">
            <div class="flex items-end justify-between gap-3 mb-2 flex-wrap">
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </span>
                        <div>
                            <h1 class="text-2xl font-black text-base-content">Profil & Berkas Yayasan</h1>
                            <p class="text-sm text-base-content/50">Kelola informasi dasar, visi misi, dokumen resmi, dan data pendiri.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 pt-6 space-y-6">

        {{-- ══ TAB SWITCHER ══ --}}
        <div class="flex gap-1 bg-white rounded-xl p-1.5 shadow-sm border border-base-300 w-fit">
            <button class="px-4 py-2 rounded-lg text-sm font-bold transition-all duration-200 bg-primary text-white shadow-sm" id="tab-profil" onclick="switchProfilTab('profil')">
                Profil Yayasan
            </button>
            <button class="px-4 py-2 rounded-lg text-sm font-bold transition-all duration-200 text-base-content/50 hover:text-base-content hover:bg-base-200" id="tab-pendiri" onclick="switchProfilTab('pendiri')">
                Pendiri & Pengurus
                    <span class="ml-1.5 px-2 py-0.5 rounded-full text-xs bg-base-300">{{ $pendiris->total() }}</span>
            </button>
        </div>

        {{-- ══════════════════════════════
             TAB 1: PROFIL YAYASAN
        ══════════════════════════════ --}}
        <div id="panel-profil" class="tab-panel">
            <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- CARD 1: Info Dasar --}}
                <div class="bg-white rounded-xl shadow-sm border border-base-300 mb-5 overflow-hidden">
                    <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">🏢</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">Informasi Dasar</p>
                            <p class="text-xs text-base-content/50">Nama, kontak, logo, dan alamat yayasan</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Nama Yayasan</span></label>
                                <input type="text" name="nama_yayasan" class="input input-bordered w-full" required
                                       value="{{ old('nama_yayasan', $profil?->nama_yayasan) }}" placeholder="Yayasan Baitul Yatim">
                                @error('nama_yayasan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Email Resmi</span></label>
                                <input type="email" name="email" class="input input-bordered w-full" required
                                       value="{{ old('email', $profil?->email) }}" placeholder="info@yayasan.org">
                                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">No. Telepon / WhatsApp</span></label>
                                <input type="text" name="no_telp" class="input input-bordered w-full" required
                                       value="{{ old('no_telp', $profil?->no_telp) }}" placeholder="08123456789">
                                @error('no_telp') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Logo Yayasan</span></label>
                                <div class="relative">
                                    <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" for="logo-input">
                                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span id="logo-label" class="text-sm text-emerald-600 font-semibold">Pilih foto logo…</span>
                                    </label>
                                    <input type="file" name="logo" id="logo-input" accept="image/*" class="hidden" onchange="document.getElementById('logo-label').textContent=this.files[0]?.name||'Pilih foto logo…'">
                                </div>
                                <p class="text-xs text-emerald-400 mt-1">JPG/PNG · Maks 2MB</p>
                                @if($profil?->logo)
                                    <div class="mt-2 p-2 border border-emerald-200 rounded-xl bg-emerald-50 inline-block">
                                        <img src="{{ asset('storage/' . $profil->logo) . '?v=' . now()->timestamp }}" class="max-h-16 rounded-lg" alt="Logo saat ini">
                                    </div>
                                @endif
                                @error('logo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-control mt-4">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Alamat Lengkap</span></label>
                            <textarea name="alamat" rows="2" class="textarea textarea-bordered w-full" required placeholder="Jl. Kebaikan No. 1, Kota...">{{ old('alamat', $profil?->alamat) }}</textarea>
                            @error('alamat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- CARD 2: Sejarah, Visi, Misi --}}
                <div class="bg-white rounded-xl shadow-sm border border-base-300 mb-5 overflow-hidden">
                    <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">📖</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">Sejarah, Visi & Misi</p>
                            <p class="text-xs text-base-content/50">Narasi dan arah gerak yayasan</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-control mb-4">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Sejarah / Deskripsi Yayasan</span></label>
                            <textarea name="sejarah_yayasan" rows="5" class="textarea textarea-bordered w-full" required placeholder="Ceritakan bagaimana yayasan ini berdiri dan berkembang…">{{ old('sejarah_yayasan', $profil?->sejarah_yayasan) }}</textarea>
                            @error('sejarah_yayasan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Visi</span></label>
                                <textarea name="visi" rows="4" class="textarea textarea-bordered w-full" required placeholder="Menjadi lembaga amanah…">{{ old('visi', $profil?->visi) }}</textarea>
                                @error('visi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Misi <span class="font-normal normal-case text-emerald-400">(gunakan Enter untuk poin baru)</span></span></label>
                                <textarea name="misi" rows="4" class="textarea textarea-bordered w-full" required placeholder="• Memberikan pendidikan terbaik&#10;• Mengelola amanah dengan transparan">{{ old('misi', $profil?->misi) }}</textarea>
                                @error('misi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD 4: Berkas Visual --}}
                <div class="bg-white rounded-xl shadow-sm border border-base-300 mb-5 overflow-hidden">
                    <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">📂</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">Berkas Resmi & Transparansi</p>
                            <p class="text-xs text-base-content/50">Dokumen legalitas dan bagan struktur organisasi</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Surat Legalitas Resmi <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                                <div class="relative">
                                    <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" for="legalitas-input">
                                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span id="legalitas-label" class="text-sm text-emerald-600 font-semibold">Pilih foto dokumen…</span>
                                    </label>
                                    <input type="file" name="foto_legalitas" id="legalitas-input" accept="image/*" class="hidden" onchange="document.getElementById('legalitas-label').textContent=this.files[0]?.name||'Pilih foto dokumen…'">
                                </div>
                                <p class="text-xs text-emerald-400 mt-1">JPG / PNG · Maks 2MB</p>
                                @if($profil?->foto_legalitas)
                                    <div class="mt-2 p-2 border border-emerald-200 rounded-xl bg-emerald-50">
                                        <p class="text-xs text-emerald-400 font-semibold text-center mb-1">Berkas saat ini</p>
                                        <img src="{{ asset('storage/' . $profil->foto_legalitas) . '?v=' . now()->timestamp }}" class="max-h-36 mx-auto rounded-lg" alt="Legalitas">
                                    </div>
                                @endif
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Bagan Struktur Organisasi <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                                <div class="relative">
                                    <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" for="struktur-input">
                                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span id="struktur-label" class="text-sm text-emerald-600 font-semibold">Pilih foto bagan…</span>
                                    </label>
                                    <input type="file" name="foto_struktur" id="struktur-input" accept="image/*" class="hidden" onchange="document.getElementById('struktur-label').textContent=this.files[0]?.name||'Pilih foto bagan…'">
                                </div>
                                <p class="text-xs text-emerald-400 mt-1">JPG / PNG · Maks 2MB</p>
                                @if($profil?->foto_struktur)
                                    <div class="mt-2 p-2 border border-emerald-200 rounded-xl bg-emerald-50">
                                        <p class="text-xs text-emerald-400 font-semibold text-center mb-1">Berkas saat ini</p>
                                        <img src="{{ asset('storage/' . $profil->foto_struktur) . '?v=' . now()->timestamp }}" class="max-h-36 mx-auto rounded-lg" alt="Struktur">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('admin.profil.index') }}" class="btn btn-ghost font-bold">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn bg-primary hover:bg-primary/90 text-white border-0 font-bold rounded-lg">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>

        {{-- ══════════════════════════════
             TAB 2: PENDIRI & PENGURUS
        ══════════════════════════════ --}}
        <div id="panel-pendiri" class="tab-panel hidden">

            {{-- Daftar pendiri saat ini --}}
            <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden">
                <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">👥</div>
                    <div>
                        <p class="font-extrabold text-sm text-base-content">Daftar Pendiri Saat Ini</p>
                        <p class="text-xs text-base-content/50">{{ $pendiris->count() }} orang terdaftar dan tampil di halaman publik</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                        @forelse($pendiris as $pendiri)
                            <div class="group bg-white rounded-xl shadow-sm border border-base-200 overflow-hidden hover:shadow-md transition-all duration-200">
                                <div class="px-5 pt-5 pb-0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center gap-4">
                                            @if($pendiri->foto)
                                                <img src="{{ asset('storage/' . $pendiri->foto) . '?v=' . now()->timestamp }}" class="w-14 h-14 rounded-xl object-cover shadow-sm ring-2 ring-base-300" alt="{{ $pendiri->nama }}">
                                            @else
                                                <div class="w-14 h-14 rounded-xl bg-primary text-white font-extrabold text-lg flex items-center justify-center shadow-sm">{{ strtoupper(substr($pendiri->nama, 0, 1)) }}</div>
                                            @endif
                                            <div>
                                                <p class="font-bold text-sm text-base-content">{{ $pendiri->nama }}</p>
                                                <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-primary bg-primary/10 px-2 py-0.5 rounded-full mt-1">{{ $pendiri->jabatan }}</span>
                                            </div>
                                        </div>
                                        <form action="{{ route('admin.pendiri.destroy', $pendiri->id) }}" method="POST"
                                              x-data="{ open: false }" @submit.prevent="open = true">
                                            @csrf @method('DELETE')
                                            <button type="button" @click="open = true" class="btn btn-ghost btn-sm btn-circle text-base-content/20 hover:text-error hover:bg-error/5 opacity-0 group-hover:opacity-100 transition-all" title="Hapus">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                            </button>
                                            <x-confirm-delete-modal entity-name="{{ $pendiri->nama }}" entity-type="pengurus" />
                                        </form>
                                    </div>
                                </div>
                                <div class="px-5 pb-5 pt-3">
                                    @if($pendiri->deskripsi)
                                        <div class="bg-base-200/50 rounded-lg p-3 border border-base-200">
                                            <svg class="w-3 h-3 text-base-content/30 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151C7.546 6.068 5.983 8.789 5.983 11H10v10H0z"/></svg>
                                            <p class="text-xs text-base-content/60 italic leading-relaxed">"{{ $pendiri->deskripsi }}"</p>
                                        </div>
                                    @else
                                        <div class="bg-base-200/50 rounded-lg p-3 border border-base-200">
                                            <p class="text-xs text-base-content/40 italic">Tidak ada kata sambutan</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12 border-2 border-dashed border-base-300 rounded-xl bg-base-100">
                                <div class="text-4xl mb-3">👥</div>
                                <p class="font-bold text-base-content">Belum Ada Data Pendiri</p>
                                <p class="text-sm text-base-content/50 mt-1">Tambahkan pendiri pertama lewat form di bawah.</p>
                            </div>
                        @endforelse
                    </div>
                    {{ $pendiris->links() }}
                </div>
            </div>

            {{-- Form tambah pendiri --}}
            <form action="{{ route('admin.pendiri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="bg-white rounded-xl shadow-sm border border-base-300 overflow-hidden mb-10">
                    <div class="px-6 py-4 border-b border-base-200 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center text-base shrink-0">➕</div>
                        <div>
                            <p class="font-extrabold text-sm text-base-content">Tambah Pendiri Baru</p>
                            <p class="text-xs text-base-content/50">Lengkapi data berikut untuk menambahkan pendiri atau pengurus baru</p>
                        </div>
                    </div>
                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Nama Lengkap</span></label>
                                <input type="text" name="nama" class="input input-bordered w-full focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200" required value="{{ old('nama') }}" placeholder="Nama lengkap">
                                @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Jabatan</span></label>
                                <input type="text" name="jabatan" class="input input-bordered w-full focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200" required value="{{ old('jabatan') }}" placeholder="Ketua Yayasan">
                                @error('jabatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Kata Sambutan <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                            <textarea name="deskripsi" rows="3" class="textarea textarea-bordered w-full focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200" placeholder="Kata sambutan singkat…">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Foto</span></label>
                            <div class="relative">
                                <label class="flex items-center gap-3 p-4 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50/50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all group" for="pendiri-foto-input">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-200 transition-colors">
                                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-600"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </div>
                                    <div>
                                        <span id="pendiri-foto-label" class="text-sm font-semibold text-emerald-700">Pilih foto pendiri</span>
                                        <p class="text-xs text-emerald-400">JPG/PNG · Maks 1MB</p>
                                    </div>
                                </label>
                                <input type="file" name="foto" id="pendiri-foto-input" accept="image/*" class="hidden" onchange="document.getElementById('pendiri-foto-label').textContent=this.files[0]?.name||'Pilih foto pendiri'">
                            </div>
                            @error('foto') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-3 border-t border-emerald-100">
                            <button type="reset" class="btn btn-outline btn-sm" onclick="document.getElementById('pendiri-foto-label').textContent='Pilih foto pendiri'">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 109-9 9.75 9.75 0 00-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-success btn-sm">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                                Tambah Pendiri
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script>
    function switchProfilTab(tab) {
        const tabs = ['profil', 'pendiri'];
        tabs.forEach(t => {
            document.getElementById('tab-' + t).classList.toggle('tab-active', t === tab);
            document.getElementById('panel-' + t).classList.toggle('hidden', t !== tab);
        });
    }

    @if($errors->has('nama') || $errors->has('jabatan') || $errors->has('foto'))
        document.addEventListener('DOMContentLoaded', () => switchProfilTab('pendiri'));
    @endif
    </script>
</x-admin-layout>
