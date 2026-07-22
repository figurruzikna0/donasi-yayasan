<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 shadow-inner mb-3 mx-auto flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
        </div>
        <h1 class="text-xl font-bold text-emerald-800">Verifikasi Email</h1>
        <p class="text-sm text-emerald-500">Konfirmasi alamat email Anda</p>
    </div>

    <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-sm text-emerald-700">
        Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang telah kami kirimkan. Jika tidak menerima email, kami akan dengan senang hati mengirimkan ulang.
    </div>

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-success text-white font-bold rounded-xl px-6 py-2.5 text-sm shadow-sm hover:shadow-md transition-all">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="link link-hover text-sm text-emerald-600 font-semibold">
                Keluar
            </button>
        </form>
    </div>
</x-guest-layout>
