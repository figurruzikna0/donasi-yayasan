<x-app-layout>
    <div class="bg-base-200 p-7">

        {{-- Page header --}}
        <div class="flex items-end justify-between gap-3 mb-6 flex-wrap">
            <div>
                <nav class="text-sm text-emerald-500 mb-1">
                    <a href="{{ route('admin.dashboard') }}" class="link link-hover text-emerald-600">Dashboard</a>
                    <span class="mx-1">/</span>
                    <span class="text-emerald-600">Profil Yayasan</span>
                </nav>
                <h1 class="text-2xl font-black text-emerald-700">Profil & Berkas Yayasan</h1>
                <p class="text-sm text-emerald-500 mt-1">Kelola informasi dasar, visi misi, dokumen resmi, dan data pendiri.</p>
            </div>
        </div>

        {{-- Flash --}}
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

        {{-- ══ TAB SWITCHER ══ --}}
        <div class="tabs tabs-box bg-base-100 border border-emerald-200 mb-5 w-fit">
            <button class="tab tab-active font-bold text-emerald-700" id="tab-profil" onclick="switchProfilTab('profil')">
                Profil Yayasan
            </button>
            <button class="tab font-bold text-emerald-600" id="tab-pendiri" onclick="switchProfilTab('pendiri')">
                Pendiri & Pengurus
                <span class="badge badge-sm ml-1">{{ $pendiris->count() }}</span>
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
                <div class="card bg-base-100 shadow-md border border-emerald-200 mb-5">
                    <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-lg">🏢</div>
                        <div>
                            <h3 class="text-white font-bold text-lg">Informasi Dasar</h3>
                            <p class="text-white/80 text-sm">Nama, kontak, logo, dan alamat yayasan</p>
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
                                <label class="label"><span class="label-text font-bold text-emerald-700">Logo Yayasan <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                                <div class="relative">
                                    <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" for="logo-input">
                                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <span id="logo-label" class="text-sm text-emerald-600 font-semibold">Pilih file logo…</span>
                                    </label>
                                    <input type="file" name="logo" id="logo-input" accept="image/*" class="hidden" onchange="document.getElementById('logo-label').textContent=this.files[0]?.name||'Pilih file logo…'">
                                </div>
                                <p class="text-xs text-emerald-400 mt-1">PNG/JPG transparan lebih baik · Maks 1MB</p>
                                @if($profil?->logo)
                                    <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo" class="w-12 h-12 rounded-full object-cover border-2 border-emerald-300 mt-2">
                                @endif
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
                <div class="card bg-base-100 shadow-md border border-emerald-200 mb-5">
                    <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-lg">📖</div>
                        <div>
                            <h3 class="text-white font-bold text-lg">Sejarah, Visi & Misi</h3>
                            <p class="text-white/80 text-sm">Narasi dan arah gerak yayasan</p>
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

                {{-- CARD 3: Berkas Visual --}}
                <div class="card bg-base-100 shadow-md border border-emerald-200 mb-5">
                    <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-lg">📂</div>
                        <div>
                            <h3 class="text-white font-bold text-lg">Berkas Resmi & Transparansi</h3>
                            <p class="text-white/80 text-sm">Dokumen legalitas dan bagan struktur organisasi</p>
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
                                        <img src="{{ asset('storage/' . $profil->foto_legalitas) }}" class="max-h-36 mx-auto rounded-lg" alt="Legalitas">
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
                                        <img src="{{ asset('storage/' . $profil->foto_struktur) }}" class="max-h-36 mx-auto rounded-lg" alt="Struktur">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mb-10">
                    <a href="{{ route('admin.profil.index') }}" class="btn btn-outline">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-success">
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
            <div class="card bg-base-100 shadow-md border border-emerald-200 mb-5">
                <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-lg">👥</div>
                    <div>
                        <h3 class="text-white font-bold text-lg">Daftar Pendiri Saat Ini</h3>
                        <p class="text-white/80 text-sm">{{ $pendiris->count() }} orang terdaftar dan tampil di halaman publik</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        @forelse($pendiris as $pendiri)
                            <div class="flex items-start gap-3 p-4 border border-emerald-200 rounded-xl bg-emerald-50 hover:border-emerald-300 hover:bg-white transition-all">
                                @if($pendiri->foto)
                                    <img src="{{ asset('storage/' . $pendiri->foto) }}" class="w-12 h-12 rounded-xl object-cover border-2 border-emerald-300 flex-shrink-0" alt="{{ $pendiri->nama }}">
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-emerald-200 text-emerald-700 font-bold flex items-center justify-center flex-shrink-0">{{ strtoupper(substr($pendiri->nama, 0, 1)) }}</div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-emerald-700 text-sm">{{ $pendiri->nama }}</p>
                                    <p class="text-xs font-semibold text-emerald-500">{{ $pendiri->jabatan }}</p>
                                    @if($pendiri->deskripsi)
                                        <p class="text-xs text-emerald-400 italic mt-1 line-clamp-2">"{{ $pendiri->deskripsi }}"</p>
                                    @endif
                                </div>
                                <form action="{{ route('admin.pendiri.destroy', $pendiri->id) }}" method="POST" onsubmit="return confirm('Hapus data pendiri ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm text-emerald-400 hover:text-red-500" title="Hapus">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50">
                                <p class="font-bold text-emerald-700">Belum Ada Data Pendiri</p>
                                <p class="text-sm text-emerald-500 mt-1">Tambahkan pendiri pertama lewat form di bawah.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Form tambah pendiri --}}
            <form action="{{ route('admin.pendiri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card bg-base-100 shadow-md border border-emerald-200 mb-10">
                    <div class="bg-gradient-to-r from-emerald-700 via-emerald-500 to-emerald-400 p-5 flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center text-lg">➕</div>
                        <div>
                            <h3 class="text-white font-bold text-lg">Tambah Pendiri Baru</h3>
                            <p class="text-white/80 text-sm">Lengkapi data berikut untuk menambahkan pendiri atau pengurus baru</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Nama Lengkap</span></label>
                                <input type="text" name="nama" class="input input-bordered w-full" required value="{{ old('nama') }}" placeholder="Nama lengkap">
                                @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Jabatan</span></label>
                                <input type="text" name="jabatan" class="input input-bordered w-full" required value="{{ old('jabatan') }}" placeholder="Ketua Yayasan">
                                @error('jabatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-control mt-4">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Kata Sambutan <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                            <textarea name="deskripsi" rows="3" class="textarea textarea-bordered w-full" placeholder="Kata sambutan singkat…">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-control mt-4">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Foto</span></label>
                            <div class="relative">
                                <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" for="pendiri-foto-input">
                                    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-emerald-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    <span id="pendiri-foto-label" class="text-sm text-emerald-600 font-semibold">Pilih foto pendiri…</span>
                                </label>
                                <input type="file" name="foto" id="pendiri-foto-input" accept="image/*" class="hidden" onchange="document.getElementById('pendiri-foto-label').textContent=this.files[0]?.name||'Pilih foto pendiri…'">
                            </div>
                            <p class="text-xs text-emerald-400 mt-1">JPG/PNG · Maks 1MB</p>
                            @error('foto') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mb-10">
                    <button type="reset" class="btn btn-outline" onclick="document.getElementById('pendiri-foto-label').textContent='Pilih foto pendiri…'">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 109-9 9.75 9.75 0 00-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                        Reset Form
                    </button>
                    <button type="submit" class="btn btn-success">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                        Tambah Pendiri
                    </button>
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
</x-app-layout>
