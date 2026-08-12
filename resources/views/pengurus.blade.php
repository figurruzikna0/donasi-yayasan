<!-- ============================================ -->
<!-- pengurus.blade.php - HALAMAN PENGURUS YAYASAN -->
<!-- ============================================ -->
<!-- Peran: halaman publik yang menampilkan daftar pengurus/pendiri yayasan dalam bentuk kartu. -->
<!-- Data berasal dari variabel $daftarPendiri (koleksi pengurus) yang dikirim oleh controller route 'pengurus', dan $profil (nama yayasan) dari view composer. -->
<!-- Alur: menampilkan navbar publik, breadcrumb, judul seksi, grid kartu pengurus (foto atau inisial nama), lalu footer. -->
<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengurus Yayasan - {{ $profil?->nama_yayasan ?? 'Baitul Yatim' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" data-theme="baitul">

    {{-- NAVBAR --}}
    <!-- Navbar publik (partial); link "Tentang Kami" pada menu mengarah ke halaman publik masing-masing -->
    @include('partials.public-navbar')

    <!-- Komponen breadcrumb: Beranda > Profil Yayasan > Pengurus -->
    <x-breadcrumb :items="['Profil Yayasan' => route('profil'), 'Pengurus' => '']" />

    {{-- PENGURUS --}}
    <!-- Seksi daftar pengurus: header seksi lalu grid kartu pengurus -->
    <section class="py-20 lg:py-28 px-4 bg-base-200">
        <div class="max-w-7xl mx-auto">
            <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs uppercase tracking-[0.2em] font-bold px-4 py-1.5 rounded-full bg-primary/10 text-primary inline-block mb-3">Struktur Manajemen</span>
                <h2 class="text-3xl md:text-4xl font-black text-base-content tracking-tight">Pengurus Yayasan</h2>
                <p class="text-base-content/60 mt-2 text-sm">Amanah dan berdedikasi tinggi demi kemaslahatan para mustahik.</p>
            </div>

            <!-- Kondisi if: jika daftar pengurus tidak kosong, tampilkan grid kartu; jika kosong tampilkan pesan "belum dimasukkan" -->
            @if($daftarPendiri->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    <!-- foreach: iterasi setiap pengurus untuk dirender menjadi satu kartu -->
                    @foreach($daftarPendiri as $person)
                        <!-- php: membuat inisial nama dari huruf depan tiap kata (mengabaikan gelar seperti H, Hj, Dr, Kh) dan memilih warna latar avatar secara acak-deterministik via crc32 -->
                        @php
                            $words = explode(' ', $person->nama);
                            $initials = '';
                            foreach ($words as $w) {
                                $w = trim(preg_replace('/[^a-zA-Z0-9.]/', '', $w));
                                if (strlen($w) === 0) continue;
                                if (!in_array(strtolower($w), ['kh', 'dr', 'h', 'hj', 'ba', 'sag', 'spd', 'spdi', 'ssosi', 'shi', 'ssy', 'se', 'skom', 'amkep', 'mag', 'mpd', 'm'])) {
                                    $initials .= strtoupper(substr($w, 0, 1));
                                }
                                if (strlen($initials) >= 2) break;
                            }
                            if (strlen($initials) === 0) $initials = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $person->nama), 0, 2)) ?: '?';
                            if (strlen($initials) === 1) $initials = $initials . ' ';
                            $bgShade = ['bg-brand-600','bg-brand-700','bg-brand-800','bg-brand-500','bg-brand-950'];
                            $bgColor = $bgShade[crc32($person->nama) % count($bgShade)];
                        @endphp
                        <!-- Kartu pengurus: avatar bulat berisi inisial (karena tidak ada foto di data publik), nama, jabatan, dan deskripsi (jika ada) -->
                        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 40 }}" class="bg-white rounded-xl border border-base-300 p-5 text-center flex flex-col items-center hover:border-primary/30 transition-all">
                            <div class="w-16 h-16 rounded-full {{ $bgColor }} flex items-center justify-center text-white font-bold text-lg mb-3 shadow-sm flex-shrink-0 leading-none">{{ $initials }}</div>
                            <h3 class="text-sm font-bold text-base-content leading-snug">{{ $person->nama }}</h3>
                            <span class="inline-block mt-1.5 text-[11px] font-semibold text-primary bg-primary/10 px-2.5 py-1 rounded-md">{{ $person->jabatan }}</span>
                            <!-- Kondisi if: deskripsi singkat pengurus hanya dirender jika terisi -->
                            @if($person->deskripsi)
                                <p class="text-xs text-base-content/40 italic leading-relaxed border-t border-base-200 mt-3 pt-3">"{{ $person->deskripsi }}"</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Blok else: state kosong ketika belum ada data pengurus -->
                <div class="text-center py-12 text-sm text-base-content/40 border border-dashed rounded-xl max-w-md mx-auto">
                    Daftar pengurus yayasan belum dimasukkan oleh admin.
                </div>
            @endif
        </div>
    </section>

    <!-- Footer publik (partial) -->
    @include('partials.footer')

    <!-- Skrip AOS: animasi scroll untuk elemen dengan atribut data-aos -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true, offset: 40 });</script>
</body>
</html>
