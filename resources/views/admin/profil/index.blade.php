<x-admin-layout>
<div class="bg-gradient-to-b from-slate-50 to-slate-100 min-h-0">

    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-900 via-emerald-700 to-emerald-500">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(255,255,255,0.12),transparent_70%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_right,rgba(16,185,129,0.2),transparent_60%)]"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <div class="flex items-center gap-2.5 mb-1">
                        <span class="w-8 h-0.5 rounded-full bg-emerald-300/60"></span>
                        <span class="text-emerald-200/80 text-xs font-bold uppercase tracking-widest">Konten</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Profil & Berkas Yayasan</h1>
                    <p class="text-emerald-100/80 text-sm mt-1.5">Kelola informasi dasar, visi misi, dokumen resmi, dan data pendiri.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 pb-12 space-y-6">

        {{-- ══ TAB SWITCHER ══ --}}
        <div class="flex gap-1 bg-white rounded-xl p-1.5 shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 w-fit">
            @php $tab = request('tab', 'profil'); @endphp
            <button class="px-4 py-2 rounded-lg text-sm font-bold transition-all duration-200 {{ $tab === 'profil' ? 'bg-emerald-700 text-white shadow-sm' : 'text-slate-400 hover:text-slate-700 hover:bg-slate-100' }}" id="tab-profil" onclick="switchProfilTab('profil')">
                Profil Yayasan
            </button>
            <button class="px-4 py-2 rounded-lg text-sm font-bold transition-all duration-200 {{ $tab === 'pendiri' ? 'bg-emerald-700 text-white shadow-sm' : 'text-slate-400 hover:text-slate-700 hover:bg-slate-100' }}" id="tab-pendiri" onclick="switchProfilTab('pendiri')">
                Pendiri & Pengurus
                    <span class="ml-1.5 px-2 py-0.5 rounded-full text-xs {{ $tab === 'pendiri' ? 'bg-emerald-600 text-emerald-100' : 'bg-slate-200 text-slate-500' }}">{{ $pendiris->total() }}</span>
            </button>
        </div>

        {{-- ══════════════════════════════
             TAB 1: PROFIL YAYASAN
        ══════════════════════════════ --}}
        <div id="panel-profil" class="tab-panel {{ $tab !== 'profil' ? 'hidden' : '' }}">
            <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- CARD 1: Info Dasar --}}
                <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 mb-5 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center text-base shrink-0">
                            <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                        </div>
                        <div>
                            <p class="font-extrabold text-sm text-slate-800">Informasi Dasar</p>
                            <p class="text-xs text-slate-400">Nama, kontak, logo, dan alamat yayasan</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Nama Yayasan</span></label>
                                <input type="text" name="nama_yayasan" class="input input-bordered w-full focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required
                                       value="{{ old('nama_yayasan', $profil?->nama_yayasan) }}" placeholder="Yayasan Baitul Yatim">
                                @error('nama_yayasan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Email Resmi</span></label>
                                <input type="email" name="email" class="input input-bordered w-full focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required
                                       value="{{ old('email', $profil?->email) }}" placeholder="info@yayasan.org">
                                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">No. Telepon / WhatsApp</span></label>
                                <input type="text" name="no_telp" class="input input-bordered w-full focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required
                                       value="{{ old('no_telp', $profil?->no_telp) }}" placeholder="08123456789">
                                @error('no_telp') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Logo Yayasan</span></label>
                                <div class="relative">
                                    <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50/50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" for="logo-input">
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
                            <textarea name="alamat" rows="2" class="textarea textarea-bordered w-full focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required placeholder="Jl. Kebaikan No. 1, Kota...">{{ old('alamat', $profil?->alamat) }}</textarea>
                            @error('alamat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- CARD 2: Sejarah, Visi, Misi --}}
                <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 mb-5 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                                        </div>
                        <div>
                            <p class="font-extrabold text-sm text-slate-800">Sejarah, Visi & Misi</p>
                            <p class="text-xs text-slate-400">Narasi dan arah gerak yayasan</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="form-control mb-4">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Sejarah / Deskripsi Yayasan</span></label>
                            <textarea name="sejarah_yayasan" rows="5" class="textarea textarea-bordered w-full focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required placeholder="Ceritakan bagaimana yayasan ini berdiri dan berkembang…">{{ old('sejarah_yayasan', $profil?->sejarah_yayasan) }}</textarea>
                            @error('sejarah_yayasan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Visi</span></label>
                                <textarea name="visi" rows="4" class="textarea textarea-bordered w-full focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required placeholder="Menjadi lembaga amanah…">{{ old('visi', $profil?->visi) }}</textarea>
                                @error('visi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Misi <span class="font-normal normal-case text-emerald-400">(gunakan Enter untuk poin baru)</span></span></label>
                                <textarea name="misi" rows="4" class="textarea textarea-bordered w-full focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required placeholder="• Memberikan pendidikan terbaik&#10;• Mengelola amanah dengan transparan">{{ old('misi', $profil?->misi) }}</textarea>
                                @error('misi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD 4: Berkas Visual --}}
                <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 mb-5 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center text-base shrink-0">
                            <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/></svg>
                        </div>
                        <div>
                            <p class="font-extrabold text-sm text-slate-800">Berkas Resmi & Transparansi</p>
                            <p class="text-xs text-slate-400">Dokumen legalitas dan bagan struktur organisasi</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Surat Legalitas Resmi <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                                <div class="relative">
                                    <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50/50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" for="legalitas-input">
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
                                    <label class="flex items-center gap-2 p-3 border-2 border-dashed border-emerald-300 rounded-xl bg-emerald-50/50 cursor-pointer hover:border-emerald-500 hover:bg-emerald-100 transition-all" for="struktur-input">
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
                    <a href="{{ route('admin.profil.index') }}" class="btn btn-ghost font-bold text-slate-600">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                        Batal
                    </a>
                    <button type="submit" class="btn bg-emerald-700 hover:bg-emerald-800 text-white border-0 font-bold rounded-lg shadow-sm">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>

        {{-- ══════════════════════════════
             TAB 2: PENDIRI & PENGURUS
        ══════════════════════════════ --}}
        <div id="panel-pendiri" class="tab-panel {{ $tab !== 'pendiri' ? 'hidden' : '' }}">

            {{-- Daftar pendiri saat ini --}}
            <div id="pendiri-list-wrap" class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center text-base shrink-0">
                            <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                        </div>
                    <div>
                        <p class="font-extrabold text-sm text-slate-800">Daftar Pendiri Saat Ini</p>
                        <p class="text-xs text-slate-400">{{ $pendiris->count() }} orang terdaftar dan tampil di halaman publik</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                        @forelse($pendiris as $pendiri)
                            <div class="group bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden hover:shadow-md hover:border-emerald-200 transition-all duration-200">
                                <div class="px-5 pt-5 pb-0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center gap-4">
                                            @if($pendiri->foto)
                                                <img src="{{ asset('storage/' . $pendiri->foto) . '?v=' . now()->timestamp }}" class="w-14 h-14 rounded-xl object-cover shadow-sm ring-2 ring-emerald-100" alt="{{ $pendiri->nama }}">
                                            @else
                                                <div class="w-14 h-14 rounded-xl bg-emerald-700 text-white font-extrabold text-lg flex items-center justify-center shadow-sm">{{ strtoupper(substr($pendiri->nama, 0, 1)) }}</div>
                                            @endif
                                            <div>
                                                <p class="font-bold text-sm text-slate-800">{{ $pendiri->nama }}</p>
                                                <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full mt-1 border border-emerald-200">{{ $pendiri->jabatan }}</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-1" x-data="{ editOpen: false, open: false }">
                                            <button type="button" @click="editOpen = true" class="btn btn-ghost btn-sm btn-circle text-slate-300 hover:text-emerald-600 hover:bg-emerald-50 opacity-0 group-hover:opacity-100 transition-all" title="Edit">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </button>
                                            <form action="{{ route('admin.pendiri.destroy', $pendiri->id) }}" method="POST" @submit.prevent="open = true">
                                                @csrf @method('DELETE')
                                                <button type="button" @click="deleteOpen = true" class="btn btn-ghost btn-sm btn-circle text-slate-300 hover:text-red-500 hover:bg-red-50 opacity-0 group-hover:opacity-100 transition-all" title="Hapus">
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                                                </button>
                                                <x-confirm-delete-modal entity-name="{{ $pendiri->nama }}" entity-type="pengurus" />
                                            </form>

                                            {{-- Modal Edit Pendiri --}}
                                            <dialog class="modal" :class="{ 'modal-open': editOpen }">
                                                <div class="modal-box max-w-lg p-0 overflow-hidden">
                                                    <form action="{{ route('admin.pendiri.update', $pendiri->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf @method('PUT')
                                                        <div class="px-6 pt-6 pb-4 border-b border-slate-100 flex items-center justify-between">
                                                            <div>
                                                                <h3 class="text-base font-black text-slate-800">Edit Pendiri</h3>
                                                                <p class="text-xs text-slate-400 mt-0.5">Perbarui data pendiri atau pengurus</p>
                                                            </div>
                                                            <button type="button" @click="editOpen = false" class="btn btn-ghost btn-sm btn-circle">
                                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-5 h-5" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                                            </button>
                                                        </div>
                                                        <div class="p-6 space-y-4">
                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                <div class="form-control">
                                                                    <label class="label"><span class="label-text font-bold text-emerald-700 text-xs">Nama Lengkap</span></label>
                                                                    <input type="text" name="nama" class="input input-bordered w-full input-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required value="{{ $pendiri->nama }}">
                                                                </div>
                                                                <div class="form-control">
                                                                    <label class="label"><span class="label-text font-bold text-emerald-700 text-xs">Jabatan</span></label>
                                                                    <input type="text" name="jabatan" class="input input-bordered w-full input-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required value="{{ $pendiri->jabatan }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-control">
                                                                <label class="label"><span class="label-text font-bold text-emerald-700 text-xs">Kata Sambutan</span></label>
                                                                <textarea name="deskripsi" rows="2" class="textarea textarea-bordered w-full text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200">{{ $pendiri->deskripsi }}</textarea>
                                                            </div>
                                                            <div class="form-control">
                                                                <label class="label"><span class="label-text font-bold text-emerald-700 text-xs">Urutan Tampil</span></label>
                                                                <input type="number" name="urutan" class="input input-bordered w-full input-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" value="{{ $pendiri->urutan ?? 0 }}" min="0">
                                                            </div>
                                                            <div class="form-control">
                                                                <label class="label"><span class="label-text font-bold text-emerald-700 text-xs">Foto <span class="font-normal normal-case text-emerald-400">(biarkan kosong jika tidak diganti)</span></span></label>
                                                                <input type="file" name="foto" class="file-input file-input-bordered w-full input-sm" accept="image/*">
                                                            </div>
                                                        </div>
                                                        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-end gap-3 bg-slate-50">
                                                            <button type="button" @click="editOpen = false" class="btn btn-ghost btn-sm font-semibold text-slate-600">Batal</button>
                                                            <button type="submit" class="btn bg-emerald-700 text-white hover:bg-emerald-800 btn-sm font-semibold border-0 shadow-sm">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <form method="dialog" class="modal-backdrop"><button @click="editOpen = false">close</button></form>
                                            </dialog>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-5 pb-5 pt-3">
                                    @if($pendiri->deskripsi)
                                        <div class="bg-slate-50 rounded-lg p-3 border border-slate-200">
                                            <svg class="w-3 h-3 text-slate-400 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151C7.546 6.068 5.983 8.789 5.983 11H10v10H0z"/></svg>
                                            <p class="text-xs text-slate-500 italic leading-relaxed">"{{ $pendiri->deskripsi }}"</p>
                                        </div>
                                    @else
                                        <div class="bg-slate-50 rounded-lg p-3 border border-slate-200">
                                            <p class="text-xs text-slate-400 italic">Tidak ada kata sambutan</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12 border-2 border-dashed border-slate-300 rounded-xl bg-slate-50">
                                <div class="text-4xl mb-3 opacity-30">
                                    <svg class="w-12 h-12 mx-auto text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                                </div>
                                <p class="font-bold text-slate-700">Belum Ada Data Pendiri</p>
                                <p class="text-sm text-slate-400 mt-1">Tambahkan pendiri pertama lewat form di bawah.</p>
                            </div>
                        @endforelse
                    </div>
                    <div id="pendiri-pagination" class="pendiri-ajax-pagination mt-6">
                        {{ $pendiris->links() }}
                    </div>
                </div>
            </div>

            {{-- Form tambah pendiri --}}
            <form action="{{ route('admin.pendiri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.04)] border border-slate-200 overflow-hidden mb-10">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center text-base shrink-0">➕</div>
                        <div>
                            <p class="font-extrabold text-sm text-slate-800">Tambah Pendiri Baru</p>
                            <p class="text-xs text-slate-400">Lengkapi data berikut untuk menambahkan pendiri atau pengurus baru</p>
                        </div>
                    </div>
                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Nama Lengkap</span></label>
                                <input type="text" name="nama" class="input input-bordered w-full focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required value="{{ old('nama') }}" placeholder="Nama lengkap">
                                @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-bold text-emerald-700">Jabatan</span></label>
                                <input type="text" name="jabatan" class="input input-bordered w-full focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required value="{{ old('jabatan') }}" placeholder="Ketua Yayasan">
                                @error('jabatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-emerald-700">Kata Sambutan <span class="font-normal normal-case text-emerald-400">(Opsional)</span></span></label>
                            <textarea name="deskripsi" rows="3" class="textarea textarea-bordered w-full focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" placeholder="Kata sambutan singkat…">{{ old('deskripsi') }}</textarea>
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
                            <button type="reset" class="btn btn-outline btn-sm border-slate-300 text-slate-600 hover:bg-slate-100" onclick="document.getElementById('pendiri-foto-label').textContent='Pilih foto pendiri'">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 109-9 9.75 9.75 0 00-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                                Reset
                            </button>
                            <button type="submit" class="btn bg-emerald-700 hover:bg-emerald-800 text-white btn-sm border-0 shadow-sm">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                                Tambah Pendiri
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

    <script>
    function switchProfilTab(tab) {
        const tabs = ['profil', 'pendiri'];
        tabs.forEach(t => {
            const btn = document.getElementById('tab-' + t);
            btn.classList.toggle('bg-emerald-700', t === tab);
            btn.classList.toggle('text-white', t === tab);
            btn.classList.toggle('shadow-sm', t === tab);
            btn.classList.toggle('text-slate-400', t !== tab);
            btn.classList.toggle('hover:text-slate-700', t !== tab);
            btn.classList.toggle('hover:bg-slate-100', t !== tab);
            document.getElementById('panel-' + t).classList.toggle('hidden', t !== tab);
        });
        const url = new URL(window.location);
        url.searchParams.set('tab', tab);
        window.history.replaceState({}, '', url);
    }

    @if($errors->has('nama') || $errors->has('jabatan') || $errors->has('foto'))
        document.addEventListener('DOMContentLoaded', () => switchProfilTab('pendiri'));
    @endif

    (function() {
        function initAjaxPagination() {
            document.addEventListener('click', function(e) {
                const link = e.target.closest('#pendiri-pagination a');
                if (!link) return;
                e.preventDefault();
                const url = link.href;
                const wrap = document.getElementById('pendiri-list-wrap');
                if (!wrap) return;
                wrap.innerHTML = '<div class="flex items-center justify-center py-12"><span class="loading loading-spinner loading-md text-emerald-700"></span></div>';
                fetch(url)
                    .then(r => {
                        if (!r.ok) throw new Error();
                        return r.text();
                    })
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newWrap = doc.getElementById('pendiri-list-wrap');
                        const oldWrap = document.getElementById('pendiri-list-wrap');
                        if (newWrap && oldWrap) {
                            const parent = oldWrap.parentNode;
                            parent.replaceChild(newWrap, oldWrap);
                            if (window.Alpine) Alpine.initTree(newWrap);
                            window.history.pushState({}, '', url);
                        } else {
                            window.location.href = url;
                        }
                    })
                    .catch(() => { window.location.href = url; });
            });
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAjaxPagination);
        } else {
            initAjaxPagination();
        }
    })();
    </script>
</x-admin-layout>
