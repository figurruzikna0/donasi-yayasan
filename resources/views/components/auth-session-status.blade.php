<!-- ============================================ -->
<!-- components/auth-session-status.blade.php - STATUS SESSION AUTH -->
<!-- ============================================ -->
<!-- Peran: komponen notifikasi sukses untuk halaman auth (login/register) yang dipanggil sebagai x-auth-session-status, menampilkan pesan status dari session. -->
<!-- Data: prop 'status' berisi teks pesan (biasanya berasal dari session('status')); komponen hanya dirender jika status terisi. -->
<!-- Alur: jika $status ada, muncul kartu notifikasi hijau dengan ikon centang dan tombol tutup; otomatis menghilang setelah 5 detik dengan progress bar yang menyusut. -->
@props(['status'])

<!-- if: komponen tidak menampilkan apa pun jika variabel status kosong -->
@if ($status)
    <!-- State Alpine.js 'show': notifikasi tampil lalu otomatis ditutup setelah 5000 ms -->
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 5000)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-3"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-250"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="relative w-full bg-emerald-50 dark:bg-emerald-950/60 border-2 border-emerald-200 dark:border-emerald-800 rounded-2xl shadow-lg shadow-emerald-500/20 overflow-hidden">
        <!-- Garis aksen hijau di tepi kiri notifikasi -->
        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-emerald-500"></div>
        <div class="relative pl-6 pr-4 py-3.5">
            <div class="flex items-start gap-3">
                <!-- Ikon centang sukses -->
                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/60 flex items-center justify-center flex-shrink-0 text-emerald-600 dark:text-emerald-300 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex-1 pt-0.5">
                    <!-- Judul dan isi pesan status yang dikirim prop $status -->
                    <p class="text-sm font-bold text-emerald-900 dark:text-emerald-100">Berhasil</p>
                    <p class="text-xs text-emerald-700 dark:text-emerald-300 mt-0.5 leading-relaxed">{{ $status }}</p>
                </div>
                <!-- Tombol tutup notifikasi secara manual -->
                <button @click="show = false" class="flex-shrink-0 w-7 h-7 rounded-lg hover:bg-black/5 dark:hover:bg-white/10 flex items-center justify-center text-slate-400 hover:text-slate-600 transition-all -mr-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
        <!-- Progress bar bawah: menyusut dari 100% ke 0% selama 5 detik sebagai penanda waktu auto-dismiss -->
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-black/5">
            <div class="h-full rounded-full bg-emerald-500 transition-all duration-[5000ms] ease-linear" style="width: 100%" x-init="$el.style.width = '0%'"></div>
        </div>
    </div>
@endif